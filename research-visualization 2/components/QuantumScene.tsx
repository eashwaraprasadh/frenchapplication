/**
 * @license
 * SPDX-License-Identifier: Apache-2.0
*/

import React from 'react';
import { Canvas } from '@react-three/fiber';
import { Float, Environment, Box, Text } from '@react-three/drei';
import { ErrorBoundary } from './ErrorBoundary';

const FloatingWord = ({ text, position, speed, rotationIntensity }: { text: string, position: [number, number, number], speed: number, rotationIntensity: number }) => {
  return (
    <Float speed={speed} rotationIntensity={rotationIntensity} floatIntensity={0.8}>
      <Text
        position={position}
        fontSize={0.3}
        color="#0072B5"
        anchorX="center"
        anchorY="middle"
        material-metalness={0.8}
        material-roughness={0.1}
      >
        {text}
      </Text>
    </Float>
  );
};

export const HeroScene: React.FC = () => {
  // Small French words focused on the right side (x: 2 to 6)
  const words = [
    { text: "Oui", pos: [3, 2.5, -1], speed: 1.5, rot: 0.2 },
    { text: "Non", pos: [5, 1.5, -2], speed: 2, rot: 0.3 },
    { text: "Et", pos: [4, -0.5, 0], speed: 1.2, rot: 0.1 },
    { text: "Le", pos: [2.5, -2.5, -1], speed: 1.8, rot: 0.4 },
    { text: "La", pos: [5.5, 0.5, -2], speed: 2.2, rot: 0.2 },
    { text: "Les", pos: [4.5, -3.5, 0], speed: 1.4, rot: 0.1 },
    { text: "Un", pos: [3.5, -1.5, -2], speed: 1.6, rot: 0.3 },
    { text: "Une", pos: [5, -2.5, -1], speed: 1.3, rot: 0.2 },
    { text: "Ça", pos: [2.5, 0.5, -3], speed: 1.9, rot: 0.5 },
    { text: "Toi", pos: [6, -2, -2], speed: 1.5, rot: 0.3 },
    { text: "Moi", pos: [4, 3, -4], speed: 2.1, rot: 0.4 },
  ];

  return (
    <div className="absolute inset-0 z-0 opacity-80 pointer-events-none">
      <ErrorBoundary>
        <Canvas camera={{ position: [0, 0, 8], fov: 45 }}>
          <ambientLight intensity={0.6} />
          <spotLight position={[10, 10, 10]} angle={0.5} penumbra={1} intensity={2} color="#fff" />
          <pointLight position={[-5, 5, -5]} intensity={1} color="#00C4FF" />

          {words.map((w, i) => (
            <FloatingWord key={i} text={w.text} position={w.pos as [number, number, number]} speed={w.speed} rotationIntensity={w.rot} />
          ))}

          {/* Abstract background shapes on the right */}
          <Float speed={3} rotationIntensity={0.5} floatIntensity={1.5}>
            <Box args={[0.2, 0.2, 0.2]} position={[3.5, 2, -1]} rotation={[0, 0, 0.5]}>
              <meshStandardMaterial color="#003366" />
            </Box>
            <Box args={[0.3, 0.3, 0.3]} position={[5.5, -2, 1]} rotation={[0.5, 0.5, 0]}>
              <meshStandardMaterial color="#0072B5" />
            </Box>
          </Float>

          <Environment preset="city" />
        </Canvas>
      </ErrorBoundary>
    </div>
  );
}; 