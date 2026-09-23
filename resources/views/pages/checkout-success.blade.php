@extends('layouts.app')

@section('title', '¡Pago Exitoso con PayPal! — FREDOSIS')

@section('content')
<section class="py-24 px-6 max-w-xl mx-auto text-center space-y-8">
    <div class="w-20 h-20 rounded-full bg-emerald-500/10 border-2 border-emerald-500 mx-auto flex items-center justify-center text-emerald-400 shadow-xl">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
    </div>

    <div class="space-y-3">
        <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">Pago Procesado con PayPal</span>
        <h1 class="text-3xl md:text-5xl font-serif font-bold text-[#f5f5f3]">¡Gracias por tu Compra!</h1>
        <p class="text-sm text-[#8e8e93] leading-relaxed">
            Tu orden ha sido confirmada y recibida por Fredosis. Prepararemos tu envío con embalaje de museo.
        </p>
    </div>

    <!-- Order Summary Card -->
    <div class="p-6 rounded-2xl bg-[#141416] border border-[#232326] text-left space-y-4 text-xs">
        <div class="flex justify-between border-b border-[#232326] pb-2.5">
            <span class="text-[#8e8e93]">N° de Orden:</span>
            <span class="font-bold text-[#d8c49d]">{{ $order->order_number }}</span>
        </div>
        <div class="flex justify-between border-b border-[#232326] pb-2.5">
            <span class="text-[#8e8e93]">Estado del Pago:</span>
            <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 font-bold border border-emerald-500/20">PAGADO (PayPal)</span>
        </div>
        <div class="flex justify-between border-b border-[#232326] pb-2.5">
            <span class="text-[#8e8e93]">Destinatario:</span>
            <span class="font-bold text-white">{{ $order->customer_name }}</span>
        </div>
        <div class="flex justify-between border-b border-[#232326] pb-2.5">
            <span class="text-[#8e8e93]">Dirección de Envío:</span>
            <span class="text-white text-right">{{ $order->shipping_address }}, {{ $order->shipping_city }}</span>
        </div>

        <div class="pt-2">
            <span class="text-[#8e8e93] block mb-2 font-semibold uppercase tracking-wider text-[10px]">Obras en tu Pedido:</span>
            <div class="space-y-2">
                @foreach($order->items as $item)
                    <div class="flex justify-between text-white">
                        <span>{{ $item->product_title }} ({{ $item->variant_name }}) x{{ $item->quantity }}</span>
                        <span class="font-bold text-[#d8c49d]">${{ number_format($item->price, 2) }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-between text-sm font-bold pt-3 border-t border-[#232326] text-[#d8c49d]">
            <span>Total Pagado:</span>
            <span>${{ number_format($order->total_amount, 2) }} {{ $order->currency }}</span>
        </div>
    </div>

    <div class="pt-4">
        <a 
            href="{{ route('home') }}" 
            class="px-8 py-3.5 rounded-full bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-widest transition-all shadow-xl inline-block"
        >
            Volver a la Galería
        </a>
    </div>
</section>
@endsection
