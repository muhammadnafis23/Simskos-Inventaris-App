<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockMovementController extends Controller
{
    public function create()
    {
        // Memuat relasi brand agar logo & nama brand terbaca di kartu kanan
        $products = Product::with('brand')->get();
        $recentMovements = StockMovement::with('product')->latest()->take(5)->get();
        
        return view('admin.stock_movements.create', compact('products', 'recentMovements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type'       => 'required|in:in,out',
            'qty'        => 'required|integer|min:1',
            'note'       => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $product = Product::findOrFail($validated['product_id']);

                if ($validated['type'] === 'out' && $product->stock < $validated['qty']) {
                    throw new \Exception('Stok tidak mencukupi untuk dikurangi.');
                }

                StockMovement::create([
                    'product_id' => $validated['product_id'],
                    'type'       => $validated['type'],
                    'qty'        => $validated['qty'],
                    'note'       => $validated['note'] ?? null,
                    'user_id'    => auth()->id(),
                ]);

                if ($validated['type'] === 'in') {
                    $product->increment('stock', $validated['qty']);
                } else {
                    $product->decrement('stock', $validated['qty']);
                }
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->route('stock.create')->with('success', 'Stok berhasil diperbarui.');
    }

    public function index()
    {
        $movements = StockMovement::with(['product', 'user'])->latest()->paginate(15);
        return view('admin.stock_movements.index', compact('movements'));
    }
}