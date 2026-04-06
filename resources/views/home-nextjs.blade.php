<!DOCTYPE html>
<html lang="en" class="smooth-scroll">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>TS Language School — Premium Language Learning</title>
    <meta name="description" content="Master French and German with expert instructors, premium courses, and proven results. DELF/DALF preparation and certification pathways."/>
    
    <!-- Next.js Fonts and CSS -->
    <link rel="preload" href="{{ asset('nextjs/static/media/4cf2300e9c8272f7-s.p.woff2') }}" as="font" crossorigin type="font/woff2"/>
    <link rel="preload" href="{{ asset('nextjs/static/media/93f479601ee12b01-s.p.woff2') }}" as="font" crossorigin type="font/woff2"/>
    <link rel="stylesheet" href="{{ asset('nextjs/static/css/83e42a7554e71d14.css') }}"/>
    
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" sizes="16x16"/>
    
    <style>
        /* Fix asset paths for fonts */
        @font-face {
            font-family: 'Geist';
            src: url('{{ asset("nextjs/static/media/4cf2300e9c8272f7-s.p.woff2") }}') format('woff2');
            font-weight: 100 900;
            font-display: swap;
        }
        
        @font-face {
            font-family: 'Geist Mono';
            src: url('{{ asset("nextjs/static/media/93f479601ee12b01-s.p.woff2") }}') format('woff2');
            font-weight: 100 900;
            font-display: swap;
        }
    </style>
</head>
<body class="__variable_188709 __variable_9a8899 antialiased bg-white text-neutral-900">

