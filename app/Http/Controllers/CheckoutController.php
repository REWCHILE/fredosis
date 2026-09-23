<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop')->with('info', 'Tu carrito está vacío.');
        }

        $currency = session()->get('currency', 'USD');
        $paypalClientId = SiteSetting::get('paypal_client_id', 'sb');
        $paypalMode = SiteSetting::get('paypal_mode', 'sandbox');

        return view('pages.checkout', compact('currency', 'paypalClientId', 'paypalMode'));
    }

    public function createPayPalOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|min:2',
            'customer_email' => 'required|email',
            'customer_phone' => 'nullable|string',
            'shipping_address' => 'required|string|min:5',
            'shipping_city' => 'required|string',
            'shipping_country' => 'required|string',
            'currency' => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['error' => 'El carrito está vacío.'], 400);
        }

        $currency = strtoupper($validated['currency'] ?? session()->get('currency', 'USD'));
        // PayPal standard allows USD, EUR, etc. If CLP, convert or handle via USD for standard PayPal checkout
        $paypalCurrency = in_array($currency, ['USD', 'EUR']) ? $currency : 'USD';

        $total = 0.0;
        $itemsData = [];

        foreach ($cart as $item) {
            $variant = ProductVariant::with('product')->find($item['variant_id']);
            if (! $variant) {
                continue;
            }

            $price = $variant->getPriceForCurrency($paypalCurrency);
            $subtotal = $price * $item['quantity'];
            $total += $subtotal;

            $itemsData[] = [
                'variant' => $variant,
                'price' => $price,
                'quantity' => $item['quantity'],
            ];
        }

        if ($total <= 0) {
            return response()->json(['error' => 'Monto inválido.'], 400);
        }

        // Create Order Record in DB
        $orderNumber = 'FRD-'.strtoupper(Str::random(6)).'-'.rand(100, 999);

        $order = DB::transaction(function () use ($validated, $orderNumber, $paypalCurrency, $total, $itemsData) {
            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'] ?? null,
                'shipping_address' => $validated['shipping_address'],
                'shipping_city' => $validated['shipping_city'],
                'shipping_country' => $validated['shipping_country'],
                'currency' => $paypalCurrency,
                'total_amount' => $total,
                'payment_gateway' => 'PAYPAL',
                'payment_status' => 'PENDING',
            ]);

            foreach ($itemsData as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['variant']->product_id,
                    'variant_id' => $item['variant']->id,
                    'product_title' => $item['variant']->product->title,
                    'variant_name' => $item['variant']->format_name,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            return $order;
        });

        // Store order ID in session
        session()->put('pending_order_id', $order->id);

        return response()->json([
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'total' => number_format($total, 2, '.', ''),
            'currency' => $paypalCurrency,
        ]);
    }

    public function capturePayPalOrder(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'paypal_order_id' => 'required|string',
            'paypal_payer_id' => 'nullable|string',
        ]);

        $order = Order::findOrFail($validated['order_id']);

        $order->update([
            'payment_status' => 'PAID',
            'paypal_order_id' => $validated['paypal_order_id'],
            'paypal_payer_id' => $validated['paypal_payer_id'] ?? null,
        ]);

        // If any original art piece was purchased, mark as sold
        foreach ($order->items as $item) {
            if ($item->variant && $item->variant->format_type === 'ORIGINAL') {
                $item->product->update(['original_sold' => true]);
                $item->variant->update(['stock' => 0, 'is_available' => false]);
            }
        }

        // Clear cart
        session()->forget('cart');
        session()->forget('pending_order_id');

        return response()->json([
            'success' => true,
            'redirect_url' => route('checkout.success', ['order_number' => $order->order_number]),
        ]);
    }

    public function success(string $order_number)
    {
        $order = Order::where('order_number', $order_number)
            ->with('items.product')
            ->firstOrFail();

        return view('pages.checkout-success', compact('order'));
    }
}
