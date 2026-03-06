<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\MenuItem;
use App\Models\Category;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $totalOrders       = Order::count();
        $todayOrders       = Order::whereDate('created_at', today())->count();
        $pendingOrders     = Order::whereIn('order_status', ['pending', 'confirmed', 'preparing'])->count();
        $readyOrders       = Order::where('order_status', 'ready')->count();
        $totalRevenue      = Order::where('payment_status', 'paid')->sum('total_amount');
        $todayRevenue      = Order::where('payment_status', 'paid')->whereDate('created_at', today())->sum('total_amount');
        $totalMenuItems    = MenuItem::count();
        $availableItems    = MenuItem::where('available', true)->count();
        $recentOrders      = Order::with('items')->orderBy('created_at', 'desc')->take(10)->get();
        $upiOrders         = Order::where('payment_method', 'upi')->count();
        $cashOrders        = Order::where('payment_method', 'cash')->count();
        $deliveredOrders   = Order::where('order_status', 'delivered')->count();
        $cancelledOrders   = Order::where('order_status', 'cancelled')->count();

        return view('admin.dashboard', compact(
            'totalOrders', 'todayOrders', 'pendingOrders', 'readyOrders',
            'totalRevenue', 'todayRevenue', 'totalMenuItems', 'availableItems',
            'recentOrders', 'upiOrders', 'cashOrders', 'deliveredOrders', 'cancelledOrders'
        ));
    }
}