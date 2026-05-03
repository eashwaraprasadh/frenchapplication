document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const signInForm = document.getElementById('signin-form');
    const signUpForm = document.getElementById('signup-form');
    const togglePasswordBtns = document.querySelectorAll('.toggle-password');
    const tabButtons = document.querySelectorAll('.tab-button');
    const forms = {
        signin: document.getElementById('signin-form'),
        signup: document.getElementById('signup-form')
    };

    // Character elements
    const characters = {
        purple: document.querySelector('.character.purple'),
        black: document.querySelector('.character.black'),
        orange: document.querySelector('.character.orange'),
        yellow: document.querySelector('.character.yellow')
    };

    // Eyes and pupils
    const eyes = {
        purple: {
            left: document.querySelector('.character.purple .eye.left'),
            right: document.querySelector('.character.purple .eye.right')
        },
        black: {
            left: document.querySelector('.character.black .eye.left'),
            right: document.querySelector('.character.black .eye.right')
        }
    };

    // Form state
    let isTyping = false;
    let isPasswordVisible = false;
    let currentTab = 'signin';

    // Initialize forms
    function initForms() {
        // Toggle password visibility
        togglePasswordBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                
                // Toggle eye icon
                const icon = this.querySelector('svg');
                if (type === 'password') {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Tab switching
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tab = this.getAttribute('data-tab');
                if (tab === currentTab) return;
                
                // Update active tab
                tabButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Toggle forms
                Object.keys(forms).forEach(formId => {
                    if (formId === tab) {
                        forms[formId].classList.remove('hidden');
                    } else {
                        forms[formId].classList.add('hidden');
                    }
                });
                
                currentTab = tab;
                updateCharacters(tab);
            });
        });

        // Form submission
        if (signInForm) {
            signInForm.addEventListener('submit', handleSignIn);
        }
        
        if (signUpForm) {
            signUpForm.addEventListener('submit', handleSignUp);
        }

        // Input focus/blur events
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                isTyping = true;
                handleInputFocus(input);
            });
            
            input.addEventListener('blur', () => {
                isTyping = false;
                resetCharacters();
            });
        });
    }

    // Handle sign in
    function handleSignIn(e) {
        e.preventDefault();
        const email = signInForm.querySelector('input[type="email"]').value;
        const password = signInForm.querySelector('input[type="password"]').value;
        
        // Simple validation
        if (!email || !password) {
            showError('Please fill in all fields');
            return;
        }
        
        // Show loading state
        const submitBtn = signInForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing in...';
        submitBtn.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            // Reset button state
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            
            // For demo purposes, show success for any non-empty password
            if (password) {
                showSuccess('Successfully signed in!');
                // Redirect to dashboard or home page
                // window.location.href = '/dashboard';
            } else {
                showError('Invalid email or password');
            }
        }, 1500);
    }

    // Handle sign up
    function handleSignUp(e) {
        e.preventDefault();
        const name = signUpForm.querySelector('input[placeholder="Full Name"]').value;
        const email = signUpForm.querySelector('input[type="email"]').value;
        const password = signUpForm.querySelector('input[placeholder="Create Password"]').value;
        
        // Simple validation
        if (!name || !email || !password) {
            showError('Please fill in all fields');
            return;
        }
        
        if (password.length < 6) {
            showError('Password must be at least 6 characters');
            return;
        }
        
        // Show loading state
        const submitBtn = signUpForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating account...';
        submitBtn.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            // Reset button state
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            
            // Show success message
            showSuccess('Account created successfully!');
            
            // Switch to sign in tab
            document.querySelector('.tab-button[data-tab="signin"]').click();
            
            // Clear form
            signUpForm.reset();
        }, 2000);
    }

    // Show error message
    function showError(message) {
        const errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        errorElement.textContent = message;
        
        // Remove any existing error messages
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        
        // Insert error message at the top of the form
        const form = currentTab === 'signin' ? signInForm : signUpForm;
        form.insertBefore(errorElement, form.firstChild);
        
        // Auto-hide error after 5 seconds
        setTimeout(() => {
            errorElement.style.opacity = '0';
            setTimeout(() => errorElement.remove(), 300);
        }, 5000);
    }

    // Show success message
    function showSuccess(message) {
        const successElement = document.createElement('div');
        successElement.className = 'success-message';
        successElement.textContent = message;
        successElement.style.backgroundColor = '#d1fae5';
        successElement.style.color = '#065f46';
        successElement.style.padding = '0.75rem 1rem';
        successElement.style.borderRadius = '0.5rem';
        successElement.style.marginBottom = '1rem';
        successElement.style.transition = 'opacity 0.3s';
        
        // Remove any existing messages
        document.querySelectorAll('.success-message, .error-message').forEach(el => el.remove());
        
        // Insert success message at the top of the form
        const form = currentTab === 'signin' ? signInForm : signUpForm;
        form.insertBefore(successElement, form.firstChild);
        
        // Auto-hide success after 3 seconds
        setTimeout(() => {
            successElement.style.opacity = '0';
            setTimeout(() => successElement.remove(), 300);
        }, 3000);
    }

    // Character animations
    function handleInputFocus(input) {
        if (!characters.purple) return;
        
        // Make characters look at the input
        const inputRect = input.getBoundingClientRect();
        const inputCenterX = inputRect.left + inputRect.width / 2;
        const inputCenterY = inputRect.top + inputRect.height / 2;
        
        // Calculate look direction for each character
        updateCharacterLook(inputCenterX, inputCenterY);
        
        // Special animation for password field
        if (input.type === 'password' && !input.value) {
            // Make purple character peek at password
            setTimeout(() => {
                if (isTyping) {
                    characters.purple.classList.add('peek');
                    setTimeout(() => {
                        if (isTyping) characters.purple.classList.remove('peek');
                    }, 1000);
                }
            }, 1000);
        }
    }

    function updateCharacterLook(x, y) {
        // Update each character's look direction
        Object.values(characters).forEach(character => {
            if (!character) return;
            
            const rect = character.getBoundingClientRect();
            const charCenterX = rect.left + rect.width / 2;
            const charCenterY = rect.top + rect.height / 3; // Look from the head area
            
            const deltaX = x - charCenterX;
            const deltaY = y - charCenterY;
            
            // Limit the eye movement range
            const maxDistance = 5;
            const distance = Math.min(Math.sqrt(deltaX * deltaX + deltaY * deltaY), maxDistance);
            
            const angle = Math.atan2(deltaY, deltaX);
            const eyeX = Math.cos(angle) * distance;
            const eyeY = Math.sin(angle) * distance;
            
            // Update pupils
            const pupils = character.querySelectorAll('.pupil');
            pupils.forEach(pupil => {
                pupil.style.transform = `translate(${eyeX}px, ${eyeY}px)`;
            });
        });
    }

    function updateCharacters(tab) {
        // Reset all characters
        resetCharacters();
        
        // Special animations based on active tab
        if (tab === 'signin') {
            // Make characters look at the sign in form
            const formRect = signInForm.getBoundingClientRect();
            const formCenterX = formRect.left + formRect.width / 2;
            const formCenterY = formRect.top + formRect.height / 2;
            updateCharacterLook(formCenterX, formCenterY);
        } else {
            // Make characters look at the sign up form
            const formRect = signUpForm.getBoundingClientRect();
            const formCenterX = formRect.left + formRect.width / 2;
            const formCenterY = formRect.top + formRect.height / 2;
            updateCharacterLook(formCenterX, formCenterY);
        }
    }

    function resetCharacters() {
        // Reset all characters to look forward
        Object.values(characters).forEach(character => {
            if (!character) return;
            
            const pupils = character.querySelectorAll('.pupil');
            pupils.forEach(pupil => {
                pupil.style.transform = 'translate(0, 0)';
            });
        });
    }

    // Random blinking for characters
    function randomBlink() {
        if (Math.random() > 0.98) { // 2% chance to blink
            const randomChar = Object.values(characters)[Math.floor(Math.random() * Object.values(characters).length)];
            if (randomChar) {
                randomChar.classList.add('blink');
                setTimeout(() => {
                    randomChar.classList.remove('blink');
                }, 200);
            }
        }
        
        // Random look around when not typing
        if (!isTyping && Math.random() > 0.99) { // 1% chance to look around
            Object.values(characters).forEach(char => {
                if (char) char.classList.add('look-around');
            });
            
            setTimeout(() => {
                Object.values(characters).forEach(char => {
                    if (char) char.classList.remove('look-around');
                });
            }, 2000);
        }
        
        requestAnimationFrame(randomBlink);
    }

    // Initialize
    initForms();
    
    // Start random blinking
    setTimeout(randomBlink, 1000);
    
    // Handle mouse movement for character eyes
    document.addEventListener('mousemove', (e) => {
        if (isTyping) return; // Don't track mouse when typing
        
        updateCharacterLook(e.clientX, e.clientY);
    });
});
