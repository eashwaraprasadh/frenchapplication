<?php
/**
 * Hostinger Deployment Preparation Script
 * Run this script to prepare your Laravel app for Hostinger deployment
 */

echo "🚀 PREPARING TS LANGUAGE PLATFORM FOR HOSTINGER DEPLOYMENT\n";
echo "=========================================================\n\n";

// Step 1: Copy production environment file
echo "📋 Step 1: Preparing environment file...\n";
if (file_exists('.env.production')) {
    copy('.env.production', '.env.hostinger');
    echo "✅ Created .env.hostinger from .env.production\n";
    echo "⚠️  IMPORTANT: Update database credentials in .env.hostinger before uploading!\n\n";
} else {
    echo "❌ .env.production not found. Creating template...\n";
    
    $envContent = 'APP_NAME="TS Language Learning Platform"
APP_ENV=production
APP_KEY=base64:EK9PZXkFkkJcwRziXFBZsvBstvO0SiI04T1rdplWcNQ=
APP_DEBUG=false
APP_URL=https://yourdomain.com

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

LOG_CHANNEL=stack
LOG_LEVEL=error

# UPDATE THESE WITH YOUR HOSTINGER DATABASE CREDENTIALS
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_ts_language
DB_USERNAME=u123456789_ts_user
DB_PASSWORD=your_hostinger_db_password

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
CACHE_STORE=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=your_email@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"';

    file_put_contents('.env.hostinger', $envContent);
    echo "✅ Created .env.hostinger template\n";
    echo "⚠️  IMPORTANT: Update all credentials in .env.hostinger!\n\n";
}

// Step 2: Create .htaccess file for public_html
echo "📋 Step 2: Creating .htaccess file...\n";
$htaccessContent = '<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

# Security Headers
<IfModule mod_headers.c>
    Header always set X-Content-Type-Options nosniff
    Header always set X-Frame-Options DENY
    Header always set X-XSS-Protection "1; mode=block"
</IfModule>

# File Upload Limits
php_value upload_max_filesize 100M
php_value post_max_size 100M
php_value max_execution_time 300
php_value max_input_time 300
php_value memory_limit 256M';

file_put_contents('.htaccess.hostinger', $htaccessContent);
echo "✅ Created .htaccess.hostinger file\n\n";

// Step 3: Create storage link script
echo "📋 Step 3: Creating storage link script...\n";
$storageLinkScript = '<?php
/**
 * Create storage link for Hostinger
 * Upload this file to public_html and run it once
 */

$target = "../storage/app/public";
$link = "storage";

if (is_link($link)) {
    unlink($link);
    echo "Removed existing storage link.<br>";
}

if (symlink($target, $link)) {
    echo "✅ Storage link created successfully!<br>";
    echo "You can now delete this file.";
} else {
    echo "❌ Failed to create storage link.<br>";
    echo "Please create it manually or contact support.";
}
?>';

file_put_contents('create_storage_link.php', $storageLinkScript);
echo "✅ Created create_storage_link.php\n\n";

// Step 4: Create deployment checklist
echo "📋 Step 4: Creating deployment checklist...\n";
$checklistContent = '# HOSTINGER DEPLOYMENT CHECKLIST

## BEFORE UPLOADING:
- [ ] Update .env.hostinger with your Hostinger database credentials
- [ ] Export your database to database_export.sql
- [ ] Test the application locally one more time

## HOSTINGER SETUP:
- [ ] Create MySQL database in Hostinger control panel
- [ ] Import database_export.sql via phpMyAdmin
- [ ] Set PHP version to 8.1 or 8.2
- [ ] Enable required PHP extensions

## FILE UPLOAD:
- [ ] Upload all Laravel files to public_html (except public folder contents)
- [ ] Upload public folder contents directly to public_html
- [ ] Rename .env.hostinger to .env
- [ ] Upload .htaccess.hostinger as .htaccess
- [ ] Upload create_storage_link.php to public_html

## PERMISSIONS:
- [ ] Set storage/ folder to 755
- [ ] Set bootstrap/cache/ folder to 755
- [ ] Set artisan file to 755

## FINAL STEPS:
- [ ] Run create_storage_link.php in browser
- [ ] Test website functionality
- [ ] Test login with admin/student/teacher accounts
- [ ] Test file uploads
- [ ] Delete create_storage_link.php

## LOGIN CREDENTIALS:
- Admin: admin@gmail.com / admin123
- Student: student@gmail.com / student123  
- Teacher: teacher@gmail.com / teacher123';

file_put_contents('DEPLOYMENT_CHECKLIST.md', $checklistContent);
echo "✅ Created DEPLOYMENT_CHECKLIST.md\n\n";

// Step 5: Show summary
echo "🎉 PREPARATION COMPLETE!\n";
echo "========================\n\n";
echo "Files created:\n";
echo "- .env.hostinger (update with your database credentials)\n";
echo "- .htaccess.hostinger (upload as .htaccess to public_html)\n";
echo "- create_storage_link.php (run once on Hostinger)\n";
echo "- DEPLOYMENT_CHECKLIST.md (follow this step by step)\n\n";

echo "📖 Next steps:\n";
echo "1. Read HOSTINGER_DEPLOYMENT_GUIDE.md for detailed instructions\n";
echo "2. Update .env.hostinger with your Hostinger database credentials\n";
echo "3. Export your database\n";
echo "4. Follow the deployment guide step by step\n\n";

echo "🔗 Useful links:\n";
echo "- Hostinger Control Panel: https://hpanel.hostinger.com\n";
echo "- phpMyAdmin: Available in your Hostinger control panel\n\n";

echo "✅ Ready for deployment to Hostinger!\n";
?>
