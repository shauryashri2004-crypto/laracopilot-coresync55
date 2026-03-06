<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $menuItems  = MenuItem::with('category')->orderBy('category_id')->orderBy('name')->paginate(15);
        $categories = Category::all();
        return view('admin.menu.index', compact('menuItems', 'categories'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $categories = Category::where('active', true)->get();
        return view('admin.menu.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $validated = $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'name'             => 'required|string|max:150',
            'description'      => 'nullable|string|max:500',
            'price'            => 'required|numeric|min:1|max:9999',
            'preparation_time' => 'required|integer|min:1|max:120',
            'is_veg'           => 'nullable|boolean',
            'available'        => 'nullable|boolean',
            'is_featured'      => 'nullable|boolean',
        ]);
        $validated['is_veg']      = $request->has('is_veg');
        $validated['available']   = $request->has('available');
        $validated['is_featured'] = $request->has('is_featured');
        MenuItem::create($validated);
        return redirect()->route('admin.menu.index')->with('success', 'Menu item added successfully!');
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $menuItem   = MenuItem::findOrFail($id);
        $categories = Category::where('active', true)->get();
        return view('admin.menu.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $menuItem  = MenuItem::findOrFail($id);
        $validated = $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'name'             => 'required|string|max:150',
            'description'      => 'nullable|string|max:500',
            'price'            => 'required|numeric|min:1|max:9999',
            'preparation_time' => 'required|integer|min:1|max:120',
            'is_veg'           => 'nullable|boolean',
            'available'        => 'nullable|boolean',
            'is_featured'      => 'nullable|boolean',
        ]);
        $validated['is_veg']      = $request->has('is_veg');
        $validated['available']   = $request->has('available');
        $validated['is_featured'] = $request->has('is_featured');
        $menuItem->update($validated);
        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully!');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        MenuItem::findOrFail($id)->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted successfully!');
    }
}