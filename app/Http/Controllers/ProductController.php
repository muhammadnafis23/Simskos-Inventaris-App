<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
    $query = Product::with(['category', 'brand']);

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('sku', 'like', "%{$search}%")
              ->orWhereHas('brand', function ($b) use ($search) {
                  $b->where('name', 'like', "%{$search}%");
              })
              ->orWhereHas('category', function ($c) use ($search) {
                  $c->where('name', 'like', "%{$search}%");
              });

            if (is_numeric($search)) {
                $q->orWhere('stock', $search)
                  ->orWhere('selling_price', 'like', "%{$search}%");
            }
        });
    }

    // --- PASTIKAN BLOK INI ADA AGAR PREVIEW DROPDOWN MUNCUL ---
    if ($request->ajax()) {
        $previewData = $query->latest()->take(5)->get()->map(function($product) {
            return [
                'name'     => $product->name,
                'sku'      => $product->sku,
                'brand'    => $product->brand ? $product->brand->name : '-',
                'category' => $product->category ? $product->category->name : '-',
                'price'    => number_format($product->selling_price, 0, ',', '.'),
                'stock'    => $product->stock
            ];
        });
        return response()->json($previewData);
    }
    // ------------------------------------------------------------

    $products = $query->latest()->paginate(15)->withQueryString();

    return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'brand_id'       => 'required|exists:brands,id',
            'sku'            => 'required|unique:products',
            'name'           => 'required|string|max:255',
            'purchase_price' => 'required|integer|min:0',
            'sale_price'     => 'required|integer|min:0',
            'stock'          => 'required|integer|min:0',
            'min_stock'      => 'required|integer|min:0',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        // Sertakan 'brands' ke dalam compact
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'brand_id'       => 'required|exists:brands,id',
            'sku'            => 'required|unique:products,sku,' . $product->id,
            'name'           => 'required|string|max:255',
            'purchase_price' => 'required|integer|min:0',
            'sale_price'     => 'required|integer|min:0',
            'stock'          => 'required|integer|min:0',
            'min_stock'      => 'required|integer|min:0',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}