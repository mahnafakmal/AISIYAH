<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OrderController::class, 'home'])->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegistration'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:customer'])->group(function (): void {
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/payment-proof', [OrderController::class, 'uploadPaymentProof'])->name('orders.proof.store');
});

Route::get('/payment-proofs/{paymentProof}', [OrderController::class, 'showPaymentProof'])
    ->middleware(['auth', 'role:admin|pimpinan|customer'])
    ->name('payment-proofs.show');

Route::get('/dashboard', function () {
    $user = request()->user();

    return match ($user->role) {
        'admin', 'pimpinan' => redirect()->route('admin.dashboard'),
        'pic' => redirect()->route('pic.dashboard'),
        default => redirect()->route('home'),
    };
})->middleware('auth')->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin|pimpinan'])->group(function (): void {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/sales-reports/{salesReport}', [AdminController::class, 'downloadSalesReport'])->name('reports.download');

    Route::middleware('role:admin')->group(function (): void {
        Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
        Route::delete('/products/{product}', [AdminController::class, 'deactivateProduct'])->name('products.destroy');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::post('/welcome', [AdminController::class, 'updateWelcome'])->name('welcome.update');
        Route::post('/orders/{order}/approve', [AdminController::class, 'approvePayment'])->name('orders.approve');
        Route::post('/orders/{order}/reject', [AdminController::class, 'rejectPayment'])->name('orders.reject');
    });
});

Route::prefix('pic')->name('pic.')->middleware(['auth', 'role:pic'])->group(function (): void {
    Route::get('/', [PicController::class, 'dashboard'])->name('dashboard');
    Route::put('/inventory', [PicController::class, 'updateInventory'])->name('inventory.update');
    Route::post('/sales-reports', [PicController::class, 'uploadSalesReport'])->name('reports.store');
    Route::get('/sales-reports/{salesReport}', [PicController::class, 'downloadSalesReport'])->name('reports.download');
});
