<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('home');
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/admin/products', [AdminController::class, 'productsIndex'])->name('admin.products.index');
    Route::get('/admin/products/create', [AdminController::class, 'productsCreate'])->name('admin.products.create');
    Route::post('/admin/products', [AdminController::class, 'productsStore'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [AdminController::class, 'productsEdit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [AdminController::class, 'productsUpdate'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [AdminController::class, 'productsDestroy'])->name('admin.products.destroy');
});

// // Route cho customer
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.dashboard');
    Route::get('/customer/products', [ProductController::class, 'index'])->name('customer.products.index');
    // Các route khác dành cho customer
});

// Route::get('/customer/cart', [CartController::class, 'cart'])->name('customer.cart');
// Route::get('/customer/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('customer.add.to.cart');
// Route::post('/customer/update-cart', [CartController::class, 'updateCart'])->name('customer.update.cart');
// Route::get('/customer/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('customer.cart.remove');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('customer.add.to.cart');
Route::get('/cart', [CartController::class, 'cart'])->name('customer.cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('customer.update.cart');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('customer.cart.remove');




// Các route yêu cầu người dùng phải đăng nhập
Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('manufacturers', ManufacturerController::class);
});

// Route đăng nhập, đăng ký và đăng xuất
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




 