<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseFolder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FolderController extends Controller
{
    /**
     * Store a newly created folder
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'parent_folder_id' => 'nullable|exists:course_folders,id'
        ]);

        try {
            $folder = CourseFolder::create([
                'name' => $request->name,
                'description' => $request->description,
                'course_id' => $request->course_id,
                'parent_folder_id' => $request->parent_folder_id,
                'order_index' => $this->getNextOrderIndex($request->course_id, $request->parent_folder_id)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Folder created successfully',
                'folder' => $folder
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating folder: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified folder
     */
    public function destroy(CourseFolder $folder): JsonResponse
    {
        try {
            // Check if folder has content
            $hasContent = $folder->subfolders()->count() > 0 ||
                         $folder->lessons()->count() > 0 ||
                         $folder->tests()->count() > 0;

            if ($hasContent) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete folder that contains content. Please move or delete the content first.'
                ], 400);
            }

            $folder->delete();

            return response()->json([
                'success' => true,
                'message' => 'Folder deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting folder: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show a single folder (for editing)
     */
    public function show(CourseFolder $folder): JsonResponse
    {
        return response()->json([
            'success' => true,
            'folder' => $folder
        ]);
    }

    /**
     * Update an existing folder (rename/edit)
     */
    public function update(Request $request, CourseFolder $folder): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        try {
            $folder->update([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Folder updated successfully',
                'folder' => $folder
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating folder: ' . $e->getMessage()
            ], 500);
        }
    }
    /**
     * Get list of valid destination folders for moving a folder within a course
     * Excludes the folder itself and all of its descendants
     */
    public function moveOptions(\App\Models\Course $course, CourseFolder $folder): JsonResponse
    {
        // Get all folders for the course
        $all = CourseFolder::where('course_id', $course->id)
            ->get(['id','name','parent_folder_id']);

        // Build maps for quick lookup
        $parentMap = [];
        $nameMap = [];
        $childrenMap = [];
        foreach ($all as $f) {
            $parentMap[$f->id] = $f->parent_folder_id;
            $nameMap[$f->id] = $f->name;
            $childrenMap[$f->parent_folder_id ?? 0][] = $f->id; // use 0 for null root
        }

        // Collect descendants of the current folder to exclude
        $excludeIds = $this->getDescendantIdsFor($folder->id, $childrenMap);
        $excludeIds[$folder->id] = true; // also exclude itself

        // Build options excluding invalid destinations
        $options = [];
        foreach ($all as $f) {
            if (isset($excludeIds[$f->id])) continue;
            $options[] = [
                'id' => $f->id,
                'name' => $f->name,
                'path' => $this->buildPath($f->id, $parentMap, $nameMap),
            ];
        }

        // Sort options by path for nicer UX
        usort($options, function ($a, $b) {
            return strcmp($a['path'], $b['path']);
        });

        return response()->json([
            'success' => true,
            'root' => [ 'id' => null, 'name' => 'Root', 'path' => 'Root' ],
            'options' => $options,
        ]);
    }

    /**
     * Move a folder under another folder (or to root)
     */
    public function move(Request $request, CourseFolder $folder): JsonResponse
    {
        $validated = $request->validate([
            'destination_folder_id' => 'nullable|exists:course_folders,id',
        ]);

        $destId = $validated['destination_folder_id'] ?? null;

        // No-op if destination is the same as current parent
        if (($folder->parent_folder_id ?? null) === ($destId ? (int)$destId : null)) {
            return response()->json([
                'success' => true,
                'message' => 'Folder already in selected location',
            ]);
        }

        // Cannot move into itself
        if ($destId && (int)$destId === (int)$folder->id) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot move a folder into itself.',
            ], 400);
        }

        // Validate same course and not into a descendant
        if ($destId) {
            $dest = CourseFolder::findOrFail($destId);
            if ($dest->course_id !== $folder->course_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Destination folder is in a different course.',
                ], 400);
            }

            // Build children map for descendant check
            $all = CourseFolder::where('course_id', $folder->course_id)
                ->get(['id','parent_folder_id']);
            $childrenMap = [];
            foreach ($all as $f) {
                $childrenMap[$f->parent_folder_id ?? 0][] = $f->id;
            }
            $desc = $this->getDescendantIdsFor($folder->id, $childrenMap);
            if (isset($desc[(int)$destId])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot move a folder into one of its own subfolders.',
                ], 400);
            }
        }

        // Move and set order to the end among new siblings
        $folder->parent_folder_id = $destId ? (int)$destId : null;
        $folder->order_index = $this->getNextOrderIndex($folder->course_id, $folder->parent_folder_id);
        $folder->save();

        return response()->json([
            'success' => true,
            'message' => 'Folder moved successfully',
            'folder' => $folder,
        ]);
    }

    /**
     * Helper: collect descendant ids (as a set) using a children adjacency map
     * $childrenMap is keyed by parent_id (use 0 for null)
     */
    private function getDescendantIdsFor(int $rootId, array $childrenMap): array
    {
        $result = [];
        $stack = [$rootId];
        while (!empty($stack)) {
            $current = array_pop($stack);
            $kids = $childrenMap[$current] ?? [];
            foreach ($kids as $kid) {
                if (!isset($result[$kid])) {
                    $result[$kid] = true;
                    $stack[] = $kid;
                }
            }
        }
        return $result;
    }

    /**
     * Helper: build path like "Parent / Child / Subchild" for display
     */
    private function buildPath(int $id, array $parentMap, array $nameMap): string
    {
        $parts = [];
        $current = $id;
        while ($current) {
            $parts[] = $nameMap[$current] ?? (string)$current;
            $current = $parentMap[$current] ?? null;
        }
        $parts = array_reverse($parts);
        return 'Root / ' . implode(' / ', $parts);
    }



    /**
     * Get the next order index for a folder
     */
    private function getNextOrderIndex(int $courseId, ?int $parentFolderId): int
    {
        $maxOrder = CourseFolder::where('course_id', $courseId)
            ->where('parent_folder_id', $parentFolderId)
            ->max('order_index');

        return ($maxOrder ?? 0) + 1;
    }
}
