<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|unique:products',
            'brand' => 'required',
            'name' => 'required',
            'purchase_price' => 'required|integer',
            'sale_price' => 'required|integer',
            'stock' => 'required|integer',
            'min_stock' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products','public');
        }

        Product::create($validated);
        return redirect()->route('products.index')->with('success','Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|unique:products,sku,'.$product->id,
            'brand' => 'required',
            'name' => 'required',
            'purchase_price' => 'required|integer',
            'sale_price' => 'required|integer',
            'stock' => 'required|integer',
            'min_stock' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products','public');
        }

        $product->update($validated);
        return redirect()->route('products.index')->with('success','Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Produk berhasil dihapus');
    }
}