@extends('layouts.app')
@section('title', 'TS Language School - Home')

@section('content')
<div class="flex flex-col min-h-screen pt-16">
    
    <!-- Limited Time Offer Banner -->
    <div class="bg-blue-600 text-white py-3 px-4 text-center text-sm font-medium relative z-20 shadow-sm">
        <span class="inline-block px-2 py-1 bg-white text-blue-600 text-xs font-bold rounded-sm mr-3">LIMITED TIME OFFER</span>
        Enroll today and get 20% off all DELF & DALF preparation courses! <a href="{{ route('contact') }}" class="underline font-bold ml-2 hover:text-blue-200 transition-colors">Claim Offer</a>
    </div>

    <!-- Hero Section -->
    <div class="relative bg-blue-950 text-white overflow-hidden">
        <!-- Background Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a?q=80&w=2070&auto=format&fit=crop" alt="Paris background" class="w-full h-full object-cover opacity-60 mix-blend-overlay" />
            <div class="absolute inset-0 bg-gradient-to-r from-blue-950 via-blue-900/90 to-blue-900/50"></div>
            
            <!-- Floating French Elements in Hero -->
            <div class="absolute top-32 right-[15%] text-7xl opacity-40 select-none grayscale animate-pulse">🗼</div>
            <div class="absolute bottom-40 left-[10%] text-6xl opacity-30 select-none grayscale animate-pulse" style="animation-delay: 1s">🥐</div>
            <div class="absolute top-1/2 right-[25%] text-6xl text-white/50 font-serif italic select-none font-bold animate-pulse" style="animation-delay: 2s">Bonjour!</div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-24 sm:py-28 lg:py-36 flex flex-col items-center text-center">
            <span class="text-blue-300 font-bold tracking-[0.2em] uppercase text-xs sm:text-sm mb-6 block drop-shadow-md">
                TS Language School
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold leading-tight mb-8 max-w-4xl drop-shadow-lg tracking-tight">
                DISCOVER THE JOY OF <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-white">LEARNING LANGUAGES</span>
            </h1>
            <p class="text-blue-100 text-lg sm:text-xl md:text-2xl mb-12 leading-relaxed max-w-3xl drop-shadow-md font-light">
                Learn Online or In-Person with Expert & Passionate Instructors. Speak confidently and discover the world from a new perspective.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 w-full sm:w-auto">
                <a href="{{ route('contact') }}" class="px-8 sm:px-10 py-4 bg-white text-blue-900 font-bold rounded-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-900/20 transition-all duration-300 text-base sm:text-lg w-full sm:w-auto text-center">
                    Start Your Language Journey Today
                </a>
                <a href="{{ route('courses') }}" class="px-8 sm:px-10 py-4 border-2 border-white/50 backdrop-blur-sm text-white font-bold rounded-sm hover:bg-white hover:text-blue-900 hover:border-white hover:-translate-y-1 transition-all duration-300 text-base sm:text-lg shadow-lg w-full sm:w-auto text-center">
                    View Our Offerings
                </a>
            </div>
        </div>
    </div>

    <!-- As Featured On -->
    <div class="bg-slate-50 py-10 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm font-semibold text-slate-500 uppercase tracking-widest mb-6">As Featured On</p>
            <div class="flex flex-wrap justify-center items-center gap-12 md:gap-20 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                <div class="text-xl font-bold flex items-center gap-2 text-slate-800"><i data-lucide="globe" class="h-6 w-6 text-blue-600"></i> Global News</div>
                <div class="text-xl font-bold flex items-center gap-2 text-slate-800"><i data-lucide="book-open" class="h-6 w-6 text-blue-600"></i> EduWeekly</div>
                <div class="text-xl font-bold flex items-center gap-2 text-slate-800"><i data-lucide="award" class="h-6 w-6 text-blue-600"></i> TopSchools</div>
                <div class="text-xl font-bold flex items-center gap-2 text-slate-800"><i data-lucide="building-2" class="h-6 w-6 text-blue-600"></i> Business Daily</div>
            </div>
        </div>
    </div>

    <!-- Let's Talk About Numbers -->
    <section class="py-24 relative bg-blue-900 border-b border-slate-200 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1502602898657-3e907a5ea82c?q=80&w=2070&auto=format&fit=crop" alt="Paris at sunset" class="w-full h-full object-cover opacity-25 mix-blend-overlay fixed" />
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-blue-300 font-semibold tracking-wide uppercase text-sm mb-2">Our Reach</h2>
            <h3 class="text-3xl md:text-5xl font-bold text-white mb-16 tracking-tight">Let's Talk About Numbers</h3>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-5xl mx-auto">
                <div class="p-8 bg-blue-950/40 backdrop-blur-md rounded-sm border border-blue-800/50 hover:-translate-y-1 hover:bg-blue-900/60 transition-all duration-300 shadow-xl group">
                    <div class="text-4xl md:text-6xl font-extrabold text-white mb-2 group-hover:scale-110 transition-transform origin-bottom">15+</div>
                    <div class="text-sm font-bold text-blue-300 uppercase tracking-wider">Years of Excellence</div>
                </div>
                <div class="p-8 bg-blue-950/40 backdrop-blur-md rounded-sm border border-blue-800/50 hover:-translate-y-1 hover:bg-blue-900/60 transition-all duration-300 shadow-xl group">
                    <div class="text-4xl md:text-6xl font-extrabold text-white mb-2 group-hover:scale-110 transition-transform origin-bottom">10k+</div>
                    <div class="text-sm font-bold text-blue-300 uppercase tracking-wider">Happy Learners</div>
                </div>
                <div class="p-8 bg-blue-950/40 backdrop-blur-md rounded-sm border border-blue-800/50 hover:-translate-y-1 hover:bg-blue-900/60 transition-all duration-300 shadow-xl group">
                    <div class="text-4xl md:text-6xl font-extrabold text-white mb-2 group-hover:scale-110 transition-transform origin-bottom">50+</div>
                    <div class="text-sm font-bold text-blue-300 uppercase tracking-wider">Expert Instructors</div>
                </div>
                <div class="p-8 bg-blue-950/40 backdrop-blur-md rounded-sm border border-blue-800/50 hover:-translate-y-1 hover:bg-blue-900/60 transition-all duration-300 shadow-xl group">
                    <div class="text-4xl md:text-6xl font-extrabold text-white mb-2 group-hover:scale-110 transition-transform origin-bottom">98%</div>
                    <div class="text-sm font-bold text-blue-300 uppercase tracking-wider">Exam Success Rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Language Offerings -->
    <section class="py-24 bg-white border-b border-slate-200 relative overflow-hidden">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="https://images.unsplash.com/photo-1549479326-8c2ce648fc1b?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-[0.04]" alt="Background pattern" />
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-blue-600 font-semibold tracking-wide uppercase text-sm mb-2">Programs</h2>
                <h3 class="text-3xl md:text-5xl font-bold text-slate-900 mb-6 tracking-tight">Our Language Offerings</h3>
                <p class="text-slate-600 text-lg">Master French with our expertly designed pathways tailored for certification and immigration requirements.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                @php
                $courses = [
                    ['id' => 'delf', 'title' => 'DELF Preparation', 'desc' => 'Levels A1 to B2. Internationally recognized French proficiency diplomas.', 'levels' => 'A1 - B2', 'price' => '$299'],
                    ['id' => 'dalf', 'title' => 'DALF Preparation', 'desc' => 'Advanced levels C1 and C2 for university admissions and professional environments.', 'levels' => 'C1 - C2', 'price' => '$349'],
                    ['id' => 'tcf', 'title' => 'TCF CANADA', 'desc' => 'Test de Connaissance du Français designed specifically for Canadian immigration.', 'levels' => 'All Levels', 'price' => '$399'],
                    ['id' => 'tef', 'title' => 'TEF CANADA', 'desc' => 'Test d’Évaluation de Français. Mandatory test for Canadian economic immigration.', 'levels' => 'All Levels', 'price' => '$399']
                ];
                @endphp

                @foreach($courses as $course)
                <div class="bg-white p-8 rounded-sm border border-slate-200 shadow-sm hover:shadow-xl hover:border-blue-500 hover:-translate-y-2 transition-all duration-300 group flex flex-col relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    
                    <div class="flex items-center justify-between mb-6 relative z-10">
                        <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-sm flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors shadow-sm">
                            <i data-lucide="book-open" class="h-7 w-7"></i>
                        </div>
                        <div class="bg-green-50 text-green-700 font-semibold px-3 py-1 rounded-sm text-sm border border-green-200 shadow-sm">
                            {{ $course['price'] }}
                        </div>
                    </div>

                    <h4 class="text-xl font-bold text-slate-900 mb-3 relative z-10">{{ $course['title'] }}</h4>
                    <p class="text-slate-600 text-sm mb-6 flex-grow relative z-10 leading-relaxed">{{ $course['desc'] }}</p>
                    <div class="flex items-center justify-between mt-auto pt-5 border-t border-slate-100 relative z-10">
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">{{ $course['levels'] }}</span>
                        <a href="{{ route('courses') }}" class="text-blue-600 font-bold text-sm hover:text-blue-800 flex items-center group/link">
                            View <i data-lucide="chevron-right" class="h-4 w-4 ml-1 transform group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center">
                <a href="{{ route('courses') }}" class="inline-block px-10 py-4 bg-blue-900 text-white font-bold rounded-sm hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-900/30 transition-all duration-300">
                    Explore All Courses
                </a>
            </div>
        </div>
    </section>

    <!-- Specialities / Age Group & App -->
    <section class="py-24 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-blue-600 font-semibold tracking-wide uppercase text-sm mb-2">Our Flex</h2>
                <h3 class="text-3xl md:text-5xl font-bold text-slate-900 mb-6 tracking-tight">Learning Built for Everyone</h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
                <div class="bg-slate-50 p-10 lg:p-12 rounded-sm border border-slate-100 hover:shadow-lg transition-shadow">
                    <h4 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-4">
                        <div class="p-3 bg-blue-100 text-blue-600 rounded flex items-center justify-center">
                            <i data-lucide="users" class="h-8 w-8"></i>
                        </div>
                        For Every Age-Group
                    </h4>
                    <p class="text-slate-600 mb-8 leading-relaxed text-lg">
                        Whether you are introducing a child to a new language, supporting a teenager through exams, or upgrading your professional skills as an adult, we have tailored curriculums designed exactly for your cognitive and developmental needs.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="h-5 w-5 text-blue-600"></i><span class="font-semibold text-slate-800">Kids Programs (Ages 6-12)</span></li>
                        <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="h-5 w-5 text-blue-600"></i><span class="font-semibold text-slate-800">Teens Prep (Ages 13-17)</span></li>
                        <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="h-5 w-5 text-blue-600"></i><span class="font-semibold text-slate-800">Adults & Professionals (18+)</span></li>
                    </ul>
                </div>

                <div class="bg-slate-50 p-10 lg:p-12 rounded-sm border border-slate-100 hover:shadow-lg transition-shadow">
                    <h4 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-4">
                        <div class="p-3 bg-blue-100 text-blue-600 rounded flex items-center justify-center">
                            <i data-lucide="graduation-cap" class="h-8 w-8"></i>
                        </div>
                        Certification & Careers
                    </h4>
                    <p class="text-slate-600 mb-8 leading-relaxed text-lg">
                        In today's globalized economy, bilingualism is your ultimate competitive edge. We don't just teach you to speak; we prepare you to officially certify your proficiency.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="h-5 w-5 text-blue-600"></i><span class="font-semibold text-slate-800">Immigration Pathways (Canada)</span></li>
                        <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="h-5 w-5 text-blue-600"></i><span class="font-semibold text-slate-800">Globally Recognised Certificates</span></li>
                        <li class="flex items-center gap-3"><i data-lucide="check-circle-2" class="h-5 w-5 text-blue-600"></i><span class="font-semibold text-slate-800">Enhanced Career Opportunities</span></li>
                    </ul>
                </div>
            </div>

            <!-- TS App Promotion Banner -->
            <div class="relative rounded-sm overflow-hidden flex flex-col md:flex-row items-center justify-between shadow-2xl bg-blue-950">
                <!-- Soft decorative background elements -->
                <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 rounded-full blur-3xl opacity-20 -mr-20 -mt-20 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white rounded-full blur-3xl opacity-10 -ml-20 -mb-20 pointer-events-none"></div>

                <div class="p-10 md:p-14 md:w-2/3 text-white relative z-10">
                    <h4 class="text-3xl md:text-4xl font-extrabold mb-4 tracking-tight">Unlock Unlimited Learning on the TS App</h4>
                    <p class="text-blue-100 text-lg mb-8 leading-relaxed font-light">
                        Practice vocabulary, interact with native speakers via text/audio, and track your certification prep progress directly from your smartphone. Learning never stops.
                    </p>
                    <div class="flex gap-4">
                        <button class="bg-white text-blue-900 px-6 max-sm:px-4 py-3 rounded-sm font-bold shadow-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300">Download for iOS</button>
                        <button class="bg-transparent border border-white/50 backdrop-blur text-white px-6 max-sm:px-4 py-3 rounded-sm font-bold hover:bg-white hover:text-blue-950 hover:-translate-y-1 transition-all duration-300">Download for Android</button>
                    </div>
                </div>
                <div class="md:w-1/3 p-10 flex justify-center items-center bg-blue-900/50 h-full w-full relative z-10 border-l border-blue-800/50">
                    <i data-lucide="smartphone" class="h-48 w-48 text-blue-300 opacity-80 animate-pulse-slow drop-shadow-2xl" stroke-width="1"></i>
                </div>
            </div>

        </div>
    </section>

    <!-- Team / Expert Instructors -->
    <section class="py-24 bg-white border-b border-slate-200 relative overflow-hidden" id="team">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="https://images.unsplash.com/photo-1550684848-fac1c5b4e853?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-[0.04]" alt="Background pattern" />
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-blue-600 font-semibold tracking-wide uppercase text-sm mb-2">Our Team</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6 tracking-tight">Learn With Expert & Passionate Instructors</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                $team = [
                    ['name' => 'Dr. Marie Dupont', 'role' => 'Head of French Department', 'img' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=800&auto=format&fit=crop'],
                    ['name' => 'Jean-Luc Tremblay', 'role' => 'TCF/TEF Examiner & Tutor', 'img' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=800&auto=format&fit=crop'],
                    ['name' => 'Sophie Martin', 'role' => 'DALF Advanced Instructor', 'img' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=800&auto=format&fit=crop']
                ];
                @endphp
                
                @foreach($team as $member)
                <div class="bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="h-64 overflow-hidden relative">
                        <img src="{{ $member['img'] }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover grayscale opacity-90 group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" />
                        <div class="absolute inset-0 bg-blue-900/20 group-hover:bg-transparent transition-colors duration-500"></div>
                    </div>
                    <div class="p-6 text-center border-t-4 border-transparent group-hover:border-blue-600 transition-colors">
                        <h4 class="text-xl font-bold text-slate-900 mb-1">{{ $member['name'] }}</h4>
                        <p class="text-blue-600 font-semibold text-sm tracking-wide">{{ $member['role'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Student Results & Certificates Section -->
    <section class="py-24 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto mb-16">
                <h2 class="text-blue-600 font-medium tracking-widest uppercase text-sm mb-2">Success Stories</h2>
                <h3 class="text-3xl md:text-5xl font-semibold text-slate-900 mb-6 tracking-tight uppercase">We Are Proud Of The Excellent Results Our Students Have Achieved</h3>
                <p class="text-slate-600 text-lg font-light">Real certificates and real scores that helped our learners secure their PR and admissions.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                $results = [
                    [
                        'testName' => "TEF", 
                        'subtitle' => "TEST D'ÉVALUATION DE FRANÇAIS",
                        'title' => "ATTESTATION DE RÉSULTATS",
                        'student' => "SHAFEEQ M.",
                        'img' => "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=200&auto=format&fit=crop",
                        'scores' => [
                            ['skill' => "Compréhension écrite", 'score' => "591", 'level' => "C1"],
                            ['skill' => "Compréhension orale", 'score' => "515", 'level' => "C1"],
                            ['skill' => "Expression écrite", 'score' => "488", 'level' => "B2"],
                            ['skill' => "Expression orale", 'score' => "472", 'level' => "B2"]
                        ]
                    ],
                    [
                        'testName' => "DELF", 
                        'subtitle' => "DIPLÔME D'ÉTUDES EN LANGUE FRANÇAISE",
                        'title' => "ATTESTATION DE RÉUSSITE",
                        'student' => "AMINA K.",
                        'img' => "https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=200&auto=format&fit=crop",
                        'scores' => [
                            ['skill' => "Compréhension de l'oral", 'score' => "22/25", 'level' => "B2"],
                            ['skill' => "Compréhension des écrits", 'score' => "24/25", 'level' => "B2"],
                            ['skill' => "Production écrite", 'score' => "20/25", 'level' => "B2"],
                            ['skill' => "Production orale", 'score' => "21/25", 'level' => "B2"]
                        ]
                    ],
                    [
                        'testName' => "TCF", 
                        'subtitle' => "TEST DE CONNAISSANCE DU FRANÇAIS",
                        'title' => "ATTESTATION DE RÉSULTATS",
                        'student' => "JASPREET S.",
                        'img' => "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=200&auto=format&fit=crop",
                        'scores' => [
                            ['skill' => "Compréhension écrite", 'score' => "545", 'level' => "C1"],
                            ['skill' => "Compréhension orale", 'score' => "447", 'level' => "B2"],
                            ['skill' => "Expression écrite", 'score' => "468", 'level' => "B2"],
                            ['skill' => "Expression orale", 'score' => "490", 'level' => "B2"]
                        ]
                    ],
                    [
                        'testName' => "DALF", 
                        'subtitle' => "DIPLÔME APPROFONDI DE LANGUE",
                        'title' => "ATTESTATION DE RÉUSSITE",
                        'student' => "SIMRAN C.",
                        'img' => "https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?q=80&w=200&auto=format&fit=crop",
                        'scores' => [
                            ['skill' => "Compréhension de l'oral", 'score' => "23/25", 'level' => "C1"],
                            ['skill' => "Compréhension des écrits", 'score' => "24/25", 'level' => "C1"],
                            ['skill' => "Production écrite", 'score' => "20/25", 'level' => "C1"],
                            ['skill' => "Production orale", 'score' => "24/25", 'level' => "C1"]
                        ]
                    ]
                ];
                @endphp

                @foreach($results as $item)
                <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-xl hover:-translate-y-2 hover:shadow-2xl hover:border-blue-300 transition-all group relative overflow-hidden flex flex-col h-[400px] cursor-pointer">
                    <!-- Watermark Logo -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] -rotate-45 pointer-events-none">
                        <div class="text-4xl font-bold text-center leading-[1]">TS<br/>LANGUAGE<br/>SCHOOL</div>
                    </div>

                    <!-- Certificate Header -->
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="text-blue-900 font-bold text-xl tracking-tighter leading-none">
                            {{ $item['testName'] }} <span class="text-[9px] mt-1 block font-medium tracking-tight text-slate-500 uppercase">{{ $item['subtitle'] }}</span>
                        </div>
                        <div class="text-right">
                            <div class="text-[8px] text-slate-400 font-bold tracking-wider">RÉPUBLIQUE FRANÇAISE</div>
                        </div>
                    </div>

                    <div class="text-center mb-5 relative z-10">
                        <h4 class="font-bold text-slate-800 text-xs tracking-widest">{{ $item['title'] }}</h4>
                        <p class="text-[8px] text-slate-500 uppercase">Au test d'évaluation de français</p>
                    </div>

                    <!-- Student Info -->
                    <div class="flex gap-3 mb-6 relative z-10">
                        <div class="w-16 h-20 bg-slate-100 flex-shrink-0 border border-slate-300 p-0.5 bg-white shadow-sm relative group-hover:border-blue-400 transition-colors">
                            <img src="{{ $item['img'] }}" class="w-full h-full object-cover grayscale mix-blend-multiply opacity-90 group-hover:grayscale-0 group-hover:mix-blend-normal transition-all" alt="{{ $item['student'] }}" />
                            <div class="absolute inset-0 ring-1 ring-inset ring-black/10"></div>
                        </div>
                        <div class="text-[9px] space-y-1.5 text-slate-600 flex-grow font-mono">
                            <div class="border-b border-slate-100 pb-1 flex justify-between"><span class="font-bold text-slate-800">Nom:</span> <span>{{ $item['student'] }}</span></div>
                            <div class="border-b border-slate-100 pb-1 flex justify-between"><span class="font-bold text-slate-800">Date:</span> <span>18 Nov 2023</span></div>
                            <div class="flex justify-between"><span class="font-bold text-slate-800">Centre:</span> <span>TS L.S.</span></div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="mt-auto border border-slate-300 rounded-sm overflow-hidden relative z-10 bg-white shadow-sm ring-1 ring-slate-900/5">
                        <table class="w-full text-[8px] sm:text-[9px] text-left border-collapse">
                            <thead class="bg-slate-100/90 border-b border-slate-300 text-slate-800 uppercase tracking-wider backdrop-blur-sm">
                                <tr>
                                    <th class="p-1.5 sm:p-2 border-r border-slate-300 font-bold">Épreuve</th>
                                    <th class="p-1.5 sm:p-2 border-r border-slate-300 text-center font-bold">Score</th>
                                    <th class="p-1.5 sm:p-2 text-center font-bold">Niv.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($item['scores'] as $score)
                                <tr class="border-b border-slate-200 last:border-0 text-slate-700 bg-white group-hover:bg-blue-50/50 transition-colors">
                                    <td class="p-1.5 sm:p-2 border-r border-slate-300 font-medium whitespace-nowrap">{{ $score['skill'] }}</td>
                                    <td class="p-1.5 sm:p-2 border-r border-slate-300 text-center font-mono font-semibold">{{ $score['score'] }}</td>
                                    <td class="p-1.5 sm:p-2 text-center font-bold text-slate-900 bg-slate-50/50 group-hover:bg-transparent">{{ $score['level'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Certified Badge -->
                    <div class="absolute top-4 right-4 bg-yellow-400 text-yellow-900 px-2 py-0.5 text-[8px] font-bold uppercase tracking-wider rounded-sm shadow-md flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-all group-hover:scale-110 z-20">
                        <i data-lucide="award" class="w-2 h-2"></i> CERTIFIED
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- WhatsApp Chat Reviews -->
    <section class="py-24 bg-white border-b border-slate-200 overflow-hidden relative">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <img src="https://images.unsplash.com/photo-1577563908411-5079b6a66019?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-5" alt="Background pattern" />
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto mb-16">
                <h2 class="text-green-600 font-medium tracking-widest uppercase text-sm mb-2">Authentic Feedback</h2>
                <h3 class="text-3xl md:text-5xl font-semibold text-slate-900 mb-6 tracking-tight uppercase">Read What TS Students Are Saying</h3>
            </div>

            <div class="flex overflow-x-auto pb-8 gap-6 snap-x hide-scrollbars no-scrollbar">
                @php
                $waChats = [
                    ['name' => "Parvi Arora", 'timeAdmin' => "09:14 AM", 'timeStudent' => "09:16 AM", 'msgAdmin' => "Bonjour Parvi ✨ We hope you had a great learning experience. Please rate your overall experience out of 5.", 'msgStudent' => "5 - Excellent! Looking forward to learning more with you."],
                    ['name' => "Gurpreet Kaur", 'timeAdmin' => "11:00 AM", 'timeStudent' => "11:10 AM", 'msgAdmin' => "Hello Gurpreet. How was your session yesterday with Chetan Sir?", 'msgStudent' => "It was amazing! ✨ The methodology is really effective, thank you! I'd rate it 5/5."],
                    ['name' => "Hardeep Kaur", 'timeAdmin' => "12:10 PM", 'timeStudent' => "12:25 PM", 'msgAdmin' => "Hi Hardeep! Please rate your overall experience with our French A1 classes.", 'msgStudent' => "5 - Excellent. I really liked the class. We will surely recommend it!"],
                    ['name' => "Turshant Kumar", 'timeAdmin' => "09:00 AM", 'timeStudent' => "09:34 AM", 'msgAdmin' => "Hello Turshant! We hope you had a fantastic learning experience during the demo session.", 'msgStudent' => "5 - Excellent! The demo was very well structured and the trainer was great."]
                ];
                $waIdx = 0;
                @endphp
                
                @foreach($waChats as $chat)
                <div class="min-w-[300px] md:min-w-[350px] bg-[#EFEAE2] flex-shrink-0 snap-center rounded-lg shadow-md border border-slate-200 overflow-hidden flex flex-col h-[500px]">
                    <!-- WA Header -->
                    <div class="bg-[#075E54] text-white p-3 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-slate-300 overflow-hidden border-2 border-[#128C7E]">
                            <img src="https://i.pravatar.cc/100?img={{ $waIdx + 10 }}" alt="Avatar" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <div class="font-semibold text-sm drop-shadow-sm">{{ $chat['name'] }}</div>
                            <div class="text-xs text-slate-200 opacity-90">online</div>
                        </div>
                    </div>
                    <!-- WA Body -->
                    <div class="p-4 flex-grow flex flex-col gap-4 overflow-y-auto relative" style="background-image: url('https://w0.peakpx.com/wallpaper/818/148/HD-wallpaper-whatsapp-background-cool-dark-green-new-theme-whatsapp.jpg'); background-size: cover; background-blend-mode: soft-light; background-color: rgba(239, 234, 226, 0.9);">
                        
                        <!-- Date Badge -->
                        <div class="self-center bg-blue-100/80 text-slate-600 text-[10px] uppercase font-bold tracking-wider px-2 py-1 rounded-md shadow-sm mb-2 backdrop-blur-sm">Today</div>

                        <div class="bg-[#DCF8C6] text-slate-800 p-3 rounded-lg rounded-tr-none self-end max-w-[85%] shadow-sm text-sm relative pb-5">
                            <p class="leading-relaxed">{{ $chat['msgAdmin'] }}</p>
                            <div class="absolute bottom-1 right-2 flex items-center gap-1 text-[10px] text-slate-500">
                                <span>{{ $chat['timeAdmin'] }}</span>
                                <i data-lucide="check-circle-2" class="w-3 h-3 text-blue-500"></i>
                            </div>
                        </div>
                        
                        <div class="bg-white text-slate-800 p-3 rounded-lg rounded-tl-none self-start max-w-[85%] shadow-sm text-sm relative pb-5 mt-2">
                            <p class="leading-relaxed whitespace-pre-wrap">{{ $chat['msgStudent'] }}</p>
                            <span class="text-[10px] text-slate-400 absolute bottom-1 right-2">{{ $chat['timeStudent'] }}</span>
                        </div>
                    </div>
                </div>
                @php $waIdx++; @endphp
                @endforeach
            </div>
        </div>
    </section>

    <!-- Video & Text Testimonials -->
    <section class="py-24 bg-blue-950 text-white relative border-y border-blue-900">
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop" alt="Students background" class="w-full h-full object-cover opacity-20 mix-blend-overlay absolute inset-0 pointer-events-none" />
            <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 pointer-events-none"></div>
            <div class="absolute bottom-0 left-1/4 w-[400px] h-[400px] bg-blue-400 rounded-full blur-[100px] opacity-10 pointer-events-none"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div class="max-w-3xl">
                    <h2 class="text-blue-400 font-semibold tracking-wide uppercase text-sm mb-2">Testimonials</h2>
                    <h3 class="text-4xl md:text-5xl font-bold tracking-tight">Student Success Stories</h3>
                </div>
                
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-6 py-3 bg-white text-blue-950 font-bold rounded-sm shadow-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300 group">
                    Submit Your Video Review
                    <i data-lucide="video" class="ml-2 w-5 h-5 text-blue-600 group-hover:scale-110 transition-transform"></i>
                </a>
            </div>

            <!-- Video Showcase Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @php
                $videos = [
                    ['name' => 'John Doe', 'course' => 'DELF B2 Success', 'img' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?q=80&w=800&auto=format&fit=crop'],
                    ['name' => 'Sarah Smith', 'course' => 'Immigration Process', 'img' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=800&auto=format&fit=crop'],
                    ['name' => 'David Chen', 'course' => 'DALF C1 Achiever', 'img' => 'https://images.unsplash.com/photo-1524508762098-fd966ffb6ef9?q=80&w=800&auto=format&fit=crop']
                ];
                @endphp
                @foreach($videos as $video)
                <div class="relative aspect-video bg-blue-900 rounded-sm overflow-hidden group cursor-pointer border border-blue-800 shadow-lg">
                    <img src="{{ $video['img'] }}" alt="{{ $video['name'] }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-950 via-blue-950/20 to-transparent"></div>
                    
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center group-hover:scale-110 group-hover:bg-white/30 transition-all shadow-xl">
                            <i data-lucide="play" class="w-8 h-8 text-white ml-1 shadow-sm"></i>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-4 left-4 right-4">
                        <h4 class="text-white font-bold drop-shadow-md text-lg">{{ $video['name'] }}</h4>
                        <p class="text-blue-200 text-sm drop-shadow-md font-medium">{{ $video['course'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Text Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                $reviews = [
                    ['name' => 'Bhumika Gupta', 'loc' => 'Toronto', 'text' => 'Scoring my desired bands in TEF Canada was crucial for my PR. The expert guidance and mock tests provided here were absolutely phenomenal.'],
                    ['name' => 'Kartik Patel', 'loc' => 'Vancouver', 'text' => 'I started from DELF A1 and am now preparing for my B2. The methodology is so interactive that learning French feels completely natural.'],
                    ['name' => 'Kanika Gill', 'loc' => 'London', 'text' => 'The flexible schedule allowed me to manage my job while studying for DALF C1. Their instructors are passionate and truly care about your success.']
                ];
                $i = 0;
                @endphp

                @foreach($reviews as $review)
                <div class="bg-blue-900/50 backdrop-blur-sm p-8 relative shadow-lg border border-blue-800/50 rounded-sm hover:-translate-y-1 transition-transform group">
                    <i data-lucide="quote" class="absolute top-6 right-6 h-12 w-12 text-blue-800 opacity-60 transform group-hover:scale-110 transition-transform"></i>
                    <div class="flex items-center gap-1 text-yellow-500 mb-6 drop-shadow-sm">
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                        <i data-lucide="star" class="h-4 w-4 fill-current"></i>
                    </div>
                    <p class="text-blue-100 italic mb-8 relative z-10 leading-relaxed font-light text-lg">
                        "{{ $review['text'] }}"
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-blue-800 border-2 border-blue-700 overflow-hidden shrink-0">
                            <img src="https://i.pravatar.cc/100?img={{ $i + 25 }}" alt="Student" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <h4 class="font-bold text-white tracking-wide">{{ $review['name'] }}</h4>
                            <span class="text-blue-400 text-sm font-medium">{{ $review['loc'] }}</span>
                        </div>
                    </div>
                </div>
                @php $i++; @endphp
                @endforeach
            </div>
        </div>
    </section>

    <!-- French Quiz Section -->
    <section class="py-24 bg-blue-50 border-y border-blue-100 relative overflow-hidden" id="french-quiz-section">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-20">
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-200 rounded-full blur-[100px] animate-[spin_20s_linear_infinite]"></div>
            <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-red-200 rounded-full blur-[100px] animate-[spin_25s_linear_infinite_reverse]"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10" id="quiz-container">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center p-3 sm:p-4 bg-white rounded-full shadow-md text-blue-600 mb-6 group cursor-pointer hover:scale-110 transition-transform">
                    <i data-lucide="flag" class="w-8 h-8 group-hover:rotate-12 transition-transform"></i>
                </div>
                <h2 class="text-blue-600 font-semibold tracking-wide uppercase text-sm mb-2">Mini Challenge</h2>
                <h3 class="text-3xl md:text-5xl font-bold text-slate-900 tracking-tight">Test Your French Knowledge</h3>
            </div>

            <div class="bg-white rounded-xl shadow-2xl border border-slate-100 overflow-hidden relative">
                <div class="h-2 w-full bg-slate-100">
                    <div id="quiz-progress" class="h-full bg-blue-500 transition-all duration-500" style="width: 0%"></div>
                </div>

                <div class="p-8 md:p-12" id="quiz-content">
                    <!-- Quiz dynamically rendered here by JS -->
                    <div class="text-center p-10"><p>Loading quiz...</p></div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questions = [
                { q: "What is the capital of France?", o: ["Lyon", "Paris", "Marseille", "Nice"], a: 1 },
                { q: "How do you say 'Hello' in French?", o: ["Au revoir", "Merci", "Bonjour", "S'il vous plaît"], a: 2 },
                { q: "Which iconic landmark was built for the 1889 World's Fair?", o: ["The Louvre", "Arc de Triomphe", "Notre-Dame", "Eiffel Tower"], a: 3 },
                { q: "What does 'Merci beaucoup' mean?", o: ["Good morning", "Thank you very much", "Excuse me", "See you later"], a: 1 },
                { q: "Which river flows through Paris?", o: ["Rhône", "Seine", "Loire", "Garonne"], a: 1 },
                { q: "What are the colors of the French flag from left to right?", o: ["Red, White, Blue", "Blue, White, Red", "White, Blue, Red", "Blue, Red, White"], a: 1 },
                { q: "What is a 'Croissant'?", o: ["A type of cheese", "A French dance", "A buttery, flaky pastry", "A French wine"], a: 2 },
                { q: "Who wrote 'Les Misérables'?", o: ["Victor Hugo", "Alexandre Dumas", "Marcel Proust", "Albert Camus"], a: 0 }
            ];
            let current = 0;
            let score = 0;
            let answered = false;

            const content = document.getElementById('quiz-content');
            const progress = document.getElementById('quiz-progress');

            function render() {
                if (current >= questions.length) {
                    progress.style.width = '100%';
                    content.innerHTML = `
                        <div class="text-center animate-fade-in">
                            <div class="text-6xl mb-6">${score === questions.length ? '🎉' : '👍'}</div>
                            <h4 class="text-3xl font-bold text-slate-900 mb-2">Quiz Complete!</h4>
                            <p class="text-xl text-slate-600 mb-8">You scored <span class="font-bold text-blue-600">${score}</span> out of <span class="font-bold">${questions.length}</span></p>
                            <button onclick="window.restartQuiz()" class="inline-flex items-center justify-center px-8 py-3 bg-blue-600 text-white font-bold rounded-sm hover:-translate-y-1 hover:shadow-lg transition-all">Try Again</button>
                        </div>
                    `;
                    return;
                }

                progress.style.width = (current / questions.length) * 100 + '%';
                const q = questions[current];
                
                let html = `
                    <div class="flex flex-col animate-fade-in">
                        <span class="text-sm font-bold text-slate-400 mb-4 uppercase tracking-widest">Question ${current + 1} of ${questions.length}</span>
                        <h4 class="text-2xl md:text-3xl font-bold text-slate-900 mb-8 leading-snug">${q.q}</h4>
                        <div class="space-y-4">
                `;

                q.o.forEach((opt, i) => {
                    html += `<button onclick="window.answerQuiz(${i})" id="opt-${i}" class="w-full text-left p-5 rounded-lg border-2 border-slate-200 hover:border-blue-400 hover:bg-blue-50 text-slate-700 transition-all font-bold flex items-center justify-between text-lg">
                        <span>${opt}</span>
                    </button>`;
                });

                html += `</div><div id="next-btn-container" class="mt-8 flex justify-end hidden">
                    <button onclick="window.nextQuestion()" class="inline-flex items-center justify-center px-6 py-3 bg-blue-900 text-white font-bold rounded-sm hover:bg-blue-800 transition-colors">
                        ${current < questions.length - 1 ? 'Next Question &rarr;' : 'View Results &rarr;'}
                    </button>
                </div></div>`;

                content.innerHTML = html;
                answered = false;
            }

            window.answerQuiz = function(idx) {
                if (answered) return;
                answered = true;
                const correct = questions[current].a;
                if (idx === correct) score++;
                
                questions[current].o.forEach((_, i) => {
                    const btn = document.getElementById('opt-'+i);
                    btn.classList.remove('border-slate-200', 'hover:border-blue-400', 'hover:bg-blue-50', 'text-slate-700');
                    if (i === correct) {
                        btn.classList.add('border-green-500', 'bg-green-50', 'text-green-800');
                        btn.innerHTML += '<i data-lucide="check-circle-2" class="w-6 h-6 text-green-500"></i>';
                    } else if (i === idx && idx !== correct) {
                        btn.classList.add('border-red-500', 'bg-red-50', 'text-red-800');
                        btn.innerHTML += '<i data-lucide="x-circle" class="w-6 h-6 text-red-500"></i>';
                    } else {
                        btn.classList.add('border-slate-200', 'bg-slate-50', 'text-slate-400', 'opacity-50');
                    }
                    btn.disabled = true;
                });
                
                if (window.lucide) window.lucide.createIcons();
                document.getElementById('next-btn-container').classList.remove('hidden');
            };

            window.nextQuestion = function() {
                current++;
                render();
                if (window.lucide) window.lucide.createIcons();
            };

            window.restartQuiz = function() {
                current = 0;
                score = 0;
                render();
            };

            render();
        });
    </script>

    <!-- France Gallery Section -->
    <section class="py-24 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                 <h2 class="text-blue-600 font-semibold tracking-wide uppercase text-sm mb-2">IMMERSION</h2>
                 <h3 class="text-4xl md:text-5xl font-semibold tracking-tight text-slate-900 mb-6">Discover France</h3>
                 <p class="text-xl text-slate-600 max-w-2xl mx-auto">Immerse yourself in French culture, art, architecture, and lifestyle.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="col-span-1 md:col-span-2 h-64 md:h-80 relative rounded-sm overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1549144511-f099e773c147?q=80&w=1200&auto=format&fit=crop" alt="Eiffel Tower, Paris" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <h4 class="text-white text-2xl font-bold tracking-tight">Paris - Tour Eiffel</h4>
                    </div>
                </div>
                <div class="col-span-1 h-64 md:h-80 relative rounded-sm overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1520939817895-060bdaf4fe1b?q=80&w=600&auto=format&fit=crop" alt="Louvre" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-opacity">
                         <h4 class="text-white text-xl font-bold tracking-tight">Musée du Louvre</h4>
                    </div>
                </div>
                <div class="col-span-1 h-64 md:h-80 relative rounded-sm overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1466096115517-bceecbfb6fde?q=80&w=600&auto=format&fit=crop" alt="French Coast" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-opacity">
                         <h4 class="text-white text-xl font-bold tracking-tight">Côte d'Azur</h4>
                    </div>
                </div>
                <div class="col-span-1 md:col-span-2 h-64 md:h-80 relative rounded-sm overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1551105953-b3dcf19e9ed8?q=80&w=1200&auto=format&fit=crop" alt="French Alps" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-opacity">
                         <h4 class="text-white text-2xl font-bold tracking-tight">Alpes Françaises</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blogs & Resources -->
    <section class="py-24 bg-slate-50 border-b border-slate-200" id="blog">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div class="max-w-2xl">
                    <h2 class="text-blue-600 font-semibold tracking-wide uppercase text-sm mb-2">Knowledge Base</h2>
                    <h3 class="text-3xl md:text-5xl font-bold text-slate-900 tracking-tight">Blogs & Resources</h3>
                </div>
                <a href="#" class="inline-flex items-center justify-center px-6 py-3 rounded-sm border-2 border-slate-300 text-slate-700 font-bold hover:bg-slate-200 hover:border-slate-400 transition-colors">
                    View All Articles
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="group cursor-pointer">
                    <div class="h-72 overflow-hidden rounded-sm mb-6 relative">
                        <img src="https://images.unsplash.com/photo-1456406644174-8ddd4cd52a06?q=80&w=800&auto=format&fit=crop" alt="Blog" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
                        <div class="absolute top-4 left-4 bg-white px-3 py-1 rounded text-xs font-bold text-blue-800 shadow-md tracking-wider">ACADEMICS</div>
                    </div>
                    <h4 class="text-2xl lg:text-3xl font-bold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors leading-snug">Role of Language Skills in Academic Success for School Students</h4>
                    <p class="text-slate-600 mb-4 line-clamp-2 text-lg leading-relaxed">Discover how early exposure to a second language dramatically improves cognitive function and academic scores across all subjects...</p>
                    <span class="text-blue-600 font-bold flex items-center group-hover:underline underline-offset-4">Read Article <i data-lucide="chevron-right" class="h-5 w-5 ml-1"></i></span>
                </div>
                <div class="group cursor-pointer">
                    <div class="h-72 overflow-hidden rounded-sm mb-6 relative">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=800&auto=format&fit=crop" alt="Blog 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
                        <div class="absolute top-4 left-4 bg-white px-3 py-1 rounded text-xs font-bold text-blue-800 shadow-md tracking-wider">CAREERS</div>
                    </div>
                    <h4 class="text-2xl lg:text-3xl font-bold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors leading-snug">Industries That Need French Language Professionals in 2024</h4>
                    <p class="text-slate-600 mb-4 line-clamp-2 text-lg leading-relaxed">From international diplomacy to tech startups in Montreal, speaking French opens doors to rapidly expanding global markets...</p>
                    <span class="text-blue-600 font-bold flex items-center group-hover:underline underline-offset-4">Read Article <i data-lucide="chevron-right" class="h-5 w-5 ml-1"></i></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Subscribe Section -->
    <section class="py-24 bg-white border-t border-slate-200">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-6 tracking-tight">Stay Updated with Exclusive Offers</h2>
            <p class="text-slate-600 text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
                Subscribe to our newsletter to receive the latest updates, language learning tips, and limited-time course discounts directly to your inbox.
            </p>
            <form class="flex flex-col sm:flex-row gap-3 max-w-xl mx-auto" action="#" method="POST">
                @csrf
                <input type="email" placeholder="Enter your email address" required class="flex-1 px-6 py-4 rounded-sm border-2 border-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-600 text-lg transition-all" />
                <button type="submit" class="bg-blue-600 text-white px-10 py-4 font-bold rounded-sm hover:bg-blue-700 hover:shadow-lg transition-all shadow-sm text-lg">
                    SUBSCRIBE
                </button>
            </form>
        </div>
    </section>

</div>
@endsection
