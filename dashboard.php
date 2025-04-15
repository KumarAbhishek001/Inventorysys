<?php
include "connection.php";
session_start();
if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}

// LOGOUT
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    if (isset($conn)) {
        $conn->close();
    }
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

// Redirect to login.php after clicking "Get Started"
if (isset($_POST['get_started'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar.collapsed {
            width: 5rem;
        }
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        .sidebar.collapsed .logo-text {
            display: none;
        }
        .main-content {
            transition: margin-left 0.3s ease;
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <button id="sidebarToggle" class="mr-4 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="flex items-center">
                        <i class="fas fa-boxes text-2xl text-indigo-600 mr-2"></i>
                        <span class="text-xl font-bold text-indigo-600">SHAURMANIX</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button id="notificationsBtn" class="p-2 text-gray-500 hover:text-gray-700 relative">
                            <i class="fas fa-bell"></i>
                            <span id="notificationBadge" class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">0</span>
                        </button>
                    </div>
                    <div class="relative">
                        <button id="userMenuBtn" class="flex items-center space-x-2">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="h-8 w-8 rounded-full">
                            <span id="userNameDisplay" class="hidden md:inline"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar bg-white shadow-md h-screen fixed top-0 left-0 z-40 w-64 pt-16">
            <div class="flex flex-col h-full">
                <div class="px-4 py-4">
                    <div class="space-y-1">
                        <a href="dashbord.php" class="flex items-center px-2 py-3 text-sm font-medium rounded-md bg-indigo-50 text-indigo-700">
                            <i class="fas fa-tachometer-alt mr-3 text-indigo-600"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                        <a href="product.php" class="flex items-center px-2 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-boxes mr-3 text-gray-500"></i>
                            <span class="sidebar-text">Products</span>
                        </a>
                        <a href="order.php" class="flex items-center px-2 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-shopping-cart mr-3 text-gray-500"></i>
                            <span class="sidebar-text">Orders</span>
                        </a>
                        
                        <a href="login.php" id="logoutBtn" class="flex items-center px-2 py-3 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-sign-out-alt mr-3 text-gray-500"></i>
                            <button type="submit" class="sidebar-text" name="logout" >Logout</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div id="mainContent" class="main-content flex-1 ml-64 p-6">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
                <p class="text-gray-600">Welcome back! Here's what's happening with your inventory today.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" id="statsCards">
                <!-- Cards will be populated by JavaScript -->
            </div>

            <!-- Recent Products -->
            <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Products</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="recentProductsTable">
                            <!-- Recent products will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Recent Activity</h2>
                    <button id="refreshActivity" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                        <i class="fas fa-sync-alt mr-1"></i> Refresh
                    </button>
                </div>
                <div class="space-y-4" id="activityFeed">
                    <!-- Activity items will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications Dropdown -->
    <div id="notificationsDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50">
        <div class="p-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
        </div>
        <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto" id="notificationsList">
            <!-- Notifications will be populated by JavaScript -->
        </div>
        <div class="p-4 border-t text-center">
            <a href="#" class="text-indigo-600 text-sm font-medium">View all notifications</a>
        </div>
    </div>

    <script>
        // Get current user from localStorage
        const currentUser = JSON.parse(localStorage.getItem('currentUser')) || {
            firstName: 'Abhishek',
            lastName: 'Kumar'
        };

        // Display user name
        document.getElementById('userNameDisplay').textContent = currentUser.firstName + ' ' + currentUser.lastName;

        // Logout functionality
        document.getElementById('logoutBtn').addEventListener('click', function(e) {
            e.preventDefault();
            localStorage.removeItem('currentUser');
            window.location.href = 'index.php';
        });

        // Data Store
        const dataStore = {
            products: [],
            orders: [],
            activities: [],
            notifications: []
        };

        // DOM elements
        const elements = {
            sidebar: document.getElementById('sidebar'),
            sidebarToggle: document.getElementById('sidebarToggle'),
            mainContent: document.getElementById('mainContent'),
            statsCards: document.getElementById('statsCards'),
            recentProductsTable: document.getElementById('recentProductsTable'),
            activityFeed: document.getElementById('activityFeed'),
            notificationsBtn: document.getElementById('notificationsBtn'),
            notificationsDropdown: document.getElementById('notificationsDropdown'),
            notificationsList: document.getElementById('notificationsList'),
            notificationBadge: document.getElementById('notificationBadge'),
            refreshActivity: document.getElementById('refreshActivity')
        };
        
        // Utility functions
        const utils = {
            formatDate: (dateString) => {
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', { 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            },
            timeAgo: (dateString) => {
                const date = new Date(dateString);
                const now = new Date();
                const seconds = Math.floor((now - date) / 1000);
                
                let interval = Math.floor(seconds / 31536000);
                if (interval >= 1) return `${interval} year${interval === 1 ? '' : 's'} ago`;
                
                interval = Math.floor(seconds / 2592000);
                if (interval >= 1) return `${interval} month${interval === 1 ? '' : 's'} ago`;
                
                interval = Math.floor(seconds / 86400);
                if (interval >= 1) return `${interval} day${interval === 1 ? '' : 's'} ago`;
                
                interval = Math.floor(seconds / 3600);
                if (interval >= 1) return `${interval} hour${interval === 1 ? '' : 's'} ago`;
                
                interval = Math.floor(seconds / 60);
                if (interval >= 1) return `${interval} minute${interval === 1 ? '' : 's'} ago`;
                
                return 'Just now';
            },
            generateRandomId: () => {
                return Math.random().toString(36).substring(2, 9);
            }
        };

        // API Service (simulated)
        const apiService = {
            fetchDashboardData: async () => {
                // Simulate API call delay
                await new Promise(resolve => setTimeout(resolve, 500));
                
                // Get products from localStorage
                const mockProducts = JSON.parse(localStorage.getItem('inventoryProducts')) || [];
                
                // Get orders from localStorage
                const mockOrders = JSON.parse(localStorage.getItem('orders')) || [];
                
                // Get activities from localStorage
                const mockActivities = JSON.parse(localStorage.getItem('activities')) || [];
                
                return {
                    products: mockProducts,
                    orders: mockOrders,
                    activities: mockActivities
                };
            },
            generateActivities: (products, orders, existingActivities = []) => {
                const activities = [...existingActivities];
                
                // Add product activities if they don't already exist
                products.forEach(product => {
                    if (!activities.some(a => a.description.includes(product.name))) {
                        activities.push({
                            id: utils.generateRandomId(),
                            type: 'product_added',
                            title: 'New product added',
                            description: `${product.name} was added to inventory`,
                            date: new Date(),
                            icon: 'fa-box',
                            color: 'blue'
                        });
                        
                        if (product.quantity < 10) {
                            activities.push({
                                id: utils.generateRandomId(),
                                type: 'low_stock',
                                title: 'Low stock alert',
                                description: `${product.name} is running low (${product.quantity} remaining)`,
                                date: new Date(),
                                icon: 'fa-exclamation-triangle',
                                color: 'yellow'
                            });
                        }
                    }
                });
                
                // Add order activities if they don't already exist
                orders.forEach(order => {
                    if (!activities.some(a => a.description.includes(order.id))) {
                        activities.push({
                            id: utils.generateRandomId(),
                            type: 'order_placed',
                            title: 'New order received',
                            description: `Order ${order.id} for ${order.quantity} ${order.product}`,
                            date: new Date(order.date),
                            icon: 'fa-shopping-cart',
                            color: 'green'
                        });
                        
                        if (order.status === 'Shipped' || order.status === 'Delivered') {
                            activities.push({
                                id: utils.generateRandomId(),
                                type: 'order_shipped',
                                title: 'Order shipped',
                                description: `Order ${order.id} has been shipped`,
                                date: new Date(new Date(order.date).getTime() + Math.floor(Math.random() * 2 * 24 * 60 * 60 * 1000)),
                                icon: 'fa-truck',
                                color: 'green'
                            });
                        }
                        
                        if (order.status === 'Delivered') {
                            activities.push({
                                id: utils.generateRandomId(),
                                type: 'order_delivered',
                                title: 'Order delivered',
                                description: `Order ${order.id} has been delivered`,
                                date: new Date(new Date(order.date).getTime() + Math.floor(Math.random() * 3 * 24 * 60 * 60 * 1000)),
                                icon: 'fa-check-circle',
                                color: 'green'
                            });
                        }
                    }
                });
                
                // Sort by date (newest first)
                return activities.sort((a, b) => new Date(b.date) - new Date(a.date));
            },
            generateNotifications: (activities) => {
                // Get only recent activities (last 3 days)
                const threeDaysAgo = new Date(Date.now() - 3 * 24 * 60 * 60 * 1000);
                return activities
                    .filter(activity => new Date(activity.date) > threeDaysAgo)
                    .slice(0, 5); // Only show 5 most recent
            }
        };

        // UI Renderers
        const renderers = {
            statsCards: (products, orders) => {
                const totalProducts = products.length;
                const lowStock = products.filter(p => p.quantity < 10 && p.quantity > 0).length;
                const outOfStock = products.filter(p => p.quantity === 0).length;
                
                // Calculate today's orders
                const today = new Date().toDateString();
                const todaysOrders = orders.filter(o => {
                    const orderDate = new Date(o.date).toDateString();
                    return orderDate === today;
                }).length;
                
                const cards = [
                    {
                        title: 'Total Products',
                        value: totalProducts,
                        change: '12% from last month',
                        changePositive: true,
                        icon: 'fa-boxes',
                        color: 'blue',
                        border: 'blue'
                    },
                    {
                        title: 'Low Stock',
                        value: lowStock,
                        change: `${lowStock > 0 ? lowStock : 'No'} alerts`,
                        changePositive: lowStock === 0,
                        icon: 'fa-exclamation-triangle',
                        color: 'yellow',
                        border: 'yellow'
                    },
                    {
                        title: "Today's Orders",
                        value: todaysOrders,
                        change: todaysOrders > 0 ? `${todaysOrders} new today` : 'No orders today',
                        changePositive: todaysOrders > 0,
                        icon: 'fa-shopping-cart',
                        color: 'green',
                        border: 'green'
                    },
                    {
                        title: 'Out of Stock',
                        value: outOfStock,
                        change: outOfStock > 0 ? 'Needs attention' : 'All stocked',
                        changePositive: outOfStock === 0,
                        icon: 'fa-times-circle',
                        color: 'red',
                        border: 'red'
                    }
                ];
                
                elements.statsCards.innerHTML = cards.map(card => `
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-${card.border}-500 fade-in">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">${card.title}</p>
                                <h3 class="text-2xl font-bold mt-2">${card.value}</h3>
                            </div>
                            <div class="bg-${card.color}-100 p-3 rounded-full h-12 w-12 flex items-center justify-center">
                                <i class="fas ${card.icon} text-${card.color}-500"></i>
                            </div>
                        </div>
                        <p class="text-sm ${card.changePositive ? 'text-green-500' : 'text-red-500'} mt-2">
                            <i class="fas ${card.changePositive ? 'fa-arrow-up' : 'fa-arrow-down'} mr-1"></i> ${card.change}
                        </p>
                    </div>
                `).join('');
            },
            recentProducts: (products) => {
                const recentProducts = products.slice(0, 5); // Show 5 most recent
                
                elements.recentProductsTable.innerHTML = recentProducts.map(product => `
                    <tr class="fade-in">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${product.id}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${product.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${product.category}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                                product.quantity === 0 ? 'bg-red-100 text-red-800' : 
                                product.quantity <= 10 ? 'bg-yellow-100 text-yellow-800' : 
                                'bg-green-100 text-green-800'
                            }">
                                ${product.quantity === 0 ? 'Out of Stock' : product.quantity <= 10 ? `Low Stock (${product.quantity})` : `In Stock (${product.quantity})`}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$${product.price.toFixed(2)}</td>
                    </tr>
                `).join('');
            },
            activityFeed: (activities) => {
                const recentActivities = activities.slice(0, 5); // Show 5 most recent
                
                elements.activityFeed.innerHTML = recentActivities.map(activity => `
                    <div class="flex items-start fade-in">
                        <div class="bg-${activity.color}-100 p-2 rounded-full mr-3">
                            <i class="fas ${activity.icon} text-${activity.color}-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium">${activity.title}</p>
                            <p class="text-xs text-gray-500">${activity.description}</p>
                            <p class="text-xs text-gray-400 mt-1">${utils.timeAgo(activity.date)}</p>
                        </div>
                    </div>
                `).join('');
            },
            notifications: (notifications) => {
                elements.notificationsList.innerHTML = notifications.map(notification => `
                    <div class="p-4 hover:bg-gray-50 cursor-pointer">
                        <div class="flex items-start">
                            <div class="bg-${notification.color}-100 p-2 rounded-full mr-3">
                                <i class="fas ${notification.icon} text-${notification.color}-500"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium">${notification.title}</p>
                                <p class="text-xs text-gray-500">${notification.description}</p>
                                <p class="text-xs text-gray-400 mt-1">${utils.timeAgo(notification.date)}</p>
                            </div>
                        </div>
                    </div>
                `).join('');
                
                // Update badge count
                if (notifications.length > 0) {
                    elements.notificationBadge.textContent = notifications.length;
                    elements.notificationBadge.classList.remove('hidden');
                } else {
                    elements.notificationBadge.classList.add('hidden');
                }
            }
        };

        // Event Handlers
        const handlers = {
            init: async () => {
                // Show loading state
                elements.statsCards.innerHTML = '<div class="col-span-4 flex justify-center items-center h-32"><i class="fas fa-spinner fa-spin text-indigo-500 text-2xl"></i></div>';
                elements.activityFeed.innerHTML = '<div class="flex justify-center items-center h-32"><i class="fas fa-spinner fa-spin text-indigo-500 text-2xl"></i></div>';
                
                try {
                    // Fetch data
                    const { products, orders, activities } = await apiService.fetchDashboardData();
                    dataStore.products = products;
                    dataStore.orders = orders;
                    
                    // Generate activities and notifications
                    dataStore.activities = apiService.generateActivities(products, orders, activities);
                    dataStore.notifications = apiService.generateNotifications(dataStore.activities);
                    
                    // Save activities back to localStorage
                    localStorage.setItem('activities', JSON.stringify(dataStore.activities));
                    
                    // Render UI
                    renderers.statsCards(products, orders);
                    renderers.recentProducts(products);
                    renderers.activityFeed(dataStore.activities);
                    renderers.notifications(dataStore.notifications);
                    
                    // ... rest of the initialization code ...
                } catch (error) {
                    console.error('Error loading dashboard data:', error);
                    showToast('Failed to load dashboard data', 'error');
                }
            }
        };

        // Toast notification
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                info: 'bg-blue-500'
            };
            
            toast.className = `fixed bottom-4 right-4 ${colors[type]} text-white px-4 py-2 rounded-md shadow-lg flex items-center animate-fade-in`;
            toast.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-2"></i>
                ${message}
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }

        // Initialize the dashboard
        document.addEventListener('DOMContentLoaded', handlers.init);
        // Sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('mainContent').classList.toggle('ml-64');
            document.getElementById('mainContent').classList.toggle('ml-20');
        });
    </script>
</body>
</html>