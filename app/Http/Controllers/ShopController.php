<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('is_active', true)
            ->with('variants')
            ->orderBy('is_featured', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.shop', compact('products'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with('variants')
            ->firstOrFail();

        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(3)
            ->get();

        return view('pages.product-detail', compact('product', 'relatedProducts'));
    }

    // --- Cart API Endpoints (Slide-over Cart Drawer) ---

    public function getCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $currency = $request->query('currency', session()->get('currency', 'USD'));

        $items = [];
        $total = 0.0;

        foreach ($cart as $key => $item) {
            $variant = ProductVariant::with('product')->find($item['variant_id']);
            if (! $variant) {
                unset($cart[$key]);

                continue;
            }

            $price = $variant->getPriceForCurrency($currency);
            $subtotal = $price * $item['quantity'];
            $total += $subtotal;

            $items[] = [
                'cart_key' => $key,
                'variant_id' => $variant->id,
                'product_id' => $variant->product_id,
                'title' => $variant->product->title,
                'format_name' => $variant->format_name,
                'format_type' => $variant->format_type,
                'image' => $variant->product->main_image,
                'price' => $price,
                'price_formatted' => CurrencyService::format($price, $currency),
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal,
                'subtotal_formatted' => CurrencyService::format($subtotal, $currency),
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'items' => $items,
            'count' => array_sum(array_column($items, 'quantity')),
            'total' => $total,
            'currency' => $currency,
            'total_formatted' => CurrencyService::format($total, $currency),
        ]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $variant = ProductVariant::with('product')->findOrFail($request->variant_id);
        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);
        $key = 'v_'.$variant->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $cart[$key] = [
                'variant_id' => $variant->id,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return $this->getCart($request);
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'cart_key' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = session()->get('cart', []);
        $key = $request->cart_key;

        if ($request->quantity <= 0) {
            unset($cart[$key]);
        } elseif (isset($cart[$key])) {
            $cart[$key]['quantity'] = (int) $request->quantity;
        }

        session()->put('cart', $cart);

        return $this->getCart($request);
    }

    public function removeFromCart(Request $request)
    {
        $request->validate(['cart_key' => 'required|string']);
        $cart = session()->get('cart', []);
        unset($cart[$request->cart_key]);
        session()->put('cart', $cart);

        return $this->getCart($request);
    }

    public function clearCart(Request $request)
    {
        session()->forget('cart');

        return $this->getCart($request);
    }
}
