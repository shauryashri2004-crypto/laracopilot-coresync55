<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Campus Canteen - Fresh Food, Fast Service')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .gradient-orange { background: linear-gradient(135deg, #f97316 0%, #ea580c 50%, #dc2626 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }
        .nav-link { transition: color 0.2s; }
        .cart-badge { animation: pulse 2s infinite; }
        @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }
    </style>
</head>
<body class="bg-gray-50 font-sans">

<!-- Top Announcement Bar -->
<div class="gradient-orange text-white text-center py-2 text-sm font-medium">
    <i class="fas fa-utensils mr-2"></i> Order in advance &amp; skip the queue! Open Mon–Sat 8AM–8PM
</div>

<!-- Navigation -->
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <div class="w-10 h-10 gradient-orange rounded-full flex items-center justify-center">
                    <i class="fas fa-utensils text-white text-sm"></i>
                </div>
                <div>
                    <span class="text-xl font-bold text-orange-600">Campus</span>
                    <span class="text-xl font-bold text-gray-800">Canteen</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="nav-link text-gray-700 hover:text-orange-600 font-medium {{ request()->routeIs('home') ? 'text-orange-600 border-b-2 border-orange-600' : '' }}">Home</a>
                <a href="{{ route('menu') }}" class="nav-link text-gray-700 hover:text-orange-600 font-medium {{ request()->routeIs('menu') ? 'text-orange-600 border-b-2 border-orange-600' : '' }}">Menu</a>
                <a href="{{ route('cart.index') }}" class="relative flex items-center space-x-1 text-gray-700 hover:text-orange-600 font-medium">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Cart</span>
                    @if(count(session('cart', [])) > 0)
                        <span class="cart-badge absolute -top-2 -right-3 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            {{ count(session('cart', [])) }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-btn" class="text-gray-700 hover:text-orange-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Nav -->
        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <div class="flex flex-col space-y-2 pt-2 border-t">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-600 py-2 font-medium">Home</a>
                <a href="{{ route('menu') }}" class="text-gray-700 hover:text-orange-600 py-2 font-medium">Menu</a>
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-orange-600 py-2 font-medium">Cart ({{ count(session('cart', [])) }})</a>
            </div>
        </div>
    </div>
</nav>

<!-- Flash Messages -->
@if(session('success'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between">
            <span><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-800 font-bold text-lg">&times;</button>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg flex items-center justify-between">
            <span><i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="text-red-800 font-bold text-lg">&times;</button>
        </div>
    </div>
@endif

<!-- Main Content -->
<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-gray-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <div class="flex items-center space-x-2 mb-4">
                <div class="w-8 h-8 gradient-orange rounded-full flex items-center justify-center">
                    <i class="fas fa-utensils text-white text-xs"></i>
                </div>
                <span class="text-lg font-bold">Campus Canteen</span>
            </div>
            <p class="text-gray-400 text-sm">Your favorite college canteen, now digital! Order ahead, skip the queue, enjoy your meal.</p>
        </div>
        <div>
            <h4 class="font-bold text-orange-400 mb-4">Quick Links</h4>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                <li><a href="{{ route('menu') }}" class="hover:text-white transition">View Menu</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-white transition">My Cart</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold text-orange-400 mb-4">Canteen Hours</h4>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><i class="fas fa-clock mr-2 text-orange-400"></i>Mon–Fri: 8:00 AM – 8:00 PM</li>
                <li><i class="fas fa-clock mr-2 text-orange-400"></i>Saturday: 9:00 AM – 5:00 PM</li>
                <li><i class="fas fa-times-circle mr-2 text-red-400"></i>Sunday: Closed</li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold text-orange-400 mb-4">Contact Us</h4>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><i class="fas fa-map-marker-alt mr-2 text-orange-400"></i>Ground Floor, Main Block</li>
                <li><i class="fas fa-phone mr-2 text-orange-400"></i>+91 98765 43210</li>
                <li><i class="fas fa-envelope mr-2 text-orange-400"></i>canteen@college.edu</li>
            </ul>
        </div>
    </div>
    <div class="border-t border-gray-800 py-6 text-center text-sm text-gray-500">
        <p>© {{ date('Y') }} Campus Canteen. All rights reserved.</p>
        <p class="mt-1">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="text-orange-400 hover:underline">LaraCopilot</a></p>
    </div>
</footer>

<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
</body>
</html>
