<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Lovely Professional University</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen">
    <div class="container mx-auto px-4 py-12">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-blue-900 mb-4">Contact SHAURMANIX</h1>
            <p class="text-gray-600 text-lg">We're here to help you manage better</p>
        </div>

        <!-- Contact Container -->
        <div class="grid md:grid-cols-2 gap-8 bg-white rounded-2xl shadow-xl p-8">
            <!-- Contact Form -->
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-800">Send Us a Message</h2>
                <form id="contactForm" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Full Name</label>
                        <input type="text" 
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter your full name" required>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 mb-2">Email</label>
                        <input type="email" 
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter your email" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Message</label>
                        <textarea rows="5"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Type your message here..." required></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-300">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="md:border-l-2 md:pl-8 border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Contact Information</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-blue-600 mt-1 mr-4"></i>
                        <div>
                            <h3 class="font-semibold text-gray-800">Address</h3>
                            <p class="text-gray-600">
                                Lovely Professional University,<br>
                                Jalender, Punjab (India), 144411
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <i class="fas fa-phone-alt text-blue-600 mr-4"></i>
                        <div>
                            <h3 class="font-semibold text-gray-800">Call Us</h3>
                            <p class="text-gray-600">+91 5915879774</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <i class="fas fa-envelope text-blue-600 mr-4"></i>
                        <div>
                            <h3 class="font-semibold text-gray-800">Email</h3>
                            <p class="text-gray-600">ak4791475@gmail.com</p>
                        </div>
                    </div>
                </div>

                <!-- Map Embed -->
                <div class="mt-8 rounded-lg overflow-hidden">
                    <iframe src="https://maps.google.com/maps?q=jalander%20punjab&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                            class="w-full h-48 border-0" 
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Add your form submission logic here
            const formData = new FormData(this);
            
            // Show success message
            alert('Thank you for your message! We will get back to you soon.');
            
            // Reset form
            this.reset();
        });
    </script>
</body>
</html>