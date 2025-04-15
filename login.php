<?php
include 'connection.php';
session_start();

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // LOGIN
    if (isset($_POST['login'])) {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);

        $stmt = $conn->prepare("SELECT email, password FROM inventory WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($db_email, $db_password);
            $stmt->fetch();
            if ($password === $db_password) {
                $_SESSION['email'] = $db_email;
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No account found with that email.";
        }
    }

    // SIGNUP
    if (isset($_POST['signup'])) {
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);
        $cpassword = trim($_POST['cpassword']);

        if ($password !== $cpassword) {
            $error = "Passwords do not match.";
        } else {
            $check = $conn->prepare("SELECT email FROM inventory WHERE email = ?");
            $check->bind_param("s", $email);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                $error = "Email already exists.";
            } else {
                $stmt = $conn->prepare("INSERT INTO inventory (fname, lname, email, password) VALUES (?, ?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param("ssss", $fname, $lname, $email, $password);
                    if ($stmt->execute()) {
                        $success = "Account created successfully. Please login.";
                    } else {
                        $error = "Signup failed: " . $stmt->error;
                    }
                } else {
                    $error = "Signup failed. Please try again.";
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .auth-container {
            transition: all 0.5s ease-in-out;
        }
        .hidden {
            display: none;
            opacity: 0;
        }
        .visible {
            display: block;
            opacity: 1;
        }
        .password-strength {
            height: 4px;
            transition: all 0.3s ease;
        }
        .strength-0 { width: 0%; background-color: #ef4444; }
        .strength-1 { width: 25%; background-color: #ef4444; }
        .strength-2 { width: 50%; background-color: #f59e0b; }
        .strength-3 { width: 75%; background-color: #3b82f6; }
        .strength-4 { width: 100%; background-color: #10b981; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl overflow-hidden w-full max-w-md">
        <!-- Tabs -->
        <div class="flex border-b">
            <button id="login-tab" class="flex-1 py-4 px-6 text-center font-medium text-blue-600 border-b-2 border-blue-600">
                Login
            </button>
            <button id="signup-tab" class="flex-1 py-4 px-6 text-center font-medium text-gray-500 hover:text-gray-700">
                Sign Up
            </button>
        </div>
        
        <!-- Error/Success Messages -->
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-4" role="alert">
                <span class="block sm:inline"><?php echo $error; ?></span>
            </div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-4" role="alert">
                <span class="block sm:inline"><?php echo $success; ?></span>
            </div>
        <?php endif; ?>
        
        <!-- Login Form -->
        <div id="login-form" class="auth-container p-6 visible">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Welcome Back</h2>
            <form method="POST" id="loginForm">
                <input type="hidden" name="login" value="1">
                <div class="mb-4">
                    <label for="login-email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                    <input type="email" id="login-email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required name="email">
                </div>
                <div class="mb-6">
                    <label for="login-password" class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="login-password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required  name="password">
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700" onclick="togglePasswordVisibility('login-password')">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <div class="text-right mt-2">
                        <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150" name="login">
                    Login
                </button>
            </form>
        </div>
        
        <!-- Signup Form -->
        <div id="signup-form" class="auth-container p-6 hidden">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Account</h2>
            <form method="POST" id="signupForm">
                <input type="hidden" name="signup" value="1">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="signup-firstname" class="block text-gray-700 text-sm font-medium mb-2">First Name</label>
                        <input type="text" id="signup-firstname" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required name="fname">
                    </div>
                    <div>
                        <label for="signup-lastname" class="block text-gray-700 text-sm font-medium mb-2">Last Name</label>
                        <input type="text" id="signup-lastname" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required name="lname">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="signup-email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                    <input type="email" id="signup-email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required name="email">
                    <p id="email-error" class="text-xs text-red-500 mt-1 hidden">Please enter a valid email address</p>
                </div>
            
                <div class="mb-4">
                    <label for="signup-password" class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="signup-password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required
                               oninput="checkPasswordStrength(this.value)" name="password">
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700" onclick="togglePasswordVisibility('signup-password')">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength mt-1 strength-0" id="password-strength"></div>
                    <div id="password-requirements" class="text-xs text-gray-500 mt-1">
                        <p>Password must contain:</p>
                        <ul class="list-disc list-inside">
                            <li id="req-length" class="text-gray-400">At least 8 characters</li>
                            <li id="req-uppercase" class="text-gray-400">One uppercase letter</li>
                            <li id="req-lowercase" class="text-gray-400">One lowercase letter</li>
                            <li id="req-number" class="text-gray-400">One number</li>
                            <li id="req-special" class="text-gray-400">One special character</li>
                        </ul>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="signup-confirm-password" class="block text-gray-700 text-sm font-medium mb-2">Confirm Password</label>
                    <div class="relative">
                        <input type="password" id="signup-confirm-password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required name="cpassword">
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700" onclick="togglePasswordVisibility('signup-confirm-password')">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <p id="password-match-error" class="text-xs text-red-500 mt-1 hidden">Passwords do not match</p>
                </div>
                <div class="mb-6 flex items-start">
                    <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1" required>
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        I agree to the <a href="#" class="text-blue-600 hover:underline">Terms and Conditions</a>
                    </label>
                </div>
                <button type="submit" id="signup-button" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 hover:bg-blue-500 cursor-pointer">
                    Submit
                </button>
            </form>
        </div>
    </div>

    <script>
        // Toggle between login and signup forms
        document.getElementById('login-tab').addEventListener('click', function() {
            document.getElementById('login-form').classList.remove('hidden');
            document.getElementById('login-form').classList.add('visible');
            document.getElementById('signup-form').classList.add('hidden');
            document.getElementById('signup-form').classList.remove('visible');
            document.getElementById('login-tab').classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
            document.getElementById('login-tab').classList.remove('text-gray-500');
            document.getElementById('signup-tab').classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
            document.getElementById('signup-tab').classList.add('text-gray-500');
        });

        document.getElementById('signup-tab').addEventListener('click', function() {
            document.getElementById('signup-form').classList.remove('hidden');
            document.getElementById('signup-form').classList.add('visible');
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('login-form').classList.remove('visible');
            document.getElementById('signup-tab').classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
            document.getElementById('signup-tab').classList.remove('text-gray-500');
            document.getElementById('login-tab').classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
            document.getElementById('login-tab').classList.add('text-gray-500');
        });

        // Password visibility toggle
        function togglePasswordVisibility(id) {
            const input = document.getElementById(id);
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

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            
            // Check length
            if (password.length >= 8) {
                strength++;
                document.getElementById('req-length').classList.remove('text-gray-400');
                document.getElementById('req-length').classList.add('text-green-500');
            } else {
                document.getElementById('req-length').classList.add('text-gray-400');
                document.getElementById('req-length').classList.remove('text-green-500');
            }
            
            // Check uppercase letters
            if (/[A-Z]/.test(password)) {
                strength++;
                document.getElementById('req-uppercase').classList.remove('text-gray-400');
                document.getElementById('req-uppercase').classList.add('text-green-500');
            } else {
                document.getElementById('req-uppercase').classList.add('text-gray-400');
                document.getElementById('req-uppercase').classList.remove('text-green-500');
            }
            
            // Check lowercase letters
            if (/[a-z]/.test(password)) {
                strength++;
                document.getElementById('req-lowercase').classList.remove('text-gray-400');
                document.getElementById('req-lowercase').classList.add('text-green-500');
            } else {
                document.getElementById('req-lowercase').classList.add('text-gray-400');
                document.getElementById('req-lowercase').classList.remove('text-green-500');
            }
            
            // Check numbers
            if (/[0-9]/.test(password)) {
                strength++;
                document.getElementById('req-number').classList.remove('text-gray-400');
                document.getElementById('req-number').classList.add('text-green-500');
            } else {
                document.getElementById('req-number').classList.add('text-gray-400');
                document.getElementById('req-number').classList.remove('text-green-500');
            }
            
            // Check special characters
            if (/[^A-Za-z0-9]/.test(password)) {
                strength++;
                document.getElementById('req-special').classList.remove('text-gray-400');
                document.getElementById('req-special').classList.add('text-green-500');
            } else {
                document.getElementById('req-special').classList.add('text-gray-400');
                document.getElementById('req-special').classList.remove('text-green-500');
            }
            
            // Update strength meter
            const strengthBar = document.getElementById('password-strength');
            strengthBar.className = 'password-strength mt-1 strength-' + strength;
            
            return strength;
        }

        // Form validation
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            const password = document.getElementById('signup-password').value;
            const confirmPassword = document.getElementById('signup-confirm-password').value;
            const terms = document.getElementById('terms').checked;
            
            // Check password match
            if (password !== confirmPassword) {
                e.preventDefault();
                document.getElementById('password-match-error').classList.remove('hidden');
            } else {
                document.getElementById('password-match-error').classList.add('hidden');
            }
            
            // Check terms
            if (!terms) {
                e.preventDefault();
                alert('You must agree to the terms and conditions');
            }
            
            // Check password strength
            if (checkPasswordStrength(password) < 3) {
                e.preventDefault();
                alert('Password is too weak. Please make it stronger.');
            }
        });
    </script>
</body>
</html>