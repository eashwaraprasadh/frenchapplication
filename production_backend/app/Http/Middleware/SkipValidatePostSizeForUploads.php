<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SkipValidatePostSizeForUploads
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // For upload routes, temporarily remove Content-Length to bypass ValidatePostSize
        if ($this->isUploadRoute($request)) {
            \Log::info('SkipValidatePostSizeForUploads middleware triggered', [
                'path' => $request->getPathInfo(),
                'content_length_before' => $request->server('CONTENT_LENGTH'),
            ]);

            // Store the original Content-Length
            $originalContentLength = $request->server('CONTENT_LENGTH');

            // Remove Content-Length header to bypass ValidatePostSize middleware
            // The server will still receive the file, but the middleware won't check the size
            if ($originalContentLength) {
                $request->server->remove('CONTENT_LENGTH');
                \Log::info('Content-Length removed', [
                    'content_length_after' => $request->server('CONTENT_LENGTH'),
                ]);
            }
        }

        return $next($request);
    }

    /**
     * Check if the current route is an upload route
     */
    private function isUploadRoute(Request $request): bool
    {
        $path = $request->getPathInfo();

        return str_contains($path, '/admin/files/upload') ||
               str_contains($path, '/admin/files/upload-content');
    }
}

