/**
 * @license
 * SPDX-License-Identifier: Apache-2.0
*/

import React, { useState, useEffect } from 'react';
import { HeroScene } from './components/QuantumScene';
import { SurfaceCodeDiagram, TransformerDecoderDiagram, PerformanceMetricDiagram } from './components/Diagrams';
// Added CheckCircle to the lucide-react imports
import { ArrowDown, Menu, X, BookOpen, GraduationCap, MapPin, Target, Users, CheckCircle } from 'lucide-react';
import logo from './logo.png';

const CourseCard = ({ cefr, clb, title, subtitle, duration, lessons, delay }: { cefr: string, clb: string, title: string, subtitle: string, duration: string, lessons: string, delay: string }) => (
  <div className="flex flex-col animate-fade-in-up p-8 bg-white rounded-xl border border-stone-200 shadow-sm hover:shadow-lg transition-all duration-500 hover:border-nobel-gold/50 group" style={{ animationDelay: delay }}>
    <div className="flex justify-between items-start mb-6">
      <div className="px-3 py-1 bg-stone-900 text-white text-[10px] font-bold tracking-widest uppercase rounded-full">TCF Canada {cefr}</div>
      <div className="text-nobel-gold font-serif italic text-sm">{clb}</div>
    </div>
    <h3 className="font-serif text-xl text-stone-900 mb-2 group-hover:text-nobel-gold transition-colors">{title}</h3>
    <p className="text-xs text-stone-500 font-bold uppercase tracking-widest mb-6 leading-tight">{subtitle}</p>
    <div className="mt-auto pt-6 border-t border-stone-100 flex justify-between text-[11px] font-medium text-stone-400 uppercase tracking-tighter">
      <span>{duration}</span>
      <span>{lessons}</span>
    </div>
  </div>
);

const TestimonialCard = ({ name, role, quote, result, delay }: { name: string, role: string, quote: string, result: string, delay: string }) => (
  <div className="bg-[#F9F8F4] p-8 rounded-xl border border-stone-200 animate-fade-in-up" style={{ animationDelay: delay }}>
    <div className="flex items-center gap-4 mb-6">
      <div className="w-12 h-12 bg-stone-200 rounded-full flex items-center justify-center text-stone-500 font-serif text-xl uppercase">{name[0]}</div>
      <div>
        <h4 className="font-serif text-lg text-stone-900 leading-none mb-1">{name}</h4>
        <p className="text-[10px] text-stone-500 uppercase tracking-widest font-bold">{role}</p>
      </div>
    </div>
    <p className="text-stone-600 italic font-serif text-base mb-6 leading-relaxed">"{quote}"</p>
    <div className="inline-flex items-center gap-2 px-3 py-1 bg-green-50 text-green-700 text-[10px] font-bold tracking-widest uppercase rounded-full border border-green-100">
      <Target size={12} /> {result}
    </div>
  </div>
);

