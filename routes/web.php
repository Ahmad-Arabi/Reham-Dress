<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProductController;

Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/product/{id}', function ($id) {
    $product = Product::with([ 'colors', 'sizes'])->find($id);
    return view('product', compact('product'));
});

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::get('/cart/remove/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

// Checkout Routes
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.apply-coupon');
    Route::post('/checkout/coupon/remove', [CheckoutController::class, 'removeCoupon'])->name('checkout.remove-coupon');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
   
    
    // Order Routes
    Route::get('/order/confirmation/{order}', [OrderController::class, 'confirmation'])->name('order.confirmation');
    Route::get('/order/receipt/{order}', [OrderController::class, 'generateReceipt'])->name('order.receipt');
});

Route::prefix('admin')->middleware(['isAdmin'])->group(function () {
    //Coupons CRUD
    Route::get('/coupons', [CouponController::class, 'index'])->name('admin.coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('admin.coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('admin.coupons.store');
    Route::get('/coupons/{id}/edit', [CouponController::class, 'edit'])->name('admin.coupons.edit');
    Route::put('/coupons/{id}', [CouponController::class, 'update'])->name('admin.coupons.update');
    Route::get('/coupons/delete/{id}', [CouponController::class, 'delete'])->name('admin.coupons.delete');
    Route::delete('/coupons/{id}', [CouponController::class, 'destroy'])->name('admin.coupons.destroy'); 
    
    //Orders CRUD
    Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders.index');
    Route::post('/orders', [OrdersController::class, 'store'])->name('admin.orders.store');
    Route::get('/orders/{id}/edit', [OrdersController::class, 'edit'])->name('admin.orders.edit');
    Route::put('/orders/{id}', [OrdersController::class, 'update'])->name('admin.orders.update');
    Route::get('/orders/{id}', [OrdersController::class, 'show'])->name('admin.orders.show'); 

    // Users CRUD
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::get('/users/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.users.delete');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');

    // Products CRUD
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::get('/products/{product}/delete', [AdminProductController::class, 'deleteConfirm'])->name('admin.products.delete');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    
});


require __DIR__.'/auth.php';
