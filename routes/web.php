<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\StorefrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StorefrontController::class, 'index'])->name('storefront');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegistration'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1')->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:customer'])->group(function (): void {
    Route::get('/cart', [OrderController::class, 'cart'])->name('cart.index');
    Route::post('/cart/items', [OrderController::class, 'addToCart'])->name('cart.items.store');
    Route::put('/cart/items/{product}', [OrderController::class, 'updateCartItem'])->name('cart.items.update');
    Route::delete('/cart/items/{product}', [OrderController::class, 'removeCartItem'])->name('cart.items.destroy');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'checkout'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/payment-proofs', [OrderController::class, 'uploadPaymentProof'])->name('orders.payment-proofs.store');
    Route::get('/payment-proofs/{paymentProof}', [OrderController::class, 'downloadPaymentProof'])->name('orders.payment-proofs.download');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function (): void {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [AdminController::class, 'archiveProduct'])->name('products.archive');
    Route::post('/staff', [AdminController::class, 'storeStaff'])->name('staff.store');
    Route::put('/site-settings', [AdminController::class, 'updateSiteSettings'])->name('settings.update');
    Route::put('/promo-settings', [AdminController::class, 'updatePromotionSettings'])->name('promo-settings.update');
    Route::put('/marketplace-settings', [AdminController::class, 'updateMarketplaceSettings'])->name('marketplace-settings.update');
    Route::post('/promotions/apply', [AdminController::class, 'applyMassPromotion'])->name('promotions.apply');
    Route::delete('/promotions', [AdminController::class, 'resetMassPromotions'])->name('promotions.reset');
    Route::post('/payment-proofs/{paymentProof}/approve', [AdminController::class, 'approvePayment'])->name('payment-proofs.approve');
    Route::post('/payment-proofs/{paymentProof}/reject', [AdminController::class, 'rejectPayment'])->name('payment-proofs.reject');
    Route::post('/orders/{order}/cancel', [AdminController::class, 'cancelOrder'])->name('orders.cancel');
    Route::get('/payment-proofs/{paymentProof}', [AdminController::class, 'downloadPaymentProof'])->name('payment-proofs.download');
    Route::get('/sales-reports/{salesReport}', [AdminController::class, 'downloadSalesReport'])->name('sales-reports.download');
});

Route::prefix('pic')->name('pic.')->middleware(['auth', 'role:pic'])->group(function (): void {
    Route::get('/', [PicController::class, 'index'])->name('dashboard');
    Route::put('/inventory', [PicController::class, 'updateInventory'])->name('inventory.update');
    Route::post('/inventory/upload', [PicController::class, 'uploadInventory'])->name('inventory.upload');
    Route::post('/sales-reports', [PicController::class, 'uploadSalesReport'])->name('sales-reports.store');
    Route::get('/sales-reports/{salesReport}', [PicController::class, 'downloadSalesReport'])->name('sales-reports.download');
});

Route::get('/pimpinan', [PimpinanController::class, 'index'])
    ->middleware(['auth', 'role:pimpinan'])
    ->name('pimpinan.dashboard');
