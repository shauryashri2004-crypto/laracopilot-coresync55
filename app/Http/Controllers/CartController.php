<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart  = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate(['menu_item_id' => 'required|exists:menu_items,id']);

        $menuItem = MenuItem::findOrFail($request->menu_item_id);

        if (!$menuItem->available) {
            return back()->with('error', 'This item is currently unavailable.');
        }

        $cart = session('cart', []);
        $id   = $menuItem->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id'               => $menuItem->id,
                'name'             => $menuItem->name,
                'price'            => $menuItem->price,
                'is_veg'           => $menuItem->is_veg,
                'preparation_time' => $menuItem->preparation_time,
                'quantity'         => 1,
            ];
        }

        session(['cart' => $cart]);
        return back()->with('success', $menuItem->name . ' added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:20']);
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session(['cart' => $cart]);
        }
        return back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back()->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared.');
    }
}