@extends('layouts.app')
@section('title', 'TS Language School - Courses')

@section('content')
<div class="pt-24 pb-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="bg-blue-900 py-16 rounded-sm mb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Our Programs</h1>
                <p class="text-blue-100 max-w-2xl mx-auto">Find the perfect language course to advance your skills, career, and global connections.</p>
            </div>
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Example Card 1 -->
            <div class="bg-white p-6 rounded-sm shadow-sm border border-slate-200 flex flex-col justify-between group hover:border-blue-600 transition-colors">
                <div class="relative h-40 overflow-hidden rounded-sm mb-4">
                    <img src="https://images.unsplash.com/photo-1520283819898-fdadabceea48?q=80" alt="DELF" class="w-full h-full object-cover" />
                    <div class="absolute top-3 right-3 bg-white px-2 py-1 rounded text-xs font-bold text-slate-900 shadow-sm">$349</div>
                    <div class="absolute top-3 left-3 bg-blue-600 text-white px-2 py-1 rounded text-[10px] font-bold uppercase">DELF</div>
                </div>
                <div class="flex-grow flex flex-col">
                    <h4 class="text-xl font-bold text-blue-900 mb-4">DELF B2</h4>
                    <div class="flex gap-2 mb-4">
                        <div class="text-[10px] px-2 py-1 bg-slate-100 rounded-sm text-slate-600 font-semibold flex items-center gap-1">
                            <i data-lucide="clock" class="w-3 h-3"></i> 14 Weeks
                        </div>
                        <div class="text-[10px] px-2 py-1 bg-blue-50 text-blue-700 rounded-sm font-semibold flex items-center gap-1">
                            <i data-lucide="book-open" class="w-3 h-3"></i> B2
                        </div>
                    </div>
                    <div class="mt-auto pt-4 border-t border-slate-100">
                        <a href="{{ route('contact') }}" class="w-full py-2 bg-slate-100 text-slate-900 font-semibold rounded-sm group-hover:bg-blue-600 group-hover:text-white transition-all text-center flex items-center justify-center gap-2">
                            Get Details & Enroll
                        </a>
                    </div>
                </div>
            </div>

            <!-- Example Card 2 -->
            <div class="bg-white p-6 rounded-sm shadow-sm border border-slate-200 flex flex-col justify-between group hover:border-blue-600 transition-colors">
                <div class="relative h-40 overflow-hidden rounded-sm mb-4">
                    <img src="https://images.unsplash.com/photo-1546410531-bea4f4b9e73d?q=80" alt="DALF" class="w-full h-full object-cover" />
                    <div class="absolute top-3 right-3 bg-white px-2 py-1 rounded text-xs font-bold text-slate-900 shadow-sm">$399</div>
                    <div class="absolute top-3 left-3 bg-blue-600 text-white px-2 py-1 rounded text-[10px] font-bold uppercase">DALF</div>
                </div>
                <div class="flex-grow flex flex-col">
                    <h4 class="text-xl font-bold text-blue-900 mb-4">DALF C1</h4>
                    <div class="flex gap-2 mb-4">
                        <div class="text-[10px] px-2 py-1 bg-slate-100 rounded-sm text-slate-600 font-semibold flex items-center gap-1">
                            <i data-lucide="clock" class="w-3 h-3"></i> 16 Weeks
                        </div>
                        <div class="text-[10px] px-2 py-1 bg-blue-50 text-blue-700 rounded-sm font-semibold flex items-center gap-1">
                            <i data-lucide="book-open" class="w-3 h-3"></i> C1
                        </div>
                    </div>
                    <div class="mt-auto pt-4 border-t border-slate-100">
                        <a href="{{ route('contact') }}" class="w-full py-2 bg-slate-100 text-slate-900 font-semibold rounded-sm group-hover:bg-blue-600 group-hover:text-white transition-all text-center flex items-center justify-center gap-2">
                            Get Details & Enroll
                        </a>
                    </div>
                </div>
            </div>

            <!-- Example Card 3 -->
            <div class="bg-white p-6 rounded-sm shadow-sm border border-slate-200 flex flex-col justify-between group hover:border-blue-600 transition-colors">
                <div class="relative h-40 overflow-hidden rounded-sm mb-4">
                    <img src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a?q=80" alt="TCF" class="w-full h-full object-cover shadow-sm" />
                    <div class="absolute top-3 right-3 bg-white px-2 py-1 rounded text-xs font-bold text-slate-900 shadow-sm">$250</div>
                    <div class="absolute top-3 left-3 bg-blue-600 text-white px-2 py-1 rounded text-[10px] font-bold uppercase">TCF CANADA</div>
                </div>
                <div class="flex-grow flex flex-col">
                    <h4 class="text-xl font-bold text-blue-900 mb-4">TCF CANADA</h4>
                    <div class="flex gap-2 mb-4">
                        <div class="text-[10px] px-2 py-1 bg-slate-100 rounded-sm text-slate-600 font-semibold flex items-center gap-1">
                            <i data-lucide="clock" class="w-3 h-3"></i> 8 Weeks
                        </div>
                        <div class="text-[10px] px-2 py-1 bg-blue-50 text-blue-700 rounded-sm font-semibold flex items-center gap-1">
                            <i data-lucide="book-open" class="w-3 h-3"></i> All Levels
                        </div>
                    </div>
                    <div class="mt-auto pt-4 border-t border-slate-100">
                        <a href="{{ route('contact') }}" class="w-full py-2 bg-slate-100 text-slate-900 font-semibold rounded-sm group-hover:bg-blue-600 group-hover:text-white transition-all text-center flex items-center justify-center gap-2">
                            Get Details & Enroll
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
