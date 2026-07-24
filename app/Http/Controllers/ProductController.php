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
                      ->orWhere('selling_price', 'like', "%{$search}%"); // SESUAIKAN: selling_price
                }
            });
        }

        if ($request->ajax()) {
            $previewData = $query->latest()->take(5)->get()->map(function($product) {
                return [
                    'name'     => $product->name,
                    'sku'      => $product->sku,
                    'brand'    => $product->brand ? $product->brand->name : '-',
                    'category' => $product->category ? $product->category->name : '-',
                    'price'    => number_format($product->selling_price, 0, ',', '.'), // SESUAIKAN: selling_price
                    'stock'    => $product->stock
                ];
            });
            return response()->json($previewData);
        }

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
        // 1. Validasi input dari form
        $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'brand_id'       => 'required|exists:brands,id',
            'name'           => 'required|string|max:255',
            'purchase_price' => 'required|integer|min:0',
            'sale_price'     => 'required|integer|min:0', // Nama field di form Blade
            'stock'          => 'required|integer|min:0',
            'min_stock'      => 'required|integer|min:0',
        ]);

        // 2. Generate SKU Otomatis
        $lastProduct = Product::orderBy('id', 'desc')->first();
        $sku = $lastProduct ? 'SKU-' . ($lastProduct->id + 1) : 'SKU-101';

        // 3. Simpan ke Database (Mapping 'sale_price' dari form ke 'selling_price' di DB)
        Product::create([
            'category_id'    => $request->category_id,
            'brand_id'       => $request->brand_id,
            'name'           => $request->name,
            'purchase_price' => $request->purchase_price,
            'selling_price'  => $request->sale_price, // MAPPING KE SELLING_PRICE
            'stock'          => $request->stock,
            'min_stock'      => $request->min_stock,
            'sku'            => $sku,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan dengan ' . $sku);
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        // 1. Validasi input
        $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'brand_id'       => 'required|exists:brands,id',
            'sku'            => 'required|unique:products,sku,' . $product->id,
            'name'           => 'required|string|max:255',
            'purchase_price' => 'required|integer|min:0',
            'sale_price'     => 'required|integer|min:0',
            'stock'          => 'required|integer|min:0',
            'min_stock'      => 'required|integer|min:0',
        ]);

        // 2. Update data ke database
        $product->update([
            'category_id'    => $request->category_id,
            'brand_id'       => $request->brand_id,
            'sku'            => $request->sku,
            'name'           => $request->name,
            'purchase_price' => $request->purchase_price,
            'selling_price'  => $request->sale_price, // MAPPING KE SELLING_PRICE
            'stock'          => $request->stock,
            'min_stock'      => $request->min_stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}