// Radial Orbital Timeline JavaScript
class RadialOrbitalTimeline {
    constructor(containerId, timelineData) {
        this.container = document.getElementById(containerId);
        this.timelineData = timelineData;
        this.activeNode = null;
        this.rotationAngle = 0;
        this.autoRotate = true;
        this.rotationTimer = null;
        
        this.init();
    }
    
    init() {
        this.createTimeline();
        this.startAutoRotation();
        this.bindEvents();
    }
    
    createTimeline() {
        const timelineHTML = `
            <div class="timeline-container">
                <div class="timeline-orbit"></div>
                <div class="timeline-center">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                        <circle cx="12" cy="12" r="3"/>
                        <circle cx="12" cy="12" r="8" fill="none" stroke="white" stroke-width="1" opacity="0.5"/>
                    </svg>
                </div>
                ${this.createNodes()}
            </div>
        `;
        
        this.container.innerHTML = timelineHTML;
        this.nodes = this.container.querySelectorAll('.timeline-node');
        this.orbit = this.container.querySelector('.timeline-orbit');
    }
    
    createNodes() {
        return this.timelineData.map((item, index) => {
            const position = this.calculateNodePosition(index);
            
            return `
                <div class="timeline-node" 
                     data-id="${item.id}" 
                     style="left: ${position.x}%; top: ${position.y}%; transform: translate(-50%, -50%);">
                    <svg class="timeline-node-icon" viewBox="0 0 24 24">
                        ${this.getIconSVG(item.icon)}
                    </svg>
                    <div class="timeline-node-label">${item.title}</div>
                    <div class="timeline-node-card">
                        <div class="timeline-node-card-header">
                            <h4 class="timeline-node-card-title">${item.title}</h4>
                        </div>
                        <p class="timeline-node-card-content">${item.content}</p>
                    </div>
                </div>
            `;
        }).join('');
    }
    
    getIconSVG(iconName) {
        const icons = {
            headphones: '<path d="M12 1a9 9 0 0 0-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2a7 7 0 0 1 14 0v2h-4v8h3c1.66 0 3-1.34 3-3v-7a9 9 0 0 0-9-9z"/>',
            book: '<path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1zm0 13.5c-1.1-.35-2.3-.5-3.5-.5-1.7 0-4.15.65-5.5 1.5V8c1.35-.85 3.8-1.5 5.5-1.5 1.2 0 2.4.15 3.5.5v7.5z"/>',
            mic: '<path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z"/><path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/>',
            pencil: '<path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>'
        };
        return icons[iconName] || icons.book;
    }
    
    calculateNodePosition(index) {
        const totalNodes = this.timelineData.length;
        
        // Always use horizontal layout
        const orbitWidth = 80; // 80% of container width
        const padding = 10; // 10% padding from edges
        const spacing = orbitWidth / (totalNodes - 1); // Even spacing between nodes
        const x = padding + (spacing * index);
        const y = 50; // Center vertically
        
        return { x, y };
    }
    
