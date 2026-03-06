@extends('layouts.app')

@section('title', 'Campus Canteen - Home')

@section('content')

<!-- Hero Section -->
<section class="gradient-orange text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl md:text-6xl font-extrabold mb-4 leading-tight">
            Hot Food,<br><span class="text-yellow-300">Zero Waiting!</span>
        </h1>
        <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">Order your favourite canteen food online, skip the queue and pick it up fresh & ready.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('menu') }}" class="bg-white text-orange-600 font-bold px-8 py-4 rounded-full hover:bg-orange-50 transition shadow-lg text-lg">
                <i class="fas fa-book-open mr-2"></i>Browse Menu
            </a>
            <a href="{{ route('cart.index') }}" class="bg-transparent border-2 border-white text-white font-bold px-8 py-4 rounded-full hover:bg-white hover:text-orange-600 transition text-lg">
                <i class="fas fa-shopping-cart mr-2"></i>View Cart
            </a>
        </div>
        <!-- Stats -->
        <div class="mt-12 grid grid-cols-3 gap-6 max-w-lg mx-auto">
            <div class="text-center">
                <div class="text-3xl font-extrabold text-yellow-300">25+</div>
                <div class="text-orange-100 text-sm">Menu Items</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-extrabold text-yellow-300">10 min</div>
                <div class="text-orange-100 text-sm">Avg Ready Time</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-extrabold text-yellow-300">₹15+</div>
                <div class="text-orange-100 text-sm">Starting Price</div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">How It Works</h2>
            <p class="text-gray-500 mt-2">Order in 3 simple steps</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-orange-600 text-2xl"></i>
                </div>
                <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mx-auto -mt-2 mb-4 text-sm font-bold">1</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Browse Menu</h3>
                <p class="text-gray-500">Explore our diverse menu with prices. Filter by category or dietary preference.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-cart-plus text-orange-600 text-2xl"></i>
                </div>
                <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mx-auto -mt-2 mb-4 text-sm font-bold">2</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Add to Cart</h3>
                <p class="text-gray-500">Select your favourite items, adjust quantities and review your order.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-money-bill-wave text-orange-600 text-2xl"></i>
                </div>
                <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mx-auto -mt-2 mb-4 text-sm font-bold">3</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Pay &amp; Pickup</h3>
                <p class="text-gray-500">Pay via UPI instantly or choose cash at counter. Collect your food when ready!</p>
            </div>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800">Food Categories</h2>
            <p class="text-gray-500 mt-2">Find exactly what you're craving</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
            @foreach($categories as $category)
            <a href="{{ route('menu', ['category' => $category->id]) }}" class="card-hover bg-white rounded-2xl p-5 text-center shadow-sm border border-gray-100 cursor-pointer">
                <div class="text-4xl mb-3">{{ $category->icon }}</div>
                <p class="font-semibold text-gray-800 text-sm">{{ $category->name }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $category->active_menu_items_count ?? 0 }} items</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Items -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">⭐ Featured Items</h2>
                <p class="text-gray-500 mt-1">Most loved by students</p>
            </div>
            <a href="{{ route('menu') }}" class="text-orange-600 font-semibold hover:underline">See All <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($featuredItems as $item)
            <div class="card-hover bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-br from-orange-100 to-red-50 h-40 flex items-center justify-center">
                    <span class="text-6xl">{{ $item->is_veg ? '🥗' : '🍗' }}</span>
                </div>
                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-bold text-gray-800">{{ $item->name }}</h3>
                        <span class="{{ $item->is_veg ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} text-xs px-2 py-0.5 rounded-full font-medium">
                            {{ $item->is_veg ? '🟢 Veg' : '🔴 Non-Veg' }}
                        </span>
                    </div>
                    <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ $item->description }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-extrabold text-orange-600">₹{{ number_format($item->price, 0) }}</span>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                            <button type="submit" class="gradient-orange text-white px-4 py-2 rounded-xl font-semibold hover:opacity-90 transition text-sm">
                                <i class="fas fa-plus mr-1"></i> Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Payment Banner -->
<section class="gradient-orange py-12">
    <div class="max-w-4xl mx-auto px-4 text-center text-white">
        <h2 class="text-2xl font-bold mb-3">Multiple Payment Options</h2>
        <p class="text-orange-100 mb-6">We accept UPI and cash at the counter for a convenient checkout experience.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <div class="bg-white bg-opacity-20 rounded-xl px-6 py-4 flex items-center space-x-3">
                <i class="fas fa-mobile-alt text-2xl text-yellow-300"></i>
                <div class="text-left">
                    <p class="font-bold">UPI Payment</p>
                    <p class="text-orange-100 text-sm">Google Pay, PhonePe, Paytm</p>
                </div>
            </div>
            <div class="bg-white bg-opacity-20 rounded-xl px-6 py-4 flex items-center space-x-3">
                <i class="fas fa-money-bill-wave text-2xl text-yellow-300"></i>
                <div class="text-left">
                    <p class="font-bold">Cash at Counter</p>
                    <p class="text-orange-100 text-sm">Pay when you collect</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
