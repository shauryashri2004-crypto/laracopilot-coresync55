@extends('layouts.app')

@section('title', 'My Cart - Campus Canteen')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-8"><i class="fas fa-shopping-cart text-orange-500 mr-3"></i>My Cart</h1>

    @if(empty($cart))
    <div class="text-center py-20 bg-white rounded-2xl shadow">
        <div class="text-7xl mb-5">🛒</div>
        <h2 class="text-2xl font-bold text-gray-700 mb-3">Your cart is empty!</h2>
        <p class="text-gray-400 mb-6">Browse our menu and add your favourite items to get started.</p>
        <a href="{{ route('menu') }}" class="gradient-orange text-white px-8 py-3 rounded-full font-bold hover:opacity-90 transition">
            <i class="fas fa-book-open mr-2"></i>Browse Menu
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-4">
            @foreach($cart as $id => $item)
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5 flex items-center gap-4">
                <div class="w-16 h-16 bg-orange-50 rounded-xl flex items-center justify-center text-3xl flex-shrink-0">
                    {{ $item['is_veg'] ? '🥗' : '🍗' }}
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-gray-800">{{ $item['name'] }}</h3>
                        <span class="{{ $item['is_veg'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} text-xs px-2 py-0.5 rounded-full">
                            {{ $item['is_veg'] ? '🟢 Veg' : '🔴 Non-Veg' }}
                        </span>
                    </div>
                    <p class="text-orange-600 font-bold mt-1">₹{{ number_format($item['price'], 0) }} each</p>
                    <div class="flex items-center justify-between mt-2">
                        <!-- Quantity Update -->
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            @method('PUT')
                            <button type="button" onclick="let q=this.nextElementSibling; if(q.value>1){q.value=parseInt(q.value)-1; this.form.submit();}" class="w-7 h-7 bg-gray-100 rounded-full text-gray-600 hover:bg-orange-100 font-bold">-</button>
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="20" class="w-12 text-center border rounded-lg py-1 text-sm" onchange="this.form.submit()">
                            <button type="button" onclick="let q=this.previousElementSibling; q.value=parseInt(q.value)+1; this.form.submit();" class="w-7 h-7 bg-gray-100 rounded-full text-gray-600 hover:bg-orange-100 font-bold">+</button>
                        </form>
                        <div class="flex items-center space-x-4">
                            <span class="font-extrabold text-gray-800">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <form action="{{ route('cart.clear') }}" method="POST" class="text-right">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium" onclick="return confirm('Clear all items from cart?')">
                    <i class="fas fa-trash mr-1"></i> Clear Cart
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-6 sticky top-24">
                <h2 class="text-xl font-bold text-gray-800 mb-5">Order Summary</h2>
                <div class="space-y-3 mb-5">
                    @foreach($cart as $item)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                        <span class="font-semibold">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="border-t pt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-bold">₹{{ number_format($total, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-gray-600 text-sm">Taxes & Fees</span>
                        <span class="text-green-600 text-sm font-semibold">Included</span>
                    </div>
                </div>
                <div class="border-t mt-4 pt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-extrabold text-gray-800">Total</span>
                        <span class="text-2xl font-extrabold text-orange-600">₹{{ number_format($total, 0) }}</span>
                    </div>
                </div>
                <a href="{{ route('order.checkout') }}" class="mt-6 block w-full gradient-orange text-white text-center py-3 rounded-xl font-bold hover:opacity-90 transition">
                    <i class="fas fa-lock mr-2"></i>Proceed to Checkout
                </a>
                <a href="{{ route('menu') }}" class="mt-3 block w-full text-center text-orange-600 font-semibold hover:underline text-sm">
                    <i class="fas fa-plus mr-1"></i>Add More Items
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
