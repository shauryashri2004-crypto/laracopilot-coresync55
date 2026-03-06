@extends('layouts.app')

@section('title', 'Order Confirmed - Campus Canteen')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-16 text-center">

    <!-- Success Animation -->
    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <i class="fas fa-check-circle text-5xl text-green-500"></i>
    </div>
    <h1 class="text-4xl font-extrabold text-gray-800 mb-2">Order Confirmed! 🎉</h1>
    <p class="text-gray-500 text-lg mb-8">Your order has been placed successfully. We'll prepare it fresh for you!</p>

    <!-- Order Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8 text-left mb-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 pb-6 border-b">
            <div class="text-center">
                <p class="text-xs text-gray-500 uppercase tracking-wide">Order No.</p>
                <p class="font-extrabold text-orange-600 text-lg">#{{ $order->order_number }}</p>
            </div>
            <div class="text-center">
                <p class="text-xs text-gray-500 uppercase tracking-wide">Payment</p>
                <p class="font-bold text-gray-800 capitalize">{{ $order->payment_method }}</p>
            </div>
            <div class="text-center">
                <p class="text-xs text-gray-500 uppercase tracking-wide">Status</p>
                <span class="inline-block bg-yellow-100 text-yellow-700 font-bold px-3 py-1 rounded-full text-sm capitalize">{{ $order->order_status }}</span>
            </div>
            <div class="text-center">
                <p class="text-xs text-gray-500 uppercase tracking-wide">Total</p>
                <p class="font-extrabold text-green-600 text-lg">₹{{ number_format($order->total_amount, 0) }}</p>
            </div>
        </div>

        <!-- Items -->
        <h3 class="font-bold text-gray-800 mb-4">Items Ordered</h3>
        <div class="space-y-3 mb-6">
            @foreach($order->items as $item)
            <div class="flex justify-between items-center py-2 border-b border-gray-50">
                <span class="text-gray-700">{{ $item->name }} <span class="text-gray-400 text-sm">× {{ $item->quantity }}</span></span>
                <span class="font-semibold text-gray-800">₹{{ number_format($item->subtotal, 0) }}</span>
            </div>
            @endforeach
            <div class="flex justify-between pt-2">
                <span class="font-extrabold text-gray-800">Total</span>
                <span class="font-extrabold text-orange-600 text-lg">₹{{ number_format($order->total_amount, 0) }}</span>
            </div>
        </div>

        <!-- Student & Payment Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 rounded-xl p-4">
            <div>
                <p class="text-xs text-gray-500 mb-1">Student</p>
                <p class="font-semibold">{{ $order->student_name }}</p>
                <p class="text-sm text-gray-500">{{ $order->student_email }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-1">Payment Info</p>
                @if($order->payment_method === 'upi')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">✅ UPI Paid</span>
                    @if($order->upi_transaction_id)
                        <p class="text-xs text-gray-400 mt-1">Txn: {{ $order->upi_transaction_id }}</p>
                    @endif
                @else
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">💵 Pay at Counter</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Status Timeline -->
    <div class="bg-white rounded-2xl shadow p-6 mb-8">
        <h3 class="font-bold text-gray-800 mb-5">Order Progress</h3>
        <div class="flex items-center justify-between">
            @php $steps = [['icon' => 'fa-receipt', 'label' => 'Order Placed', 'status' => 'pending'], ['icon' => 'fa-check', 'label' => 'Confirmed', 'status' => 'confirmed'], ['icon' => 'fa-fire', 'label' => 'Preparing', 'status' => 'preparing'], ['icon' => 'fa-bell', 'label' => 'Ready', 'status' => 'ready'], ['icon' => 'fa-check-double', 'label' => 'Collected', 'status' => 'delivered']]; @endphp
            @foreach($steps as $index => $step)
            <div class="flex flex-col items-center {{ $index < count($steps)-1 ? 'flex-1' : '' }}">
                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $order->order_status === $step['status'] ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-400' }}">
                    <i class="fas {{ $step['icon'] }} text-sm"></i>
                </div>
                <p class="text-xs text-gray-500 mt-1 text-center">{{ $step['label'] }}</p>
                @if($index < count($steps)-1)
                    <div class="hidden"></div>
                @endif
            </div>
            @if($index < count($steps)-1)
            <div class="flex-1 h-0.5 bg-gray-200 mx-1 mb-5"></div>
            @endif
            @endforeach
        </div>
    </div>

    @if($order->notes)
    <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 mb-6 text-left">
        <p class="text-sm font-semibold text-orange-700"><i class="fas fa-sticky-note mr-2"></i>Special Instructions</p>
        <p class="text-gray-700 text-sm mt-1">{{ $order->notes }}</p>
    </div>
    @endif

    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('menu') }}" class="gradient-orange text-white px-8 py-3 rounded-xl font-bold hover:opacity-90 transition">
            <i class="fas fa-plus mr-2"></i>Order More
        </a>
        <a href="{{ route('order.track', $order->id) }}" class="bg-gray-800 text-white px-8 py-3 rounded-xl font-bold hover:bg-gray-700 transition">
            <i class="fas fa-map-marker-alt mr-2"></i>Track Order
        </a>
    </div>
</div>
@endsection
