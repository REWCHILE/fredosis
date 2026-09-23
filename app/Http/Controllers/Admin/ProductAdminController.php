<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductAdminController extends Controller
{
    public function index()
    {
        $products = Product::with('variants')->orderBy('id', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form', ['product' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'main_image' => 'required|url',
            'technique' => 'nullable|string',
            'dimensions' => 'nullable|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'base_price_usd' => 'required|numeric|min:0',
            'base_price_clp' => 'required|numeric|min:0',
            'has_original' => 'nullable|boolean',
            'original_sold' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        $validated['has_original'] = $request->has('has_original');
        $validated['original_sold'] = $request->has('original_sold');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $product = Product::create($validated);

        // Add default standard variants: Original (if checked), Print A3, Print A4
        if ($product->has_original) {
            ProductVariant::create([
                'product_id' => $product->id,
                'format_name' => 'Pieza Original (Única con Certificado)',
                'format_type' => 'ORIGINAL',
                'price_usd' => $product->base_price_usd,
                'price_clp' => $product->base_price_clp,
                'price_eur' => round($product->base_price_usd * 0.92, 2),
                'price_mxn' => round($product->base_price_usd * 19.8, 2),
                'stock' => $product->original_sold ? 0 : 1,
                'is_available' => !$product->original_sold,
            ]);
        }

        // Standard Fine Art Print A3
        ProductVariant::create([
            'product_id' => $product->id,
            'format_name' => 'Fine Art Print A3 (Algodón 310g)',
            'format_type' => 'PRINT',
            'price_usd' => round($product->base_price_usd * 0.15, 2) ?: 45.00,
            'price_clp' => round($product->base_price_clp * 0.15, 2) ?: 42000.00,
            'price_eur' => 41.00,
            'price_mxn' => 890.00,
            'stock' => 25,
            'is_available' => true,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Producto y láminas agregados exitosamente.');
    }

    public function edit($id)
    {
        $product = Product::with('variants')->findOrFail($id);
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'main_image' => 'required|url',
            'technique' => 'nullable|string',
            'dimensions' => 'nullable|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'base_price_usd' => 'required|numeric|min:0',
            'base_price_clp' => 'required|numeric|min:0',
            'has_original' => 'nullable|boolean',
            'original_sold' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['has_original'] = $request->has('has_original');
        $validated['original_sold'] = $request->has('original_sold');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado de la tienda.');
    }
}
