# Hostinger Deployment Guide for TS Language Learning Platform

## Prerequisites
- Hostinger Cloud hosting account
- MySQL database created in Hostinger panel
- Domain configured and pointing to Hostinger

## Step 1: Prepare Files for Upload

### 1.1 Build Production Assets
```bash
npm install
npm run build
```

### 1.2 Optimize for Production
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Step 2: Upload Files via File Manager

### 2.1 Upload Structure
Upload ALL files to your domain's `public_html` folder via Hostinger File Manager:

```
public_html/
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
├── artisan
├── composer.json
├── composer.lock
└── public/ (contents go to public_html root)
```

### 2.2 Important: Move Public Folder Contents
Move everything from the `public/` folder to the root of `public_html/`:
- Move `public/index.php` to `public_html/index.php`
- Move `public/css/` to `public_html/css/`
- Move `public/js/` to `public_html/js/`
- Move all other public assets to root

### 2.3 Update index.php
Edit `public_html/index.php` and update the paths:

```php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
```

## Step 3: Database Configuration

### 3.1 Create MySQL Database in Hostinger Panel
1. Go to Hostinger Control Panel
2. Navigate to "Databases" → "MySQL Databases"
3. Create new database (note the database name, username, password)

### 3.2 Configure Environment
Create `.env` file in `public_html/` with your Hostinger database details:

```env
APP_NAME="TS Language Learning Platform"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_hostinger_database_name
DB_USERNAME=your_hostinger_database_username
DB_PASSWORD=your_hostinger_database_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=your_email@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="TS Language Learning Platform"
```

### 3.3 Generate Application Key
Run via SSH or create a temporary script:
```bash
php artisan key:generate
```

### 3.4 Run Database Migrations
```bash
php artisan migrate --force
php artisan db:seed --force
```

## Step 4: Set Permissions

Set proper permissions via File Manager:
- `storage/` folder: 755
- `storage/logs/` folder: 755
- `storage/framework/` folder: 755
- `bootstrap/cache/` folder: 755

## Step 5: Final Configuration

### 5.1 Clear Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### 5.2 Optimize for Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Troubleshooting

### Common Issues:
1. **500 Error**: Check `.env` file configuration and database credentials
2. **Permission Errors**: Ensure storage and bootstrap/cache folders are writable
3. **Database Connection**: Verify Hostinger database credentials
4. **Missing Assets**: Ensure public folder contents are in root directory

### File Structure Verification:
Your `public_html` should look like:
```
public_html/
├── index.php (from public folder)
├── css/ (from public folder)
├── js/ (from public folder)
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
├── artisan
└── composer.json
```

## Default Admin Account
After deployment, login with:
- Email: admin@tslanguage.com
- Password: admin123

**Important**: Change the admin password immediately after first login!
