<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalStockValue = Product::sum(DB::raw('stock * purchase_price'));

        $lowStock = Product::with('brand')
        ->whereColumn('stock', '<=', 'min_stock')
        ->get();
        $recentMovements = StockMovement::with('product')
        ->latest()
        ->take(10)
        ->get();

        return view('admin.dashboard', compact(
            'totalProducts', 'totalStockValue', 'lowStock', 'recentMovements'
        ));
    }

    public function preview()
    {
        // Load relasi category dan brand
        $products = Product::with(['category', 'brand'])->get();

        // Hitung Finansial Laporan
        $totalProducts = $products->count();
        $totalAssetModal = $products->sum(fn($p) => $p->stock * $p->purchase_price);
        $totalAssetJual = $products->sum(fn($p) => $p->stock * $p->sale_price);
        $totalEstimasiProfit = $totalAssetJual - $totalAssetModal;

        return view('admin.reports.preview', compact(
            'products',
            'totalProducts',
            'totalAssetModal',
            'totalAssetJual',
            'totalEstimasiProfit'
        ));
    }

    public function exportPdf()
    {
        $products = Product::with(['category', 'brand'])->get();
        $totalAssetModal = $products->sum(fn($p) => $p->stock * $p->purchase_price);

        $pdf = Pdf::loadView('admin.reports.pdf', compact('products', 'totalAssetModal'));
        return $pdf->download('laporan-stok.pdf');
    }

    public function exportExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ProductsExport, 'laporan-stok.xlsx');
    }
}