import React, { useState } from 'react';
import { motion, AnimatePresence } from 'motion/react';
import { CheckCircle2, XCircle, ArrowRight, Flag } from 'lucide-react';

const QUIZ_QUESTIONS = [
  {
    question: "Comment tu t’appelles ?",
    options: ["Je suis indien.", "Je m’appelle Rahul.", "J’ai 20 ans.", "Oui, merci."],
    answerIndex: 1
  },
  {
    question: "Quel âge as-tu ?",
    options: ["J’ai 18 ans.", "Je vais bien.", "Je suis étudiant.", "Bonjour."],
    answerIndex: 0
  },
  {
    question: "Où habites-tu ?",
    options: ["J’aime Paris.", "J’habite à Chennai.", "Je parle français.", "Merci beaucoup."],
    answerIndex: 1
  },
  {
    question: "Quelle est la couleur du ciel ?",
    options: ["Rouge", "Bleu", "Vert", "Noir"],
    answerIndex: 1
  },
  {
    question: "Combien font 2 + 3 ?",
    options: ["4", "6", "5", "7"],
    answerIndex: 2
  },
  {
    question: "Quel jour vient après lundi ?",
    options: ["Mardi", "Jeudi", "Vendredi", "Dimanche"],
    answerIndex: 0
  },
  {
    question: "Choisissez le bon article : ___ pomme",
    options: ["Le", "La", "Les", "Un"],
    answerIndex: 1
  },
  {
    question: "Je ___ étudiant.",
    options: ["es", "suis", "êtes", "sommes"],
    answerIndex: 1
  },
  {
    question: "Nous ___ français.",
    options: ["parle", "parlent", "parlons", "parlez"],
    answerIndex: 2
  },
  {
    question: "Comment ça va ?",
    options: ["Merci", "Ça va bien", "Bonne nuit", "À demain"],
    answerIndex: 1
  }
];

