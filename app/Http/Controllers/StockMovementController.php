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
        $products = Product::all();
        return view('staff.stock-movements.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'qty' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            StockMovement::create([
                ...$validated,
                'user_id' => auth()->id(),
            ]);

            $product = Product::find($validated['product_id']);

            if ($validated['type'] === 'in') {
                $product->increment('stock', $validated['qty']);
            } else {
                if ($product->stock < $validated['qty']) {
                    abort(422, 'Stok tidak mencukupi untuk dikurangi.');
                }
                $product->decrement('stock', $validated['qty']);
            }
        });

        return redirect()->route('stock.create')->with('success','Stok berhasil diperbarui');
    }

    public function index()
    {
        $movements = StockMovement::with(['product','user'])->latest()->paginate(15);
        return view('staff.stock-movements.index', compact('movements'));
    }
}