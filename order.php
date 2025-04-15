<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <i class="fas fa-boxes text-2xl text-blue-600 mr-2"></i>
                    <span class="text-xl font-bold text-blue-600">SHAURMANIX</span>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="dashbord.php" class="text-gray-600 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    <a href="product.php" class="text-gray-600 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium">Products</a>
                    <a href="order.php" class="bg-blue-100 text-blue-700 px-3 py-2 rounded-md text-sm font-medium">Orders</a>
                </div>
                <div class="flex items-center">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8 text-blue-600">Order Management System</h1>
        
        <!-- Tabs Navigation -->
        <div class="flex border-b border-gray-200 mb-6">
            <button id="placeOrderTab" class="py-2 px-4 font-medium text-blue-600 border-b-2 border-blue-600">Place Order</button>
            <button id="trackOrderTab" class="py-2 px-4 font-medium text-gray-500 hover:text-blue-600">Track Order</button>
            <button id="orderHistoryTab" class="py-2 px-4 font-medium text-gray-500 hover:text-blue-600">Order History</button>
        </div>
        
        <!-- Place Order Section -->
        <div id="placeOrderSection" class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Place New Order</h2>
            <form id="orderForm" class="space-y-4">
                <div>
                    <label for="product" class="block text-sm font-medium text-gray-700">Product</label>
                    <select id="product" name="product" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" required>
                        <option value="">Select a product</option>
                        <!-- Products will be loaded from localStorage -->
                    </select>
                </div>
                
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" required>
                </div>
                
                <div>
                    <label for="customerName" class="block text-sm font-medium text-gray-700">Your Name</label>
                    <input type="text" id="customerName" name="customerName" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Shipping Address</label>
                    <textarea id="address" name="address" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"></textarea>
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Place Order
                </button>
            </form>
        </div>
        
        <!-- Track Order Section (Hidden by default) -->
        <div id="trackOrderSection" class="bg-white rounded-lg shadow-md p-6 mb-8 hidden">
            <h2 class="text-xl font-semibold mb-4">Track Your Order</h2>
            <div class="space-y-4">
                <div>
                    <label for="orderId" class="block text-sm font-medium text-gray-700">Order ID</label>
                    <input type="text" id="orderId" placeholder="Enter your order ID" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                
                <button id="trackButton" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Track Order
                </button>
                
                <div id="trackingResults" class="mt-6 hidden">
                    <h3 class="text-lg font-medium mb-2">Order Status</h3>
                    <div class="bg-gray-50 p-4 rounded-md">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Order Placed</p>
                                    <p class="text-sm text-gray-500">June 12, 2023</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Processing</p>
                                    <p class="text-sm text-gray-500">June 13, 2023</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Shipped</p>
                                    <p class="text-sm text-gray-500">June 14, 2023</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center text-white">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Out for Delivery</p>
                                    <p class="text-sm text-gray-500">Expected June 16, 2023</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500">Delivered</p>
                                    <p class="text-sm text-gray-500">Not yet delivered</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 bg-gray-50 p-4 rounded-md">
                        <h3 class="text-lg font-medium mb-2">Order Details</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Order ID</p>
                                <p class="font-medium">ORD-123456</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Product</p>
                                <p class="font-medium">Laptop</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Quantity</p>
                                <p class="font-medium">1</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Amount</p>
                                <p class="font-medium">$999.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order History Section (Hidden by default) -->
        <div id="orderHistorySection" class="bg-white rounded-lg shadow-md p-6 hidden">
            <h2 class="text-xl font-semibold mb-4">Your Order History</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="orderHistoryTable">
                        <!-- Orders will be populated here by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Order Confirmation Modal (Hidden by default) -->
        <div id="orderConfirmationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg p-6 max-w-md w-full">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mt-3" id="modalTitle">Order Placed Successfully!</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Your order ID is: <span id="modalOrderId" class="font-medium">ORD-123456</span></p>
                        <p class="text-sm text-gray-500 mt-2">We've sent a confirmation email with details.</p>
                    </div>
                    <div class="mt-4">
                        <button type="button" id="closeModalButton" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const placeOrderTab = document.getElementById('placeOrderTab');
        const trackOrderTab = document.getElementById('trackOrderTab');
        const orderHistoryTab = document.getElementById('orderHistoryTab');
        
        const placeOrderSection = document.getElementById('placeOrderSection');
        const trackOrderSection = document.getElementById('trackOrderSection');
        const orderHistorySection = document.getElementById('orderHistorySection');
        
        const orderForm = document.getElementById('orderForm');
        const productSelect = document.getElementById('product');
        const trackButton = document.getElementById('trackButton');
        const trackingResults = document.getElementById('trackingResults');
        const orderHistoryTable = document.getElementById('orderHistoryTable');
        
        const orderConfirmationModal = document.getElementById('orderConfirmationModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalOrderId = document.getElementById('modalOrderId');
        const closeModalButton = document.getElementById('closeModalButton');

        // Load products from localStorage into the select dropdown
        function loadProductsForOrder() {
            const products = JSON.parse(localStorage.getItem('inventoryProducts')) || [];
            productSelect.innerHTML = '<option value="">Select a product</option>';
            
            products.forEach(product => {
                if (product.quantity > 0) { // Only show products that are in stock
                    const option = document.createElement('option');
                    option.value = product.name.toLowerCase().replace(/\s+/g, '-');
                    option.textContent = `${product.name} ($${product.price.toFixed(2)})`;
                    option.setAttribute('data-price', product.price);
                    productSelect.appendChild(option);
                }
            });
        }

        // Calculate order amount based on product and quantity
        function calculateAmount(product, quantity) {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = parseFloat(selectedOption.getAttribute('data-price'));
            return '$' + (price * quantity).toFixed(2);
        }

        // Tab Switching
        placeOrderTab.addEventListener('click', () => {
            switchTab('place');
        });

        trackOrderTab.addEventListener('click', () => {
            switchTab('track');
        });

        orderHistoryTab.addEventListener('click', () => {
            switchTab('history');
        });

        function switchTab(tab) {
            // Update tab styles
            placeOrderTab.classList.remove('text-blue-600', 'border-blue-600');
            placeOrderTab.classList.add('text-gray-500', 'hover:text-blue-600');
            trackOrderTab.classList.remove('text-blue-600', 'border-blue-600');
            trackOrderTab.classList.add('text-gray-500', 'hover:text-blue-600');
            orderHistoryTab.classList.remove('text-blue-600', 'border-blue-600');
            orderHistoryTab.classList.add('text-gray-500', 'hover:text-blue-600');
            
            // Hide all sections
            placeOrderSection.classList.add('hidden');
            trackOrderSection.classList.add('hidden');
            orderHistorySection.classList.add('hidden');
            
            // Show selected section and update tab style
            if (tab === 'place') {
                placeOrderSection.classList.remove('hidden');
                placeOrderTab.classList.add('text-blue-600', 'border-blue-600');
                placeOrderTab.classList.remove('text-gray-500', 'hover:text-blue-600');
            } else if (tab === 'track') {
                trackOrderSection.classList.remove('hidden');
                trackOrderTab.classList.add('text-blue-600', 'border-blue-600');
                trackOrderTab.classList.remove('text-gray-500', 'hover:text-blue-600');
            } else if (tab === 'history') {
                orderHistorySection.classList.remove('hidden');
                orderHistoryTab.classList.add('text-blue-600', 'border-blue-600');
                orderHistoryTab.classList.remove('text-gray-500', 'hover:text-blue-600');
                populateOrderHistory();
            }
        }

        // Form Submission
        orderForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    // Get form values
    const product = document.getElementById('product').value;
    const quantity = document.getElementById('quantity').value;
    const customerName = document.getElementById('customerName').value;
    const email = document.getElementById('email').value;
    const address = document.getElementById('address').value;
    
    // Generate random order ID
    const orderId = 'ORD-' + Math.floor(100000 + Math.random() * 900000);
    const orderDate = new Date().toISOString();
    
    // Create order object
    const newOrder = {
        id: orderId,
        date: orderDate,
        product: document.getElementById('product').options[document.getElementById('product').selectedIndex].text,
        quantity: quantity,
        amount: calculateAmount(product, quantity),
        status: 'Pending',
        customerName: customerName,
        email: email,
        address: address
    };
    
    // Get existing orders from localStorage or initialize empty array
    const existingOrders = JSON.parse(localStorage.getItem('orders')) || [];
    
    // Add new order
    existingOrders.unshift(newOrder);
    
    // Save back to localStorage
    localStorage.setItem('orders', JSON.stringify(existingOrders));
    
    // Create activity for this order
    const activities = JSON.parse(localStorage.getItem('activities')) || [];
    activities.unshift({
        id: 'ACT-' + Math.floor(100000 + Math.random() * 900000),
        type: 'order_placed',
        title: 'New order received',
        description: `Order ${orderId} for ${quantity} ${newOrder.product}`,
        date: orderDate,
        icon: 'fa-shopping-cart',
        color: 'green'
    });
    localStorage.setItem('activities', JSON.stringify(activities));
    
    // Show confirmation modal
    modalOrderId.textContent = orderId;
    orderConfirmationModal.classList.remove('hidden');
    
    // Reset form
    orderForm.reset();
});

        // Track Order Button
        trackButton.addEventListener('click', () => {
            const orderId = document.getElementById('orderId').value.trim();
            
            if (orderId) {
                // In a real app, you would fetch order details from a server
                // Here we're just showing the sample tracking results
                trackingResults.classList.remove('hidden');
            } else {
                alert('Please enter an order ID');
            }
        });

        // Close Modal Button
        closeModalButton.addEventListener('click', () => {
            orderConfirmationModal.classList.add('hidden');
        });

        // Populate Order History
        function populateOrderHistory() {
            orderHistoryTable.innerHTML = '';
            
            const orders = JSON.parse(localStorage.getItem('orders')) || [];
            
            orders.forEach(order => {
                const row = document.createElement('tr');
                
                // Status badge color
                let statusClass = '';
                if (order.status === 'Delivered') {
                    statusClass = 'bg-green-100 text-green-800';
                } else if (order.status === 'Shipped') {
                    statusClass = 'bg-blue-100 text-blue-800';
                } else if (order.status === 'Processing') {
                    statusClass = 'bg-yellow-100 text-yellow-800';
                } else {
                    statusClass = 'bg-gray-100 text-gray-800';
                }
                
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${order.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(order.date).toLocaleDateString()}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${order.product}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${order.quantity}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${order.amount}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                            ${order.status}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-blue-600 hover:text-blue-900 track-history-btn" data-orderid="${order.id}">Track</button>
                    </td>
                `;
                
                orderHistoryTable.appendChild(row);
            });
            
            // Add event listeners to track buttons in history
            document.querySelectorAll('.track-history-btn').forEach(button => {
                button.addEventListener('click', (e) => {
                    const orderId = e.target.getAttribute('data-orderid');
                    switchTab('track');
                    document.getElementById('orderId').value = orderId;
                    trackingResults.classList.remove('hidden');
                });
            });
        }

        // Initialize the page with place order tab active
        document.addEventListener('DOMContentLoaded', () => {
            loadProductsForOrder();
            switchTab('place');
        });
    </script>
</body>
</html>