import { Link, useLocation } from 'react-router-dom';
import { Menu, X, BookOpen } from 'lucide-react';
import { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'motion/react';

import logo from '../assets/logo.jpg';

export default function Navbar() {
  const [isOpen, setIsOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const location = useLocation();

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 20);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const navLinks = [
    { name: 'Home', path: '/' },
    { name: 'About', path: '/about' },
    { name: 'Courses', path: '/courses' },
    { name: 'Contact', path: '/contact' },
  ];

  return (
    <motion.header 
      initial={{ y: -100 }}
      animate={{ y: 0 }}
      transition={{ duration: 0.5 }}
      className={`fixed top-0 w-full z-40 transition-all duration-300 flex items-center bg-white ${scrolled ? 'h-16 shadow-md border-b border-slate-200' : 'h-20 border-b border-transparent'} shrink-0`}
    >
      <div className="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center">
          <Link to="/" className="flex items-center group">
            <img 
              src={logo} 
              alt="TS Language School" 
              className="h-12 md:h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105"
            />
          </Link>
          
          <nav className="hidden md:flex gap-8">
            {navLinks.map((link) => (
              <Link 
                key={link.name} 
                to={link.path}
                className={`font-medium text-sm transition-colors uppercase tracking-wider relative ${location.pathname === link.path ? 'text-blue-600' : 'text-slate-600 hover:text-blue-600'}`}
              >
                {link.name}
                {location.pathname === link.path && (
                  <motion.div layoutId="underline" className="absolute -bottom-1 left-0 right-0 h-0.5 bg-blue-600" />
                )}
              </Link>
            ))}
          </nav>

          <div className="hidden md:block">
            <Link to="/contact" className="bg-blue-600 text-white px-6 py-2.5 rounded-sm font-medium hover:bg-blue-700 transition-colors shadow-sm tracking-wide uppercase text-sm">
              Apply Now
            </Link>
          </div>

          <button 
            className="md:hidden p-2 transition-colors text-slate-900"
            onClick={() => setIsOpen(!isOpen)}
          >
            {isOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
          </button>
        </div>
      </div>

      {/* Mobile Menu */}
      <AnimatePresence>
        {isOpen && (
          <motion.div 
            initial={{ opacity: 0, y: -20 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -20 }}
            className="md:hidden absolute top-full left-0 w-full bg-white shadow-xl border-t border-slate-100 py-4 px-4 flex flex-col gap-4"
          >
            {navLinks.map((link) => (
              <Link 
                key={link.name} 
                to={link.path}
                onClick={() => setIsOpen(false)}
                className={`font-medium p-3 rounded-sm transition-colors text-sm uppercase tracking-wide ${location.pathname === link.path ? 'bg-slate-50 text-blue-600' : 'text-slate-600 hover:text-blue-600'}`}
              >
                {link.name}
              </Link>
            ))}
            <Link to="/contact" onClick={() => setIsOpen(false)} className="bg-blue-600 text-white text-center px-5 py-3 rounded-sm font-medium hover:bg-blue-700 transition-colors shadow-sm mt-2 uppercase tracking-wide text-sm">
              Apply Now
            </Link>
          </motion.div>
        )}
      </AnimatePresence>
    </motion.header>
  );
}