const App: React.FC = () => {
  const [scrolled, setScrolled] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 50);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const scrollToSection = (id: string) => (e: React.MouseEvent) => {
    e.preventDefault();
    setMenuOpen(false);
    const element = document.getElementById(id);
    if (element) {
      const headerOffset = 100;
      const elementPosition = element.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
      window.scrollTo({ top: offsetPosition, behavior: "smooth" });
    }
  };

  return (
    <div className="min-h-screen bg-[#F9F8F4] text-stone-800 selection:bg-nobel-gold selection:text-white">

      {/* Navigation */}
      <nav className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${scrolled ? 'bg-[#F9F8F4]/90 backdrop-blur-md shadow-sm py-4' : 'bg-transparent py-6'}`}>
        <div className="container mx-auto px-6 flex justify-between items-center">
          <div className="flex items-center gap-4 cursor-pointer" onClick={() => window.scrollTo({ top: 0, behavior: 'smooth' })}>
            <img src={logo} alt="TS Language School" className="h-10 md:h-20 w-auto object-contain" />
            <span className={`font-serif font-bold text-lg tracking-wide transition-opacity hidden md:inline-block ${scrolled ? 'opacity-100' : 'opacity-0 md:opacity-100'}`}>
              TS LANGUAGE <span className="font-normal text-stone-500">SCHOOL</span>
            </span>
          </div>

          <div className="hidden md:flex items-center gap-8 text-sm font-medium tracking-wide text-stone-600">
            <a href="#courses" onClick={scrollToSection('courses')} className="hover:text-nobel-gold transition-colors cursor-pointer uppercase">Courses</a>
            <a href="#method" onClick={scrollToSection('method')} className="hover:text-nobel-gold transition-colors cursor-pointer uppercase">Method</a>
            <a href="#success" onClick={scrollToSection('success')} className="hover:text-nobel-gold transition-colors cursor-pointer uppercase">Success</a>
            <a href="/login" className="hover:text-nobel-gold transition-colors uppercase">Sign In</a>
            <a href="/register" className="px-6 py-2 bg-stone-900 text-white rounded-sm hover:bg-stone-800 transition-colors shadow-sm cursor-pointer uppercase text-xs font-bold tracking-widest">Apply</a>
          </div>

          <button
            type="button"
            className="md:hidden text-stone-900 p-3 -mr-3 cursor-pointer touch-manipulation relative z-[100]"
            onClick={(e) => {
              e.preventDefault();
              setMenuOpen(!menuOpen);
            }}
            aria-label="Toggle menu"
            aria-expanded={menuOpen}
          >
            {menuOpen ? <X className="pointer-events-none" /> : <Menu className="pointer-events-none" />}
          </button>
        </div>

        {/* Mobile Menu Overlay */}
        {menuOpen && (
          <div className="absolute top-full left-0 right-0 bg-[#F9F8F4] border-b border-stone-200 shadow-xl md:hidden py-6 px-6 flex flex-col gap-6 animate-fade-in-up">
            <a href="#courses" onClick={scrollToSection('courses')} className="text-stone-700 hover:text-nobel-gold font-medium uppercase tracking-wide text-sm transition-colors cursor-pointer">Courses</a>
            <a href="#method" onClick={scrollToSection('method')} className="text-stone-700 hover:text-nobel-gold font-medium uppercase tracking-wide text-sm transition-colors cursor-pointer">Method</a>
            <a href="#success" onClick={scrollToSection('success')} className="text-stone-700 hover:text-nobel-gold font-medium uppercase tracking-wide text-sm transition-colors cursor-pointer">Success</a>
            <hr className="border-stone-200" />
            <a href="/login" className="text-stone-700 hover:text-nobel-gold font-medium uppercase tracking-wide text-sm transition-colors">Sign In</a>
            <a href="/register" className="px-6 py-3 bg-stone-900 text-white text-center rounded-sm hover:bg-stone-800 transition-colors uppercase text-xs font-bold tracking-widest mt-2 shadow-sm">Apply</a>
          </div>
        )}
      </nav>

      {/* Hero Section */}
      <header className="relative h-screen flex items-center justify-center overflow-hidden">
        <HeroScene />
        <div className="absolute inset-0 z-0 pointer-events-none bg-[radial-gradient(circle_at_center,rgba(249,248,244,0.85)_0%,rgba(249,248,244,0.4)_60%,rgba(249,248,244,0.1)_100%)]" />

        <div className="relative z-10 container mx-auto px-6 text-center">
          <div className="inline-block mb-6 px-4 py-1.5 border border-stone-800 text-stone-800 text-xs tracking-[0.3em] uppercase font-bold rounded-sm backdrop-blur-sm bg-white/20">
            Canada Immigration Ready
          </div>
          <h1 className="font-serif text-5xl md:text-7xl lg:text-8xl font-medium leading-[0.9] mb-10 text-stone-900">
            SPECIALIZED <br /><span className="italic font-normal text-stone-600">TCF PREP</span>
          </h1>

          <div className="flex flex-col md:flex-row justify-center items-center gap-6 mb-16">
            <div className="flex flex-col items-center">
              <span className="text-3xl md:text-4xl font-serif text-stone-900">PATHWAY TO</span>
              <span className="text-4xl md:text-5xl font-serif text-nobel-gold font-bold tracking-tighter">CANADA</span>
            </div>
          </div>

          <p className="max-w-xl mx-auto text-lg text-stone-700 font-light leading-relaxed mb-12 border-l-2 border-stone-300 pl-8 text-left italic">
            "Boost your Express Entry CRS score and unlock Provincial Nominee Programs with specialized TCF Canada preparation aligned with CLB standards."
          </p>

          <div className="flex justify-center gap-12 text-[10px] font-bold tracking-[0.2em] text-stone-400 uppercase">
            <span className="flex items-center gap-2"><Target size={14} className="text-nobel-gold" /> Express Entry Boost</span>
            <span className="flex items-center gap-2"><CheckCircle size={14} className="text-nobel-gold" /> CLB-Aligned</span>
            <span className="flex items-center gap-2"><GraduationCap size={14} className="text-nobel-gold" /> TCF Focused</span>
          </div>
        </div>

        {/* Marquee */}
        <div className="absolute bottom-0 w-full bg-stone-900 py-4 overflow-hidden border-t border-stone-800">
          <div className="animate-marquee">
            {[...Array(10)].map((_, i) => (
              <span key={i} className="text-white text-xs font-bold tracking-[0.2em] uppercase mx-8 opacity-60">
                ● TCF Canada Prep ● TS Language School ● Canada Immigration Ready
              </span>
            ))}
          </div>
        </div>
      </header>

      <main>
        {/* Course Levels Grid */}
        <section id="courses" className="py-24 bg-white">
          <div className="container mx-auto px-6">
            <div className="text-center mb-20">
              <div className="inline-block mb-4 text-xs font-bold tracking-[0.3em] text-nobel-gold uppercase">Target CLB 7+</div>
              <h2 className="font-serif text-4xl md:text-5xl mb-6 text-stone-900">Choose Your CLB Level</h2>
              <p className="text-stone-500 max-w-2xl mx-auto">Each CEFR level maps to Canadian Language Benchmarks (CLB) for immigration purposes. Find your starting point for Express Entry.</p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              <CourseCard cefr="A1" clb="CLB 1-2" title="Beginner" subtitle="Foundation for Express Entry" duration="8 weeks" lessons="32 lessons" delay="0s" />
              <CourseCard cefr="A2" clb="CLB 3-4" title="Elementary" subtitle="Minimum for some PNP Programs" duration="10 weeks" lessons="40 lessons" delay="0.1s" />
              <CourseCard cefr="B1" clb="CLB 5-6" title="Intermediate" subtitle="Strengthens Express Entry Profile" duration="12 weeks" lessons="48 lessons" delay="0.2s" />
              <CourseCard cefr="B2" clb="CLB 7-8" title="Upper Intermediate" subtitle="Target for Express Entry (Recommended)" duration="14 weeks" lessons="56 lessons" delay="0.3s" />
              <CourseCard cefr="C1" clb="CLB 9-10" title="Advanced" subtitle="Maximum CRS Points Boost" duration="16 weeks" lessons="64 lessons" delay="0.4s" />
              <CourseCard cefr="C2" clb="CLB 11-12" title="Mastery" subtitle="Elite Proficiency Recognition" duration="18 weeks" lessons="72 lessons" delay="0.5s" />
            </div>
          </div>
        </section>

        {/* Methodology: The Matrix */}
        <section id="method" className="py-24 bg-[#F9F8F4] border-t border-stone-100">
          <div className="container mx-auto px-6">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
              <div>
                <div className="inline-flex items-center gap-2 px-3 py-1 bg-white text-stone-600 text-xs font-bold tracking-widest uppercase rounded-full mb-6 border border-stone-200 shadow-sm">
                  <BookOpen size={14} /> TS METHOD
                </div>
                <h2 className="font-serif text-4xl md:text-5xl mb-8 text-stone-900 leading-tight">Exam-First <br />Methodology</h2>
                <div className="space-y-8">
                  <div className="flex gap-4">
                    <div className="w-12 h-12 rounded-full bg-stone-900 flex items-center justify-center text-white shrink-0"><Target size={20} /></div>
                    <div>
                      <h4 className="font-serif text-xl mb-1">Rubric Alignment</h4>
                      <p className="text-stone-500 text-sm leading-relaxed">Curriculum rigorously aligned with TCF Canada exam rubrics and CLB descriptors.</p>
                    </div>
                  </div>
                  <div className="flex gap-4">
                    <div className="w-12 h-12 rounded-full bg-stone-900 flex items-center justify-center text-white shrink-0"><MapPin size={20} /></div>
                    <div>
                      <h4 className="font-serif text-xl mb-1">Canada Landscape</h4>
                      <p className="text-stone-500 text-sm leading-relaxed">Integrated cultural context specifically for living and working in Canada.</p>
                    </div>
                  </div>
                  <div className="flex gap-4">
                    <div className="w-12 h-12 rounded-full bg-stone-900 flex items-center justify-center text-white shrink-0"><Users size={20} /></div>
                    <div>
                      <h4 className="font-serif text-xl mb-1">CLB 7+ Guarantee</h4>
                      <p className="text-stone-500 text-sm leading-relaxed">Structured roadmap focused on the magic CLB 7 threshold for maximum CRS points.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div className="relative">
                <SurfaceCodeDiagram />
                <div className="absolute -bottom-6 -right-6 p-6 bg-stone-900 text-white rounded-xl shadow-xl max-w-xs">
                  <p className="text-xs font-bold uppercase tracking-[0.2em] mb-2 text-nobel-gold">Expert Insight</p>
                  <p className="text-sm font-light italic">"65% of candidates fail to reach CLB 7 without specific preparation. We reverse-engineer the exam for you."</p>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* TCF Canada Score Comparison Table */}
        <section className="py-24 bg-white">
          <div className="container mx-auto px-6">
            <div className="max-w-6xl mx-auto overflow-hidden rounded-2xl border border-stone-200 shadow-xl">
              <div className="bg-stone-900 p-8 text-white">
                <h3 className="font-serif text-3xl mb-2">Résultats au TCF Canada</h3>
                <p className="text-stone-400 text-sm">Score comparison across all four skills.</p>
              </div>
              <div className="overflow-x-auto">
                <table className="w-full text-left border-collapse">
                  <thead className="bg-stone-50 text-[10px] font-bold uppercase tracking-widest text-stone-500 border-b border-stone-200">
                    <tr>
                      <th className="px-6 py-4 border-r border-stone-100">NCLC</th>
                      <th className="px-6 py-4 border-r border-stone-100">Compréhension orale</th>
                      <th className="px-6 py-4 border-r border-stone-100">Compréhension écrite</th>
                      <th className="px-6 py-4 border-r border-stone-100">Expression orale</th>
                      <th className="px-6 py-4">Expression écrite</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-stone-100 text-sm">
                    <tr>
                      <td className="px-6 py-6 font-bold border-r border-stone-50">10 et plus</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">549 à 699 (C1-C2)</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">549 à 699 (C1-C2)</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">16 à 20 (C1-C2)</td>
                      <td className="px-6 py-6 text-stone-600">16 à 20 (C1-C2)</td>
                    </tr>
                    <tr className="bg-stone-50/50">
                      <td className="px-6 py-6 font-bold border-r border-stone-50">9</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">523 à 548 (C1)</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">524 à 548 (C1)</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">14-15 (C1)</td>
                      <td className="px-6 py-6 text-stone-600">14-15 (C1)</td>
                    </tr>
                    <tr>
                      <td className="px-6 py-6 font-bold border-r border-stone-50">8</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">503 à 522 (C1)</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">499 à 523 (B2-C1)</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">12-13 (B2)</td>
                      <td className="px-6 py-6 text-stone-600">12-13 (B2)</td>
                    </tr>
                    <tr className="bg-nobel-gold/5 border-l-4 border-l-nobel-gold">
                      <td className="px-6 py-6 font-bold border-r border-stone-50 text-stone-900">7</td>
                      <td className="px-6 py-6 text-stone-900 font-medium border-r border-stone-50">458 à 502 (B2-C1)</td>
                      <td className="px-6 py-6 text-stone-900 font-medium border-r border-stone-50">453 à 498 (B2)</td>
                      <td className="px-6 py-6 text-stone-900 font-medium border-r border-stone-50">10-11 (B2)</td>
                      <td className="px-6 py-6 text-stone-900 font-medium">10-11 (B2)</td>
                    </tr>
                    <tr className="bg-stone-50/50">
                      <td className="px-6 py-6 font-bold border-r border-stone-50">6</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">398 à 457 (B1-B2)</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">406 à 452 (B2)</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">7-8-9 (B1)</td>
                      <td className="px-6 py-6 text-stone-600">7-8-9 (B1)</td>
                    </tr>
                    <tr>
                      <td className="px-6 py-6 font-bold border-r border-stone-50">5</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">369 à 397 (B1)</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">375 à 405 (B1-B2)</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">6 (B1)</td>
                      <td className="px-6 py-6 text-stone-600">6 (B1)</td>
                    </tr>
                    <tr className="bg-stone-50/50">
                      <td className="px-6 py-6 font-bold border-r border-stone-50">4</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">331 à 368 (B1)</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">342 à 374 (B1)</td>
                      <td className="px-6 py-6 text-stone-600 border-r border-stone-50">4-5 (A2)</td>
                      <td className="px-6 py-6 text-stone-600">4-5 (A2)</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>

        {/* Success Stories */}
        <section id="success" className="py-24 bg-[#F9F8F4]">
          <div className="container mx-auto px-6">
            <div className="text-center mb-16">
              <h2 className="font-serif text-4xl md:text-5xl mb-4 text-stone-900">Student Success</h2>
              <p className="text-stone-500">Real results from real applicants. From A1 to Permanent Residency.</p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              <TestimonialCard
                name="Navdeep Singh"
                role="TCF Candidate • Brampton"
                quote="I had already attempted TCF twice with no success. This training completely changed my approach, especially for speaking and writing. Achieving CLB 9 felt impossible before, but the focused exam strategies made it real."
                result="CLB 9 Achieved"
                delay="0s"
              />
              <TestimonialCard
                name="Simran Kaur"
                role="OINP Applicant • Mississauga"
                quote="What stood out for me was the personal feedback after every mock test. I understood exactly where I was losing points. I cleared CLB 7 in my first attempt and became eligible for OINP."
                result="CLB 7 Achieved"
                delay="0.1s"
              />
              <TestimonialCard
                name="Patveer Singh"
                role="Express Entry • Toronto"
                quote="I was stuck at 441 CRS for months. After the B2 Intensive course, I hit CLB 8 in all bands and my score jumped to 498. I received my ITA in the very next draw!"
                result="CLB 8 Achieved"
                delay="0.2s"
              />
              <TestimonialCard
                name="Harpreet Kaur"
                role="Ontario Nomination • Ottawa"
                quote="The methodology here is different. They don't just teach French; they teach the exam. I needed CLB 7 for the Ontario nomination and got it on my first try."
                result="CLB 7 Achieved"
                delay="0.3s"
              />
              <TestimonialCard
                name="Manpreet Singh"
                role="PR Strategy • Vancouver"
                quote="Starting from A1 was daunting, but the structured roadmap kept me motivated. The transition to Canadian cultural context in B1 made all the difference for my interview."
                result="CLB 9 Achieved"
                delay="0.4s"
              />
            </div>
          </div>
        </section>

        {/* Performance Comparison */}
        <section className="py-24 bg-white">
          <div className="container mx-auto px-6">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
              <div>
                <PerformanceMetricDiagram />
              </div>
              <div>
                <div className="inline-block mb-3 text-xs font-bold tracking-widest text-stone-500 uppercase">THE TS ADVANTAGE</div>
                <h2 className="font-serif text-4xl mb-6 text-stone-900">Express Entry Boost</h2>
                <p className="text-lg text-stone-600 mb-6 leading-relaxed">
                  Our data shows that TS School students are 40% more likely to achieve their target CLB level within the first attempt compared to general language schools.
                </p>
                <div className="grid grid-cols-2 gap-4">
                  <div className="p-4 border border-stone-100 rounded-lg">
                    <div className="text-2xl font-serif text-nobel-gold mb-1">92%</div>
                    <div className="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Pass Rate CLB 7</div>
                  </div>
                  <div className="p-4 border border-stone-100 rounded-lg">
                    <div className="text-2xl font-serif text-nobel-gold mb-1">4.8/5</div>
                    <div className="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Student Rating</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      </main>

      <footer className="bg-stone-900 text-stone-400 py-16">
        <div className="container mx-auto px-6">
          <div className="flex flex-col md:flex-row justify-between items-start gap-12 mb-16">
            <div className="max-w-xs">
              <div className="text-white font-serif font-bold text-2xl mb-4">TS Language Platform</div>
              <p className="text-sm leading-relaxed mb-6">Master French with our comprehensive online learning platform designed for all levels.</p>
            </div>

            <div className="grid grid-cols-2 md:grid-cols-4 gap-12 text-sm">
              <div>
                <h4 className="text-white font-serif text-lg mb-4">LEARN</h4>
                <ul className="space-y-2">
                  <li><a href="/courses" className="hover:text-nobel-gold transition-colors">Courses</a></li>
                  <li><a href="/dashboard" className="hover:text-nobel-gold transition-colors">Lessons</a></li>
                  <li><a href="/test" className="hover:text-nobel-gold transition-colors">Tests</a></li>
                  <li><a href="#" className="hover:text-nobel-gold transition-colors">Resources</a></li>
                </ul>
              </div>
              <div>
                <h4 className="text-white font-serif text-lg mb-4">SUPPORT</h4>
                <ul className="space-y-2">
                  <li><a href="#" className="hover:text-nobel-gold transition-colors">Help Center</a></li>
                  <li><a href="#" className="hover:text-nobel-gold transition-colors">Contact Us</a></li>
                  <li><a href="#" className="hover:text-nobel-gold transition-colors">FAQ</a></li>
                  <li><a href="#" className="hover:text-nobel-gold transition-colors">Community</a></li>
                </ul>
              </div>
              <div>
                <h4 className="text-white font-serif text-lg mb-4">COMPANY</h4>
                <ul className="space-y-2">
                  <li><a href="/about" className="hover:text-nobel-gold transition-colors">About Us</a></li>
                  <li><a href="#" className="hover:text-nobel-gold transition-colors">Privacy Policy</a></li>
                  <li><a href="#" className="hover:text-nobel-gold transition-colors">Terms of Service</a></li>
                  <li><a href="#" className="hover:text-nobel-gold transition-colors">Careers</a></li>
                </ul>
              </div>
              <div>
                <h4 className="text-white font-serif text-lg mb-4">NEWSLETTER</h4>
                <p className="text-sm mb-4">Stay updated with our latest courses and tips</p>
                <div className="flex gap-2">
                  <input type="email" placeholder="Enter email" className="bg-stone-800 border-none text-white text-xs p-2 rounded-sm w-full focus:ring-1 focus:ring-nobel-gold" />
                  <button className="bg-nobel-gold text-stone-900 px-3 py-2 text-xs font-bold rounded-sm uppercase">Subscribe</button>
                </div>
              </div>
            </div>
          </div>
          <div className="pt-8 border-t border-stone-800 text-center text-[10px] uppercase tracking-[0.2em] font-medium">
            © 2026 TS Language Platform. All rights reserved.
          </div>
        </div>
      </footer>
    </div>
  );
};

export default App;