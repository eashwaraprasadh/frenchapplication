/**
 * @license
 * SPDX-License-Identifier: Apache-2.0
*/

import React, { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { Activity, BarChart2, Book, CheckCircle, Target, Search } from 'lucide-react';

// --- EXAM RUBRIC DIAGRAM (Formerly Surface Code) ---
export const SurfaceCodeDiagram: React.FC = () => {
  const [errors, setErrors] = useState<number[]>([]);
  
  const adjacency: Record<number, number[]> = {
    0: [0, 1],
    1: [0, 2],
    2: [1, 3],
    3: [2, 3],
    4: [0, 1, 2, 3],
  };

  const toggleError = (id: number) => {
    setErrors(prev => prev.includes(id) ? prev.filter(e => e !== id) : [...prev, id]);
  };

  const activeStabilizers = [0, 1, 2, 3].filter(stabId => {
    let errorCount = 0;
    Object.entries(adjacency).forEach(([dataId, stabs]) => {
        if (errors.includes(parseInt(dataId)) && stabs.includes(stabId)) {
            errorCount++;
        }
    });
    return errorCount % 2 !== 0;
  });

  return (
    <div className="flex flex-col items-center p-8 bg-white rounded-xl shadow-sm border border-stone-200 my-8 w-full max-w-md mx-auto">
      <h3 className="font-serif text-xl mb-2 text-stone-800">Exam Rubric Checker</h3>
      <p className="text-xs text-stone-400 mb-6 text-center">
        Simulate a student response by clicking <strong>Core Lexical Units</strong>. The <strong>CLB Analyzers</strong> monitor for syntax and cohesion.
      </p>
      
      <div className="relative w-64 h-64 bg-[#F5F4F0] rounded-lg border border-stone-200 p-4 flex flex-wrap justify-between content-between">
         {/* Grid Lines */}
         <div className="absolute inset-0 pointer-events-none flex items-center justify-center opacity-20">
            <div className="w-2/3 h-2/3 border border-stone-400"></div>
            <div className="absolute w-full h-[1px] bg-stone-400"></div>
            <div className="absolute h-full w-[1px] bg-stone-400"></div>
         </div>

         {/* CLB Analyzers */}
         {[
             {id: 0, x: '50%', y: '20%', type: 'GR', color: 'bg-stone-900'},
             {id: 1, x: '20%', y: '50%', type: 'PH', color: 'bg-nobel-gold'},
             {id: 2, x: '80%', y: '50%', type: 'VC', color: 'bg-stone-900'},
             {id: 3, x: '50%', y: '80%', type: 'CO', color: 'bg-nobel-gold'},
         ].map(stab => (
             <motion.div
                key={`stab-${stab.id}`}
                className={`absolute w-10 h-10 -ml-5 -mt-5 flex items-center justify-center text-white text-[9px] font-bold rounded-full shadow-md transition-all duration-300 ${activeStabilizers.includes(stab.id) ? stab.color + ' scale-110' : 'bg-stone-200 text-stone-400 opacity-40'}`}
                style={{ left: stab.x, top: stab.y }}
             >
                 {stab.type}
             </motion.div>
         ))}

         {/* Lexical Units */}
         {[
             {id: 0, x: '20%', y: '20%'}, {id: 1, x: '80%', y: '20%'},
             {id: 4, x: '50%', y: '50%'}, 
             {id: 2, x: '20%', y: '80%'}, {id: 3, x: '80%', y: '80%'},
         ].map(q => (
             <button
                key={`data-${q.id}`}
                onClick={() => toggleError(q.id)}
                className={`absolute w-8 h-8 -ml-4 -mt-4 rounded-sm border-2 flex items-center justify-center transition-all duration-200 z-10 ${errors.includes(q.id) ? 'bg-nobel-gold border-nobel-gold text-white' : 'bg-white border-stone-300 hover:border-stone-500'}`}
                style={{ left: q.x, top: q.y }}
             >
                {errors.includes(q.id) && <Activity size={12} />}
             </button>
         ))}
      </div>

      <div className="mt-8 grid grid-cols-2 gap-x-6 gap-y-2 text-[10px] font-bold uppercase tracking-widest text-stone-400">
          <div className="flex items-center gap-2"><div className="w-2 h-2 bg-stone-900"></div> GR: GRAMMAR</div>
          <div className="flex items-center gap-2"><div className="w-2 h-2 bg-nobel-gold"></div> PH: PHONETICS</div>
          <div className="flex items-center gap-2"><div className="w-2 h-2 bg-stone-900"></div> VC: VOCAB</div>
          <div className="flex items-center gap-2"><div className="w-2 h-2 bg-nobel-gold"></div> CO: COHERENCE</div>
      </div>
    </div>
  );
};

// --- CRS PERFORMANCE CHART ---
export const PerformanceMetricDiagram: React.FC = () => {
    const [level, setLevel] = useState<number>(1);
    
    const data = [
        { label: 'Foundation', standard: 15, expert: 45 },
        { label: 'Entry Ready', standard: 38, expert: 72 },
        { label: 'PR Success', standard: 52, expert: 92 }
    ];

    const currentData = data[level];

    return (
        <div className="flex flex-col p-10 bg-stone-900 text-stone-100 rounded-2xl border border-stone-800 shadow-2xl w-full max-w-2xl mx-auto">
            <div className="mb-10 text-center">
                <h3 className="font-serif text-2xl mb-2 text-white">CRS Probability Score</h3>
                <p className="text-stone-500 text-xs tracking-widest uppercase">Targeting CLB 7-9 for Federal draws</p>
            </div>
            
            <div className="flex justify-center gap-4 mb-12">
                {data.map((d, i) => (
                    <button 
                        key={i}
                        onClick={() => setLevel(i)}
                        className={`px-4 py-2 rounded-full text-[10px] font-bold tracking-[0.2em] uppercase transition-all duration-300 border ${level === i ? 'bg-nobel-gold text-stone-900 border-nobel-gold' : 'bg-transparent text-stone-500 border-stone-800 hover:border-stone-600'}`}
                    >
                        {d.label}
                    </button>
                ))}
            </div>

            {/* Graph Container */}
            <div className="relative w-full pr-4 pl-8">
                {/* Y-axis Labels */}
                <div className="absolute left-0 top-0 bottom-8 w-6 flex flex-col justify-between text-[9px] text-stone-600 font-mono">
                    <span>100%</span>
                    <span>50%</span>
                    <span>0%</span>
                </div>

                {/* Plot Area */}
                <div className="relative h-64 border-l border-b border-stone-700 flex items-end justify-around px-8 ml-2">
                    {/* Grid Lines */}
                    <div className="absolute inset-0 flex flex-col justify-between pointer-events-none opacity-20">
                        <div className="w-full h-[1px] bg-stone-500"></div>
                        <div className="w-full h-[1px] bg-stone-500"></div>
                        <div className="w-full h-[1px] bg-stone-500"></div>
                    </div>

                    {/* Standard Bar */}
                    <div className="flex flex-col items-center gap-3 w-16 h-full justify-end group z-10">
                        <div className="text-[9px] font-mono text-stone-400 opacity-0 group-hover:opacity-100 transition-opacity mb-1">{currentData.standard}%</div>
                        <motion.div 
                            className="w-full bg-stone-700 rounded-t-sm"
                            initial={{ height: 0 }}
                            animate={{ height: `${currentData.standard}%` }}
                            transition={{ type: "spring", stiffness: 60, damping: 15 }}
                        />
                    </div>

                    {/* Expert Bar */}
                    <div className="flex flex-col items-center gap-3 w-16 h-full justify-end group z-10">
                         <div className="text-[9px] font-bold text-nobel-gold mb-1">{currentData.expert}%</div>
                         <motion.div 
                            className="w-full bg-nobel-gold rounded-t-sm shadow-[0_0_25px_rgba(197,160,89,0.3)] relative overflow-hidden"
                            initial={{ height: 0 }}
                            animate={{ height: `${currentData.expert}%` }}
                            transition={{ type: "spring", stiffness: 60, damping: 15, delay: 0.1 }}
                        >
                            <div className="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        </motion.div>
                    </div>
                </div>

                {/* X-axis Labels */}
                <div className="flex justify-around px-8 mt-4 ml-2">
                    <div className="w-16 text-center text-[9px] font-bold uppercase tracking-widest text-stone-500">Standard</div>
                    <div className="w-16 text-center text-[9px] font-bold uppercase tracking-widest text-nobel-gold">TS Prep</div>
                </div>
            </div>
            
            <div className="mt-12 flex items-center justify-center gap-8 text-[10px] font-medium text-stone-500 italic border-t border-stone-800 pt-8">
                <span className="flex items-center gap-2"><CheckCircle size={14} className="text-green-500"/> Verified ITA results</span>
                <span className="flex items-center gap-2"><Target size={14} className="text-nobel-gold"/> Express Entry Aligned</span>
            </div>
        </div>
    )
}

// --- ADAPTIVE TUTORING FLOW ---
export const TransformerDecoderDiagram: React.FC = () => {
  const [step, setStep] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => setStep(s => (s + 1) % 4), 2500);
    return () => clearInterval(interval);
  }, []);

  return (
    <div className="flex flex-col items-center p-10 bg-white rounded-2xl border border-stone-200 shadow-xl w-full max-w-lg mx-auto">
      <h3 className="font-serif text-2xl mb-2 text-stone-900">Personalized Roadmap</h3>
      <p className="text-xs text-stone-500 mb-10 tracking-widest uppercase">From A1 Assessment to PR Application</p>

      <div className="w-full space-y-8">
          {[
              { id: 0, label: 'Initial Evaluation', desc: 'Detailed phonetic & syntactic baseline' },
              { id: 1, label: 'Gap Analysis', desc: 'Identify CLB 7 weak-points in your profile' },
              { id: 2, label: 'Intensive Immersion', desc: '1-on-1 focus on high-yield rubrics' },
              { id: 3, label: 'Exam Readiness', desc: 'Final simulation with certified examiners' }
          ].map((item) => (
              <div key={item.id} className={`flex items-start gap-6 transition-all duration-700 ${step === item.id ? 'opacity-100 translate-x-4' : 'opacity-20 translate-x-0'}`}>
                  <div className={`w-8 h-8 rounded-full border-2 flex items-center justify-center shrink-0 font-serif font-bold ${step === item.id ? 'bg-stone-900 border-stone-900 text-white' : 'border-stone-200 text-stone-300'}`}>
                      {item.id + 1}
                  </div>
                  <div>
                      <h4 className={`font-serif text-lg leading-none mb-1 ${step === item.id ? 'text-stone-900' : 'text-stone-300'}`}>{item.label}</h4>
                      <p className="text-xs text-stone-400 font-medium">{item.desc}</p>
                  </div>
                  {step === item.id && (
                      <motion.div layoutId="arrow" className="ml-auto text-nobel-gold">
                          <CheckCircle size={20} />
                      </motion.div>
                  )}
              </div>
          ))}
      </div>
      
      <div className="mt-12 w-full h-1 bg-stone-50 rounded-full overflow-hidden">
          <motion.div 
            className="h-full bg-nobel-gold" 
            animate={{ width: `${((step + 1) / 4) * 100}%` }} 
            transition={{ duration: 0.5 }}
          />
      </div>
    </div>
  );
};