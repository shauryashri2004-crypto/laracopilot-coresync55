<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredItems = MenuItem::with('category')
            ->where('available', true)
            ->where('is_featured', true)
            ->take(6)
            ->get();

        $categories = Category::withCount(['menuItems' => fn($q) => $q->where('available', true)])
            ->where('active', true)
            ->get();

        return view('home', compact('featuredItems', 'categories'));
    }
}