@extends('layouts.app')

@section('title', 'Menu - Campus Canteen')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    <!-- Header -->
    <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-gray-800">Our Menu</h1>
        <p class="text-gray-500 mt-2">Fresh food prepared with love, ready to order</p>
    </div>

    <!-- Filters -->
    <form method="GET" action="{{ route('menu') }}" class="bg-white rounded-2xl shadow p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Search</label>
                <input type="text" name="search" value="{{ $search }}" placeholder="Search food items..." class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                <select name="category" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>{{ $cat->icon }} {{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center space-x-2 pt-5">
                <input type="checkbox" name="veg" id="veg" value="1" {{ $vegOnly ? 'checked' : '' }} class="w-4 h-4 text-green-600">
                <label for="veg" class="text-sm font-semibold text-gray-700">🟢 Veg Only</label>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="flex-1 gradient-orange text-white py-2 rounded-lg font-semibold hover:opacity-90 transition">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <a href="{{ route('menu') }}" class="flex-1 bg-gray-200 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-300 transition text-center">Clear</a>
            </div>
        </div>
    </form>

    <!-- Cart Quick View -->
    @if(count(session('cart', [])) > 0)
    <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 mb-6 flex items-center justify-between">
        <span class="text-orange-700 font-semibold"><i class="fas fa-shopping-cart mr-2"></i>{{ count(session('cart', [])) }} item(s) in cart</span>
        <a href="{{ route('cart.index') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-700 transition text-sm">
            View Cart <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
    @endif

    <!-- Menu Items by Category -->
    @forelse($menuItems as $categoryName => $items)
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="w-1 h-7 bg-orange-500 rounded mr-3 block"></span>
            {{ $categoryName }}
            <span class="ml-3 text-sm font-normal text-gray-400">({{ $items->count() }} items)</span>
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach($items as $item)
            <div class="card-hover bg-white rounded-2xl shadow border border-gray-100 overflow-hidden flex flex-col">
                <div class="bg-gradient-to-br from-orange-50 to-amber-50 h-32 flex items-center justify-center">
                    <span class="text-5xl">{{ $item->is_veg ? '🥗' : '🍗' }}</span>
                </div>
                <div class="p-4 flex flex-col flex-1">
                    <div class="flex items-start justify-between mb-1">
                        <h3 class="font-bold text-gray-800 text-sm leading-tight">{{ $item->name }}</h3>
                        <span class="{{ $item->is_veg ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} text-xs px-1.5 py-0.5 rounded ml-2 flex-shrink-0">
                            {{ $item->is_veg ? '🟢' : '🔴' }}
                        </span>
                    </div>
                    <p class="text-gray-400 text-xs mb-3 flex-1 line-clamp-2">{{ $item->description }}</p>
                    <div class="text-xs text-gray-400 mb-3">
                        <i class="fas fa-clock mr-1"></i> ~{{ $item->preparation_time }} mins
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-extrabold text-orange-600">₹{{ number_format($item->price, 0) }}</span>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                            <button type="submit" class="gradient-orange text-white px-3 py-1.5 rounded-lg font-semibold hover:opacity-90 transition text-xs">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @empty
    <div class="text-center py-20">
        <div class="text-6xl mb-4">🍽️</div>
        <h3 class="text-xl font-bold text-gray-700 mb-2">No items found</h3>
        <p class="text-gray-400 mb-4">Try adjusting your filters or search term.</p>
        <a href="{{ route('menu') }}" class="text-orange-600 font-semibold hover:underline">Clear Filters</a>
    </div>
    @endforelse
</div>
@endsection
