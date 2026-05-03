<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {
        $path = request('path', '');

        // Root view: Show "Public" and "Uploads" drives
        if (empty($path)) {
            $directories = collect([
                ['name' => 'Public', 'path' => 'Public', 'type' => 'drive', 'items_count' => '-'],
                ['name' => 'Uploads', 'path' => 'Uploads', 'type' => 'drive', 'items_count' => '-'],
            ]);
            $files = collect();
            return view('admin.files.index', compact('files', 'directories', 'path'));
        }

        // Determine Disk and Relative Path
        $diskInfo = $this->resolveDisk($path);
        if (!$diskInfo) {
            return redirect()->route('admin.files.index')->with('error', 'Invalid path.');
        }

        list($disk, $relativePath) = $diskInfo;

        $files = collect();
        $directories = collect();

        // Get Directories
        $dirs = $disk->directories($relativePath);
        foreach ($dirs as $dir) {
            $directories->push([
                'name' => basename($dir),
                'path' => $path . '/' . basename($dir),
                'type' => 'directory',
                'items_count' => count($disk->files($dir))
            ]);
        }

        // Get Files
        $allFiles = $disk->files($relativePath);
        foreach ($allFiles as $file) {
            $files->push([
                'name' => basename($file),
                'path' => $path . '/' . basename($file),
                'size' => $this->formatSize($disk->size($file)),
                'modified' => date('Y-m-d H:i:s', $disk->lastModified($file)),
                'type' => strtolower(pathinfo($file, PATHINFO_EXTENSION)),
                'url' => $this->getFileUrl($path, $file)
            ]);
        }

        return view('admin.files.index', compact('files', 'directories', 'path'));
    }

    private function resolveDisk($path)
    {
        $parts = explode('/', $path, 2);
        $root = $parts[0];
        $relativePath = $parts[1] ?? '';

        if ($root === 'Public') {
            return [Storage::disk('public'), $relativePath];
        } elseif ($root === 'Uploads') {
            return [
                Storage::build([
                    'driver' => 'local',
                    'root' => base_path('storage/uploads'),
                    'url' => env('APP_URL') . '/storage/uploads',
                    'visibility' => 'public',
                ]),
                $relativePath
            ];
        }

        return null;
    }

    private function getFileUrl($path, $file)
    {
        $parts = explode('/', $path, 2);
        $root = $parts[0];

        if ($root === 'Public') {
            return Storage::disk('public')->url($parts[1] ?? $file); // Adjust logic if needed
        } elseif ($root === 'Uploads') {
            // Custom URL logic for storage/uploads based on routes/web.php
            // Route::get('/storage/uploads/{type}/{filename}
            // We need to parse strict structure or just serve via 'storage/uploads/path'
            return url('storage/uploads/' . ($parts[1] ? $parts[1] . '/' : '') . basename($file));
        }
        return '#';
    }

    public function store(Request $request)
    {
        // Check for POST size limit violation (empty request but content-length > 0)
        if (empty($request->all()) && $request->server('CONTENT_LENGTH') > 0) {
            $maxPost = ini_get('post_max_size');
            return response()->json([
                'success' => false,
                'message' => "The uploaded files exceed the server's post_max_size limit of {$maxPost}."
            ], 422);
        }

        // Check if this is a Course File upload
        if ($request->has('course_id')) {
            $request->validate([
                'files' => 'required|array',
                'files.*' => 'file|max:512000', // 500MB max
                'course_id' => 'required|exists:courses,id',
                'folder_id' => 'nullable|exists:course_folders,id',
            ]);

            $courseId = $request->input('course_id');
            $folderId = $request->input('folder_id'); // Can be 'root' or null or ID
            if ($folderId === 'root')
                $folderId = null;

            $uploadedFiles = [];
            $files = $request->file('files');

            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName();
                $filename = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getClientOriginalExtension();

                // Store in course directory
                $path = $file->storeAs("courses/{$courseId}/files", $filename, 'public');

                // Create CourseFile record
                $courseFile = \App\Models\CourseFile::create([
                    'course_id' => $courseId,
                    'folder_id' => $folderId,
                    'original_name' => $originalName,
                    'filename' => $filename,
                    'path' => $path,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'uploaded_by' => auth()->id(),
                    'downloadable' => true,
                    'viewable' => true,
                ]);

                $uploadedFiles[] = $courseFile;
            }

            return response()->json(['success' => true, 'files' => $uploadedFiles]);
        }

        // Existing generic file upload logic
        $request->validate([
            'file' => 'required|file|max:51200',
            'path' => 'required|string'
        ]);

        $path = $request->input('path');
        $diskInfo = $this->resolveDisk($path);
        if (!$diskInfo) {
            return redirect()->back()->with('error', 'Please select a folder inside Public or Uploads.');
        }

        list($disk, $relativePath) = $diskInfo;

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        if ($disk->exists($relativePath . '/' . $filename)) {
            $filename = pathinfo($filename, PATHINFO_FILENAME) . '_' . time() . '.' . $file->getClientOriginalExtension();
        }

        $disk->putFileAs($relativePath, $file, $filename);

        return redirect()->route('admin.files.index', ['path' => $path])
            ->with('success', 'File uploaded successfully.');
    }

    // Alias for route compatibility, simply calls store
    public function upload(Request $request)
    {
        return $this->store($request);
    }

    public function uploadChunk(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'chunkIndex' => 'required|integer',
            'totalChunks' => 'required|integer',
            'fileId' => 'required|string',
            'fileName' => 'required|string',
            'type' => 'required|string',
        ]);

        $file = $request->file('file');
        $chunkIndex = $request->input('chunkIndex');
        $totalChunks = $request->input('totalChunks');
        $fileId = $request->input('fileId');
        $fileName = $request->input('fileName');
        $type = $request->input('type');

        // Sanitize type
        if (!in_array($type, ['audio', 'video', 'image', 'file'])) {
            $type = 'file';
        }

        $chunkDir = storage_path('app/chunks/' . md5($fileId));

        if (!file_exists($chunkDir)) {
            mkdir($chunkDir, 0755, true);
        }

        $chunkPath = $chunkDir . '/' . $chunkIndex;
        move_uploaded_file($file->getPathname(), $chunkPath);

        // Check if all chunks are uploaded
        $chunksUploaded = 0;
        for ($i = 0; $i < $totalChunks; $i++) {
            if (file_exists($chunkDir . '/' . $i)) {
                $chunksUploaded++;
            }
        }

        if ($chunksUploaded === (int) $totalChunks) {
            // Assemble file
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            if (empty($extension)) {
                $extension = $file->getClientOriginalExtension();
            }
            $finalFilename = \Illuminate\Support\Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '-' . time() . '.' . $extension;
            $finalDir = base_path('storage/uploads/' . $type);

            if (!file_exists($finalDir)) {
                mkdir($finalDir, 0755, true);
            }

            $finalPath = $finalDir . '/' . $finalFilename;
            $out = fopen($finalPath, 'wb');

            for ($i = 0; $i < $totalChunks; $i++) {
                $chunkFile = $chunkDir . '/' . $i;
                $in = fopen($chunkFile, 'rb');
                while ($buff = fread($in, 4096)) {
                    fwrite($out, $buff);
                }
                fclose($in);
                unlink($chunkFile); // delete chunk
            }
            fclose($out);
            @rmdir($chunkDir); // remove chunk directory

            $url = url('storage/uploads/' . $type . '/' . $finalFilename);

            return response()->json([
                'success' => true,
                'url' => $url,
                'message' => 'File uploaded successfully'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Chunk uploaded'
        ]);
    }

    public function createFolder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z0-9_\-\s]+$/',
            'path' => 'required|string'
        ]);

        $path = $request->input('path');
        $diskInfo = $this->resolveDisk($path);

        if (!$diskInfo) {
            return redirect()->back()->with('error', 'Please create folders inside Public or Uploads.');
        }

        list($disk, $relativePath) = $diskInfo;
        $targetDir = ($relativePath ? $relativePath . '/' : '') . $request->name;

        if ($disk->exists($targetDir)) {
            return redirect()->back()->with('error', 'Folder already exists.');
        }

        $disk->makeDirectory($targetDir);

        return redirect()->route('admin.files.index', ['path' => $path])
            ->with('success', 'Folder created successfully.');
    }

    public function destroy(Request $request)
    {
        $path = $request->input('path');
        // Prevent deletion of Roots
        if ($path === 'Public' || $path === 'Uploads') {
            return redirect()->back()->with('error', 'Cannot delete root drives.');
        }

        $diskInfo = $this->resolveDisk($path);
        if (!$diskInfo) {
            return redirect()->back()->with('error', 'Invalid path.');
        }

        list($disk, $relativePath) = $diskInfo;

        if ($disk->exists($relativePath)) {
            try {
                $disk->deleteDirectory($relativePath); // Try folder
                if ($disk->exists($relativePath)) {
                    $disk->delete($relativePath); // Try file
                }
                return redirect()->route('admin.files.index', ['path' => dirname($path) == '.' ? '' : dirname($path)])
                    ->with('success', 'Item deleted successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Deletion failed.');
            }
        }

        return redirect()->back()->with('error', 'File or folder not found.');
    }

    /**
     * Delete a Course File by ID (AJAX)
     */
    public function destroyCourseFile(\App\Models\CourseFile $file)
    {
        try {
            // Delete from storage
            if (Storage::disk('public')->exists($file->path)) {
                Storage::disk('public')->delete($file->path);
            }

            // Delete record
            $file->delete();

            return response()->json(['success' => true, 'message' => 'File deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting file: ' . $e->getMessage()], 500);
        }
    }

    private function formatSize($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public function updateSettings(Request $request, \App\Models\CourseFile $file)
    {
        $validated = $request->validate([
            'downloadable' => 'required|boolean',
            'viewable' => 'required|boolean',
        ]);

        $file->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'File settings updated successfully.',
            'file' => $file
        ]);
    }
}
