<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — Campus Canteen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .sidebar-link { transition: all 0.2s; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(249,115,22,0.15); color: #f97316; border-left: 3px solid #f97316; }
    </style>
</head>
<body class="bg-gray-100">
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col flex-shrink-0 overflow-y-auto">
        <div class="p-5 border-b border-gray-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-utensils text-white"></i>
                </div>
                <div>
                    <p class="font-bold text-white">Campus Canteen</p>
                    <p class="text-xs text-orange-400">Admin Panel</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fas fa-receipt w-5"></i><span>Orders</span>
                @php $pendingCount = \App\Models\Order::whereIn('order_status', ['pending', 'confirmed', 'preparing'])->count(); @endphp
                @if($pendingCount > 0)
                    <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-0.5">{{ $pendingCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.menu.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
                <i class="fas fa-book-open w-5"></i><span>Menu Items</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fas fa-tags w-5"></i><span>Categories</span>
            </a>
            <div class="pt-4 border-t border-gray-700">
                <a href="{{ route('home') }}" target="_blank" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300">
                    <i class="fas fa-external-link-alt w-5"></i><span>View Website</span>
                </a>
            </div>
        </nav>

        <div class="p-4 border-t border-gray-700">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-xs"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-white">{{ session('admin_user', 'Admin') }}</p>
                    <p class="text-xs text-gray-400">{{ session('admin_role', 'Staff') }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full text-left flex items-center space-x-2 text-gray-400 hover:text-red-400 text-sm transition">
                    <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
            <div class="flex items-center space-x-4 text-sm text-gray-500">
                <span><i class="fas fa-clock mr-1"></i>{{ now()->format('D, d M Y') }}</span>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="px-6 pt-4">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between mb-4">
                    <span><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="font-bold text-lg">&times;</button>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg flex items-center justify-between mb-4">
                    <span><i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="font-bold text-lg">&times;</button>
                </div>
            @endif
        </div>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
