<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Main pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}/{slug?}', [ProductController::class, 'show'])->name('products.show');

// Cart Routes (with optional token auth for logged-in user detection)
Route::middleware(['web', \App\Http\Middleware\WebTokenAuthOptional::class])->group(function () {
    Route::post('/cart/sync', [CartController::class, 'sync']);
    Route::get('/cart/data', [CartController::class, 'index']);
    Route::get('/cart', [PageController::class, 'cart'])->name('cart');
    Route::post('/cart/guest/reset', [CartController::class, 'resetGuest']);
    
    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/checkout/validate-card', [CheckoutController::class, 'validateCard'])->name('checkout.validate-card');
    
    // Orders Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/data', [OrderController::class, 'getOrders'])->name('orders.data');
});

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-of-service', [PageController::class, 'termsOfService'])->name('terms-of-service');
Route::get('/shipping-policy', [PageController::class, 'shippingPolicy'])->name('shipping-policy');

// Legacy URL support (redirect old PHP URLs)
Route::get('/pages/index.php', fn() => redirect('/'));
Route::get('/pages/products.php', fn() => redirect('/products'));
Route::get('/pages/cart.php', fn() => redirect('/cart'));
Route::get('/pages/about.php', fn() => redirect('/about'));
Route::get('/pages/contact.php', fn() => redirect('/contact'));
