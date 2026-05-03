import { CheckCircle2 } from 'lucide-react';

export default function About() {
  return (
    <div className="flex flex-col min-h-screen pt-24 pb-20">
      {/* Header */}
      <div className="bg-blue-900 py-16">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
          <h1 className="text-4xl md:text-5xl font-bold mb-4">About TS Language School</h1>
          <p className="text-blue-100 max-w-2xl mx-auto">Your trusted partner in language education, empowering students to break barriers and speak directly to the world.</p>
        </div>
      </div>

      {/* Intro */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
          <div>
            <h2 className="text-3xl font-bold text-slate-900 mb-6">A Legacy of Educational Excellence</h2>
            <p className="text-slate-600 mb-4 leading-relaxed">
              Established in 2020, TS Language School was created with a clear mission: to deliver high-quality, practical, and affordable language training. We believe language is a powerful bridge that connects people and opportunities.
            </p>
            <p className="text-slate-600 mb-6 leading-relaxed">
              Over the years, we have grown from a small local academy into a trusted learning center, helping more than 3,000 students build confidence and fluency. Our modern teaching methods replace outdated memorization with engaging, interactive learning experiences.
            </p>
            <div className="grid grid-cols-2 gap-6 mt-8">
              <div className="border-l-4 border-blue-600 pl-4">
                <div className="text-3xl font-bold text-slate-900">3K+</div>
                <div className="text-slate-500 text-sm">Happy Learners</div>
              </div>
              <div className="border-l-4 border-blue-600 pl-4">
                <div className="text-3xl font-bold text-slate-900">6+</div>
                <div className="text-slate-500 text-sm">Years of Excellence</div>
              </div>
              <div className="border-l-4 border-blue-600 pl-4">
                <div className="text-3xl font-bold text-slate-900">20+</div>
                <div className="text-slate-500 text-sm">Expert Instructors</div>
              </div>
              <div className="border-l-4 border-blue-600 pl-4">
                <div className="text-3xl font-bold text-slate-900">98%</div>
                <div className="text-slate-500 text-sm">Success Rate</div>
              </div>
            </div>
          </div>
          <div>
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop" alt="Our campus" className="rounded-sm shadow-sm border border-slate-200" />
          </div>
        </div>
      </div>

      {/* Mission & Vision */}
      <div className="bg-slate-50 py-20">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div className="bg-white p-10 rounded-sm shadow-sm border border-slate-200">
              <div className="h-14 w-14 bg-blue-100 text-blue-600 rounded-sm flex items-center justify-center mb-6">
                <svg className="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
              </div>
              <h3 className="text-2xl font-bold text-slate-900 mb-4">Our Mission</h3>
              <p className="text-slate-600 leading-relaxed">
                To provide outstanding language education through modern and effective teaching methods, empowering students to reach their personal, academic, and career goals in an increasingly connected world.
              </p>
            </div>
            <div className="bg-white p-10 rounded-sm shadow-sm border border-slate-200">
              <div className="h-14 w-14 bg-blue-100 text-blue-600 rounded-sm flex items-center justify-center mb-6">
                <svg className="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
              </div>
              <h3 className="text-2xl font-bold text-slate-900 mb-4">Our Vision</h3>
              <p className="text-slate-600 leading-relaxed">
                To become a globally recognized leader in language learning, known for excellence in education, cultural understanding, and the smart integration of technology in teaching.
              </p>
            </div>
          </div>
        </div>
      </div>

      {/* Highlights */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <h2 className="text-3xl font-bold text-slate-900 mb-12 text-center">Why We Stand Out</h2>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {[
            "Accredited by International Bodies",
            "Modern, Technology-Integrated Classrooms",
            <span key="support"><strong>24/7 Support</strong> & Flexible Learning</span>,
            "Native and Highly Qualified Staff",
            "Free Placement Testing",
            "Cultural Activities and Excursions"
          ].map((item, idx) => (
            <div key={idx} className="flex items-start gap-4 p-6 bg-slate-50 rounded-sm border border-slate-200">
              <CheckCircle2 className="h-6 w-6 text-blue-600 shrink-0" />
              <span className="text-slate-800 font-medium">{item}</span>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