<!-- Header -->
<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-xl border-b border-black/10 smooth-scroll">
    <div class="mx-auto max-w-[980px] px-6 h-11 flex items-center justify-between text-xs">
        <a class="text-[#1d1d1f] font-medium tracking-tight hover:text-black transition-colors" href="{{ route('home') }}">
            📚 TS Language School
        </a>
        
        <nav class="hidden md:flex items-center gap-8" aria-label="Primary">
            <a class="text-[#1d1d1f] hover:text-black transition-colors" href="#about">About</a>
            <a class="text-[#1d1d1f] hover:text-black transition-colors" href="{{ route('courses.index') }}">Courses</a>
            <a class="text-[#1d1d1f] hover:text-black transition-colors" href="#exams">Exams</a>
            <a class="text-[#1d1d1f] hover:text-black transition-colors" href="#media">Media</a>
            <a class="text-[#1d1d1f] hover:text-black transition-colors" href="#certification">Certification</a>
            <a class="text-[#1d1d1f] hover:text-black transition-colors" href="#membership">Membership</a>
            <a class="text-[#1d1d1f] hover:text-black transition-colors" href="#contact">Contact</a>
        </nav>
        
        <div class="hidden md:flex items-center gap-4">
            @auth
                @if(auth()->user()->role === 'student')
                    <a class="text-[#1d1d1f] hover:text-black transition-colors" href="{{ route('student.dashboard') }}">Dashboard</a>
                @elseif(auth()->user()->role === 'teacher')
                    <a class="text-[#1d1d1f] hover:text-black transition-colors" href="{{ route('teacher.dashboard') }}">Dashboard</a>
                @elseif(auth()->user()->role === 'admin')
                    <a class="text-[#1d1d1f] hover:text-black transition-colors" href="{{ route('admin.dashboard') }}">Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-[#007AFF] text-white rounded-full px-4 py-1.5 text-xs font-medium hover:bg-[#0056CC] transition-colors">
                        Sign Out
                    </button>
                </form>
            @else
                <a class="text-[#1d1d1f] hover:text-black transition-colors" href="{{ route('login') }}">Sign In</a>
                <a class="bg-[#007AFF] text-white rounded-full px-4 py-1.5 text-xs font-medium hover:bg-[#0056CC] transition-colors" href="{{ route('register') }}">Get Started</a>
            @endauth
        </div>
        
        <button class="md:hidden w-8 h-8 flex items-center justify-center" aria-label="Toggle Menu" onclick="toggleMobileMenu()">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
</header>

<!-- Mobile Menu (Hidden by default) -->
<div id="mobileMenu" class="hidden md:hidden bg-white border-b border-black/10 px-6 py-4">
    <nav class="flex flex-col gap-4">
        <a class="text-[#1d1d1f] hover:text-black transition-colors" href="#about">About</a>
        <a class="text-[#1d1d1f] hover:text-black transition-colors" href="{{ route('courses.index') }}">Courses</a>
        <a class="text-[#1d1d1f] hover:text-black transition-colors" href="#exams">Exams</a>
        <a class="text-[#1d1d1f] hover:text-black transition-colors" href="#media">Media</a>
        <a class="text-[#1d1d1f] hover:text-black transition-colors" href="#certification">Certification</a>
        <a class="text-[#1d1d1f] hover:text-black transition-colors" href="#membership">Membership</a>
        <a class="text-[#1d1d1f] hover:text-black transition-colors" href="#contact">Contact</a>
        <hr class="border-black/10">
        @auth
            @if(auth()->user()->role === 'student')
                <a class="text-[#1d1d1f] hover:text-black transition-colors" href="{{ route('student.dashboard') }}">Dashboard</a>
            @elseif(auth()->user()->role === 'teacher')
                <a class="text-[#1d1d1f] hover:text-black transition-colors" href="{{ route('teacher.dashboard') }}">Dashboard</a>
            @elseif(auth()->user()->role === 'admin')
                <a class="text-[#1d1d1f] hover:text-black transition-colors" href="{{ route('admin.dashboard') }}">Admin</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-[#1d1d1f] hover:text-black transition-colors">Sign Out</button>
            </form>
        @else
            <a class="text-[#1d1d1f] hover:text-black transition-colors" href="{{ route('login') }}">Sign In</a>
            <a class="bg-[#007AFF] text-white rounded-full px-4 py-2 text-center text-xs font-medium hover:bg-[#0056CC] transition-colors" href="{{ route('register') }}">Get Started</a>
        @endauth
    </nav>
</div>

<main>
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative overflow-hidden min-h-screen flex items-center apple-mesh-gradient">
            <div class="apple-floating-shapes">
                <div class="floating-shape"></div>
                <div class="floating-shape"></div>
                <div class="floating-shape"></div>
            </div>
            
            <div class="mx-auto max-w-[980px] px-6 text-center w-full relative z-10">
                <div class="mb-8">
                    <h1 class="apple-text-large text-[#1d1d1f] mb-6">
                        Master Languages.<br/>
                        <span class="bg-gradient-to-r from-[#007AFF] to-[#5856D6] bg-clip-text text-transparent">Beautifully simple.</span>
                    </h1>
                </div>
                
                <p class="apple-text-body text-[#86868b] max-w-[640px] mx-auto mb-12">
                    Experience language learning reimagined. Master French and German with premium courses, expert guidance, and certification pathways designed for real progress.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a class="bg-[#007AFF] text-white rounded-full px-8 py-3 text-[17px] font-medium hover:bg-[#0056CC] transition-all duration-300 shadow-lg hover:shadow-xl" href="{{ route('courses.index') }}">
                        Explore French Courses
                    </a>
                    <a class="border border-[#007AFF] text-[#007AFF] rounded-full px-8 py-3 text-[17px] font-medium hover:bg-[#007AFF] hover:text-white transition-all duration-300" href="#orientation-test">
                        Take Orientation Test
                    </a>
                </div>
                
                <div class="mt-20 mx-auto max-w-2xl">
                    <div class="relative w-full h-80 flex items-center justify-center">
                        <!-- SVG Animation Placeholder -->
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="text-6xl">🎓</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-gradient-to-r from-[#007AFF]/10 to-[#5856D6]/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-gradient-to-r from-[#5856D6]/10 to-[#007AFF]/10 rounded-full blur-3xl"></div>
            </div>
            
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#f5f5f7]/20 to-[#f5f5f7] pointer-events-none"></div>
        </section>

        <!-- Features Section -->
        <section class="bg-[#f5f5f7] py-32 relative overflow-hidden apple-subtle-pattern">
            <div class="apple-geometric-bg absolute inset-0"></div>
            
            <div class="mx-auto max-w-[980px] px-6 relative z-10">
                <div class="text-center mb-20">
                    <h2 class="apple-text-medium text-[#1d1d1f] mb-6">Designed for excellence.</h2>
                    <p class="text-[21px] text-[#86868b] max-w-[640px] mx-auto">
                        Every detail crafted to accelerate your learning journey.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-black/5 hover:shadow-2xl transition-all duration-500 relative group overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#007AFF]/10 to-[#5856D6]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10">
                            <div class="text-4xl mb-6">🎯</div>
                            <h3 class="text-[24px] font-semibold text-[#1d1d1f] mb-4 tracking-tight">Expert-Led</h3>
                            <p class="text-[17px] text-[#86868b] leading-relaxed">
                                Learn from native speakers with years of teaching experience in French and German.
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-black/5 hover:shadow-2xl transition-all duration-500 relative group overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#5856D6]/10 to-[#AF52DE]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10">
                            <div class="text-4xl mb-6">✨</div>
                            <h3 class="text-[24px] font-semibold text-[#1d1d1f] mb-4 tracking-tight">Elegant Experience</h3>
                            <p class="text-[17px] text-[#86868b] leading-relaxed">
                                Beautiful, intuitive interface that makes learning feel effortless and enjoyable.
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-black/5 hover:shadow-2xl transition-all duration-500 relative group overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#AF52DE]/10 to-[#007AFF]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10">
                            <div class="text-4xl mb-6">🏆</div>
                            <h3 class="text-[24px] font-semibold text-[#1d1d1f] mb-4 tracking-tight">Exam Ready</h3>
                            <p class="text-[17px] text-[#86868b] leading-relaxed">
                                Comprehensive preparation for French (TCF, DELF, DALF) and German (Goethe, telc) certifications.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
                <div class="absolute top-1/4 -left-32 w-64 h-64 bg-gradient-to-r from-[#007AFF]/5 to-transparent rounded-full blur-3xl"></div>
                <div class="absolute bottom-1/4 -right-32 w-64 h-64 bg-gradient-to-l from-[#5856D6]/5 to-transparent rounded-full blur-3xl"></div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="bg-white py-32 relative apple-gradient-bg">
            <div class="absolute inset-0 apple-subtle-pattern opacity-30"></div>
            
            <div class="mx-auto max-w-[980px] px-6 relative z-10">
                <div class="text-center mb-20">
                    <h2 class="apple-text-medium text-[#1d1d1f] mb-6">Trusted by learners worldwide.</h2>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-[#007AFF] mb-2">10K+</div>
                        <div class="text-[17px] text-[#86868b]">Active Students</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-[#007AFF] mb-2">95%</div>
                        <div class="text-[17px] text-[#86868b]">Success Rate</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-[#007AFF] mb-2">50+</div>
                        <div class="text-[17px] text-[#86868b]">Expert Teachers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-[#007AFF] mb-2">15+</div>
                        <div class="text-[17px] text-[#86868b]">Countries</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-gradient-to-b from-[#f5f5f7] to-white py-32 relative overflow-hidden apple-mesh-gradient">
            <div class="absolute inset-0 apple-geometric-bg opacity-50"></div>
            <div class="apple-floating-shapes opacity-60">
                <div class="floating-shape" style="width:200px;height:200px;top:20%;left:10%"></div>
                <div class="floating-shape" style="width:150px;height:150px;bottom:30%;right:15%"></div>
            </div>
            
            <div class="mx-auto max-w-[980px] px-6 text-center relative z-20">
                <h2 class="apple-text-medium text-[#1d1d1f] mb-6">Ready to begin your journey?</h2>
                <p class="text-[21px] text-[#86868b] mb-12 max-w-[640px] mx-auto">
                    Join thousands of learners who have mastered languages with our premium approach.
                </p>
                <a class="inline-block bg-[#1d1d1f] text-white rounded-full px-12 py-4 text-[17px] font-medium hover:bg-black transition-all duration-300 shadow-lg hover:shadow-2xl" href="{{ route('register') }}">
                    Get Started Today
                </a>
            </div>
            
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-[#007AFF]/5 to-[#5856D6]/5 rounded-full blur-3xl"></div>
            </div>
        </section>
    </div>
</main>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}
</script>

</body>
</html>

