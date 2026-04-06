<?php
// Log all requests to a file
$logFile = '/tmp/upload-requests.log';
$logData = [
    'timestamp' => date('Y-m-d H:i:s'),
    'method' => $_SERVER['REQUEST_METHOD'],
    'path' => $_SERVER['REQUEST_URI'],
    'content_length' => $_SERVER['CONTENT_LENGTH'] ?? 'not set',
    'content_type' => $_SERVER['CONTENT_TYPE'] ?? 'not set',
    'headers' => getallheaders(),
    'files' => $_FILES,
    'post' => $_POST,
];

file_put_contents($logFile, json_encode($logData, JSON_PRETTY_PRINT) . "\n\n", FILE_APPEND);

echo json_encode(['logged' => true]);
?>

