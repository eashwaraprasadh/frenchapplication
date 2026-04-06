# Static Pages Export Guide

This guide explains how to export Next.js pages as static HTML and integrate them with Laravel.

## ✅ What's Been Built

Your Next.js project has been successfully built with the following static pages:

- **Homepage** (`/`) - Main landing page
- **About** (`/about`) - About TS Language School
- **Media Library** (`/media-library`) - Learning resources
- **Certification** (`/certification`) - Certification programs
- **Contact** (`/contact`) - Contact form and information
- **Membership** (`/membership`) - Pricing and membership plans

## 📁 Build Output

After running `npm run build`, Next.js generates:

```
.next/
├── static/
│   ├── chunks/
│   │   ├── app/
│   │   │   ├── page.js (homepage)
│   │   │   ├── about/page.js
│   │   │   ├── media-library/page.js
│   │   │   ├── certification/page.js
│   │   │   ├── contact/page.js
│   │   │   └── membership/page.js
│   │   └── [other chunks]
│   └── [other static files]
└── [other directories]
```

## 🔄 Integration with Laravel

### Option 1: Serve Static HTML Files

1. **Build the Next.js project:**
   ```bash
   npm run build
   ```

2. **Copy static assets to Laravel:**
   ```bash
   cp -r .next/static/chunks/app/* public/pages/
   cp -r public/uploads/* public/uploads/
   ```

3. **Create Laravel routes:**
   ```php
   // routes/web.php
   Route::get('/', function () {
       return file_get_contents(public_path('pages/page.html'));
   });
   
   Route::get('/about', function () {
       return file_get_contents(public_path('pages/about/page.html'));
   });
   
   Route::get('/media-library', function () {
       return file_get_contents(public_path('pages/media-library/page.html'));
   });
   
   Route::get('/certification', function () {
       return file_get_contents(public_path('pages/certification/page.html'));
   });
   
   Route::get('/contact', function () {
       return file_get_contents(public_path('pages/contact/page.html'));
   });
   
   Route::get('/membership', function () {
       return file_get_contents(public_path('pages/membership/page.html'));
   });
   ```

### Option 2: Use Next.js as Microservice

Keep Next.js running separately and proxy requests from Laravel:

```php
// routes/web.php
Route::get('/{path?}', function ($path = '') {
    $response = Http::get('http://localhost:3000/' . $path);
    return $response->body();
})->where('path', '.*');
```

### Option 3: Full Static Export (Recommended)

1. **Enable static export in next.config.ts:**
   ```typescript
   const nextConfig: NextConfig = {
     output: 'export',
     trailingSlash: true,
     images: { unoptimized: true },
     // ... other config
   }
   ```

2. **Build and export:**
   ```bash
   npm run build
   ```

3. **Copy the `out/` directory to Laravel:**
   ```bash
   cp -r out/* public/
   ```

4. **Configure Laravel to serve static files:**
   ```php
   // routes/web.php
   Route::fallback(function () {
       $path = request()->path();
       $file = public_path($path . '.html');
       
       if (file_exists($file)) {
           return file_get_contents($file);
       }
       
       return abort(404);
   });
   ```

## 🚀 Deployment Steps

### For Static HTML Integration:

1. **Build Next.js:**
   ```bash
   npm run build
   ```

2. **Copy to Laravel public directory:**
   ```bash
   mkdir -p public/static-pages
   cp -r .next/static/* public/static-pages/
   ```

3. **Update Laravel routes to serve these files**

4. **Deploy Laravel application**

### For Full Static Export:

1. **Update next.config.ts** to enable `output: 'export'`

2. **Build:**
   ```bash
   npm run build
   ```

3. **Copy output:**
   ```bash
   cp -r out/* /path/to/laravel/public/
   ```

4. **Deploy**

## 📊 Build Statistics

```
Route                    Size      First Load JS
─────────────────────────────────────────────────
/                        3.36 kB   150 kB
/about                   2.2 kB    142 kB
/media-library           2.2 kB    142 kB
/certification           2.3 kB    142 kB
/contact                 2.8 kB    143 kB
/membership              2.96 kB   143 kB
```

## 🔗 Navigation Links

All pages include navigation to:
- About
- Courses (dropdown)
- Exams (dropdown)
- Media
- Certification
- Membership
- Contact
- Sign In / Get Started buttons

## 🎨 Styling

All pages use:
- **Tailwind CSS** for styling
- **Framer Motion** for animations
- **Apple-inspired design** with clean typography
- **Responsive design** for all devices

## 📱 Responsive Breakpoints

- Mobile: < 768px
- Tablet: 768px - 1024px
- Desktop: > 1024px

## ⚙️ Environment Variables

Make sure to set these in your `.env.local`:

```
NEXT_PUBLIC_API_URL=http://localhost:3000
JWT_SECRET=your-secret-key
DB_USER=your-db-user
DB_PASSWORD=your-db-password
DB_NAME=your-db-name
```

## 🐛 Troubleshooting

### Build fails with API route errors
- API routes cannot be exported as static
- Use `output: 'export'` only if you don't need API routes
- Or keep API routes separate and proxy from Laravel

### Styles not loading
- Ensure Tailwind CSS is properly configured
- Check that CSS files are being copied to public directory
- Verify CSS imports in layout.tsx

### Images not displaying
- Use `unoptimized: true` in next.config.ts
- Ensure image paths are relative to public directory

## 📚 Additional Resources

- [Next.js Static Export Docs](https://nextjs.org/docs/advanced-features/static-html-export)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Framer Motion Documentation](https://www.framer.com/motion/)

## ✨ Next Steps

1. ✅ Build the Next.js project
2. ✅ Test pages locally
3. ✅ Copy static files to Laravel
4. ✅ Configure Laravel routes
5. ✅ Deploy to production

---

**Last Updated:** October 20, 2024
**Next.js Version:** 15.5.4
**Build Status:** ✅ Successful

