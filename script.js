// Utility functions
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function checkPasswordStrength(password) {
    let strength = 0;
    
    // Check length
    if (password.length >= 8) {
        strength++;
        document.getElementById('req-length').className = 'text-green-500';
    } else {
        document.getElementById('req-length').className = 'text-gray-400';
    }
    
    // Check uppercase letters
    if (/[A-Z]/.test(password)) {
        strength++;
        document.getElementById('req-uppercase').className = 'text-green-500';
    } else {
        document.getElementById('req-uppercase').className = 'text-gray-400';
    }
    
    // Check lowercase letters
    if (/[a-z]/.test(password)) {
        strength++;
        document.getElementById('req-lowercase').className = 'text-green-500';
    } else {
        document.getElementById('req-lowercase').className = 'text-gray-400';
    }
    
    // Check numbers
    if (/[0-9]/.test(password)) {
        strength++;
        document.getElementById('req-number').className = 'text-green-500';
    } else {
        document.getElementById('req-number').className = 'text-gray-400';
    }
    
    // Check special characters
    if (/[^A-Za-z0-9]/.test(password)) {
        strength++;
        document.getElementById('req-special').className = 'text-green-500';
    } else {
        document.getElementById('req-special').className = 'text-gray-400';
    }
    
    // Update strength meter
    const strengthMeter = document.getElementById('password-strength');
    strengthMeter.className = `password-strength mt-1 strength-${strength}`;
    
    // Also validate the form to enable/disable signup button
    document.getElementById('signup-button').disabled = strength < 3 || 
        document.getElementById('signup-password').value !== 
        document.getElementById('signup-confirm-password').value;
}

function validateSignupForm() {
    // Get all values
    const firstName = document.getElementById('signup-firstname').value.trim();
    const lastName = document.getElementById('signup-lastname').value.trim();
    const email = document.getElementById('signup-email').value.trim();
    const username = document.getElementById('signup-username').value.trim();
    const password = document.getElementById('signup-password').value;
    const confirmPassword = document.getElementById('signup-confirm-password').value;
    const termsChecked = document.getElementById('terms').checked;
    
    // Validate email
    const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    if (document.getElementById('email-error')) {
        document.getElementById('email-error').classList.toggle('hidden', emailValid);
    }
    
    // Validate username
    const usernameValid = username.length >= 4 && username.length <= 20;
    if (document.getElementById('username-error')) {
        document.getElementById('username-error').classList.toggle('hidden', usernameValid);
    }
    
    // Validate password match
    const passwordsMatch = password === confirmPassword && password.length > 0;
    if (document.getElementById('password-match-error')) {
        document.getElementById('password-match-error').classList.toggle('hidden', passwordsMatch);
    }
    
    // Check if all required fields are filled and valid
    const allFieldsValid = firstName && lastName && emailValid && usernameValid && 
                         password.length >= 8 && passwordsMatch && termsChecked;
    
    // Enable/disable signup button
    if (document.getElementById('signup-button')) {
        document.getElementById('signup-button').disabled = !allFieldsValid;
    }
    
    return allFieldsValid;
}

// Main initialization
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const loginTab = document.getElementById('login-tab');
    const signupTab = document.getElementById('signup-tab');
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');

    if (loginTab && signupTab && loginForm && signupForm) {
        loginTab.addEventListener('click', function() {
            loginTab.classList.add('text-blue-600', 'border-blue-600');
            loginTab.classList.remove('text-gray-500');
            signupTab.classList.add('text-gray-500');
            signupTab.classList.remove('text-blue-600', 'border-blue-600');
            
            loginForm.classList.remove('hidden');
            loginForm.classList.add('visible');
            signupForm.classList.add('hidden');
            signupForm.classList.remove('visible');
        });

        signupTab.addEventListener('click', function() {
            signupTab.classList.add('text-blue-600', 'border-blue-600');
            signupTab.classList.remove('text-gray-500');
            loginTab.classList.add('text-gray-500');
            loginTab.classList.remove('text-blue-600', 'border-blue-600');
            
            signupForm.classList.remove('hidden');
            signupForm.classList.add('visible');
            loginForm.classList.add('hidden');
            loginForm.classList.remove('visible');
        });
    }

    // Login form submission
    const loginFormElement = document.getElementById('loginForm');
    if (loginFormElement) {
        loginFormElement.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            
            // Check if user exists in localStorage
            const users = JSON.parse(localStorage.getItem('users')) || [];
            const user = users.find(u => u.email === email && u.password === password);
            
            if (user) {
                // Store current user in localStorage
                localStorage.setItem('currentUser', JSON.stringify(user));
                // Redirect to dashboard
                window.location.href = 'dashboard.php';
            } else {
                alert('Invalid email or password');
            }
        });
    }

    // Signup form submission
    const signupFormElement = document.getElementById('signupForm');
    if (signupFormElement) {
        // Add validation listeners
        const signupFields = ['signup-firstname', 'signup-lastname', 'signup-email', 
                            'signup-username', 'signup-password', 'signup-confirm-password'];
        
        signupFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.addEventListener('input', validateSignupForm);
            }
        });
        
        const termsCheckbox = document.getElementById('terms');
        if (termsCheckbox) {
            termsCheckbox.addEventListener('change', validateSignupForm);
        }

        signupFormElement.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateSignupForm()) {
                return;
            }
            
            const firstName = document.getElementById('signup-firstname').value.trim();
            const lastName = document.getElementById('signup-lastname').value.trim();
            const email = document.getElementById('signup-email').value.trim();
            const username = document.getElementById('signup-username').value.trim();
            const password = document.getElementById('signup-password').value;
            
            // Get existing users or create empty array
            const users = JSON.parse(localStorage.getItem('users')) || [];
            
            // Check if email already exists
            if (users.some(u => u.email === email)) {
                alert('Email already registered');
                return;
            }
            
            // Create new user object
            const newUser = {
                id: Date.now().toString(),
                firstName,
                lastName,
                email,
                username,
                password,
                createdAt: new Date().toISOString()
            };
            
            // Add to users array
            users.push(newUser);
            
            // Save to localStorage
            localStorage.setItem('users', JSON.stringify(users));
            
            alert('Account created successfully! Please log in.');
            
            // Switch to login tab after signup
            if (loginTab) loginTab.click();
            
            // Clear form
            signupFormElement.reset();
            if (document.getElementById('password-strength')) {
                document.getElementById('password-strength').className = 'password-strength mt-1 strength-0';
            }
            
            // Reset requirement highlights
            const requirements = ['length', 'uppercase', 'lowercase', 'number', 'special'];
            requirements.forEach(req => {
                const element = document.getElementById(`req-${req}`);
                if (element) element.className = 'text-gray-400';
            });
            
            // Disable button again
            if (document.getElementById('signup-button')) {
                document.getElementById('signup-button').disabled = true;
            }
        });
    }
});