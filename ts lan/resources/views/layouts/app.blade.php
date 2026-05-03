<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TS Language School')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (use Vite for Laravel) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js for interactive components like mobile menu -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Lucide Icons script for Vanilla JS usage (if not using blade icons pkg) -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="font-sans text-slate-800 bg-slate-50 antialiased flex flex-col min-h-screen">

    @include('components.navbar')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('components.footer')

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/1234567890" target="_blank" rel="noreferrer" class="fixed bottom-6 right-6 flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-white shadow-lg hover:scale-110 hover:bg-green-600 transition-transform duration-300 z-50 transform hover:-translate-y-1">
        <i data-lucide="message-circle" class="h-8 w-8"></i>
    </a>

    <script>
      // Initialize Lucide icons
      lucide.createIcons();
    </script>
</body>
</html>
