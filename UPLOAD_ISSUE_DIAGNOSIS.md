# File Upload 422 Error - Root Cause Analysis

## Problem
Audio files (5-10MB) are failing to upload with HTTP 422 error.

## Root Cause
**LiteSpeed Web Server Request Body Size Limit**

The server is using LiteSpeed (not Apache or Nginx), which has a built-in request body size limit that is **separate from PHP's post_max_size setting**.

### Evidence
1. ✅ Laravel is NOT receiving the request (logs are empty)
2. ✅ The 422 error is thrown by LiteSpeed, not Laravel
3. ✅ LiteSpeed is the web server (confirmed via `ps aux | grep php` showing `lsphp`)
4. ✅ PHP settings (post_max_size, upload_max_filesize) are correctly set to 256M+
5. ✅ .htaccess directives are not being applied (CloudLinux + LiteSpeed limitation)

### What We've Tried
- ❌ Updated php.ini to 3GB - not used by web server
- ❌ Updated .htaccess with php_value directives - not applied by LiteSpeed
- ❌ Removed ValidatePostSize middleware - request never reaches Laravel
- ❌ Added LimitRequestBody to .htaccess - LiteSpeed doesn't respect this

## Solution
**Contact Hostinger Support**

Ask them to increase the LiteSpeed `maxReqBodySize` configuration parameter:

```
Subject: Increase LiteSpeed Request Body Size Limit

Dear Hostinger Support,

I need to increase the maximum request body size on my LiteSpeed web server for domain: tslanguageschool.com

Current Issue:
- File uploads larger than ~2MB are failing with HTTP 422 error
- The request never reaches the PHP application
- This is a LiteSpeed server-level limit, not a PHP limit

Request:
Please increase the `maxReqBodySize` parameter in the LiteSpeed configuration to at least 100MB or 512MB.

Current Configuration:
- Server: LiteSpeed
- Domain: tslanguageschool.com
- PHP: 8.2.28
- Current post_max_size: 256M (system-wide)
- Current upload_max_filesize: 256M (system-wide)

Thank you!
```

## Technical Details

### Server Configuration
- Web Server: LiteSpeed (lsws)
- PHP: 8.2.28 (lsphp)
- Hosting: Hostinger (CloudLinux)
- System post_max_size: 256M (from /etc/php.ini)
- System upload_max_filesize: 256M (from /etc/php.ini)

### Why .htaccess Doesn't Work
- LiteSpeed doesn't fully respect Apache .htaccess directives
- CloudLinux restricts what can be overridden at the user level
- Request body size limits are enforced at the web server level, before PHP processes the request

### Why PHP Settings Don't Work
- PHP settings only apply AFTER the request reaches PHP
- LiteSpeed rejects the request BEFORE it reaches PHP
- The 422 error is thrown by LiteSpeed's HTTP handler, not by PHP or Laravel

## Current Status
✅ Application is working normally
✅ All other features are functional
❌ File uploads > ~2MB fail with 422 error

## Next Steps
1. Contact Hostinger support with the message above
2. Wait for them to increase the LiteSpeed maxReqBodySize parameter
3. Test uploads after the change is made

