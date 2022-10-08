<?php

use App\Http\Middleware\CheckIfAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

// Pages
Route::view('/', 'index')->name('home');
Route::view('/product-view', 'product-view')->name('product.view');
Route::view('/checkout', 'checkout')->name('checkout');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');
Route::view('/forgotpassword', 'forgotpassword')->name('forgotpassword');
Route::view('/verify', 'verify')->name('verify');
Route::view('/prof', 'prof')->name('prof');
Route::view('/cart', 'cart')->name('cart');
Route::view('/sales', 'sales')->name('sales');
Route::view('/products', 'products')->name('products');

// Admin route
Route::middleware(['auth', CheckIfAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');

    Route::resource('products', ProductController::class);

    Route::resource('orders', OrderController::class);

    Route::resource('customers', CustomerController::class)->only('index', 'show');

    Route::resource('transaction', TransactionController::class)->only('index', 'show');

    // Route::get('settings', [SettingController::class, 'index'])->name('users');

    Route::get('profile', [AdminProfileController::class, 'show'])->name('profile.show');

    Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');
});

// Customer route
Route::middleware('auth')->name('customer.')->group(function () {
    Route::view('/dashboard', 'customer.dashboard')->name('dashboard');

    Route::get('profile', [CustomerProfileController::class, 'show'])->name('profile.show');

    Route::put('profile', [CustomerProfileController::class, 'update'])->name('profile.update');
});