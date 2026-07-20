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
        $lowStock = Product::whereColumn('stock', '<=', 'min_stock')->get();
        $recentMovements = StockMovement::with('product')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalProducts','totalStockValue','lowStock','recentMovements'
        ));
    }

    public function exportPdf()
    {
        $products = Product::with('category')->get();
        $pdf = Pdf::loadView('admin.reports.pdf', compact('products'));
        return $pdf->download('laporan-stok.pdf');
    }

    public function exportExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ProductsExport, 'laporan-stok.xlsx');
    }

    public function preview()
    {
    $products = Product::with('category')->get();
    return view('admin.reports.preview', compact('products'));
    }
}