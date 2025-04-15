<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management | InventoryPro</title>
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
        .fade-in {
            animation: fadeIn 0.3s ease-in;
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
                    <i class="fas fa-boxes text-2xl text-indigo-600 mr-2"></i>
                    <span class="text-xl font-bold text-indigo-600">SHAURMANIX</span>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="dashbord.php" class="text-gray-600 hover:text-indigo-700 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    <a href="product.php" class="bg-indigo-100 text-indigo-700 px-3 py-2 rounded-md text-sm font-medium">Products</a>
                    <a href="order.php" class="text-gray-600 hover:text-indigo-700 px-3 py-2 rounded-md text-sm font-medium">Orders</a>
                </div>
                <div class="flex items-center">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Product Management</h1>
                <p class="text-gray-600">Manage your inventory products</p>
            </div>
            <button id="addProductBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                <i class="fas fa-plus mr-2"></i> Add Product
            </button>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-grow relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search products...">
                </div>
                <select id="categoryFilter" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Categories</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Groceries">Groceries</option>
                    <option value="Furniture">Furniture</option>
                </select>
                <select id="stockFilter" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Stock Status</option>
                    <option value="in_stock">In Stock</option>
                    <option value="low_stock">Low Stock</option>
                    <option value="out_of_stock">Out of Stock</option>
                </select>
            </div>
        </div>

        <!-- Products Table -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="productsTable">
                        <!-- Products will be loaded here -->
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex justify-between items-center">
                <div class="text-sm text-gray-500" id="productCount">Showing 0 products</div>
                <div class="flex space-x-2">
                    <button id="prevPage" class="px-3 py-1 border rounded-md text-sm disabled:opacity-50" disabled>Previous</button>
                    <button id="nextPage" class="px-3 py-1 border rounded-md text-sm disabled:opacity-50" disabled>Next</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Add/Edit Product Modal -->
    <div id="productModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold" id="modalTitle">Add New Product</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="productForm" class="space-y-4">
                <input type="hidden" id="productId">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                    <input type="text" id="productName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                    <select id="productCategory" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="">Select a category</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Clothing">Clothing</option>
                        <option value="Groceries">Groceries</option>
                        <option value="Furniture">Furniture</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantity *</label>
                        <input type="number" id="productQuantity" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price ($) *</label>
                        <input type="number" id="productPrice" min="0" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="productDescription" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" id="cancelBtn" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700">
                        <span id="submitBtnText">Add Product</span>
                        <i id="submitSpinner" class="fas fa-spinner fa-spin ml-2 hidden"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Confirm Deletion</h3>
                <button id="closeDeleteModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p class="mb-4">Are you sure you want to delete this product? This action cannot be undone.</p>
            <div class="flex justify-end space-x-3">
                <button id="cancelDeleteBtn" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</button>
                <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm font-medium hover:bg-red-700">
                    Delete Product
                </button>
            </div>
        </div>
    </div>

    <script>
        // Product Management System
        const productManager = {
            products: [],
            currentPage: 1,
            productsPerPage: 10,
            currentProductId: null,
            
            // Initialize the product manager
            init: function() {
                this.loadProducts();
                this.setupEventListeners();
            },
            
            // Load products from localStorage or initialize with sample data
            loadProducts: function() {
                const savedProducts = localStorage.getItem('inventoryProducts');
                if (savedProducts) {
                    this.products = JSON.parse(savedProducts);
                } else {
                    // Sample data if no products exist
                    this.products = [
                        { id: this.generateId(), name: 'Wireless Headphones', category: 'Electronics', quantity: 45, price: 89.99, description: 'High-quality wireless headphones with noise cancellation' },
                        { id: this.generateId(), name: 'Smart Watch', category: 'Electronics', quantity: 3, price: 199.99, description: 'Latest smart watch with health monitoring features' },
                        { id: this.generateId(), name: 'Bluetooth Speaker', category: 'Electronics', quantity: 12, price: 59.99, description: 'Portable speaker with 20-hour battery life' },
                        { id: this.generateId(), name: 'Cotton T-Shirt', category: 'Clothing', quantity: 30, price: 19.99, description: 'Comfortable 100% cotton t-shirt' },
                        { id: this.generateId(), name: 'Desk Chair', category: 'Furniture', quantity: 8, price: 149.99, description: 'Ergonomic office chair with lumbar support' }
                    ];
                    this.saveProducts();
                }
                
                this.renderProducts();
            },
            
            // Save products to localStorage
            saveProducts: function() {
                localStorage.setItem('inventoryProducts', JSON.stringify(this.products));
            },
            
            // Generate a unique ID for new products
            generateId: function() {
                return 'PROD-' + Math.random().toString(36).substr(2, 9).toUpperCase();
            },
            
            // Add a new product
            addProduct: function(product) {
                product.id = this.generateId();
                this.products.unshift(product);
                this.saveProducts();
                this.renderProducts();
                this.showToast('Product added successfully!');
            },
            
            // Update an existing product
            updateProduct: function(id, updatedProduct) {
                const index = this.products.findIndex(p => p.id === id);
                if (index !== -1) {
                    this.products[index] = { ...updatedProduct, id: id };
                    this.saveProducts();
                    this.renderProducts();
                    this.showToast('Product updated successfully!');
                }
            },
            
            // Delete a product
            deleteProduct: function(id) {
                this.products = this.products.filter(p => p.id !== id);
                this.saveProducts();
                this.renderProducts();
                this.showToast('Product deleted successfully!');
            },
            
            // Filter products based on search and filters
            filterProducts: function() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const category = document.getElementById('categoryFilter').value;
                const stockFilter = document.getElementById('stockFilter').value;
                
                return this.products.filter(product => {
                    const matchesSearch = product.name.toLowerCase().includes(searchTerm) || 
                                         product.description.toLowerCase().includes(searchTerm);
                    const matchesCategory = category === '' || product.category === category;
                    
                    let matchesStock = true;
                    if (stockFilter === 'in_stock') {
                        matchesStock = product.quantity > 10;
                    } else if (stockFilter === 'low_stock') {
                        matchesStock = product.quantity > 0 && product.quantity <= 10;
                    } else if (stockFilter === 'out_of_stock') {
                        matchesStock = product.quantity === 0;
                    }
                    
                    return matchesSearch && matchesCategory && matchesStock;
                });
            },
            
            // Render products to the table
            renderProducts: function() {
                const filteredProducts = this.filterProducts();
                const startIndex = (this.currentPage - 1) * this.productsPerPage;
                const paginatedProducts = filteredProducts.slice(startIndex, startIndex + this.productsPerPage);
                
                const tableBody = document.getElementById('productsTable');
                tableBody.innerHTML = '';
                
                if (paginatedProducts.length === 0) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No products found</td>
                        </tr>
                    `;
                } else {
                    paginatedProducts.forEach(product => {
                        const row = document.createElement('tr');
                        row.className = 'fade-in';
                        row.innerHTML = `
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="edit-btn text-indigo-600 hover:text-indigo-900 mr-3" data-id="${product.id}">Edit</button>
                                <button class="delete-btn text-red-600 hover:text-red-900" data-id="${product.id}">Delete</button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
                
                // Update product count
                document.getElementById('productCount').textContent = 
                    `Showing ${filteredProducts.length} product${filteredProducts.length !== 1 ? 's' : ''}`;
                
                // Update pagination buttons
                const prevBtn = document.getElementById('prevPage');
                const nextBtn = document.getElementById('nextPage');
                
                prevBtn.disabled = this.currentPage === 1;
                nextBtn.disabled = startIndex + this.productsPerPage >= filteredProducts.length;
            },
            
            // Show the add/edit product modal
            showProductModal: function(product = null) {
                const modal = document.getElementById('productModal');
                const title = document.getElementById('modalTitle');
                const form = document.getElementById('productForm');
                const submitText = document.getElementById('submitBtnText');
                
                if (product) {
                    // Edit mode
                    title.textContent = 'Edit Product';
                    submitText.textContent = 'Update Product';
                    document.getElementById('productId').value = product.id;
                    document.getElementById('productName').value = product.name;
                    document.getElementById('productCategory').value = product.category;
                    document.getElementById('productQuantity').value = product.quantity;
                    document.getElementById('productPrice').value = product.price;
                    document.getElementById('productDescription').value = product.description || '';
                } else {
                    // Add mode
                    title.textContent = 'Add New Product';
                    submitText.textContent = 'Add Product';
                    form.reset();
                    document.getElementById('productId').value = '';
                }
                
                modal.classList.remove('hidden');
            },
            
            // Setup event listeners
            setupEventListeners: function() {
                // Add product button
                document.getElementById('addProductBtn').addEventListener('click', () => {
                    this.showProductModal();
                });
                
                // Close modal buttons
                document.getElementById('closeModal').addEventListener('click', () => {
                    document.getElementById('productModal').classList.add('hidden');
                });
                
                document.getElementById('cancelBtn').addEventListener('click', () => {
                    document.getElementById('productModal').classList.add('hidden');
                });
                
                // Product form submission
                document.getElementById('productForm').addEventListener('submit', (e) => {
                    e.preventDefault();
                    
                    const submitBtn = e.target.querySelector('button[type="submit"]');
                    const spinner = document.getElementById('submitSpinner');
                    
                    submitBtn.disabled = true;
                    spinner.classList.remove('hidden');
                    
                    // Simulate API call delay
                    setTimeout(() => {
                        const productId = document.getElementById('productId').value;
                        const product = {
                            name: document.getElementById('productName').value,
                            category: document.getElementById('productCategory').value,
                            quantity: parseInt(document.getElementById('productQuantity').value),
                            price: parseFloat(document.getElementById('productPrice').value),
                            description: document.getElementById('productDescription').value
                        };
                        
                        if (productId) {
                            this.updateProduct(productId, product);
                        } else {
                            this.addProduct(product);
                        }
                        
                        document.getElementById('productModal').classList.add('hidden');
                        submitBtn.disabled = false;
                        spinner.classList.add('hidden');
                    }, 1000);
                });
                
                // Delete product buttons (using event delegation)
                document.getElementById('productsTable').addEventListener('click', (e) => {
                    if (e.target.classList.contains('delete-btn')) {
                        const productId = e.target.getAttribute('data-id');
                        this.showDeleteModal(productId);
                    }
                    
                    if (e.target.classList.contains('edit-btn')) {
                        const productId = e.target.getAttribute('data-id');
                        const product = this.products.find(p => p.id === productId);
                        if (product) {
                            this.showProductModal(product);
                        }
                    }
                });
                
                // Delete modal buttons
                document.getElementById('closeDeleteModal').addEventListener('click', () => {
                    document.getElementById('deleteModal').classList.add('hidden');
                });
                
                document.getElementById('cancelDeleteBtn').addEventListener('click', () => {
                    document.getElementById('deleteModal').classList.add('hidden');
                });
                
                document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
                    const productId = this.currentProductId;
                    document.getElementById('deleteModal').classList.add('hidden');
                    this.deleteProduct(productId);
                });
                
                // Search and filter inputs
                document.getElementById('searchInput').addEventListener('input', () => {
                    this.currentPage = 1;
                    this.renderProducts();
                });
                
                document.getElementById('categoryFilter').addEventListener('change', () => {
                    this.currentPage = 1;
                    this.renderProducts();
                });
                
                document.getElementById('stockFilter').addEventListener('change', () => {
                    this.currentPage = 1;
                    this.renderProducts();
                });
                
                // Pagination buttons
                document.getElementById('prevPage').addEventListener('click', () => {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                        this.renderProducts();
                    }
                });
                
                document.getElementById('nextPage').addEventListener('click', () => {
                    const filteredProducts = this.filterProducts();
                    if ((this.currentPage * this.productsPerPage) < filteredProducts.length) {
                        this.currentPage++;
                        this.renderProducts();
                    }
                });
            },
            
            // Show the delete confirmation modal
            showDeleteModal: function(productId) {
                this.currentProductId = productId;
                document.getElementById('deleteModal').classList.remove('hidden');
            },
            
            // Show toast notification
            showToast: function(message, type = 'success') {
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
        };
        
        // Initialize the product manager when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            productManager.init();
        });
    </script>
</body>
</html>