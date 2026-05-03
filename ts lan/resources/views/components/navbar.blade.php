<header x-data="{ open: false }" 
        class="fixed top-0 w-full z-40 transition-colors duration-300 h-16 flex items-center bg-white border-b border-slate-200 shrink-0">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-full">
            
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-blue-900 flex items-center justify-center rounded-sm">
                    <i data-lucide="book-open" class="h-6 w-6 text-white"></i>
                </div>
                <span class="font-bold text-xl tracking-tight text-blue-900">TS Language School</span>
            </a>
            
            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
                <a href="{{ route('home') }}" class="transition-colors {{ request()->routeIs('home') ? 'text-blue-600' : 'text-slate-700 hover:text-blue-600' }}">Home</a>
                <a href="{{ route('about') }}" class="transition-colors {{ request()->routeIs('about') ? 'text-blue-600' : 'text-slate-700 hover:text-blue-600' }}">About</a>
                <a href="{{ route('courses') }}" class="transition-colors {{ request()->routeIs('courses') ? 'text-blue-600' : 'text-slate-700 hover:text-blue-600' }}">Courses</a>
                <a href="{{ route('contact') }}" class="transition-colors {{ request()->routeIs('contact') ? 'text-blue-600' : 'text-slate-700 hover:text-blue-600' }}">Contact</a>
            </nav>

            <!-- Desktop CTA -->
            <div class="hidden md:flex items-center">
                <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-5 py-2 rounded-sm font-semibold hover:bg-blue-700 transition-colors shadow-sm">
                    Apply Now
                </a>
            </div>

            <!-- Mobile Hamburger -->
            <button @click="open = !open" 
                    class="md:hidden p-2 transition-colors text-slate-900 flex items-center">
                <i x-show="!open" data-lucide="menu" class="h-6 w-6"></i>
                <i x-show="open" data-lucide="x" class="h-6 w-6" style="display: none;"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" 
         style="display: none;" 
         class="md:hidden absolute top-full left-0 w-full bg-white shadow-sm border-t border-slate-100 py-4 px-4 flex flex-col gap-4 text-slate-900">
        
        <a href="{{ route('home') }}" class="font-medium p-2 rounded-sm transition-colors {{ request()->routeIs('home') ? 'bg-slate-50 text-blue-600' : 'hover:text-blue-600' }}">Home</a>
        <a href="{{ route('about') }}" class="font-medium p-2 rounded-sm transition-colors {{ request()->routeIs('about') ? 'bg-slate-50 text-blue-600' : 'hover:text-blue-600' }}">About</a>
        <a href="{{ route('courses') }}" class="font-medium p-2 rounded-sm transition-colors {{ request()->routeIs('courses') ? 'bg-slate-50 text-blue-600' : 'hover:text-blue-600' }}">Courses</a>
        <a href="{{ route('contact') }}" class="font-medium p-2 rounded-sm transition-colors {{ request()->routeIs('contact') ? 'bg-slate-50 text-blue-600' : 'hover:text-blue-600' }}">Contact</a>
        
        <a href="{{ route('contact') }}" class="bg-blue-600 text-white text-center px-5 py-2 rounded-sm font-semibold hover:bg-blue-700 mt-2">Apply Now</a>
    </div>
</header>
