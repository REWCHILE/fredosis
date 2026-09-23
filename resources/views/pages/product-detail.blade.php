@extends('layouts.app')

@section('title', $product->title . ' — FREDOSIS | Dibujo & Fine Art Print')
@section('meta_description', $product->short_description)

@section('content')

    <section class="py-16 md:py-24 px-6 md:px-16 max-w-7xl mx-auto space-y-16">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-[#8e8e93]">
            <a href="{{ route('home') }}" class="hover:text-[#d8c49d]">Inicio</a>
            <span>/</span>
            <a href="{{ route('shop') }}" class="hover:text-[#d8c49d]">Tienda</a>
            <span>/</span>
            <span class="text-[#f5f5f3] font-semibold">{{ $product->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start" x-data="{ 
            selectedVariantId: {{ $product->variants->first()->id ?? 0 }},
            currentImage: '{{ $product->main_image }}',
            selectedVariantObj: @js($product->variants->first())
        }">
            <!-- Left: Artwork Gallery Images -->
            <div class="lg:col-span-7 space-y-4">
                <div class="aspect-[4/5] bg-black border border-[#232326] rounded-2xl overflow-hidden relative shadow-2xl">
                    <img :src="currentImage" :alt="'{{ $product->title }}'" class="w-full h-full object-contain cursor-zoom-in" @click="openLightbox({
                        title: '{{ addslashes($product->title) }}',
                        image_url: currentImage,
                        category: '{{ $product->category }}',
                        medium: '{{ addslashes($product->technique) }}',
                        dimensions: '{{ addslashes($product->dimensions) }}',
                        year: '2026',
                        description: '{{ addslashes($product->description) }}'
                    })">
                </div>

                <!-- Thumbnails Gallery -->
                @if($product->gallery_images && count($product->gallery_images) > 1)
                    <div class="flex gap-3 overflow-x-auto pb-2">
                        @foreach($product->gallery_images as $img)
                            <button 
                                type="button"
                                @click="currentImage = '{{ $img }}'"
                                :class="currentImage === '{{ $img }}' ? 'border-[#d8c49d]' : 'border-[#26262a]'"
                                class="w-20 h-24 rounded-lg overflow-hidden border-2 bg-black shrink-0 transition-all"
                            >
                                <img src="{{ $img }}" alt="Detalle" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right: Technical Data, Format Selection & PayPal Checkout -->
            <div class="lg:col-span-5 space-y-8 bg-[#121214] border border-[#232326] rounded-2xl p-8 shadow-2xl">
                <div>
                    <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">{{ $product->technique }}</span>
                    <h1 class="text-2xl md:text-4xl font-serif font-bold text-[#f5f5f3] mt-1">{{ $product->title }}</h1>
                    @if($product->dimensions)
                        <p class="text-xs text-[#8e8e93] mt-1">Dimensiones originales: {{ $product->dimensions }}</p>
                    @endif
                </div>

                <div class="border-t border-b border-[#232326] py-4 space-y-1">
                    <span class="text-xs text-[#8e8e93]">Precio según formato seleccionado</span>
                    <div class="text-3xl font-serif font-bold text-[#d8c49d]" x-text="'$' + selectedVariantObj.price_usd + ' USD / $' + parseInt(selectedVariantObj.price_clp).toLocaleString('es-CL') + ' CLP'">
                        ${{ number_format($product->base_price_usd, 0) }} USD
                    </div>
                </div>

                <!-- Description -->
                <p class="text-xs text-[#a6a6aa] leading-relaxed">
                    {{ $product->description }}
                </p>

                <!-- Format Selection Dropdown / Cards -->
                <div class="space-y-3">
                    <label class="text-xs uppercase tracking-widest text-[#777] font-semibold block">Elige el formato de adquisición:</label>
                    <div class="space-y-2">
                        @foreach($product->variants as $variant)
                            <label 
                                @click="selectedVariantId = {{ $variant->id }}; selectedVariantObj = @js($variant)"
                                :class="selectedVariantId === {{ $variant->id }} ? 'border-[#d8c49d] bg-[#18181b]' : 'border-[#26262a] bg-[#141416] hover:border-[#333]'"
                                class="flex items-center justify-between p-3.5 rounded-xl border cursor-pointer transition-all"
                            >
                                <div class="flex items-center gap-3">
                                    <input 
                                        type="radio" 
                                        name="variant_radio" 
                                        value="{{ $variant->id }}" 
                                        :checked="selectedVariantId === {{ $variant->id }}"
                                        class="text-[#d8c49d] focus:ring-[#d8c49d]"
                                    >
                                    <div>
                                        <p class="text-xs font-semibold text-white">{{ $variant->format_name }}</p>
                                        <p class="text-[11px] text-[#777]">
                                            @if($variant->format_type === 'ORIGINAL')
                                                Pieza única de autor • Certificado de autenticidad incluido
                                            @else
                                                Impresión giclée en papel de algodón 308g
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-[#d8c49d]">
                                    ${{ number_format($variant->price_usd, 0) }} USD
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Add to Cart & Checkout CTAs -->
                <div class="space-y-3 pt-2">
                    <button 
                        type="button"
                        @click="addToCart(selectedVariantId, 1, '{{ addslashes($product->title) }}')"
                        class="w-full flex items-center justify-center gap-2 py-4 px-6 rounded-xl bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-widest transition-all shadow-xl hover:scale-[1.01] cursor-pointer"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                        <span>Añadir al Carrito</span>
                    </button>
                    <a 
                        href="{{ route('checkout') }}"
                        @click="addToCart(selectedVariantId, 1, '{{ addslashes($product->title) }}')"
                        class="w-full flex items-center justify-center gap-2 py-3.5 px-6 rounded-xl border border-[#333] hover:border-[#d8c49d] text-white hover:text-[#d8c49d] font-semibold text-xs uppercase tracking-wider transition-all cursor-pointer"
                    >
                        Comprar Directamente con PayPal
                    </a>
                </div>

                <!-- Conservation & Shipping Info -->
                <div class="pt-4 border-t border-[#232326] space-y-2 text-[11px] text-[#777]">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <span>Embalaje de museo en tubo rígido impermeable de alta resistencia.</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                        <span>Firma manuscrita y numeración por Fredosis.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
