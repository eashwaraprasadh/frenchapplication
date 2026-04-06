document.addEventListener('DOMContentLoaded', function() {
    // Get all character eyes
    const eyes = document.querySelectorAll('.pupil');
    const characters = document.querySelectorAll('.character');
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    
    // Track mouse position
    let mouseX = 0;
    let mouseY = 0;
    
    // Track if password input is focused
    let isPasswordFocused = false;
    let focusedInput = null;
    
    // Mouse move event listener
    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });
    
    // Password input focus/blur events
    passwordInputs.forEach(input => {
        input.addEventListener('focus', () => {
            isPasswordFocused = true;
            focusedInput = input;
        });
        
        input.addEventListener('blur', () => {
            isPasswordFocused = false;
            focusedInput = null;
        });
    });
    
    // Animate eyes to follow cursor or look at password field
    function animateEyes() {
        eyes.forEach(eye => {
            const eyeRect = eye.getBoundingClientRect();
            const eyeCenterX = eyeRect.left + eyeRect.width / 2;
            const eyeCenterY = eyeRect.top + eyeRect.height / 2;
            
            let targetX, targetY;
            
            if (isPasswordFocused && focusedInput) {
                // Look at the password input
                const inputRect = focusedInput.getBoundingClientRect();
                targetX = inputRect.left + inputRect.width / 2;
                targetY = inputRect.top + inputRect.height / 2;
            } else {
                // Follow cursor
                targetX = mouseX;
                targetY = mouseY;
            }
            
            // Calculate angle between eye and target
            const angle = Math.atan2(targetY - eyeCenterY, targetX - eyeCenterX);
            
            // Calculate distance (limit to prevent pupils from going outside the eye)
            const distance = Math.min(5, Math.hypot(targetX - eyeCenterX, targetY - eyeCenterY) / 30);
            
            // Calculate new position
            const newX = Math.cos(angle) * distance;
            const newY = Math.sin(angle) * distance;
            
            // Apply transformation
            eye.style.transform = `translate(calc(-50% + ${newX}px), calc(-50% + ${newY}px))`;
        });
        
        requestAnimationFrame(animateEyes);
    }
    
    // Add blinking animation to characters
    function addBlinking() {
        characters.forEach(character => {
            const face = character.querySelector('.face');
            const eyes = character.querySelector('.eyes');
            
            // Random blinking (every 2-6 seconds)
            const blink = () => {
                eyes.style.height = '2px';
                setTimeout(() => {
                    eyes.style.height = '';
                    setTimeout(blink, 2000 + Math.random() * 4000);
                }, 200);
            };
            
            // Start blinking after initial delay
            setTimeout(blink, 2000 + Math.random() * 4000);
            
            // Add subtle head movement on hover
            character.addEventListener('mousemove', (e) => {
                const rect = character.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const angleX = (y - centerY) / 20;
                const angleY = (centerX - x) / 20;
                
                face.style.transform = `perspective(1000px) rotateX(${angleX}deg) rotateY(${angleY}deg)`;
            });
            
            // Reset on mouse leave
            character.addEventListener('mouseleave', () => {
                face.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
            });
        });
    }
    
    // Initialize animations
    animateEyes();
    addBlinking();
});
