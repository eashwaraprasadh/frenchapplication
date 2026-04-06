<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Quiz</title>
  <link href="{{ asset('new-assets/images/tslogo.jpg') }}" rel="shortcut icon" type="image/x-icon" />
  <style>
    :root {
      --primary: #ff9f1c;
      --success: #2ec4b6;
      --danger: #e71d36;
      --bg: #fff7eb;
      --card: #ffffff;
      --text: #011627;
    }
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: "Comic Sans MS", cursive, sans-serif;
      background: var(--bg);
      color: var(--text);
      display: flex;
      min-height: 100vh;
      padding: 20px;
      justify-content: flex-end; /* move content to the right */
      align-items: center;
      position: relative;
    }
    /* Add background image with opacity */
    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: url('../images/nature.jpg') ;
      opacity: 0.45; /* Increase for more visibility */
      z-index: -1;
    }
    /* Quiz container on the right side */
    .quiz-container {
      width: 100%;
      max-width: 500px;
      background: var(--card);
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      animation: popIn 0.5s ease;
      margin: 0 auto; /* center the container */
    }
    @keyframes popIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }
    .header {
      background: var(--primary);
      color: #fff;
      padding: 25px;
      text-align: center;
    }
    .header h1 {
      font-size: 2rem;
    }
    .progress {
      height: 10px;
      background: #ffe5b4;
      width: 100%;
    }
    .progress-bar {
      height: 100%;
      background: var(--success);
      width: 0%;
      transition: width 0.4s ease;
    }
    .question-box {
      padding: 30px;
    }
    .question {
      font-size: 1.4rem;
      margin-bottom: 25px;
      animation: bounceIn 0.5s ease;
    }
    @keyframes bounceIn {
      0% {
        opacity: 0;
        transform: translateY(-15px);
      }
      60% {
        transform: translateY(5px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .options label {
      display: block;
      background: #c3db84;
      margin: 12px 0;
      padding: 15px 20px;
      border-radius: 12px;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
    }
    .options label:hover {
      background: #ffe5b4;
      transform: translateX(6px);
    }
    .options input[type="radio"] {
      display: none;
    }
    .options input[type="radio"]:checked + span {
      background: var(--primary);
      color: #fff;
      display: block;
      border-radius: 8px;
      padding: 10px;
    }
    .btn {
      margin-top: 25px;
      background: var(--primary);
      color: #fff;
      border: none;
      padding: 14px 28px;
      border-radius: 12px;
      font-size: 1.1rem;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
    }
    .btn:hover {
      background: #e8890b;
      transform: translateY(-3px);
    }
    .btn:disabled {
      background: #ccc;
      cursor: not-allowed;
      transform: none;
    }
    .result {
      padding: 30px;
      text-align: center;
      animation: fadeIn 0.6s ease;
    }
    .result h2 {
      margin-bottom: 20px;
    }
    .result .score {
      font-size: 2.2rem;
      margin-bottom: 20px;
    }
    .result .answers {
      text-align: left;
      margin-top: 30px;
      max-height: 400px;
      overflow-y: auto;
      padding-right: 10px;
    }
    .result .answers::-webkit-scrollbar {
      width: 6px;
    }
    .result .answers::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 3px;
    }
    .result .answers::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.3);
      border-radius: 3px;
    }
    .answer-item {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 16px;
      border-left: 4px solid transparent;
      transition: all 0.3s ease;
      position: relative;
    }
    .answer-item:hover {
      background: rgba(255, 255, 255, 0.08);
      transform: translateX(4px);
    }
    .answer-item.correct {
      border-left-color: var(--success);
      background: rgba(76, 149, 108, 0.1);
    }
    .answer-item.incorrect {
      border-left-color: var(--danger);
      background: rgba(184, 84, 80, 0.1);
    }
    .answer-number {
      font-weight: bold;
      color: rgba(255, 255, 255, 0.9);
      font-size: 0.9rem;
      margin-bottom: 8px;
    }
    .answer-question {
      font-weight: 500;
      margin-bottom: 12px;
      line-height: 1.4;
      color: #000;
    }
    .answer-responses {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .response-row {
      display: flex;
      align-items: center;
      padding: 6px 10px;
      border-radius: 6px;
      font-size: 0.9rem;
    }
    .response-label {
      font-weight: 600;
      min-width: 100px;
      margin-right: 10px;
      color: #000;
    }
    .user-response {
      background: rgba(255, 255, 255, 0.1);
      color: #000;
    }
    .correct-response {
      background: rgba(76, 149, 108, 0.2);
      color: var(--success);
      font-weight: 500;
    }
    .answer-icon {
      margin-left: 8px;
      font-size: 1.1rem;
    }
    .correct {
      color: var(--success);
    }
    .incorrect {
      color: var(--danger);
    }

    /* Professional review button styling */
    .review-btn {
      background: linear-gradient(135deg, var(--primary), #e8890b);
      box-shadow: 0 4px 12px rgba(255, 159, 28, 0.35);
      font-weight: 600;
      letter-spacing: 0.5px;
    }
    .review-btn:hover {
      background: linear-gradient(135deg, #e8890b, var(--primary));
      box-shadow: 0 6px 16px rgba(255, 159, 28, 0.45);
      transform: translateY(-3px) scale(1.02);
    }
    /* Left frost image block (scoped) */
    .left-frost {
      position: absolute;
      left: 30%;
      top: 50%;
      transform: translate(-50%, -50%);
      z-index: 1;
      pointer-events: none;
    }
    .left-frost nav {
      width: clamp(22rem, 40vw, 36rem);
      position: relative;
      display: flex;
      border-radius: 1em;
      overflow: hidden;
      filter: url(#❄);
      pointer-events: auto;
    }
    .left-frost img {
      width: 100%;
      display: block;
      filter: none;
    }
    .left-frost .hover-area {
      display: none;
    }
    .left-frost i {
      background: white;
      opacity: 0;
      transition: opacity 5s;
      border-radius: 50%;
      scale: 2;
    }
    .left-frost i:is(:hover, :active) {
      opacity: 1;
      transition-duration: 0s;
    }
    .left-frost canvas.scratch {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      display: block;
      z-index: 5;
      cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='100' height='120' viewport='0 0 100 100' style='fill:white;font-size:80px; opacity: .8;'><text y='50%'>❄</text></svg>") 45 35, auto;
      touch-action: none;
      transition: opacity .35s ease;
    }
    .left-frost nav.revealed { filter: none; }
    
    /* Mobile layout */
    @media (max-width: 768px) {
      .mobile-layout {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
      }
      .left-frost {
        order: 1;
        width: 100%;
        padding: 1rem;
        margin: 0 auto;
        max-width: 100%;
        /* Increase image size for mobile */
        height: 320px;
      }
      .left-frost nav {
        width: 100%;
        max-width: 30rem;
        margin: 0 auto;
        height: 320px;
        min-height: 200px;
      }
      .quiz-container {
        padding-bottom: 30vh; /* Space for the fixed image at bottom */
        /* Increase quiz size for mobile */
        max-width: 95vw;
        font-size: 1.2rem;
      }
      .header h1 {
        font-size: 2.4rem;
      }
      .question {
        font-size: 1.6rem;
      }
    }
  </style>
</head>
<body>
  <div class="mobile-layout">
    <!-- Frost image block at the top -->
    <div class="left-frost">
    <svg height="0" width="0" viewBox="0 0 1 1" color-interpolation-filters="sRGB" aria-hidden="true">
      <filter id="❄" primitiveUnits="userSpaceOnUse" x="0%" y="0%" width="120%" height="120%">
        <feComponentTransfer result="SourceBackground" in="SourceGraphic">
          <feFuncR type="discrete" tableValues="0.000 0.016 0.032 0.048 0.063 0.079 0.095 0.111 0.127 0.143 0.159 0.175 0.190 0.206 0.222 0.238 0.254 0.270 0.286 0.302 0.317 0.333 0.349 0.365 0.381 0.397 0.413 0.429 0.444 0.460 0.476 0.492 0.508 0.524 0.540 0.556 0.571 0.587 0.603 0.619 0.635 0.651 0.667 0.683 0.698 0.714 0.730 0.746 0.762 0.778 0.794 0.810 0.825 0.841 0.857 0.873 0.889 0.905 0.921 0.937 0.952 0.968 0.984 1.000"></feFuncR>
          <feFuncG type="discrete" tableValues="0.000 0.016 0.032 0.048 0.063 0.079 0.095 0.111 0.127 0.143 0.159 0.175 0.190 0.206 0.222 0.238 0.254 0.270 0.286 0.302 0.317 0.333 0.349 0.365 0.381 0.397 0.413 0.429 0.444 0.460 0.476 0.492 0.508 0.524 0.540 0.556 0.571 0.587 0.603 0.619 0.635 0.651 0.667 0.683 0.698 0.714 0.730 0.746 0.762 0.778 0.794 0.810 0.825 0.841 0.857 0.873 0.889 0.905 0.921 0.937 0.952 0.968 0.984 1.000"></feFuncG>
          <feFuncB type="discrete" tableValues="0.000 0.016 0.032 0.048 0.063 0.079 0.095 0.111 0.127 0.143 0.159 0.175 0.190 0.206 0.222 0.238 0.254 0.270 0.286 0.302 0.317 0.333 0.349 0.365 0.381 0.397 0.413 0.429 0.444 0.460 0.476 0.492 0.508 0.524 0.540 0.556 0.571 0.587 0.603 0.619 0.635 0.651 0.667 0.683 0.698 0.714 0.730 0.746 0.762 0.778 0.794 0.810 0.825 0.841 0.857 0.873 0.889 0.905 0.921 0.937 0.952 0.968 0.984 1.000"></feFuncB>
        </feComponentTransfer>
        <feBlend result="blend-0" in="SourceBackground" in2="none"></feBlend>
        <feGaussianBlur result="gaussian-blur-6" in="blend-0" stdDeviation="10"></feGaussianBlur>
        <feTurbulence result="turbulence-0" baseFrequency="0.420" type="fractalNoise" />
        <feDisplacementMap result="displacement-map-0" in="gaussian-blur-6" in2="turbulence-0" scale="150" xChannelSelector="R" yChannelSelector="G"></feDisplacementMap>
        <feComponentTransfer result="SourceMask" in="SourceGraphic">
          <feFuncR type="discrete" tableValues="0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000"></feFuncR>
          <feFuncG type="discrete" tableValues="0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000"></feFuncG>
          <feFuncB type="discrete" tableValues="0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000"></feFuncB>
        </feComponentTransfer>
        <feBlend result="SourceMask"></feBlend>
        <feColorMatrix result="color-matrix-0" in="SourceMask" values="0.761905 0.190476 0.047619 0 0 0.761905 0.190476 0.047619 0 0 0.761905 0.190476 0.047619 0 0 0 0 0 1 0"></feColorMatrix>
        <feColorMatrix result="color-matrix-1" in="color-matrix-0" type="luminanceToAlpha"></feColorMatrix>
        <feGaussianBlur result="gaussian-blur-0" in="color-matrix-1" stdDeviation="0"></feGaussianBlur>
        <feComposite result="composite-1" in="displacement-map-0" in2="gaussian-blur-0" operator="in"></feComposite>
        <feMerge result="merge-0">
          <feMergeNode in="blend-0"></feMergeNode>
          <feMergeNode in="composite-1"></feMergeNode>
        </feMerge>
      </filter>

      <filter id="gray-unpack-2b">
        <feColorMatrix id="unpackMatrix" in="SourceGraphic" result="unpackedGray" type="matrix" values="0.761905 0.190476 0.047619 0 0 0.761905 0.190476 0.047619 0 0 0.761905 0.190476 0.047619 0 0 0 0 0 1 0" />
      </filter>
      <filter id="gray-pack-2b">
        <feComponentTransfer id="feComponentTransfer-1" result="packed" in="SourceGraphic">
          <feFuncR id="feFuncR-1" type="discrete" tableValues="0 0.3333 0.6667 1"></feFuncR>
          <feFuncG id="feFuncG-1" type="discrete" tableValues="0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1" />
          <feFuncB id="feFuncB-1" type="discrete" tableValues="0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1 0 0.3333 0.6667 1"></feFuncB>
          <feFuncA type="identity"></feFuncA>
        </feComponentTransfer>
      </filter>
      <filter id="unpack-lower">
        <feComponentTransfer in="SourceGraphic" result="component-transfer-0">
          <feFuncR type="discrete" id="unpack-lower-r" tableValues="0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000 0.000 0.333 0.667 1.000"></feFuncB>
        </feComponentTransfer>
      </filter>
      <filter id="pack-upper">
        <feColorMatrix type="matrix" id="pack-upper-quantize" result="quantized" values="0.24705882352941178 0 0 0 0 0 0.24705882352941178 0 0 0 0 0 0.24705882352941178 0 0 0 0 0 1 0" in="SourceGraphic"></feColorMatrix>
        <feComposite in="quantized" operator="over" result="composited" in2="quantized"></feComposite>
        <feColorMatrix in="composited" type="matrix" id="pack-upper-shift" values="4 0 0 0 0 0 4 0 0 0 0 0 4 0 0 0 0 0 1 0" result="color-matrix-0"></feColorMatrix>
      </filter>
      <filter id="pack-lower">
        <feColorMatrix type="matrix" id="pack-lower-matrix" values="0.011764705882352941 0 0 0 0 0 0.011764705882352941 0 0 0 0 0 0.011764705882352941 0 0 0 0 0 1 0"></feColorMatrix>
      </filter>
      <filter id="unpack-upper">
        <feComponentTransfer in="SourceGraphic" result="component-transfer-0">
          <feFuncR type="discrete" id="unpack-upper-r" tableValues="0.000 0.016 0.032 0.048 0.063 0.079 0.095 0.111 0.127 0.143 0.159 0.175 0.190 0.206 0.222 0.238 0.254 0.270 0.286 0.302 0.317 0.333 0.349 0.365 0.381 0.397 0.413 0.429 0.444 0.460 0.476 0.492 0.508 0.524 0.540 0.556 0.571 0.587 0.603 0.619 0.635 0.651 0.667 0.683 0.698 0.714 0.730 0.746 0.762 0.778 0.794 0.810 0.825 0.841 0.857 0.873 0.889 0.905 0.921 0.937 0.952 0.968 0.984 1.000"></feFuncR>
          <feFuncG type="discrete" id="unpack-upper-g" tableValues="0.000 0.016 0.032 0.048 0.063 0.079 0.095 0.111 0.127 0.143 0.159 0.175 0.190 0.206 0.222 0.238 0.254 0.270 0.286 0.302 0.317 0.333 0.349 0.365 0.381 0.397 0.413 0.429 0.444 0.460 0.476 0.492 0.508 0.524 0.540 0.556 0.571 0.587 0.603 0.619 0.635 0.651 0.667 0.683 0.698 0.714 0.730 0.746 0.762 0.778 0.794 0.810 0.825 0.841 0.857 0.873 0.889 0.905 0.921 0.937 0.952 0.968 0.984 1.000"></feFuncG>
          <feFuncB type="discrete" id="unpack-upper-b" tableValues="0.000 0.016 0.032 0.048 0.063 0.079 0.095 0.111 0.127 0.143 0.159 0.175 0.190 0.206 0.222 0.238 0.254 0.270 0.286 0.302 0.317 0.333 0.349 0.365 0.381 0.397 0.413 0.429 0.444 0.460 0.476 0.492 0.508 0.524 0.540 0.556 0.571 0.587 0.603 0.619 0.635 0.651 0.667 0.683 0.698 0.714 0.730 0.746 0.762 0.778 0.794 0.810 0.825 0.841 0.857 0.873 0.889 0.905 0.921 0.937 0.952 0.968 0.984 1.000"></feFuncB>
        </feComponentTransfer>
      </filter>
    </svg>
    <nav>
      <img alt="cold image" />
      <canvas class="scratch"></canvas>
      <aside class="hover-area"></aside>
    </nav>
  </div>
  <div class="quiz-container">
    <div class="header">
      <h1>Quiz tout simple !</h1>
    </div>
    <div class="progress">
      <div class="progress-bar" id="progressBar"></div>
    </div>

    <div id="quizBox" class="question-box">
      <div class="question" id="questionText"></div>
      <div class="options" id="optionsBox"></div>
      <button class="btn" id="nextBtn" onclick="nextQuestion()">Submit</button>
    </div>

    <div id="resultBox" class="result" style="display:none;">
      <h2>Bravo ! Voici ton score</h2>
      <div class="score" id="scoreText"></div>
      <button class="btn review-btn" id="showAnswersBtn" onclick="showAnswers()">See Answers</button>
      <div class="answers" id="answersText" style="display:none;"></div>
      <button class="btn" onclick="location.href='join-now.html'">Back</button>
    </div>
  </div>

  <script>
    // Harmonize container colors with the nature background
    const naturePalette = {
      primary: "#3a6b47",      // muted forest green
      success: "#4c956c",      // soft sage
      danger: "#b85450",       // earthy terracotta
      bg: "rgba(250, 248, 243, 0.92)", // warm off-white with slight transparency
      card: "rgba(255, 255, 255, 0.85)", // slightly transparent white
      text: "#2d2a26"          // dark charcoal
    };

    // Inject updated CSS variables
    const root = document.documentElement;
    Object.entries(naturePalette).forEach(([key, val]) => {
      root.style.setProperty(`--${key}`, val);
    });

    const quiz = [
      {
        question: "Quel mot commence par la lettre « A » ?",
        options: ["Chat", "Avion", "Voiture", "École"],
        answer: 1,
        level: "facile"
      },
      {
        question: "Complète : « Le chat est ___ ».",
        options: ["grand", "petit", "chaud", "froid"],
        answer: 0,
        level: "facile"
      },
      {
        question: "Quel animal dit « Meuh » ?",
        options: ["Chien", "Chat", "Vache", "Oiseau"],
        answer: 2,
        level: "facile"
      },
      {
        question: "Combien de lettres dans le mot « soleil » ?",
        options: ["5", "6", "7", "8"],
        answer: 1,
        level: "facile"
      },
      {
        question: "Quel mot rime avec « jour » ?",
        options: ["Amour", "Toujours", "Bonjour", "Pour"],
        answer: 2,
        level: "facile"
      },
      {
        question: "Quelle couleur est le ciel quand il fait beau ?",
        options: ["Rouge", "Vert", "Bleu", "Jaune"],
        answer: 2,
        level: "facile"
      },
      {
        question: "Complète : « J’ai ___ pommes. »",
        options: ["un", "une", "des", "le"],
        answer: 2,
        level: "facile"
      },
      {
        question: "Quel est le contraire de « petit » ?",
        options: ["Gros", "Grand", "Court", "Long"],
        answer: 1,
        level: "facile"
      },
      {
        question: "Quel mois vient après juillet ?",
        options: ["Juin", "Septembre", "Août", "Mai"],
        answer: 2,
        level: "facile"
      },
      {
        question: "Comment dit-on « hello » en français ?",
        options: ["Salut", "Bonjour", "Au revoir", "Merci"],
        answer: 1,
        level: "facile"
      }
    ];

    let current = 0;
    let score = 0;
    let userAnswers = [];

    function loadQuestion() {
      const q = quiz[current];
      document.getElementById("questionText").textContent = `Q${current + 1}. ${q.question}`;
      const optsBox = document.getElementById("optionsBox");
      optsBox.innerHTML = "";
      q.options.forEach((opt, idx) => {
        const label = document.createElement("label");
        label.innerHTML = `<input type="radio" name="q" value="${idx}" onchange="enableNext()"> <span>${opt}</span>`;
        optsBox.appendChild(label);
      });
      document.getElementById("nextBtn").disabled = true;
      updateProgress();
    }

    function enableNext() {
      document.getElementById("nextBtn").disabled = false;
    }

    function updateProgress() {
      const percent = ((current + 1) / quiz.length) * 100;
      document.getElementById("progressBar").style.width = percent + "%";
    }

    function nextQuestion() {
      const selected = document.querySelector('input[name="q"]:checked');
      if (!selected) return;
      const ans = parseInt(selected.value);
      userAnswers.push(ans);
      if (ans === quiz[current].answer) score++;
      current++;
      if (current < quiz.length) {
        loadQuestion();
      } else {
        showResult();
      }
    }

    function showResult() {
      document.getElementById("quizBox").style.display = "none";
      document.getElementById("resultBox").style.display = "block";
      document.getElementById("scoreText").textContent = `${score} / ${quiz.length}`;
    }

    function showAnswers() {
      const answersDiv = document.getElementById("answersText");
      answersDiv.innerHTML = "";
      quiz.forEach((q, idx) => {
        const div = document.createElement("div");
        div.className = "answer-item";
        
        const isCorrect = userAnswers[idx] === q.answer;
        div.classList.add(isCorrect ? "correct" : "incorrect");
        
        const correct = q.options[q.answer];
        const user = q.options[userAnswers[idx]];
        
        div.innerHTML = `
          <div class="answer-number">Question ${idx + 1}</div>
          <div class="answer-question">${q.question}</div>
          <div class="answer-responses">
            <div class="response-row user-response">
              <span class="response-label">Ta réponse:</span>
              <span>${user}</span>
              <span class="answer-icon ${isCorrect ? 'correct' : 'incorrect'}">${isCorrect ? '✓' : '✗'}</span>
            </div>
            ${!isCorrect ? `
              <div class="response-row correct-response">
                <span class="response-label">Bonne réponse:</span>
                <span>${correct}</span>
                <span class="answer-icon correct">✓</span>
              </div>
            ` : ''}
          </div>
        `;
        answersDiv.appendChild(div);
      });
      answersDiv.style.display = "block";
      document.getElementById("showAnswersBtn").style.display = "none";
    }

    function backToScore() {
      document.getElementById("answersText").style.display = "none";
      document.getElementById("showAnswersBtn").style.display = "inline-block";
    }
    // Frost init - canvas scratch to reveal
    const hoverAreas = 30; // no longer used for grid, kept for parity if needed later
    const img = "../images/tests.jpg') }}";
    function initFrost() {
      const nav = document.querySelector('.left-frost nav');
      if (!nav) return;
      const imageEl = nav.querySelector('img');
      let canvas = nav.querySelector('canvas.scratch');
      let ctx = canvas.getContext('2d');
      let revealed = false;
      let revealTimer = null;
      let recreateTimer = null;

      function resizeAndRedraw() {
        const dpr = window.devicePixelRatio || 1;
        const rect = nav.getBoundingClientRect();
        canvas.width = Math.max(1, Math.floor(rect.width * dpr));
        canvas.height = Math.max(1, Math.floor(rect.height * dpr));
        canvas.style.width = rect.width + 'px';
        canvas.style.height = rect.height + 'px';
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        // draw blurred image to cover fully
        ctx.clearRect(0, 0, rect.width, rect.height);
        ctx.filter = 'blur(18px) saturate(0.5) brightness(0.9)';
        // cover with image fitted to nav width
        const iw = imageEl.naturalWidth || rect.width;
        const ih = imageEl.naturalHeight || rect.height;
        const ar = iw / ih;
        let dw = rect.width, dh = rect.width / ar;
        if (dh < rect.height) { dh = rect.height; dw = rect.height * ar; }
        const dx = (rect.width - dw) / 2;
        const dy = (rect.height - dh) / 2;
        ctx.drawImage(imageEl, dx, dy, dw, dh);
        ctx.filter = 'none';
        // set erase mode for scratch
        ctx.globalCompositeOperation = 'destination-out';
      }

      function computeClearedRatio() {
        // sample alpha channel to estimate cleared area
        const { width, height } = canvas;
        if (width === 0 || height === 0) return 0;
        const imgData = ctx.getImageData(0, 0, width, height);
        const data = imgData.data;
        let cleared = 0;
        let total = 0;
        const step = 16; // sample every 16px for performance
        const stride = 4; // RGBA
        for (let y = 0; y < height; y += step) {
          for (let x = 0; x < width; x += step) {
            const idx = (y * width + x) * stride + 3; // alpha
            if (data[idx] < 8) cleared++;
            total++;
          }
        }
        return total ? cleared / total : 0;
      }

      function revealIfNeeded(force = false) {
        if (revealed) return;
        const ratio = force ? 1 : computeClearedRatio();
        if (force || ratio >= 0.5) {
          revealed = true;
          nav.classList.add('revealed');
          canvas.style.opacity = '0';
          canvas.style.pointerEvents = 'none';
          if (revealTimer) clearTimeout(revealTimer);
          if (recreateTimer) clearTimeout(recreateTimer);
          revealTimer = setTimeout(() => {
            if (canvas && canvas.parentNode) {
              canvas.parentNode.removeChild(canvas);
            }
            // auto close after 5s: recreate blurred canvas overlay
            recreateTimer = setTimeout(() => {
              // rebuild canvas
              const newCanvas = document.createElement('canvas');
              newCanvas.className = 'scratch';
              nav.appendChild(newCanvas);
              canvas = newCanvas;
              ctx = canvas.getContext('2d');
              revealed = false;
              nav.classList.remove('revealed');
              // ensure interactive again
              canvas.style.opacity = '1';
              canvas.style.pointerEvents = 'auto';
              resizeAndRedraw();
              setupScratch();
            }, 5000);
          }, 450);
        }
      }

      function setupScratch() {
        let drawing = false;
        let last = null;
        const brush = 26; // radius in px
        const rect = () => nav.getBoundingClientRect();
        let moveCount = 0;

        function scratchAt(x, y) {
          ctx.beginPath();
          ctx.arc(x, y, brush, 0, Math.PI * 2);
          ctx.fill();
        }

        function pointerPos(e) {
          const r = rect();
          const clientX = e.touches ? e.touches[0].clientX : e.clientX;
          const clientY = e.touches ? e.touches[0].clientY : e.clientY;
          return { x: clientX - r.left, y: clientY - r.top };
        }

        function onDown(e) { drawing = true; last = pointerPos(e); scratchAt(last.x, last.y); e.preventDefault(); }
        function onMove(e) {
          if (!drawing) return;
          const p = pointerPos(e);
          // draw a line of circles between last and p for smoothness
          const dx = p.x - last.x, dy = p.y - last.y;
          const dist = Math.hypot(dx, dy);
          const steps = Math.max(1, Math.floor(dist / (brush * 0.5)));
          for (let i = 0; i <= steps; i++) {
            const t = i / steps;
            scratchAt(last.x + dx * t, last.y + dy * t);
          }
          last = p;
          e.preventDefault();
          // check reveal occasionally to save perf
          if (++moveCount % 6 === 0) revealIfNeeded(false);
        }
        function onUp() { drawing = false; revealIfNeeded(false); }

        canvas.addEventListener('pointerdown', onDown, { passive: false });
        canvas.addEventListener('pointermove', onMove, { passive: false });
        window.addEventListener('pointerup', onUp, { passive: true });
        canvas.addEventListener('touchstart', onDown, { passive: false });
        canvas.addEventListener('touchmove', onMove, { passive: false });
        window.addEventListener('touchend', onUp, { passive: true });
      }

      imageEl.onload = () => { resizeAndRedraw(); };
      imageEl.src = img;
      if (imageEl.complete) { resizeAndRedraw(); }
      setupScratch();
      window.addEventListener('resize', resizeAndRedraw);
    }

    window.onload = () => { loadQuestion(); initFrost(); };
  </script>

</body>
</html>

