/**
 * @license
 * SPDX-License-Identifier: Apache-2.0
*/

import React, { useRef } from 'react';
import { Canvas, useFrame } from '@react-three/fiber';
import { Float, Environment, Box, Cylinder, Torus } from '@react-three/drei';
import * as THREE from 'three';
import { ErrorBoundary } from './ErrorBoundary';

const CNTower = (props: any) => {
  const ref = useRef<THREE.Group>(null);

  useFrame((state) => {
    if (ref.current) {
      ref.current.rotation.y = Math.sin(state.clock.getElapsedTime() * 0.1) * 0.1;
    }
  });

  // Material Palette
  const goldMaterial = <meshStandardMaterial color="#C5A059" metalness={0.8} roughness={0.2} />;
  const concreteMaterial = <meshStandardMaterial color="#4b5563" metalness={0.1} roughness={0.9} />; // Dark grey concrete
  const antennaRed = <meshStandardMaterial color="#ef4444" metalness={0.3} roughness={0.4} />;
  const antennaWhite = <meshStandardMaterial color="#ffffff" metalness={0.3} roughness={0.4} />;
  const glassMaterial = <meshStandardMaterial color="#1e293b" metalness={0.9} roughness={0.1} />; // Dark glass for windows

  return (
    <group ref={ref} {...props}>
      {/* --- BASE STRUCTURE (Y-shaped buttresses) --- */}
      <group position={[0, -3, 0]}>
        {[0, 2, 4].map((k) => (
          <group key={k} rotation={[0, (k * Math.PI) / 3, 0]}>
            <mesh position={[0.5, 1.5, 0]} rotation={[0, 0, -0.15]}>
              <cylinderGeometry args={[0.1, 0.3, 4, 3]} />
              {concreteMaterial}
            </mesh>
          </group>
        ))}
      </group>

      {/* --- MAIN SHAFT --- */}
      <mesh position={[0, 0.5, 0]}>
        <cylinderGeometry args={[0.15, 0.25, 8, 6]} />
        {concreteMaterial}
      </mesh>

      {/* --- SKYPOD (Main Observation Deck) --- */}
      <group position={[0, 2.8, 0]}>
        {/* Main pod body - Gold for luxury accent */}
        <mesh>
          <cylinderGeometry args={[0.6, 0.4, 0.4, 32]} />
          {goldMaterial}
        </mesh>
        {/* Windows/Rim detail - Dark Glass */}
        <mesh position={[0, 0, 0]}>
          <torusGeometry args={[0.6, 0.05, 16, 32]} />
          {glassMaterial}
        </mesh>
      </group>

      {/* --- UPPER SHAFT --- */}
      <mesh position={[0, 3.5, 0]}>
        <cylinderGeometry args={[0.08, 0.08, 1.2, 6]} />
        {concreteMaterial}
      </mesh>

      {/* --- SPACE DECK (Smaller Pod) --- */}
      <group position={[0, 4.1, 0]}>
        <mesh>
          <cylinderGeometry args={[0.25, 0.2, 0.15, 32]} />
          {goldMaterial}
        </mesh>
      </group>

      {/* --- ANTENNA / SPIRE --- */}
      <group position={[0, 5.5, 0]}>
        {/* Lower antenna segment - Red/White pattern */}
        <mesh position={[0, -0.8, 0]}>
          <cylinderGeometry args={[0.04, 0.08, 1.5, 6]} />
          {antennaWhite}
        </mesh>

        {/* Upper antenna segment (needle) - Red tip */}
        <mesh position={[0, 0.5, 0]}>
          <cylinderGeometry args={[0.01, 0.04, 1.2, 6]} />
          {antennaRed}
        </mesh>
      </group>

    </group>
  );
};

export const HeroScene: React.FC = () => {
  return (
    <div className="absolute inset-0 z-0 opacity-80 pointer-events-none">
      <ErrorBoundary>
        <Canvas camera={{ position: [0, 1, 9], fov: 35 }}>
          <ambientLight intensity={0.5} />
          <spotLight position={[10, 10, 10]} angle={0.5} penumbra={1} intensity={2} color="#fff" />
          <pointLight position={[-5, 5, -5]} intensity={1} color="#C5A059" />

          <Float speed={1.5} rotationIntensity={0.1} floatIntensity={0.2}>
            <CNTower position={[0, -1.5, 0]} scale={0.9} />
          </Float>

          {/* Abstract shapes floating around */}
          <Float speed={3} rotationIntensity={0.5} floatIntensity={1.5}>
            <Box args={[0.2, 0.2, 0.2]} position={[-3, 2, -1]} rotation={[0, 0, 0.5]}>
              <meshStandardMaterial color="#1a1a1a" />
            </Box>
            <Box args={[0.3, 0.3, 0.3]} position={[3, -2, 1]} rotation={[0.5, 0.5, 0]}>
              <meshStandardMaterial color="#C5A059" />
            </Box>
            {/* Ring representing signal/broadcast */}
            <mesh position={[2, 3, -2]} rotation={[Math.PI / 4, 0, 0]}>
              <torusGeometry args={[0.5, 0.02, 16, 32]} />
              <meshStandardMaterial color="#C5A059" metalness={1} roughness={0.1} />
            </mesh>
          </Float>

          <Environment preset="city" />
        </Canvas>
      </ErrorBoundary>
    </div>
  );
};