export function FrenchQuiz() {
  const [currentQuestion, setCurrentQuestion] = useState(0);
  const [selectedOption, setSelectedOption] = useState<number | null>(null);
  const [isAnswered, setIsAnswered] = useState(false);
  const [score, setScore] = useState(0);
  const [showResults, setShowResults] = useState(false);

  const handleOptionClick = (index: number) => {
    if (isAnswered) return;
    setSelectedOption(index);
    setIsAnswered(true);

    if (index === QUIZ_QUESTIONS[currentQuestion].answerIndex) {
      setScore(score + 1);
    }
  };

  const handleNext = () => {
    if (currentQuestion < QUIZ_QUESTIONS.length - 1) {
      setCurrentQuestion(currentQuestion + 1);
      setSelectedOption(null);
      setIsAnswered(false);
    } else {
      setShowResults(true);
    }
  };

  const handleRestart = () => {
    setCurrentQuestion(0);
    setSelectedOption(null);
    setIsAnswered(false);
    setScore(0);
    setShowResults(false);
  };

  return (
    <motion.section 
      initial={{ opacity: 0, y: 30 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true, margin: "-50px" }}
      transition={{ duration: 0.7 }}
      className="py-24 bg-blue-50 border-y border-blue-100 relative overflow-hidden"
    >
      <div className="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-20">
        <motion.div animate={{ rotate: 360 }} transition={{ duration: 100, repeat: Infinity, ease: 'linear' }} className="absolute -top-40 -left-40 w-96 h-96 bg-blue-200 rounded-full blur-[100px]"></motion.div>
        <motion.div animate={{ rotate: -360 }} transition={{ duration: 100, repeat: Infinity, ease: 'linear' }} className="absolute -bottom-40 -right-40 w-96 h-96 bg-red-200 rounded-full blur-[100px]"></motion.div>
      </div>

      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div className="text-center mb-12">
          <div className="inline-flex items-center justify-center p-3 sm:p-4 bg-white rounded-full shadow-md text-blue-600 mb-6 group cursor-pointer hover:scale-110 transition-transform">
             <Flag className="w-8 h-8 group-hover:rotate-12 transition-transform" />
          </div>
          <h2 className="text-blue-600 font-medium tracking-widest uppercase text-sm mb-2">Mini Challenge</h2>
          <h3 className="text-3xl md:text-5xl font-semibold text-slate-900 tracking-tight">Test Your French Knowledge</h3>
        </div>

        <div className="bg-white rounded-xl shadow-2xl border border-slate-100 overflow-hidden relative">
          <div className="h-2 w-full bg-slate-100">
            <motion.div 
              className="h-full bg-blue-500"
              initial={{ width: '0%' }}
              animate={{ width: `${showResults ? 100 : (currentQuestion / QUIZ_QUESTIONS.length) * 100}%` }}
              transition={{ duration: 0.5 }}
            />
          </div>

          <div className="p-8 md:p-12">
            <AnimatePresence mode="wait">
              {showResults ? (
                <motion.div 
                  key="results"
                  initial={{ opacity: 0, scale: 0.95 }}
                  animate={{ opacity: 1, scale: 1 }}
                  exit={{ opacity: 0, scale: 0.95 }}
                  className="text-center"
                >
                  <div className="text-6xl mb-6">
                    {score === QUIZ_QUESTIONS.length ? '🎉' : score >= QUIZ_QUESTIONS.length / 2 ? '👍' : '📚'}
                  </div>
                  <h4 className="text-3xl font-bold text-slate-900 mb-2">Quiz Complete!</h4>
                  <p className="text-xl text-slate-600 mb-8">You scored <span className="font-bold text-blue-600">{score}</span> out of <span className="font-bold">{QUIZ_QUESTIONS.length}</span></p>
                  
                  <button 
                    onClick={handleRestart}
                    className="inline-flex items-center justify-center px-8 py-3 bg-blue-600 text-white font-medium rounded-sm hover:-translate-y-1 hover:shadow-lg transition-all"
                  >
                    Try Again
                  </button>
                </motion.div>
              ) : (
                <motion.div 
                  key={currentQuestion}
                  initial={{ opacity: 0, x: 20 }}
                  animate={{ opacity: 1, x: 0 }}
                  exit={{ opacity: 0, x: -20 }}
                  className="flex flex-col"
                >
                  <span className="text-sm font-bold text-slate-400 mb-4 uppercase tracking-widest">Question {currentQuestion + 1} of {QUIZ_QUESTIONS.length}</span>
                  <h4 className="text-2xl md:text-3xl font-semibold text-slate-900 mb-8 leading-snug">{QUIZ_QUESTIONS[currentQuestion].question}</h4>
                  
                  <div className="space-y-4">
                    {QUIZ_QUESTIONS[currentQuestion].options.map((option, index) => {
                      const isCorrectAnswer = index === QUIZ_QUESTIONS[currentQuestion].answerIndex;
                      const isSelected = selectedOption === index;
                      
                      let buttonClasses = "w-full text-left p-5 rounded-lg border-2 transition-all font-medium flex items-center justify-between text-lg ";
                      
                      if (!isAnswered) {
                        buttonClasses += "border-slate-200 hover:border-blue-400 hover:bg-blue-50 text-slate-700";
                      } else if (isCorrectAnswer) {
                        buttonClasses += "border-green-500 bg-green-50 text-green-800";
                      } else if (isSelected && !isCorrectAnswer) {
                        buttonClasses += "border-red-500 bg-red-50 text-red-800";
                      } else {
                        buttonClasses += "border-slate-200 bg-slate-50 text-slate-400 opacity-50";
                      }

                      return (
                        <button
                          key={index}
                          disabled={isAnswered}
                          onClick={() => handleOptionClick(index)}
                          className={buttonClasses}
                        >
                          <span>{option}</span>
                          {isAnswered && isCorrectAnswer && <CheckCircle2 className="w-6 h-6 text-green-500" />}
                          {isAnswered && isSelected && !isCorrectAnswer && <XCircle className="w-6 h-6 text-red-500" />}
                        </button>
                      );
                    })}
                  </div>

                  {isAnswered && (
                    <motion.div 
                      initial={{ opacity: 0, y: 10 }}
                      animate={{ opacity: 1, y: 0 }}
                      className="mt-8 flex justify-end"
                    >
                      <button 
                        onClick={handleNext}
                        className="inline-flex items-center justify-center px-6 py-3 bg-blue-900 text-white font-medium rounded-sm hover:bg-blue-800 transition-colors group"
                      >
                        {currentQuestion < QUIZ_QUESTIONS.length - 1 ? 'Next Question' : 'View Results'}
                        <ArrowRight className="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" />
                      </button>
                    </motion.div>
                  )}
                </motion.div>
              )}
            </AnimatePresence>
          </div>
        </div>
      </div>
    </motion.section>
  );
}
