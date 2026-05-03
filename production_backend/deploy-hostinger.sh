#!/bin/bash

# TS Language Learning Platform - Hostinger Deployment Script
echo "Preparing TS Language Learning Platform for Hostinger deployment..."

# Step 1: Install dependencies
echo "Installing production dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

# Step 2: Install and build frontend assets
echo "Building frontend assets..."
npm install
npm run build

# Step 3: Clear all caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Step 4: Optimize for production
echo "Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Step 5: Create deployment folder
echo "Creating deployment package..."
mkdir -p deployment-package

# Step 6: Copy necessary files (excluding development files)
echo "Copying files for deployment..."
rsync -av --exclude='node_modules' \
          --exclude='.git' \
          --exclude='.env' \
          --exclude='storage/logs/*' \
          --exclude='storage/framework/cache/*' \
          --exclude='storage/framework/sessions/*' \
          --exclude='storage/framework/views/*' \
          --exclude='tests' \
          --exclude='deployment-package' \
          --exclude='deploy-hostinger.sh' \
          . deployment-package/

# Step 7: Create .env.production template
echo "Creating production environment template..."
cp .env.example deployment-package/.env.production

# Step 8: Create directory structure info
echo "Creating deployment instructions..."
cat > deployment-package/UPLOAD_INSTRUCTIONS.txt << 'EOF'
HOSTINGER UPLOAD INSTRUCTIONS:

1. Upload ALL files in this folder to your domain's public_html directory
2. Move contents of 'public' folder to the root of public_html:
   - Move public/index.php to public_html/index.php
   - Move public/css to public_html/css
   - Move public/js to public_html/js
   - Move all other public assets to root
3. Rename .env.production to .env
4. Update .env with your Hostinger database credentials
5. Set folder permissions:
   - storage/ : 755
   - bootstrap/cache/ : 755
6. Run: php artisan key:generate
7. Run: php artisan migrate --force
8. Run: php artisan db:seed --force

Your final public_html structure should be:
public_html/
├── index.php (moved from public/)
├── css/ (moved from public/)
├── js/ (moved from public/)
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env (renamed from .env.production)
├── artisan
└── composer.json
EOF

# Step 9: Create index.php with correct paths for Hostinger
echo "Creating Hostinger-compatible index.php..."
cat > deployment-package/public/index.php << 'EOF'
<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
EOF

echo "Deployment package created successfully!"
echo "Check the 'deployment-package' folder for files ready to upload to Hostinger."
echo "Follow the instructions in UPLOAD_INSTRUCTIONS.txt for proper deployment."
