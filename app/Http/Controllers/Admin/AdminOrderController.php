<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $status = request('status');
        $orders = Order::with('items')
            ->when($status, fn($q) => $q->where('order_status', $status))
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.orders.index', compact('orders', 'status'));
    }

    public function show($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $order = Order::with('items.menuItem')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $order     = Order::findOrFail($id);
        $validated = $request->validate([
            'order_status'   => 'required|in:pending,confirmed,preparing,ready,delivered,cancelled',
            'payment_status' => 'required|in:pending,paid,failed',
        ]);
        $order->update($validated);
        return redirect()->back()->with('success', 'Order #' . $order->order_number . ' updated successfully!');
    }
}