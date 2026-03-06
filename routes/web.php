<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Order Routes
Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::post('/order/place', [OrderController::class, 'place'])->name('order.place');
Route::get('/order/confirmation/{id}', [OrderController::class, 'confirmation'])->name('order.confirmation');
Route::get('/order/track/{id}', [OrderController::class, 'track'])->name('order.track');

// Admin Auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Admin Categories
Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/admin/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
Route::get('/admin/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('/admin/categories/{id}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('/admin/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

// Admin Menu
Route::get('/admin/menu', [AdminMenuController::class, 'index'])->name('admin.menu.index');
Route::get('/admin/menu/create', [AdminMenuController::class, 'create'])->name('admin.menu.create');
Route::post('/admin/menu', [AdminMenuController::class, 'store'])->name('admin.menu.store');
Route::get('/admin/menu/{id}/edit', [AdminMenuController::class, 'edit'])->name('admin.menu.edit');
Route::put('/admin/menu/{id}', [AdminMenuController::class, 'update'])->name('admin.menu.update');
Route::delete('/admin/menu/{id}', [AdminMenuController::class, 'destroy'])->name('admin.menu.destroy');

// Admin Orders
Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
Route::get('/admin/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
Route::put('/admin/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');