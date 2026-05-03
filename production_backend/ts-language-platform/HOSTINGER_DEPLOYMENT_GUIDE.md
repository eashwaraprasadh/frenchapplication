# 🚀 HOSTINGER DEPLOYMENT GUIDE
## TS Language Learning Platform

### 📋 **STEP 1: PREPARE DATABASE EXPORT**

1. **Export your local database:**
```bash
# From your local project directory
mysqldump -u root -p ts_language_platform > database_export.sql
```

2. **Or use phpMyAdmin:**
   - Go to http://localhost/phpmyadmin
   - Select `ts_language_platform` database
   - Click "Export" tab
   - Choose "Quick" export method
   - Format: SQL
   - Click "Export" and save as `database_export.sql`

---

### 📋 **STEP 2: HOSTINGER SETUP**

#### **A. Create Database on Hostinger:**
1. Login to Hostinger Control Panel
2. Go to **Databases** → **MySQL Databases**
3. Click **Create Database**
4. Database Name: `u123456789_ts_language` (or similar)
5. Username: `u123456789_ts_user` (or similar)
6. Password: Create a strong password
7. **Save these credentials!**

#### **B. Import Database:**
1. Go to **phpMyAdmin** in Hostinger
2. Select your new database
3. Click **Import** tab
4. Choose your `database_export.sql` file
5. Click **Import**

---

### 📋 **STEP 3: UPLOAD FILES**

#### **A. Prepare Files for Upload:**
1. **Copy `.env.production` to `.env`**
2. **Update `.env` with Hostinger database credentials:**
```env
DB_HOST=localhost
DB_DATABASE=u123456789_ts_language
DB_USERNAME=u123456789_ts_user
DB_PASSWORD=your_hostinger_db_password
APP_URL=https://yourdomain.com
```

#### **B. Upload via File Manager:**
1. Login to Hostinger Control Panel
2. Go to **File Manager**
3. Navigate to `public_html` folder
4. **Upload these folders/files:**
   - `app/` (entire folder)
   - `bootstrap/` (entire folder)
   - `config/` (entire folder)
   - `database/` (entire folder)
   - `resources/` (entire folder)
   - `routes/` (entire folder)
   - `storage/` (entire folder)
   - `vendor/` (entire folder)
   - `artisan` (file)
   - `composer.json` (file)
   - `composer.lock` (file)
   - `.env` (file - the updated one)

5. **Upload public folder contents to public_html:**
   - Copy everything from `public/` folder to `public_html/`
   - This includes: `index.php`, `favicon.ico`, `build/`, `storage/`

---

### 📋 **STEP 4: SET PERMISSIONS**

#### **A. Set Folder Permissions:**
1. In File Manager, right-click on these folders:
   - `storage/` → Permissions → 755
   - `storage/logs/` → Permissions → 755
   - `storage/framework/` → Permissions → 755
   - `storage/app/` → Permissions → 755
   - `bootstrap/cache/` → Permissions → 755

#### **B. Set File Permissions:**
1. Right-click on `artisan` → Permissions → 755

---

### 📋 **STEP 5: CONFIGURE HOSTINGER**

#### **A. PHP Configuration:**
1. Go to **Advanced** → **PHP Configuration**
2. Set PHP Version: **8.1** or **8.2**
3. Enable these extensions:
   - `mysqli`
   - `pdo_mysql`
   - `mbstring`
   - `openssl`
   - `tokenizer`
   - `xml`
   - `ctype`
   - `json`
   - `bcmath`
   - `fileinfo`

#### **B. Create .htaccess in public_html:**
```apache
<IfModule mod_rewrite.c>
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
php_value memory_limit 256M
```

---

### 📋 **STEP 6: FINAL CONFIGURATION**

#### **A. Clear Caches (via File Manager):**
1. Delete these folders if they exist:
   - `bootstrap/cache/config.php`
   - `bootstrap/cache/routes.php`
   - `bootstrap/cache/views.php`

#### **B. Set Storage Link:**
1. Create a symbolic link from `public_html/storage` to `storage/app/public`
2. In File Manager, create folder `public_html/storage` if it doesn't exist
3. Or use this PHP script (create as `create_storage_link.php` in public_html):
```php
<?php
$target = '../storage/app/public';
$link = 'storage';

if (is_link($link)) {
    unlink($link);
}

if (symlink($target, $link)) {
    echo "Storage link created successfully!";
} else {
    echo "Failed to create storage link.";
}
?>
```

---

### 📋 **STEP 7: TEST DEPLOYMENT**

#### **A. Test Basic Functionality:**
1. Visit your domain: `https://yourdomain.com`
2. Should see the homepage
3. Test login with:
   - Admin: `admin@gmail.com` / `admin123`
   - Student: `student@gmail.com` / `student123`
   - Teacher: `teacher@gmail.com` / `teacher123`

#### **B. Test Features:**
1. **Admin Panel:** Course creation, test builder
2. **Student Portal:** Course enrollment, test taking
3. **File Uploads:** Image and audio uploads
4. **Database:** All data should be preserved

---

### 🔧 **TROUBLESHOOTING**

#### **Common Issues:**

1. **500 Internal Server Error:**
   - Check `.env` file database credentials
   - Verify folder permissions (755 for folders, 644 for files)
   - Check PHP version compatibility

2. **Database Connection Error:**
   - Verify database credentials in `.env`
   - Ensure database exists and is imported
   - Check if database user has proper permissions

3. **File Upload Issues:**
   - Check `.htaccess` upload limits
   - Verify `storage/` folder permissions
   - Ensure storage link is created

4. **CSS/JS Not Loading:**
   - Check if `public/build/` folder is uploaded
   - Verify file paths in browser developer tools
   - Clear browser cache

5. **Session Issues:**
   - Check `storage/framework/sessions/` permissions
   - Verify session configuration in `.env`

---

### 📞 **SUPPORT**

If you encounter issues:
1. Check Hostinger error logs in Control Panel
2. Enable debug mode temporarily: `APP_DEBUG=true` in `.env`
3. Check Laravel logs in `storage/logs/laravel.log`

---

### ✅ **DEPLOYMENT CHECKLIST**

- [ ] Database exported and imported
- [ ] Files uploaded to correct locations
- [ ] `.env` file configured with Hostinger credentials
- [ ] Folder permissions set (755)
- [ ] PHP extensions enabled
- [ ] `.htaccess` file created
- [ ] Storage link created
- [ ] Website accessible
- [ ] Login functionality working
- [ ] File uploads working
- [ ] All features tested

**🎉 Your TS Language Learning Platform is now live on Hostinger!**
