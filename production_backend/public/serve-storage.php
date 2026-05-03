<?php
// Get the requested file path
$path = isset($_GET['file']) ? $_GET['file'] : '';

// Security: prevent directory traversal
if (strpos($path, '..') !== false || strpos($path, '//') !== false) {
    http_response_code(403);
    exit('Forbidden');
}

// Build the full file path
$file = __DIR__ . '/../storage/app/public/' . $path;

// Check if file exists
if (!file_exists($file) || !is_file($file)) {
    http_response_code(404);
    exit('Not Found');
}

// Get file extension
$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

// Set appropriate content type
$mimeTypes = [
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif',
    'mp3' => 'audio/mpeg',
    'mp4' => 'video/mp4',
    'wav' => 'audio/wav',
    'webm' => 'video/webm',
    'ogg' => 'audio/ogg',
];

$contentType = $mimeTypes[$ext] ?? 'application/octet-stream';

// Set headers
header('Content-Type: ' . $contentType);
header('Content-Length: ' . filesize($file));
header('Cache-Control: public, max-age=31536000');
header('Pragma: public');

// Output file
readfile($file);
