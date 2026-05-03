import { Link } from 'react-router-dom';
import { Mail, MapPin, Phone, Facebook, Twitter, Instagram, Youtube } from 'lucide-react';
import logo from '../assets/logo.jpg';

export default function Footer() {
  return (
    <footer className="bg-slate-900 text-slate-300 pt-16 pb-8 border-t border-slate-800">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
          
          <div className="space-y-6">
            <Link to="/" className="flex items-center group">
              <img 
                src={logo} 
                alt="TS Language School" 
                className="h-16 w-auto object-contain rounded-sm bg-white p-2 shadow-sm"
              />
            </Link>
            <p className="text-slate-400 text-sm leading-relaxed">
              Empowering students globally with world-class language education, expert trainers, and modern learning facilities.
            </p>
            <div className="flex gap-4">
              <a href="#" className="h-10 w-10 rounded-sm bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-colors"><Facebook className="h-4 w-4" /></a>
              <a href="#" className="h-10 w-10 rounded-sm bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-colors"><Twitter className="h-4 w-4" /></a>
              <a href="#" className="h-10 w-10 rounded-sm bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-colors"><Instagram className="h-4 w-4" /></a>
              <a href="#" className="h-10 w-10 rounded-sm bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-colors"><Youtube className="h-4 w-4" /></a>
            </div>
          </div>

          <div>
            <h3 className="text-white font-semibold mb-6 flex items-center gap-2">Quick Links</h3>
            <ul className="space-y-3">
              <li><Link to="/" className="text-slate-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2"><span className="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Home</Link></li>
              <li><Link to="/about" className="text-slate-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2"><span className="w-1.5 h-1.5 rounded-full bg-blue-500"></span> About Us</Link></li>
              <li><Link to="/courses" className="text-slate-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2"><span className="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Our Courses</Link></li>
              <li><Link to="/contact" className="text-slate-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2"><span className="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Contact</Link></li>
              <li><a href="#" className="text-slate-400 hover:text-blue-400 transition-colors text-sm flex items-center gap-2"><span className="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Career</a></li>
            </ul>
          </div>

          <div>
            <h3 className="text-white font-semibold mb-6 flex items-center gap-2">Popular Courses</h3>
            <ul className="space-y-3">
              <li><Link to="/courses" className="text-slate-400 hover:text-blue-400 transition-colors text-sm">DELF Preparation</Link></li>
              <li><Link to="/courses" className="text-slate-400 hover:text-blue-400 transition-colors text-sm">DALF Preparation</Link></li>
              <li><Link to="/courses" className="text-slate-400 hover:text-blue-400 transition-colors text-sm">TCF CANADA</Link></li>
              <li><Link to="/courses" className="text-slate-400 hover:text-blue-400 transition-colors text-sm">TEF CANADA</Link></li>
            </ul>
          </div>

          <div>
            <h3 className="text-white font-semibold mb-6">Contact Info</h3>
            <ul className="space-y-4">
              <li className="flex items-start gap-3">
                <MapPin className="h-5 w-5 text-blue-500 shrink-0 mt-0.5" />
                <div className="flex flex-col gap-2">
                  <span className="text-slate-400 text-xs leading-relaxed"><strong className="text-blue-500">India:</strong> A4, Chandra Shekhar Avenue, 1st Street, Thuraipakkam, Chennai - 600 097</span>
                  <span className="text-slate-400 text-xs leading-relaxed"><strong className="text-blue-500">Canada:</strong> 15 Freeborn Cresent, Scarborough, Toronto. M1P 3T9</span>
                </div>
              </li>
              <li className="flex items-center gap-3">
                <Phone className="h-5 w-5 text-blue-500 shrink-0" />
                <div className="flex flex-col">
                  <span className="text-slate-400 text-sm">+91 90433 10908</span>
                  <a href="https://wa.me/16472692509" target="_blank" rel="noreferrer" className="text-blue-400 text-sm hover:underline">+1 (647) 269-2509</a>
                </div>
              </li>
              <li className="flex items-center gap-3">
                <Mail className="h-5 w-5 text-blue-500 shrink-0" />
                <div className="flex flex-col">
                  <span className="text-slate-400 text-sm">info@tslanguageschool.com</span>
                  <span className="text-blue-400 text-[10px] font-bold uppercase tracking-widest mt-1">24/7 Support Available</span>
                </div>
              </li>
            </ul>
          </div>

        </div>

        <div className="pt-8 border-t border-slate-800 text-center md:flex justify-between items-center text-sm text-slate-500">
          <p>&copy; {new Date().getFullYear()} TS Language School. All rights reserved.</p>
          <div className="flex gap-4 mt-4 md:mt-0 justify-center">
            <a href="#" className="hover:text-slate-400 transition-colors">Privacy Policy</a>
            <a href="#" className="hover:text-slate-400 transition-colors">Terms of Service</a>
          </div>
        </div>
      </div>
    </footer>
  );
}
