<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
