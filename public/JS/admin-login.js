document.addEventListener('DOMContentLoaded', function() {
    // Form elements
    const adminLoginForm = document.getElementById('adminLoginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const loginError = document.getElementById('loginError');

    // Function to validate email format
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Add focus events for styling
    const inputs = document.querySelectorAll('.input-group input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('input-focused');
        });

        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('input-focused');
            }
        });

        // Check if input has value on page load (e.g., after form submission error)
        if (input.value) {
            input.parentElement.classList.add('input-focused');
        }
    });

    // Form validation
    if (adminLoginForm) {
        adminLoginForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Reset errors
            emailError.textContent = '';
            emailError.classList.remove('show');
            passwordError.textContent = '';
            passwordError.classList.remove('show');
            loginError.textContent = '';
            loginError.classList.remove('show');
            
            // Validate email
            if (!emailInput.value.trim()) {
                emailError.textContent = 'Email tidak boleh kosong';
                emailError.classList.add('show');
                isValid = false;
            } else if (!isValidEmail(emailInput.value.trim())) {
                emailError.textContent = 'Format email tidak valid';
                emailError.classList.add('show');
                isValid = false;
            }
            
            // Validate password
            if (!passwordInput.value) {
                passwordError.textContent = 'Password tidak boleh kosong';
                passwordError.classList.add('show');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    // Clear error messages when typing
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const errorElement = this.parentElement.querySelector('.error-message');
            if (errorElement) {
                errorElement.textContent = '';
                errorElement.classList.remove('show');
            }
            loginError.textContent = '';
            loginError.classList.remove('show');
        });
    });

    // Add animation class to form on load
    const loginContainer = document.querySelector('.login-container');
    if (loginContainer) {
        setTimeout(() => {
            loginContainer.style.opacity = 1;
        }, 100);
    }
});