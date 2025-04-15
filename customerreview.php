<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customer Reviews</title>

  <!-- ✅ Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800">

  <!-- Customer Reviews Section -->
  <section class="py-16 bg-gradient-to-r from-indigo-50 to-white">
    <div class="max-w-6xl mx-auto px-4 text-center">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">What Our Customers Say</h2>
      <div class="grid md:grid-cols-3 gap-8">

        <!-- Review 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
          <div class="flex justify-center mb-4">
            <img src="ABC.jpg" alt="Madhubala Singh" class="w-16 h-16 rounded-full border-2 border-indigo-500" />
          </div>
          <p class="text-gray-600 mb-4">"SHAURMANIX has completely changed the way we manage our stock. It's fast, intuitive, and reliable!"</p>
          <div class="flex justify-center text-yellow-400 mb-2 text-lg">⭐⭐⭐⭐⭐</div>
          <h4 class="text-sm font-semibold text-indigo-600">— Madhubala Singh</h4>
        </div>

        <!-- Review 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
          <div class="flex justify-center mb-4">
            <img src="https://i.pravatar.cc/100?img=45" alt="Kushagra Raj" class="w-16 h-16 rounded-full border-2 border-indigo-500" />
          </div>
          <p class="text-gray-600 mb-4">"The smart alerts and live tracking help us stay on top of everything. Highly recommend it!"</p>
          <div class="flex justify-center text-yellow-400 mb-2 text-lg">⭐⭐⭐⭐☆</div>
          <h4 class="text-sm font-semibold text-indigo-600">— Kushagra Raj</h4>
        </div>

        <!-- Review 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
          <div class="flex justify-center mb-4">
            <img src="https://i.pravatar.cc/100?img=12" alt="Shweta Singh" class="w-16 h-16 rounded-full border-2 border-indigo-500" />
          </div>
          <p class="text-gray-600 mb-4">"Easy to use and super helpful for report generation. InventoryPro saves us hours each week."</p>
          <div class="flex justify-center text-yellow-400 mb-2 text-lg">⭐⭐⭐⭐⭐</div>
          <h4 class="text-sm font-semibold text-indigo-600">— Shweta Singh</h4>
        </div>

        <!-- Centered Row with Two Reviews -->
        <div class="md:col-span-3 flex flex-col md:flex-row justify-center gap-8 mt-8">

          <!-- Review 4 -->
          <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 w-full md:w-1/3">
            <div class="flex justify-center mb-4">
              <img src="https://i.pravatar.cc/100?img=17" alt="Arwin Dillon" class="w-16 h-16 rounded-full border-2 border-indigo-500" />
            </div>
            <p class="text-gray-600 mb-4">"Love the interface and the analytics dashboard. It's now so easy to track inventory trends."</p>
            <div class="flex justify-center text-yellow-400 mb-2 text-lg">⭐⭐⭐⭐⭐</div>
            <h4 class="text-sm font-semibold text-indigo-600">— Arwin Dillon</h4>
          </div>

          <!-- Review 5 -->
          <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 w-full md:w-1/3">
            <div class="flex justify-center mb-4">
              <img src="https://i.pravatar.cc/100?img=23" alt="Prashant" class="w-16 h-16 rounded-full border-2 border-indigo-500" />
            </div>
            <p class="text-gray-600 mb-4">"From purchase orders to stock alerts, everything is seamless. Great tool for retailers."</p>
            <div class="flex justify-center text-yellow-400 mb-2 text-lg">⭐⭐⭐⭐⭐</div>
            <h4 class="text-sm font-semibold text-indigo-600">— Prashant</h4>
          </div>

        </div>

      </div>
    </div>
  </section>

</body>
</html>
