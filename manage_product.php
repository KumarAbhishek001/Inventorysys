<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Tracker | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        .logo-text {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(90deg, #4f46e5 0%, #10b981 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .tagline {
            font-size: 0.7rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #6b7280;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white text-gray-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-boxes text-2xl text-indigo-600"></i>
                    <div>
                        <div class="logo-text">SHAURMANIX</div>
                        <div class="tagline">STREAMLINING YOUR STOCK, ONE STEP AHEAD</div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="index.php" class="bg-indigo-100 text-indigo-700 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <!-- Add Product button removed from here -->
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Inventory Tracker</h1>
                <p class="text-gray-600">Search and manage your products efficiently</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-500">Last updated: <span id="lastUpdated" class="font-medium">Just now</span></span>
                <button id="refreshBtn" class="p-2 rounded-full hover:bg-gray-200 text-gray-600">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>

        <!-- Search Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Search Products</h2>
                <p class="text-gray-600">Enter product name, SKU, or category</p>
            </div>
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-grow relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter product name...">
                </div>
                <button id="searchBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md font-medium flex items-center justify-center">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
                <button id="advancedBtn" class="border border-indigo-600 text-indigo-600 hover:bg-indigo-50 px-4 py-3 rounded-md font-medium flex items-center justify-center">
                    <i class="fas fa-sliders-h mr-2"></i> Advanced
                </button>
            </div>
        </div>

        <!-- Inventory Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Products</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1" id="totalProducts">1,248</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-boxes text-blue-500"></i>
                    </div>
                </div>
                <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-up mr-1"></i> 12% from last month</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">In Stock</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1" id="inStock">956</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                </div>
                <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-up mr-1"></i> 8% from last month</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Low Stock</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1" id="lowStock">42</h3>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                    </div>
                </div>
                <p class="text-red-500 text-sm mt-2"><i class="fas fa-arrow-down mr-1"></i> 5% from last month</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-red-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Out of Stock</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1" id="outOfStock">32</h3>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <i class="fas fa-times-circle text-red-500"></i>
                    </div>
                </div>
                <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-down mr-1"></i> 15% from last month</p>
            </div>
        </div>

        <!-- Recent Products Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Recent Products</h2>
                <button id="viewAllBtn" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                    View All <i class="fas fa-chevron-right ml-1"></i>
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <!-- Actions column removed from here -->
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="productTable">
                        <!-- Products will be loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        // Sample product data
        let products = [
            { id: 'PRD-001', name: 'Wireless Headphones', category: 'Electronics', quantity: 45, price: 89.99 },
            { id: 'PRD-002', name: 'Smart Watch', category: 'Electronics', quantity: 3, price: 199.99 },
            { id: 'PRD-003', name: 'Bluetooth Speaker', category: 'Electronics', quantity: 0, price: 59.99 }
        ];

        // DOM elements
        const productTable = document.getElementById('productTable');
        const refreshBtn = document.getElementById('refreshBtn');
        const searchBtn = document.getElementById('searchBtn');
        const advancedBtn = document.getElementById('advancedBtn');
        const viewAllBtn = document.getElementById('viewAllBtn');
        const searchInput = document.getElementById('searchInput');

        // Update last updated time
        function updateLastUpdated() {
            const now = new Date();
            const options = { 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit',
                hour12: true 
            };
            document.getElementById('lastUpdated').textContent = now.toLocaleTimeString('en-US', options);
        }

        // Render products table
        function renderProducts(productsToRender = products) {
            productTable.innerHTML = productsToRender.map(product => `
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#${product.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${product.name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${product.category}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                            product.quantity === 0 ? 'bg-red-100 text-red-800' : 
                            product.quantity < 10 ? 'bg-yellow-100 text-yellow-800' : 
                            'bg-green-100 text-green-800'
                        }">
                            ${product.quantity === 0 ? 'Out of Stock' : product.quantity < 10 ? `Low Stock (${product.quantity})` : `In Stock (${product.quantity})`}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$${product.price.toFixed(2)}</td>
                    <!-- Edit/Delete buttons removed from here -->
                </tr>
            `).join('');

            // Update stats
            updateStats();
        }

        // Update statistics
        function updateStats() {
            const totalProducts = products.length;
            const inStock = products.filter(p => p.quantity > 10).length;
            const lowStock = products.filter(p => p.quantity > 0 && p.quantity <= 10).length;
            const outOfStock = products.filter(p => p.quantity === 0).length;

            document.getElementById('totalProducts').textContent = totalProducts;
            document.getElementById('inStock').textContent = inStock;
            document.getElementById('lowStock').textContent = lowStock;
            document.getElementById('outOfStock').textContent = outOfStock;
        }

        // Show toast notification
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            let bgColor = 'bg-green-500';
            let icon = 'fa-check-circle';
            
            if (type === 'error') {
                bgColor = 'bg-red-500';
                icon = 'fa-exclamation-circle';
            } else if (type === 'info') {
                bgColor = 'bg-blue-500';
                icon = 'fa-info-circle';
            } else if (type === 'warning') {
                bgColor = 'bg-yellow-500';
                icon = 'fa-exclamation-triangle';
            }
            
            toast.className = `fixed bottom-4 right-4 ${bgColor} text-white px-4 py-2 rounded-md shadow-lg flex items-center animate-fade-in`;
            toast.innerHTML = `
                <i class="fas ${icon} mr-2"></i>
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

        // Event Listeners
        refreshBtn.addEventListener('click', function() {
            this.classList.add('animate-spin');
            setTimeout(() => {
                this.classList.remove('animate-spin');
                updateLastUpdated();
                showToast('Inventory data refreshed successfully!');
            }, 1000);
        });

        searchBtn.addEventListener('click', function() {
            const searchTerm = searchInput.value.trim().toLowerCase();
            if (searchTerm) {
                const filteredProducts = products.filter(product => 
                    product.name.toLowerCase().includes(searchTerm) || 
                    product.id.toLowerCase().includes(searchTerm) ||
                    product.category.toLowerCase().includes(searchTerm)
                );
                renderProducts(filteredProducts);
                showToast(`Found ${filteredProducts.length} matching products`, 'info');
            } else {
                renderProducts();
                showToast('Please enter a search term', 'error');
            }
        });

        advancedBtn.addEventListener('click', () => {
            showToast('Advanced search with filters coming soon!', 'info');
        });

        viewAllBtn.addEventListener('click', () => {
            renderProducts();
            showToast('Showing all products');
        });

        // Initialize
        updateLastUpdated();
        renderProducts();
    </script>
</body>
</html>