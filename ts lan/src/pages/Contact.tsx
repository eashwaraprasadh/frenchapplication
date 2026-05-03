import React, { useState } from 'react';
import { MapPin, Phone, Mail, Clock, UploadCloud } from 'lucide-react';

export default function Contact() {
  const [inquiryType, setInquiryType] = useState('general');

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    alert("Form submitted! This function will be linked to the Laravel backend POST route.");
  };

  return (
    <div className="flex flex-col min-h-screen pt-24 pb-20 bg-slate-50">
      
      {/* Header */}
      <div className="bg-blue-900 py-16">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
          <h1 className="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
          <p className="text-blue-100 max-w-2xl mx-auto">Have questions about our courses, ready to enroll, or want to share your success story? Get in touch with our team today.</p>
        </div>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 w-full">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-16">
          
          {/* Contact Information */}
          <div>
            <h2 className="text-3xl font-bold text-slate-900 mb-8">Get in Touch</h2>
            <div className="space-y-8">
              <div className="flex gap-4 group">
                <div className="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                  <MapPin className="h-6 w-6" />
                </div>
                <div className="space-y-4">
                  <h4 className="text-xl font-bold text-slate-900 mb-1">Our Locations</h4>
                  <div>
                    <h5 className="font-semibold text-blue-600 text-sm uppercase tracking-wider mb-1">India</h5>
                    <p className="text-slate-600 text-sm">A4, Chandra Shekhar Avenue, 1st Street,<br/>Thuraipakkam, Chennai - 600 097</p>
                  </div>
                  <div>
                    <h5 className="font-semibold text-blue-600 text-sm uppercase tracking-wider mb-1">Canada</h5>
                    <p className="text-slate-600 text-sm">15 Freeborn Cresent, Scarborough,<br/>Toronto. Postal Code: M1P 3T9</p>
                  </div>
                </div>
              </div>
              <div className="flex gap-4 group">
                <div className="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                  <Phone className="h-6 w-6" />
                </div>
                <div>
                  <h4 className="text-xl font-bold text-slate-900 mb-1">Phone Number</h4>
                  <p className="text-slate-600">+91 90433 10908<br/><a href="https://wa.me/16472692509" target="_blank" rel="noreferrer" className="text-blue-600 hover:underline">+1 (647) 269-2509</a></p>
                </div>
              </div>
              <div className="flex gap-4 group">
                <div className="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                  <Mail className="h-6 w-6" />
                </div>
                <div>
                  <h4 className="text-xl font-bold text-slate-900 mb-1">Email Address</h4>
                  <p className="text-slate-600">info@tslanguageschool.com</p>
                </div>
              </div>
              <div className="flex gap-4 group">
                <div className="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                  <Clock className="h-6 w-6" />
                </div>
                <div>
                  <h4 className="text-xl font-bold text-slate-900 mb-1">Working Hours</h4>
                  <p className="text-slate-600">Available 24/7 for Online Learning & Support</p>
                </div>
              </div>
            </div>
            
            {/* Map Placeholder */}
            <div className="mt-12 rounded-sm overflow-hidden h-64 bg-slate-200 border border-slate-300 shadow-sm">
              <iframe 
                src="https://www.google.com/maps?q=15%20Freeborn%20Cresent%2C%20Scarborough%2C%20Toronto%2C%20ON%20M1P%203T9&z=15&output=embed" 
                width="100%" 
                height="100%" 
                style={{ border: 0 }} 
                allowFullScreen={false} 
                loading="lazy" 
                referrerPolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
          </div>

          {/* Contact Form */}
          <div className="bg-white p-8 md:p-10 rounded-sm shadow border border-slate-200 relative">
            <h3 className="text-2xl font-bold text-slate-900 mb-6">Send us a Message</h3>
            <form onSubmit={handleSubmit} className="space-y-6">
              
              <div className="mb-6">
                <label className="block text-sm font-semibold text-slate-700 mb-3">What are you inquiring about?</label>
                <div className="flex flex-wrap gap-4">
                  <label className="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="inquiryType" value="general" checked={inquiryType === 'general'} onChange={(e) => setInquiryType(e.target.value)} className="w-4 h-4 text-blue-600 focus:ring-blue-600" />
                    <span className="text-slate-700 font-medium">General Inquiry</span>
                  </label>
                  <label className="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="inquiryType" value="enrollment" checked={inquiryType === 'enrollment'} onChange={(e) => setInquiryType(e.target.value)} className="w-4 h-4 text-blue-600 focus:ring-blue-600" />
                    <span className="text-slate-700 font-medium">Course Enrollment</span>
                  </label>
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label htmlFor="name" className="block text-sm font-medium text-slate-700 mb-2">Full Name</label>
                  <input type="text" id="name" required className="w-full px-4 py-3 rounded-sm border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-slate-50 transition-colors" placeholder="John Doe" />
                </div>
                <div>
                  <label htmlFor="email" className="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
                  <input type="email" id="email" required className="w-full px-4 py-3 rounded-sm border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-slate-50 transition-colors" placeholder="john@example.com" />
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label htmlFor="phone" className="block text-sm font-medium text-slate-700 mb-2">Phone Number</label>
                  <input type="tel" id="phone" className="w-full px-4 py-3 rounded-sm border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-slate-50 transition-colors" placeholder="+91 90433 10908" />
                </div>
                <div>
                  <label htmlFor="course" className="block text-sm font-medium text-slate-700 mb-2">Relevant Course</label>
                  <select id="course" className="w-full px-4 py-3 rounded-sm border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-slate-50 transition-colors">
                    <option value="">Select a Course</option>
                    <option value="delf">DELF (A1-C2)</option>
                    <option value="dalf">DALF (C1-C2)</option>
                    <option value="tcf">TCF CANADA</option>
                    <option value="tef">TEF CANADA</option>
                  </select>
                </div>
              </div>


              <div>
                <label htmlFor="message" className="block text-sm font-medium text-slate-700 mb-2">Message</label>
                <textarea id="message" rows={5} required className="w-full px-4 py-3 rounded-sm border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-slate-50 transition-colors resize-none" placeholder="How can we help you?"></textarea>
              </div>

              <button type="submit" className="w-full bg-blue-600 text-white font-bold py-4 rounded-sm hover:bg-blue-700 transition-colors shadow-sm">
                Send Message
              </button>
            </form>
          </div>

        </div>
      </div>

    </div>
  );
}