    bindEvents() {
        // Node click events
        this.nodes.forEach(node => {
            node.addEventListener('click', (e) => {
                e.stopPropagation();
                this.toggleNode(parseInt(node.dataset.id));
            });
            
            // Add hover animations
            node.addEventListener('mouseenter', (e) => {
                const icon = node.querySelector('.timeline-node-icon');
                const label = node.querySelector('.timeline-node-label');
                
                // Pulse animation for icon
                icon.style.animation = 'pulse 0.6s ease-in-out';
                
                // Scale up effect
                node.style.transform = 'translate(-50%, -50%) scale(1.1)';
                node.style.boxShadow = '0 8px 25px rgba(59, 130, 246, 0.4)';
                
                // Highlight label
                label.style.background = 'linear-gradient(135deg, #3b82f6, #2563eb)';
                label.style.color = 'white';
                label.style.transform = 'translateX(-50%) translateY(-5px) scale(1.05)';
            });
            
            node.addEventListener('mouseleave', (e) => {
                const icon = node.querySelector('.timeline-node-icon');
                const label = node.querySelector('.timeline-node-label');
                
                // Reset animations
                icon.style.animation = '';
                node.style.transform = 'translate(-50%, -50%) scale(1)';
                node.style.boxShadow = '';
                
                // Reset label
                label.style.background = '';
                label.style.color = '';
                label.style.transform = 'translateX(-50%) translateY(0) scale(1)';
            });
        });
        
        // Related link click events
        this.relatedLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.stopPropagation();
                const targetId = parseInt(link.dataset.target);
                this.highlightNode(targetId);
            });
        });
        
        // Container click events
        this.container.addEventListener('click', (e) => {
            if (e.target === this.container || e.target.classList.contains('timeline-container')) {
                this.deactivateAll();
            }
        });
        
        // Add entrance animations
        this.addEntranceAnimations();
        
        // Add continuous floating animation
        this.addFloatingAnimation();
        
        // Add event listener for related link clicks
        this.container.addEventListener('click', (e) => {
            if (e.target.closest('.timeline-node-card-related-link')) {
                e.stopPropagation();
                const relatedId = parseInt(e.target.closest('.timeline-node-card-related-link').dataset.relatedId);
                this.activateNode(relatedId);
            }
        });
        
        // Container click to deactivate
        this.container.addEventListener('click', (e) => {
            if (e.target === this.container || e.target.classList.contains('timeline-container')) {
                this.deactivateAll();
            }
        });
        
        // Window resize handler
        window.addEventListener('resize', () => {
            this.handleResize();
        });
    }
    
    addEntranceAnimations() {
        // Staggered entrance animation for nodes
        this.nodes.forEach((node, index) => {
            node.style.opacity = '0';
            node.style.transform = 'translate(-50%, -50%) scale(0)';
            
            setTimeout(() => {
                node.style.transition = 'all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
                node.style.opacity = '1';
                node.style.transform = 'translate(-50%, -50%) scale(1)';
            }, index * 150);
        });
        
        // Animate labels after nodes
        setTimeout(() => {
            this.labels = this.container.querySelectorAll('.timeline-node-label');
            this.labels.forEach((label, index) => {
                label.style.opacity = '0';
                label.style.transform = 'translateX(-50%) translateY(10px)';
                
                setTimeout(() => {
                    label.style.transition = 'all 0.4s ease-out';
                    label.style.opacity = '1';
                    label.style.transform = 'translateX(-50%) translateY(0)';
                }, index * 100);
            });
        }, this.nodes.length * 150);
    }
    
    addFloatingAnimation() {
        // Add subtle floating animation to nodes
        this.nodes.forEach((node, index) => {
            const delay = index * 0.5;
            node.style.animation = `float 3s ease-in-out ${delay}s infinite`;
        });
    }
    
    highlightNode(nodeId) {
        const node = this.container.querySelector(`[data-id="${nodeId}"]`);
        if (!node) return;
        
        // Add highlight effect
        node.classList.add('highlighted');
        node.style.boxShadow = '0 0 30px rgba(59, 130, 246, 0.8)';
        node.style.transform = 'translate(-50%, -50%) scale(1.2)';
        
        // Remove highlight after 2 seconds
        setTimeout(() => {
            node.classList.remove('highlighted');
            node.style.boxShadow = '';
            node.style.transform = 'translate(-50%, -50%) scale(1)';
        }, 2000);
    }
    
    handleResize() {
        // Recalculate node positions on resize
        this.nodes.forEach((node, index) => {
            const position = this.calculateNodePosition(index);
            node.style.left = `${position.x}%`;
            node.style.top = `${position.y}%`;
        });
        
        // Show/hide orbit based on screen size
        const isMobile = window.innerWidth <= 768;
        if (this.orbit) {
            this.orbit.style.display = isMobile ? 'none' : 'flex';
        }
    }
    
    bindResizeEvents() {
        window.addEventListener('resize', () => {
            this.handleResize();
        });
        
        // Initial resize check
        this.handleResize();
    }
    
    toggleNode(nodeId) {
        if (this.activeNode === nodeId) {
            this.deactivateAll();
        } else {
            this.activateNode(nodeId);
        }
    }
    
    activateNode(nodeId) {
        this.deactivateAll();
        
        const node = this.container.querySelector(`[data-id="${nodeId}"]`);
        if (!node) return;
        
        node.classList.add('active');
        this.activeNode = nodeId;
        this.autoRotate = false;
        
        // Highlight related nodes
        const relatedIds = node.dataset.related.split(',').map(id => parseInt(id));
        relatedIds.forEach(relatedId => {
            const relatedNode = this.container.querySelector(`[data-id="${relatedId}"]`);
            if (relatedNode) {
                relatedNode.classList.add('related');
            }
        });
        
        // Center view on active node
        this.centerViewOnNode(nodeId);
    }
    
    deactivateAll() {
        this.nodes.forEach(node => {
            node.classList.remove('active', 'related');
        });
        this.activeNode = null;
        this.autoRotate = true;
    }
    
    centerViewOnNode(nodeId) {
        // For horizontal layout, we don't need to center view
        // The nodes are already positioned horizontally
    }
    
    startAutoRotation() {
        // Auto-rotation disabled for horizontal layout
    }
    
    stopAutoRotation() {
        // Auto-rotation disabled for horizontal layout
    }
    
    updateRotation() {
        // Rotation updates disabled for horizontal layout
    }
    
    destroy() {
        this.stopAutoRotation();
        this.nodes.forEach(node => {
            node.removeEventListener('click', this.toggleNode);
        });
    }
}

// Initialize timeline when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Timeline data for practice test components
    const timelineData = [
        {
            id: 1,
            title: "Listening",
            content: "Improve your listening comprehension with audio exercises covering various accents, speeds, and real-life scenarios. Practice understanding conversations, news broadcasts, and academic lectures.",
            icon: "headphones"
        },
        {
            id: 2,
            title: "Reading",
            content: "Enhance your reading skills with authentic French texts including articles, literature, and documents. Learn strategies for quick comprehension and detailed analysis.",
            icon: "book"
        },
        {
            id: 3,
            title: "Speaking",
            content: "Develop your speaking confidence through guided conversations, pronunciation practice, and oral presentations. Receive personalized feedback on fluency, grammar, and expression.",
            icon: "mic"
        },
        {
            id: 4,
            title: "Writing",
            content: "Master French writing skills through structured exercises, essay writing, and correspondence practice. Focus on grammar, vocabulary, and proper French writing conventions.",
            icon: "pencil"
        }
    ];
    
    // Initialize the timeline
    const timeline = new RadialOrbitalTimeline('practice-timeline', timelineData);
    
    // Make it globally accessible
    window.practiceTimeline = timeline;
});
