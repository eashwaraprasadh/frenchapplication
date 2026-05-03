@extends('layouts.app')
@section('title', 'Contact - TS Language School')

@section('content')
<div class="flex flex-col min-h-screen pt-24 pb-20 bg-slate-50">
    <!-- Header -->
    <div class="bg-blue-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
            <p class="text-blue-100 max-w-2xl mx-auto">Have questions about our courses, ready to enroll, or want to share your success story? Get in touch with our team today.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            
            <!-- Contact Info -->
            <div>
                <h2 class="text-3xl font-bold text-slate-900 mb-8">Get in Touch</h2>
                <div class="space-y-8">
                    <div class="flex gap-4 group">
                        <div class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <i data-lucide="map-pin" class="h-6 w-6"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-1">Our Location</h4>
                            <p class="text-slate-600">123 Education Lane, Learning District<br>New York, NY 10001, USA</p>
                        </div>
                    </div>
                    <div class="flex gap-4 group">
                        <div class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <i data-lucide="phone" class="h-6 w-6"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-1">Phone Number</h4>
                            <p class="text-slate-600">+1 (123) 456-7890<br>+1 (987) 654-3210 (WhatsApp)</p>
                        </div>
                    </div>
                    <div class="flex gap-4 group">
                        <div class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <i data-lucide="mail" class="h-6 w-6"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-1">Email Address</h4>
                            <p class="text-slate-600">info@tslanguageschool.com<br>admissions@tslanguageschool.com</p>
                        </div>
                    </div>
                    <div class="flex gap-4 group">
                        <div class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <i data-lucide="clock" class="h-6 w-6"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-1">Working Hours</h4>
                            <p class="text-slate-600">Mon - Fri: 8:00 AM - 8:00 PM<br>Sat: 9:00 AM - 2:00 PM</p>
                        </div>
                    </div>
                </div>

                <div class="mt-12 rounded-sm overflow-hidden h-64 bg-slate-200 border border-slate-300 shadow-sm">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.25280010834!2d-74.144487327885!3d40.69766374859258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s" 
                        width="100%" 
                        height="100%" 
                        style="border: 0" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white p-8 md:p-10 rounded-sm shadow border border-slate-200 relative">
                <h3 class="text-2xl font-bold text-slate-900 mb-6" id="form-title">Send us a Message</h3>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('contact.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-3">What are you inquiring about?</label>
                        <div class="flex flex-wrap gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="inquiryType" value="general" checked onchange="toggleReviewForm(this.value)" class="w-4 h-4 text-blue-600 focus:ring-blue-600" />
                                <span class="text-slate-700 font-medium">General Inquiry</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="inquiryType" value="enrollment" onchange="toggleReviewForm(this.value)" class="w-4 h-4 text-blue-600 focus:ring-blue-600" />
                                <span class="text-slate-700 font-medium">Course Enrollment</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="inquiryType" value="review" onchange="toggleReviewForm(this.value)" class="w-4 h-4 text-blue-600 focus:ring-blue-600" />
                                <span class="text-slate-700 font-medium">Submit a Video Review <span class="ml-2 uppercase text-[10px] bg-blue-100 text-blue-800 px-2 py-0.5 rounded">New</span></span>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Full Name</label>
                            <input type="text" name="name" id="name" required class="w-full px-4 py-3 rounded-sm border {{ $errors->has('name') ? 'border-red-500' : 'border-slate-200' }} focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 transition-colors" placeholder="John Doe">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
                            <input type="email" name="email" id="email" required class="w-full px-4 py-3 rounded-sm border {{ $errors->has('email') ? 'border-red-500' : 'border-slate-200' }} focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 transition-colors" placeholder="john@example.com">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700 mb-2">Phone Number</label>
                            <input type="tel" name="phone" id="phone" class="w-full px-4 py-3 rounded-sm border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 transition-colors" placeholder="+1 (123) 456-7890">
                        </div>
                        <div>
                            <label for="course" class="block text-sm font-medium text-slate-700 mb-2">Relevant Course</label>
                            <select name="course" id="course" class="w-full px-4 py-3 rounded-sm border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 transition-colors">
                                <option value="">Select a Course</option>
                                <option value="delf">DELF (A1-C2)</option>
                                <option value="dalf">DALF (C1-C2)</option>
                                <option value="tcf">TCF CANADA</option>
                                <option value="tef">TEF CANADA</option>
                            </select>
                        </div>
                    </div>

                    <div id="videoUploadBox" class="hidden p-6 border-2 border-dashed border-blue-200 bg-blue-50/50 rounded-sm text-center transition-all">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-4 text-blue-600 shadow-sm">
                            <i data-lucide="upload-cloud" class="h-6 w-6"></i>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">Upload Your Success Story</h4>
                        <p class="text-slate-500 text-sm mb-4">Share your journey with TS Language School. Videos should be under 2 minutes and in MP4 format.</p>
                        <input type="file" name="video" id="videoReview" accept="video/mp4,video/x-m4v,video/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-sm file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer" />
                    </div>

                    <div>
                        <label for="message" id="message-label" class="block text-sm font-medium text-slate-700 mb-2">Message</label>
                        <textarea name="message" id="message" rows="5" required class="w-full px-4 py-3 rounded-sm border border-slate-200 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 transition-colors" placeholder="How can we help you?"></textarea>
                    </div>

                    <button type="submit" id="submit-btn" class="w-full bg-blue-600 text-white font-bold py-4 rounded-sm hover:bg-blue-700 transition-colors shadow-sm">
                        Send Message
                    </button>
                </form>
                
                <script>
                    function toggleReviewForm(type) {
                        const videoBox = document.getElementById('videoUploadBox');
                        const msgLabel = document.getElementById('message-label');
                        const msgInput = document.getElementById('message');
                        const submitBtn = document.getElementById('submit-btn');
                        
                        if (type === 'review') {
                            videoBox.classList.remove('hidden');
                            msgLabel.innerText = 'Briefly describe your experience';
                            msgInput.placeholder = 'I achieved C1 in TEF Canada...';
                            submitBtn.innerText = 'Submit Video Review';
                        } else {
                            videoBox.classList.add('hidden');
                            msgLabel.innerText = 'Message';
                            msgInput.placeholder = 'How can we help you?';
                            submitBtn.innerText = 'Send Message';
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
