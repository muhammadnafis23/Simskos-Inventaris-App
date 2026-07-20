<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index() {
        return response()->json(Product::with('category')->get());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|unique:products',
            'brand' => 'required',
            'name' => 'required',
            'purchase_price' => 'required|integer',
            'sale_price' => 'required|integer',
            'stock' => 'required|integer',
            'min_stock' => 'required|integer',
        ]);
        return response()->json(Product::create($validated), 201);
    }

    public function show(Product $product) {
        return response()->json($product->load('category'));
    }

    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'brand' => 'sometimes',
            'name' => 'sometimes',
            'purchase_price' => 'sometimes|integer',
            'sale_price' => 'sometimes|integer',
            'stock' => 'sometimes|integer',
            'min_stock' => 'sometimes|integer',
        ]);
        $product->update($validated);
        return response()->json($product);
    }

    public function destroy(Product $product) {
        $product->delete();
        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}