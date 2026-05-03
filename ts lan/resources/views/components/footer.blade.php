<footer class="bg-slate-900 text-slate-300 pt-16 pb-8 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            
            <div class="space-y-6">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div class="h-8 w-8 bg-blue-600 text-white rounded-sm flex items-center justify-center">
                        <i data-lucide="book-open" class="h-5 w-5"></i>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-white">TS Language</span>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Empowering students globally with world-class language education, expert trainers, and modern learning facilities.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="h-10 w-10 rounded-sm bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-colors"><i data-lucide="facebook" class="h-4 w-4"></i></a>
                    <a href="#" class="h-10 w-10 rounded-sm bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-colors"><i data-lucide="twitter" class="h-4 w-4"></i></a>
                    <a href="#" class="h-10 w-10 rounded-sm bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-colors"><i data-lucide="instagram" class="h-4 w-4"></i></a>
                    <a href="#" class="h-10 w-10 rounded-sm bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-colors"><i data-lucide="linkedin" class="h-4 w-4"></i></a>
                </div>
            </div>

            <div>
                <h3 class="text-white font-semibold mb-6 flex items-center gap-2">Quick Links</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-slate-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-slate-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> About Us</a></li>
                    <li><a href="{{ route('courses') }}" class="text-slate-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Our Courses</a></li>
                    <li><a href="{{ route('contact') }}" class="text-slate-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Contact</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-semibold mb-6 flex items-center gap-2">Popular Courses</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('courses') }}" class="text-slate-400 hover:text-blue-400 transition-colors text-sm">DELF Preparation</a></li>
                    <li><a href="{{ route('courses') }}" class="text-slate-400 hover:text-blue-400 transition-colors text-sm">DALF Preparation</a></li>
                    <li><a href="{{ route('courses') }}" class="text-slate-400 hover:text-blue-400 transition-colors text-sm">TCF CANADA</a></li>
                    <li><a href="{{ route('courses') }}" class="text-slate-400 hover:text-blue-400 transition-colors text-sm">TEF CANADA</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-semibold mb-6">Contact Info</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <i data-lucide="map-pin" class="h-5 w-5 text-blue-500 shrink-0 mt-0.5"></i>
                        <span class="text-slate-400 text-sm">123 Education Lane, Learning District, City, Country</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="phone" class="h-5 w-5 text-blue-500 shrink-0"></i>
                        <span class="text-slate-400 text-sm">+1 (123) 456-7890</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="mail" class="h-5 w-5 text-blue-500 shrink-0"></i>
                        <span class="text-slate-400 text-sm">info@tslanguageschool.com</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="pt-8 border-t border-slate-800 text-center md:flex justify-between items-center text-sm text-slate-500">
            <p>&copy; {{ date('Y') }} TS Language School. All rights reserved.</p>
            <div class="flex gap-4 mt-4 md:mt-0 justify-center">
                <a href="#" class="hover:text-slate-400 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-slate-400 transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
