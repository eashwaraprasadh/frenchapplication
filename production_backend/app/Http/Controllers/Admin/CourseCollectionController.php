<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCollection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CourseCollectionController extends Controller
{
    public function options(): JsonResponse
    {
        $all = CourseCollection::all(['id','name','parent_collection_id'])->toArray();

        // Build maps
        $parentMap = [];
        $nameMap = [];
        $childrenMap = [];
        foreach ($all as $c) {
            $parentMap[$c['id']] = $c['parent_collection_id'];
            $nameMap[$c['id']] = $c['name'];
            $childrenMap[$c['parent_collection_id'] ?? 0][] = $c['id'];
        }

        // Build path for each collection
        $options = [];
        foreach ($all as $c) {
            $options[] = [
                'id' => $c['id'],
                'name' => $c['name'],
                'path' => $this->buildPath($c['id'], $parentMap, $nameMap),
            ];
        }
        usort($options, fn($a,$b) => strcmp($a['path'], $b['path']));

        return response()->json([
            'success' => true,
            'root' => [ 'id' => null, 'name' => 'Root', 'path' => 'Root' ],
            'options' => $options,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_collection_id' => 'nullable|exists:course_collections,id',
        ]);

        $collection = CourseCollection::create([
            'name' => $validated['name'],
            'parent_collection_id' => $validated['parent_collection_id'] ?? null,
            'order_index' => 0,
            'status' => 'active',
        ]);

        return response()->json([
            'success' => true,
            'collection' => $collection,
        ]);
    }

    private function buildPath(int $id, array $parentMap, array $nameMap): string
    {
        $parts = [];
        $curr = $id;
        while ($curr) {
            $parts[] = $nameMap[$curr] ?? ('#'.$curr);
            $curr = $parentMap[$curr] ?? null;
        }
        $parts = array_reverse($parts);
        return 'Root / ' . implode(' / ', $parts);
    }
}

