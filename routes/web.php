<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\WishlistController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

//     APP - ADMIN SIDE     //
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('auth');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/paid', [OrderController::class, 'paidOrders'])->name('orders.paid-orders');
    Route::get('/orders/pending', [OrderController::class, 'pendingOrders'])->name('orders.pending-orders');

    Route::get('/orders/{id}/details', [OrderController::class, 'orderDetails'])->name('orders.details');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
});



//     APP - CLIENT SIDE    //
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product:slug}', [HomeController::class, 'viewProduct'])->name('product.view');
Route::get('/c/{category:slug}', [HomeController::class, 'viewCategory'])->name('category_view');
Route::get('/search', [HomeController::class, 'search'])->name('product.search');

Route::prefix('/cart')->name('cart.')->middleware('auth')->group(function(){
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::get('/add/{product:slug}/{qty}', [CartController::class, 'add'])->name('add');
    Route::get('/remove/{product_id}', [CartController::class, 'remove'])->name('remove');
    Route::get('/update-quantity/{product:slug}', [CartController::class, 'updateQuantity'])->name('update-quantity');
});

Route::prefix('/checkout')->name('checkout.')->middleware('auth')->group(function(){
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'placeOrder'])->name('place.order');
    Route::get('/success', [CheckoutController::class, 'success'])->name('success');
    Route::get('/failure', [CheckoutController::class, 'failure'])->name('failure');
});

Route::prefix('/wishlist')->name('wishlist.')->middleware('auth')->group(function(){
    Route::get('/', [WishlistController::class, 'index'])->name('index');
    Route::post('/add-to-wishlist', [WishlistController::class, 'add'])->name('add');
    Route::post('/remove-to-wishlist', [WishlistController::class, 'remove'])->name('remove');
});

Route::prefix('/dashboard/client')->name('dashboard.')->middleware('auth')->group(function(){
    Route::get('', [HomeController::class, 'dashboardIndex'])->name('index');
    Route::get('/orders/{id}/details', [HomeController::class, 'orderDetails'])->name('orders.details');
});
