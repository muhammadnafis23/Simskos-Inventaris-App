<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockMovementController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth','verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/reports', [DashboardController::class,'preview'])->name('reports.preview');
    Route::get('/reports/export-pdf', [DashboardController::class,'exportPdf'])->name('reports.pdf');
    Route::get('/reports/export-excel', [DashboardController::class,'exportExcel'])->name('reports.excel');

    // Redirect setelah login sesuai role
    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('stock.create');
    })->name('dashboard');

    // Khusus admin
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');
        Route::get('/reports/export-pdf', [DashboardController::class,'exportPdf'])->name('reports.pdf');
        Route::get('/reports/export-excel', [DashboardController::class,'exportExcel'])->name('reports.excel');
    });

    // Admin & staff sama-sama boleh akses
    Route::middleware('role:admin,staff')->group(function () {
        Route::get('/stock-movements/create', [StockMovementController::class,'create'])->name('stock.create');
        Route::post('/stock-movements', [StockMovementController::class,'store'])->name('stock.store');
        Route::get('/stock-movements', [StockMovementController::class,'index'])->name('stock.index');
    });

});

require __DIR__.'/auth.php';