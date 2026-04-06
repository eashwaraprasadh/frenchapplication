<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function checkUploadLimits(Request $request)
    {
        return response()->json([
            'post_max_size' => ini_get('post_max_size'),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time'),
            'content_length' => $request->server('CONTENT_LENGTH'),
            'content_type' => $request->header('Content-Type'),
            'request_method' => $request->method(),
        ]);
    }
}

