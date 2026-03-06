<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Please add items before checkout.');
        }
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('checkout', compact('cart', 'total'));
    }

    public function place(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'student_name'       => 'required|string|max:100',
            'student_email'      => 'required|email|max:150',
            'student_phone'      => 'required|string|size:10',
            'payment_method'     => 'required|in:upi,cash',
            'upi_transaction_id' => 'required_if:payment_method,upi|nullable|string|max:50',
            'notes'              => 'nullable|string|max:300',
        ]);

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $orderNumber = 'ORD' . strtoupper(substr(uniqid(), -6));

        $paymentStatus = ($validated['payment_method'] === 'upi') ? 'paid' : 'pending';

        $order = Order::create([
            'order_number'       => $orderNumber,
            'student_name'       => $validated['student_name'],
            'student_email'      => $validated['student_email'],
            'student_phone'      => $validated['student_phone'],
            'payment_method'     => $validated['payment_method'],
            'payment_status'     => $paymentStatus,
            'order_status'       => 'pending',
            'total_amount'       => $total,
            'notes'              => $validated['notes'] ?? null,
            'upi_transaction_id' => $validated['upi_transaction_id'] ?? null,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'menu_item_id' => $item['id'],
                'name'         => $item['name'],
                'price'        => $item['price'],
                'quantity'     => $item['quantity'],
                'subtotal'     => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('order.confirmation', $order->id);
    }

    public function confirmation($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('order-confirmation', compact('order'));
    }

    public function track($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('order-track', compact('order'));
    }
}