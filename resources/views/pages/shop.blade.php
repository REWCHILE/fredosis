@extends('layouts.app')

@section('title', 'Tienda — Original Drawings for Sale — © FREDO | FREDOSIS')
@section('meta_description', 'Original drawings and fine art prints by Chilean artist Wladimir Inostroza (Fredo / Fredosis). Worldwide shipping in rigid protective box. PayPal & Webpay accepted.')

@section('content')

    <section class="py-16 md:py-24 px-6 md:px-16 max-w-7xl mx-auto space-y-12">
        <!-- Header Inspired by Fredo's Sketch -->
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#18181b] border border-[#d8c49d]/30 text-xs text-[#d8c49d] font-mono tracking-wider">
                <span>SHOP / ORIGINAL DRAWINGS</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#f5f5f3] tracking-tight">
                Original Drawings for Sale
            </h1>
            <p class="text-xs md:text-sm text-[#8e8e93] leading-relaxed max-w-2xl mx-auto">
                Piezas originales únicas a grafito, pastel suave y óleos de autor creadas por <strong class="text-white">Wladimir Inostroza (© FREDO)</strong>. Cada obra original se entrega con certificado de autenticidad y embalaje rígido de alta protección.
            </p>
            
            <!-- Chilean Purchase Notice from Info drawing for sale.docx -->
            <div class="p-4 rounded-xl bg-[#141416] border border-[#2c2c30] text-xs text-left md:text-center text-[#a6a6aa] space-y-2">
                <p class="text-white font-medium">
                    🇨🇱 <strong class="text-[#d8c49d]">Para compras Nacionales (Chile):</strong> Puedes realizar pago directo en pesos chilenos (CLP) vía Webpay o coordinar por email a 
                    <a href="mailto:fredocontacto@gmail.com" class="text-[#d8c49d] underline font-mono">fredocontacto@gmail.com</a>.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4 text-[11px] text-[#777] pt-1">
                    <span class="inline-flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                        PayPal (USD / Global) & Webpay (CLP)
                    </span>
                    <span>•</span>
                    <button type="button" @click="document.getElementById('shipping-policy-modal').showModal()" class="text-[#d8c49d] hover:underline cursor-pointer">
                        Ver Políticas de Envío y Embalaje
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Grid Matching Boceto Pagina -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)
                @php
                    $originalVariant = $product->variants->firstWhere('format_type', 'ORIGINAL') ?? $product->variants->first();
                    $printVariant = $product->variants->firstWhere('format_type', 'PRINT');
                @endphp
                <div 
                    class="bg-[#121214] border border-[#232326] rounded-2xl overflow-hidden flex flex-col justify-between group hover:border-[#d8c49d]/50 transition-all shadow-xl"
                    x-data="{ 
                        selectedVariantId: {{ $originalVariant->id ?? 0 }},
                        variants: [
                            @foreach($product->variants as $v)
                                {
                                    id: {{ $v->id }},
                                    name: '{{ addslashes($v->format_name) }}',
                                    usd: {{ (float) $v->price_usd }},
                                    clp: {{ (float) $v->price_clp }},
                                    eur: {{ (float) $v->price_eur }},
                                    mxn: {{ (float) $v->price_mxn }}
                                },
                            @endforeach
                        ],
                        selectedVariant() {
                            return this.variants.find(v => v.id == this.selectedVariantId) || this.variants[0];
                        },
                        formatCurrentPrice() {
                            const v = this.selectedVariant();
                            if (!v) return '$0 USD';
                            const curr = activeCurrency || 'USD';
                            if (curr === 'CLP') return '$' + Math.round(v.clp).toLocaleString('es-CL') + ' CLP';
                            if (curr === 'EUR') return '€' + Number(v.eur).toFixed(2) + ' EUR';
                            if (curr === 'MXN') return '$' + Number(v.mxn).toFixed(2) + ' MXN';
                            return '$' + Number(v.usd).toFixed(0) + ' USD';
                        },
                        formatSecondaryPrice() {
                            const v = this.selectedVariant();
                            if (!v) return '';
                            const curr = activeCurrency || 'USD';
                            if (curr === 'USD') return '≈ $' + Math.round(v.clp).toLocaleString('es-CL') + ' CLP';
                            if (curr === 'CLP') return '≈ $' + Number(v.usd).toFixed(0) + ' USD';
                            return '≈ $' + Number(v.usd).toFixed(0) + ' USD';
                        }
                    }"
                >
                    <div>
                        <!-- Artwork Thumbnail -->
                        <div class="aspect-[4/5] overflow-hidden bg-black relative">
                            <a href="{{ route('shop.detail', $product->slug) }}">
                                <img 
                                    src="{{ $product->main_image }}" 
                                    alt="{{ $product->title }} - © FREDO" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 cursor-pointer"
                                    loading="lazy"
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

                            <button 
                                type="button"
                                @click="openLightbox({
                                    title: '{{ addslashes($product->title) }}',
                                    image_url: '{{ $product->main_image }}',
                                    category: '{{ $product->category }}',
                                    medium: '{{ addslashes($product->technique) }}',
                                    dimensions: '{{ addslashes($product->dimensions) }}',
                                    year: '{{ $product->created_at->year ?? '2022' }}',
                                    description: '{{ addslashes($product->description) }}'
                                })"
                                class="absolute bottom-3 right-3 p-2 rounded-lg bg-black/70 text-white/80 hover:text-white hover:bg-black transition-all"
                                title="Ampliar imagen"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 3 21 3 21 9"/><polyline points="9 21 3 21 3 15"/><line x1="21" y1="3" x2="14" y2="10"/><line x1="3" y1="21" x2="10" y2="14"/></svg>
                            </button>
                        </div>

                        <!-- Info Block Corresponding to the Sketch -->
                        <div class="p-6 space-y-4">
                            <!-- Technical Typography Block -->
                            <div class="space-y-1">
                                <h3 class="font-serif text-2xl font-bold tracking-wide text-[#ededeb] group-hover:text-[#d8c49d] transition-colors uppercase">
                                    <a href="{{ route('shop.detail', $product->slug) }}">{{ $product->title }}</a>
                                </h3>
                                @if($product->dimensions)
                                    <p class="text-xs font-mono text-[#a6a6aa]">{{ $product->dimensions }}</p>
                                @endif
                                <p class="text-xs uppercase tracking-wider text-[#d8c49d] font-semibold">
                                    {{ $product->technique }}
                                </p>
                                @php
                                    preg_match('/\b(19\d\d|20\d\d)\b/', ($product->short_description ?? '') . ' ' . $product->slug, $ym);
                                    $artworkYear = $ym[0] ?? '';
                                @endphp
                                @if($artworkYear)
                                    <p class="text-[11px] font-mono text-[#777]">
                                        {{ $artworkYear }}
                                    </p>
                                @endif
                                <p class="text-[11px] tracking-widest text-[#888] font-bold">
                                    © FREDO
                                </p>
                            </div>

                            <!-- Format Selector -->
                            <div class="space-y-1.5 border-t border-[#232326] pt-3">
                                <label class="text-[11px] uppercase tracking-wider text-[#777] font-semibold block">Formato de Adquisición:</label>
                                <select 
                                    x-model="selectedVariantId"
                                    class="w-full bg-[#18181b] border border-[#2c2c30] rounded-lg px-3 py-2 text-xs text-white focus:outline-none focus:border-[#d8c49d] cursor-pointer"
                                >
                                    @foreach($product->variants as $variant)
                                        <option value="{{ $variant->id }}">
                                            {{ $variant->format_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Price Display & Buy Button Matching Sketch -->
                            <div class="pt-2 border-t border-[#232326] flex items-center justify-between gap-4">
                                <div>
                                    <div class="text-2xl font-serif font-bold text-[#d8c49d]">
                                        <span x-text="formatCurrentPrice()"></span>
                                    </div>
                                    <div class="text-[11px] text-[#777] font-mono" x-text="formatSecondaryPrice()">
                                    </div>
                                </div>

                                <button 
                                    type="button"
                                    @click="addToCart(selectedVariantId, 1, '{{ addslashes($product->title) }}')"
                                    class="px-6 py-3 rounded-lg bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-widest transition-all shadow-md flex items-center gap-2 cursor-pointer hover:scale-[1.02] active:scale-95"
                                >
                                    <span>BUY</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Shipping Policy Modal from Page 6 of Art Catalog -->
    <dialog id="shipping-policy-modal" class="bg-[#141416] text-[#ededeb] border border-[#2c2c30] rounded-2xl p-8 max-w-2xl w-full backdrop:bg-black/80 shadow-2xl m-auto">
        <div class="space-y-6">
            <div class="flex items-center justify-between border-b border-[#232326] pb-4">
                <h3 class="font-serif text-2xl font-bold text-[#d8c49d]">Políticas de Envío & Pagos</h3>
                <button onclick="document.getElementById('shipping-policy-modal').close()" class="text-[#8e8e93] hover:text-white text-xl">✕</button>
            </div>
            
            <div class="space-y-4 text-xs text-[#a6a6aa] leading-relaxed font-sans max-h-[60vh] overflow-y-auto pr-2">
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-1">Pagos (Payments)</h4>
                    <p>Pagos internacionales mediante <strong>PayPal</strong> a la cuenta oficial: <code class="text-[#d8c49d] bg-black px-2 py-0.5 rounded">fredocontacto@gmail.com</code>. Para compras dentro de Chile se acepta transferencia bancaria directa y Webpay en pesos chilenos (CLP).</p>
                </div>

                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-1">Envíos Internacionales (Shipping)</h4>
                    <p>Los envíos internacionales se realizan a través de <strong>Correos de Chile</strong> (servicio certificado con seguimiento online en www.correos.cl). El tiempo de entrega internacional estimado es de <strong>30 días hábiles</strong>.</p>
                </div>

                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-1">Embalaje Protegido</h4>
                    <p>Cada dibujo original, lámina fine art o polera se envía en <strong>caja o tubo rígido de alta resistencia con bolsa protectora antihumedad</strong> para garantizar que llegue en perfectas condiciones a cualquier lugar del mundo.</p>
                </div>

                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-1">Despacho & Número de Seguimiento</h4>
                    <p>Las órdenes se despachan los días <strong>jueves posteriores a la confirmación del pago</strong>. Se enviará de inmediato el código de seguimiento (tracking code) a tu correo electrónico.</p>
                </div>

                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-1">Marcos e Impuestos Aduaneros</h4>
                    <p>Los dibujos no incluyen marco a menos que se especifique expresamente en la fotografía y descripción. Los aranceles e impuestos que aplique la aduana del país de destino son responsabilidad exclusiva del comprador.</p>
                </div>
            </div>

            <div class="pt-4 border-t border-[#232326] flex justify-end">
                <button onclick="document.getElementById('shipping-policy-modal').close()" class="px-5 py-2.5 rounded-lg bg-[#d8c49d] text-black font-bold text-xs uppercase tracking-wider">
                    Entendido
                </button>
            </div>
        </div>
    </dialog>

@endsection
