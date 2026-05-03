<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Hostinger Specific Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file contains settings specific to Hostinger hosting
    | environment to ensure optimal performance and compatibility.
    |
    */

    'file_uploads' => [
        'max_size' => env('UPLOAD_MAX_SIZE', 10240), // 10MB in KB
        'allowed_image_types' => explode(',', env('ALLOWED_IMAGE_TYPES', 'jpg,jpeg,png,gif,webp')),
        'allowed_audio_types' => explode(',', env('ALLOWED_AUDIO_TYPES', 'mp3,wav,ogg')),
        'allowed_video_types' => explode(',', env('ALLOWED_VIDEO_TYPES', 'mp4,webm,avi')),
    ],

    'platform' => [
        'timezone' => env('PLATFORM_TIMEZONE', 'UTC'),
        'default_language' => env('DEFAULT_LANGUAGE', 'french'),
        'enable_registration' => env('ENABLE_REGISTRATION', true),
        'require_email_verification' => env('REQUIRE_EMAIL_VERIFICATION', true),
    ],

    'performance' => [
        // Optimize for shared hosting
        'cache_views' => true,
        'cache_config' => true,
        'cache_routes' => true,
        'optimize_autoloader' => true,
    ],

    'security' => [
        // Enhanced security for production
        'force_https' => env('APP_ENV') === 'production',
        'secure_cookies' => env('APP_ENV') === 'production',
        'csrf_protection' => true,
    ],

    'database' => [
        // Hostinger MySQL optimizations
        'strict_mode' => false,
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'engine' => 'InnoDB',
    ],

    'mail' => [
        // Hostinger email settings
        'default_from' => env('MAIL_FROM_ADDRESS', 'noreply@example.com'),
        'default_name' => env('MAIL_FROM_NAME', 'TS Language Platform'),
    ],
];
