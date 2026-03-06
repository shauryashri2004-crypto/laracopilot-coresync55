<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->get('category');
        $search     = $request->get('search');
        $vegOnly    = $request->get('veg');

        $categories = Category::where('active', true)->withCount(['activeMenuItems'])->get();

        $menuItems = MenuItem::with('category')
            ->where('available', true)
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%"))
            ->when($vegOnly, fn($q) => $q->where('is_veg', true))
            ->orderBy('category_id')
            ->orderBy('name')
            ->get()
            ->groupBy('category.name');

        return view('menu', compact('menuItems', 'categories', 'categoryId', 'search', 'vegOnly'));
    }

    public function show($id)
    {
        $item    = MenuItem::with('category')->findOrFail($id);
        $related = MenuItem::where('category_id', $item->category_id)
            ->where('id', '!=', $id)
            ->where('available', true)
            ->take(4)->get();
        return view('menu-detail', compact('item', 'related'));
    }
}