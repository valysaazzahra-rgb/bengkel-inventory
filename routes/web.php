<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController, CategoryController, SupplierController, SparepartController,
    StockInController, StockOutController, ReportController, UserController
};

Route::get('/', fn() => redirect()->route('dashboard'));

Route::middleware(['auth'])->group(function () {

    // dashboard semua role
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('role:admin,staff,owner');

    // master data (admin & staff)
    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('suppliers', SupplierController::class)->except(['show']);
        Route::resource('spareparts', SparepartController::class)->except(['show']);
    });

    // transaksi (admin & staff)
    Route::middleware('role:admin,staff')->group(function () {
        Route::get('stock-ins', [StockInController::class, 'index'])->name('stock-ins.index');
        Route::get('stock-ins/create', [StockInController::class, 'create'])->name('stock-ins.create');
        Route::post('stock-ins', [StockInController::class, 'store'])->name('stock-ins.store');
        Route::get('stock-ins/{stockIn}', [StockInController::class, 'show'])->name('stock-ins.show');

        Route::get('stock-outs', [StockOutController::class, 'index'])->name('stock-outs.index');
        Route::get('stock-outs/create', [StockOutController::class, 'create'])->name('stock-outs.create');
        Route::post('stock-outs', [StockOutController::class, 'store'])->name('stock-outs.store');
        Route::get('stock-outs/{stockOut}', [StockOutController::class, 'show'])->name('stock-outs.show');
    });

    // laporan (admin/staff/owner)
    Route::middleware('role:admin,staff,owner')->group(function () {
        Route::get('reports/low-stock', [ReportController::class, 'lowStock'])->name('reports.low-stock');
        Route::get('reports/transactions', [ReportController::class, 'transactions'])->name('reports.transactions');
        Route::get('reports/recap', [ReportController::class, 'recap'])->name('reports.recap');
    });

    // user management (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });
});

require __DIR__.'/auth.php';