@extends('layouts.app')

@section('title', 'Checkout - Campus Canteen')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Checkout</h1>
    <p class="text-gray-500 mb-8">Fill in your details and choose a payment method</p>

    <!-- Progress Steps -->
    <div class="flex items-center mb-10">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold text-sm">1</div>
            <span class="ml-2 text-sm font-semibold text-orange-600">Cart</span>
        </div>
        <div class="flex-1 h-0.5 bg-orange-500 mx-3"></div>
        <div class="flex items-center">
            <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold text-sm">2</div>
            <span class="ml-2 text-sm font-semibold text-orange-600">Checkout</span>
        </div>
        <div class="flex-1 h-0.5 bg-gray-200 mx-3"></div>
        <div class="flex items-center">
            <div class="w-8 h-8 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold text-sm">3</div>
            <span class="ml-2 text-sm text-gray-400">Confirmation</span>
        </div>
    </div>

    <form action="{{ route('order.place') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left: Details + Payment -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Student Details -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4"><i class="fas fa-user-graduate mr-2 text-orange-500"></i>Your Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name *</label>
                            <input type="text" name="student_name" value="{{ old('student_name') }}" class="w-full border rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-400 focus:outline-none @error('student_name') border-red-400 @enderror" placeholder="Rahul Sharma" required>
                            @error('student_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">College Email *</label>
                            <input type="email" name="student_email" value="{{ old('student_email') }}" class="w-full border rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-400 focus:outline-none @error('student_email') border-red-400 @enderror" placeholder="you@college.edu" required>
                            @error('student_email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Mobile Number *</label>
                            <input type="text" name="student_phone" value="{{ old('student_phone') }}" class="w-full border rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-400 focus:outline-none @error('student_phone') border-red-400 @enderror" placeholder="10-digit mobile number" maxlength="10" required>
                            @error('student_phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Special Instructions (optional)</label>
                            <textarea name="notes" rows="2" class="w-full border rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-400 focus:outline-none" placeholder="Extra spicy? Less oil? Let us know...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4"><i class="fas fa-credit-card mr-2 text-orange-500"></i>Payment Method</h2>
                    @error('payment_method')<p class="text-red-500 text-sm mb-3">{{ $message }}</p>@enderror

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="payment_method" value="upi" class="sr-only peer" {{ old('payment_method') === 'upi' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-200 rounded-xl p-4 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-mobile-alt text-2xl text-blue-500"></i>
                                    <div>
                                        <p class="font-bold text-gray-800">UPI Payment</p>
                                        <p class="text-xs text-gray-500">Google Pay, PhonePe, Paytm</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="payment_method" value="cash" class="sr-only peer" {{ old('payment_method', 'cash') === 'cash' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-200 rounded-xl p-4 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-money-bill-wave text-2xl text-green-500"></i>
                                    <div>
                                        <p class="font-bold text-gray-800">Cash at Counter</p>
                                        <p class="text-xs text-gray-500">Pay when you collect</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- UPI Transaction ID (shown when UPI selected) -->
                    <div id="upi-section" class="mt-4 hidden">
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-3">
                            <p class="font-semibold text-blue-800 mb-1">UPI ID: <span class="font-mono">canteen@college</span></p>
                            <p class="text-blue-600 text-sm">Pay the amount and enter the transaction ID below.</p>
                        </div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">UPI Transaction ID *</label>
                        <input type="text" name="upi_transaction_id" value="{{ old('upi_transaction_id') }}" class="w-full border rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-400 focus:outline-none @error('upi_transaction_id') border-red-400 @enderror" placeholder="Enter your UPI transaction ID">
                        @error('upi_transaction_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow p-6 sticky top-24">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Order Summary</h2>
                    <div class="space-y-3 mb-5 max-h-64 overflow-y-auto">
                        @foreach($cart as $item)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                            <span class="font-semibold">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="border-t pt-4">
                        <div class="flex justify-between">
                            <span class="text-xl font-extrabold text-gray-800">Total</span>
                            <span class="text-2xl font-extrabold text-orange-600">₹{{ number_format($total, 0) }}</span>
                        </div>
                    </div>
                    <button type="submit" class="mt-6 w-full gradient-orange text-white py-3 rounded-xl font-bold hover:opacity-90 transition">
                        <i class="fas fa-check-circle mr-2"></i>Place Order
                    </button>
                    <p class="text-xs text-gray-400 text-center mt-3">By placing the order you agree to our canteen terms.</p>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function () {
            document.getElementById('upi-section').classList.toggle('hidden', this.value !== 'upi');
        });
    });
    // Show UPI section if already selected (old input)
    const upiRadio = document.querySelector('input[name="payment_method"][value="upi"]');
    if (upiRadio && upiRadio.checked) {
        document.getElementById('upi-section').classList.remove('hidden');
    }
</script>
@endsection
