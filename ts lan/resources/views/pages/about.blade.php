@extends('layouts.app')
@section('title', 'TS Language School - About')

@section('content')
<div class="pt-24 pb-16 bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-6">About TS Language School</h1>
            <p class="text-xl text-slate-600">Empowering global communication through exceptional language education.</p>
        </div>

        <!-- Mission & Vision Split -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-24">
            <div class="bg-slate-50 p-10 rounded-sm border border-slate-200">
                <h2 class="text-2xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <i data-lucide="target" class="text-blue-600 h-6 w-6"></i> Our Mission
                </h2>
                <p class="text-slate-600 leading-relaxed">
                    To provide high-quality, accessible, and engaging language learning experiences that equip our students with the skills they need to succeed in a globalized world.
                </p>
            </div>
            
            <div class="bg-blue-900 text-white p-10 rounded-sm shadow-sm">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                    <i data-lucide="eye" class="text-blue-400 h-6 w-6"></i> Our Vision
                </h2>
                <p class="text-blue-100 leading-relaxed">
                    To be the leading global institution for language acquisition, recognized for our innovative teaching methods, cultural immersion programs, and student success.
                </p>
            </div>
        </div>

        <!-- Stats / Details -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center border-t border-slate-200 pt-16">
            <div>
                <div class="text-4xl font-extrabold text-blue-600 mb-2">2005</div>
                <div class="text-sm font-bold text-slate-900 uppercase">Established</div>
            </div>
            <div>
                <div class="text-4xl font-extrabold text-blue-600 mb-2">10k+</div>
                <div class="text-sm font-bold text-slate-900 uppercase">Graduates</div>
            </div>
            <div>
                <div class="text-4xl font-extrabold text-blue-600 mb-2">50+</div>
                <div class="text-sm font-bold text-slate-900 uppercase">Expert Tutors</div>
            </div>
            <div>
                <div class="text-4xl font-extrabold text-blue-600 mb-2">10</div>
                <div class="text-sm font-bold text-slate-900 uppercase">Languages</div>
            </div>
        </div>
    </div>
</div>
@endsection
