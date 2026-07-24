<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth','verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Redirect setelah login sesuai role
    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('stock.create');
    })->name('dashboard');

    // KHUSUS ADMIN (Full CRUD + User Management)
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('users', UserController::class); // <-- Fitur Kelola Akun Karyawan
        
        Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');
        Route::get('/reports', [DashboardController::class,'preview'])->name('reports.preview');
        Route::get('/reports/export-pdf', [DashboardController::class,'exportPdf'])->name('reports.pdf');
        Route::get('/reports/export-excel', [DashboardController::class,'exportExcel'])->name('reports.excel');
    });

    // ADMIN & STAFF/USER (Bisa Akses Katalog Read-Only + Transaksi Stok)
    Route::middleware('role:admin,staff,user')->group(function () {
        // Karyawan hanya bisa melihat daftar katalog (Read-Only)
        Route::get('/catalog/products', [ProductController::class, 'index'])->name('products.public_index');
        Route::get('/catalog/categories', [CategoryController::class, 'index'])->name('categories.public_index');
        Route::get('/catalog/brands', [BrandController::class, 'index'])->name('brands.public_index');

        // Transaksi Stok
        Route::get('/stock-movements/create', [StockMovementController::class,'create'])->name('stock.create');
        Route::post('/stock-movements', [StockMovementController::class,'store'])->name('stock.store');
        Route::get('/stock-movements', [StockMovementController::class,'index'])->name('stock.index');
    });

});

require __DIR__.'/auth.php';