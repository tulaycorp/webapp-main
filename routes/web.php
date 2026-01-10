<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
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

// Cart Routes
Route::post('/cart/sync', [CartController::class, 'sync']);
Route::get('/cart/data', [CartController::class, 'index']); // New API endpoint
Route::get('/cart', [PageController::class, 'cart'])->name('cart'); // Restore UI route
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Legacy URL support (redirect old PHP URLs)
Route::get('/pages/index.php', fn() => redirect('/'));
Route::get('/pages/products.php', fn() => redirect('/products'));
Route::get('/pages/cart.php', fn() => redirect('/cart'));
Route::get('/pages/about.php', fn() => redirect('/about'));
Route::get('/pages/contact.php', fn() => redirect('/contact'));
