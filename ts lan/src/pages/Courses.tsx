import { useState } from 'react';
import { Link } from 'react-router-dom';
import { BookOpen, Clock, ArrowRight, Search } from 'lucide-react';
import discoverFrance2 from '../assets/discover-france-2.jpeg';
import discoverFrance3 from '../assets/discover-france-3.jpeg';
import delfA1 from '../assets/delf-a1.png';
import delfA2 from '../assets/delf-a2.png';
import delfC1 from '../assets/delf-c1.png';
import dalfA1Img from '../assets/dalf-a1.png';
import dalfA2Img from '../assets/dalf-a2.png';
import dalfB1Img from '../assets/dalf-b1.png';
import dalfC2Img from '../assets/dalf-c2.jpg';
import tefCanadaImg from '../assets/tef-canada.png';

const coursesData = [
  { id: 1, title: 'DELF A1', category: 'DELF', duration: '12 Weeks', levels: 'A1', image: delfA1 },
  { id: 2, title: 'DELF A2', category: 'DELF', duration: '12 Weeks', levels: 'A2', image: delfA2 },
  { id: 3, title: 'DELF B1', category: 'DELF', duration: '14 Weeks', levels: 'B1', image: 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=2070' },
  { id: 4, title: 'DELF B2', category: 'DELF', duration: '14 Weeks', levels: 'B2', image: 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&q=80&w=2070' },
  { id: 5, title: 'DELF C1', category: 'DELF', duration: '16 Weeks', levels: 'C1', image: delfC1 },
  { id: 6, title: 'DELF C2', category: 'DELF', duration: '16 Weeks', levels: 'C2', image: 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=2070' },
  { id: 7, title: 'DALF A1', category: 'DALF', duration: '12 Weeks', levels: 'A1', image: dalfA1Img },
  { id: 8, title: 'DALF A2', category: 'DALF', duration: '12 Weeks', levels: 'A2', image: dalfA2Img },
  { id: 9, title: 'DALF B1', category: 'DALF', duration: '14 Weeks', levels: 'B1', image: dalfB1Img },
  { id: 10, title: 'DALF B2', category: 'DALF', duration: '14 Weeks', levels: 'B2', image: 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=2070' },
  { id: 11, title: 'DALF C1', category: 'DALF', duration: '16 Weeks', levels: 'C1', image: 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&q=80&w=2070' },
  { id: 12, title: 'DALF C2', category: 'DALF', duration: '16 Weeks', levels: 'C2', image: dalfC2Img },
  { id: 13, title: 'TCF CANADA', category: 'TCF CANADA', duration: '8 Weeks', levels: 'All Levels', image: 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=2070' },
  { id: 14, title: 'TEF CANADA', category: 'TEF CANADA', duration: '8 Weeks', levels: 'All Levels', image: tefCanadaImg },
];

const categories = ['All', 'DELF', 'DALF', 'TCF CANADA', 'TEF CANADA'];

export default function Courses() {
  const [activeCategory, setActiveCategory] = useState('All');
  const [searchTerm, setSearchTerm] = useState('');

  const filteredCourses = coursesData.filter(course => {
    const matchesCategory = activeCategory === 'All' || course.category === activeCategory;
    const matchesSearch = course.title.toLowerCase().includes(searchTerm.toLowerCase());
    return matchesCategory && matchesSearch;
  });

  return (
    <div className="flex flex-col min-h-screen pt-24 pb-20 bg-slate-50">
      
      {/* Header */}
      <div className="bg-blue-900 py-16">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
          <h1 className="text-4xl md:text-5xl font-bold mb-4">Our Programs</h1>
          <p className="text-blue-100 max-w-2xl mx-auto">Find the perfect language course to advance your skills, career, and global connections.</p>
        </div>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        
        {/* Filters and Search */}
        <div className="flex flex-col md:flex-row justify-between items-center gap-6 mb-12">
          <div className="flex flex-wrap gap-2 justify-center md:justify-start">
            {categories.map(category => (
              <button
                key={category}
                onClick={() => setActiveCategory(category)}
                className={`px-5 py-2.5 rounded-sm text-sm font-medium transition-colors ${activeCategory === category ? 'bg-blue-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:border-blue-600 hover:text-blue-600'}`}
              >
                {category}
              </button>
            ))}
          </div>

          <div className="relative w-full md:w-72">
            <input 
              type="text" 
              placeholder="Search courses..." 
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="w-full pl-10 pr-4 py-3 rounded-sm border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent text-sm bg-white"
            />
            <Search className="absolute text-slate-400 h-5 w-5 left-3 top-1/2 transform -translate-y-1/2" />
          </div>
        </div>

        {/* Course Grid */}
        {filteredCourses.length > 0 ? (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {filteredCourses.map(course => (
              <div key={course.id} className="bg-white p-6 rounded-sm shadow-sm border border-slate-200 flex flex-col justify-between group hover:border-blue-600 transition-colors">
                <div className="relative h-40 overflow-hidden rounded-sm mb-4">
                  <img src={course.image} alt={course.title} className="w-full h-full object-cover" />
                  <div className="absolute top-3 left-3 bg-blue-600 text-white px-2 py-1 rounded text-[10px] font-bold uppercase">{course.category}</div>
                </div>
                <div className="flex-grow flex flex-col">
                  <h4 className="text-xl font-bold text-blue-900 mb-4">{course.title}</h4>
                  
                  <div className="flex gap-2 mb-4">
                    <div className="text-[10px] px-2 py-1 bg-slate-100 rounded-sm text-slate-600 font-semibold flex items-center gap-1">
                      <Clock className="w-3 h-3" /> {course.duration}
                    </div>
                    <div className="text-[10px] px-2 py-1 bg-blue-50 text-blue-700 rounded-sm font-semibold flex items-center gap-1">
                      <BookOpen className="w-3 h-3" /> {course.levels}
                    </div>
                  </div>

                  <div className="mt-auto pt-4 border-t border-slate-100">
                    <Link to="/contact" className="w-full py-2 bg-slate-100 text-slate-900 font-semibold rounded-sm group-hover:bg-blue-600 group-hover:text-white transition-all text-center flex items-center justify-center gap-2">
                       Get Details & Enroll
                    </Link>
                  </div>
                </div>
              </div>
            ))}
          </div>
        ) : (
          <div className="text-center py-20">
            <h3 className="text-2xl font-bold text-slate-900 mb-2">No courses found</h3>
            <p className="text-slate-500">Try adjusting your category or search term.</p>
          </div>
        )}

      </div>
    </div>
  );
}
