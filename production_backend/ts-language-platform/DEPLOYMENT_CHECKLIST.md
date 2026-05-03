# HOSTINGER DEPLOYMENT CHECKLIST

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
- Teacher: teacher@gmail.com / teacher123