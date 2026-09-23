@extends('layouts.app')

@section('title', 'Tienda de Dibujos & Láminas — FREDOSIS | Fine Art Prints & Originales')
@section('meta_description', 'Compra dibujos originales a grafito y láminas giclée de autor de Fredosis. Envíos protegidos a todo el mundo. Pagos seguros con PayPal.')

@section('content')

    <section class="py-20 px-6 md:px-16 max-w-7xl mx-auto space-y-12">
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-semibold">Catálogo E-Commerce</span>
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#f5f5f3]">Dibujos & Láminas Fine Art</h1>
            <p class="text-xs md:text-sm text-[#8e8e93]">
                Piezas únicas originales a grafito y láminas de edición limitada impresas sobre papel 100% algodón Hahnemühle Photo Rag 308g.
            </p>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#18181b] border border-[#2c2c30] text-xs text-[#d8c49d]">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                <span>Pagos directos y protegidos con <strong>PayPal</strong> en USD, CLP, EUR y MXN</span>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)
                <div class="bg-[#121214] border border-[#232326] rounded-xl overflow-hidden flex flex-col justify-between group hover:border-[#d8c49d]/40 transition-all">
                    <div>
                        <!-- Product Main Image -->
                        <div class="aspect-[4/5] overflow-hidden bg-black relative">
                            <a href="{{ route('shop.detail', $product->slug) }}">
                                <img 
                                    src="{{ $product->main_image }}" 
                                    alt="{{ $product->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                >
                            </a>
                            <!-- Badge -->
                            @if($product->has_original && !$product->original_sold)
                                <span class="absolute top-4 left-4 px-2.5 py-1 rounded bg-[#d8c49d] text-black text-[10px] font-bold uppercase tracking-widest shadow-md">
                                    Pieza Original Disponible
                                </span>
                            @elseif($product->original_sold)
                                <span class="absolute top-4 left-4 px-2.5 py-1 rounded bg-black/85 text-[#8e8e93] text-[10px] font-bold uppercase tracking-widest border border-[#333]">
                                    Original Vendido
                                </span>
                            @endif
                        </div>

                        <!-- Details & Variants Selector -->
                        <div class="p-6 space-y-4" x-data="{ selectedVariant: {{ $product->variants->first()->id ?? 0 }} }">
                            <div>
                                <span class="text-[10px] uppercase tracking-widest text-[#d8c49d] font-bold">{{ $product->technique }}</span>
                                <h3 class="font-serif text-xl font-bold text-[#ededeb] mt-1 group-hover:text-[#d8c49d] transition-colors">
                                    <a href="{{ route('shop.detail', $product->slug) }}">{{ $product->title }}</a>
                                </h3>
                                <p class="text-xs text-[#8e8e93] mt-2 line-clamp-2 leading-relaxed">{{ $product->description }}</p>
                            </div>

                            <!-- Format Variants Radio / Select -->
                            <div class="space-y-1.5 border-t border-[#232326] pt-3">
                                <label class="text-[11px] uppercase tracking-wider text-[#777] font-semibold block">Seleccionar Formato:</label>
                                <select 
                                    x-model="selectedVariant"
                                    class="w-full bg-[#18181b] border border-[#2c2c30] rounded-lg px-3 py-2 text-xs text-white focus:outline-none focus:border-[#d8c49d]"
                                >
                                    @foreach($product->variants as $variant)
                                        <option value="{{ $variant->id }}">
                                            {{ $variant->format_name }} — ${{ number_format($variant->price_usd, 0) }} USD (${{ number_format($variant->price_clp, 0, ',', '.') }} CLP)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Add to Cart Action Button -->
                            <div class="pt-2 flex items-center gap-3">
                                <button 
                                    type="button"
                                    @click="addToCart(selectedVariant)"
                                    class="flex-1 flex items-center justify-center gap-2 py-3 px-4 rounded-lg bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-wider transition-all shadow-md"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                                    <span>Añadir al Carrito</span>
                                </button>
                                <a 
                                    href="{{ route('shop.detail', $product->slug) }}" 
                                    class="p-3 rounded-lg border border-[#2c2c30] text-[#8e8e93] hover:text-white hover:border-white transition-all"
                                    title="Ver ficha técnica"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
