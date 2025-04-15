<?php
include "connection.php";
session_start();

// If user is already logged in, redirect to dashboard


// LOGOUT - This shouldn't be needed here since we're not logged in
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    if (isset($conn)) {
        $conn->close();
    }
    header("Location: login.php");
    exit();
}

// Redirect to login.php after clicking "Get Started"
if (isset($_POST['get_started'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHAURMANIX - Inventory Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%);
        }
        .nav-link:hover {
            color: #a855f7;
            transform: translateY(-2px);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.45);
        }
        .logo-container {
            transition: all 0.3s ease;
        }
        .logo-container:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="font-['Inter'] bg-gray-50">
    <!-- Navigation with Logo -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo with Brand Name -->
                <div class="flex items-center space-x-3 logo-container">
                    <div class="flex items-center justify-center bg-indigo-600 text-white rounded-lg w-10 h-10 font-bold text-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-indigo-600">SHAURMANIX</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="manage_product.php" class="nav-link text-gray-700 hover:text-indigo-600 transition-all duration-300 font-medium">Track Inventory</a>
                    <a href="contactus.php" class="nav-link text-gray-700 hover:text-indigo-600 transition-all duration-300 font-medium">Contact</a>
                    <a href="customerreview.php" class="nav-link text-gray-700 hover:text-indigo-600 transition-all duration-300 font-medium">Customer Review</a>
                </div>
                <div class="flex items-center">
                    <form method="POST">
                        <button type="submit" name="get_started" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors duration-300 shadow-md hover:shadow-lg" name="get_started">
                            Get Started
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Image -->
    <div class="hero-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">Real-Time Inventory Management</h1>
                    <p class="text-lg md:text-xl text-indigo-100 mb-8 italic">"Streamlining Your Stock, One Step Ahead."</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <form method="POST">
                            <button type="submit" name="get_started" class="bg-white text-indigo-600 px-6 py-3 rounded-lg shadow-md hover:bg-indigo-50 transition-colors duration-300">
                                Get Started
                            </button>
                        </form>
                        <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-indigo-700 transition-colors duration-300">
                            Learn More
                        </button>
                    </div>
                </div>
                <div class="hidden md:block">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Inventory Management Dashboard" 
                         class="rounded-lg shadow-2xl transform rotate-1 hover:rotate-0 transition-transform duration-500">
                </div>
            </div>
        </div>
    </div>

    <!-- Key Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Key Features</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Powerful tools to streamline your inventory management process</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="feature-card bg-white p-8 rounded-xl shadow-md transition-all duration-300">
                <div class="w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Real-Time Updates</h3>
                <p class="text-gray-600">Track stock levels with live updates as transactions happen in your business.</p>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card bg-white p-8 rounded-xl shadow-md transition-all duration-300">
                <div class="w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Stock Alerts</h3>
                <p class="text-gray-600">Get instant alerts when stock levels are low or when items need reordering.</p>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card bg-white p-8 rounded-xl shadow-md transition-all duration-300">
                <div class="w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Easy Reports</h3>
                <p class="text-gray-600">Generate detailed inventory reports with just a few clicks for better insights.</p>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Find What You Need</h2>
                <p class="text-gray-600">Search across your entire inventory management system</p>
            </div>
            
            <div class="relative max-w-xl mx-auto">
                <input type="text" 
                       placeholder="Search products, orders, or suppliers..." 
                       class="search-input w-full px-6 py-4 rounded-full border-0 shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-300 transition-all duration-300">
                <button class="absolute right-2 top-2 bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700 transition-colors duration-300 shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Simple animation for feature cards when they come into view
        document.addEventListener('DOMContentLoaded', function() {
            const featureCards = document.querySelectorAll('.feature-card');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            featureCards.forEach(card => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(card);
            });
            
            // Add hover effect to navigation links
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', () => {
                    link.style.transform = 'translateY(-2px)';
                });
                link.addEventListener('mouseleave', () => {
                    link.style.transform = 'translateY(0)';
                });
            });
            
            // Add hover effect to logo
            const logo = document.querySelector('.logo-container');
            logo.addEventListener('mouseenter', () => {
                logo.style.transform = 'scale(1.05)';
            });
            logo.addEventListener('mouseleave', () => {
                logo.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>