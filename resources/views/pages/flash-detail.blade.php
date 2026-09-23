@extends('layouts.app')

@section('title', $flash->title . ' — Diseño Flash | FREDOSIS Tatuajes Santiago')
@section('meta_description', 'Diseño flash exclusivo de Fredosis: ' . $flash->title . '. Tatuaje de autor en Santiago Centro a pasos de Metro Santa Ana. Reserva directa en línea.')

@section('content')

    <section class="py-16 md:py-24 px-6 md:px-16 max-w-6xl mx-auto space-y-12">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-[#8e8e93]">
            <a href="{{ route('home') }}" class="hover:text-[#d8c49d]">Inicio</a>
            <span>/</span>
            <a href="{{ route('flash.index') }}" class="hover:text-[#d8c49d]">Flashes Disponibles</a>
            <span>/</span>
            <span class="text-[#f5f5f3] font-semibold">{{ $flash->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left: Artwork Zoomable View -->
            <div class="lg:col-span-6 space-y-4">
                <div 
                    class="aspect-[3/4] bg-black border border-[#232326] rounded-2xl overflow-hidden relative shadow-2xl group cursor-pointer"
                    @click="openLightbox('{{ $flash->image_url }}', '{{ addslashes($flash->title) }}')"
                >
                    <img 
                        src="{{ $flash->image_url }}" 
                        alt="{{ $flash->title }}" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    >
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="px-5 py-2.5 rounded-full bg-black/80 text-xs text-[#d8c49d] border border-[#d8c49d]/40 font-semibold tracking-wider flex items-center gap-2">
                            <span>🔍 Clic para examinar detalles</span>
                        </span>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-[#141417] border border-[#232326] text-[11px] text-[#777] flex items-center justify-between">
                    <span>📍 Estudio Privado • Metro Santa Ana, Santiago</span>
                    <span class="text-[#d8c49d] font-semibold">Técnica de Autor</span>
                </div>
            </div>

            <!-- Right: Details & Direct Booking Action -->
            <div class="lg:col-span-6 space-y-8">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        @if(!$flash->is_claimed)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-bold text-xs">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                Disponible para Tatuar (1 Sola Vez)
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 font-bold text-xs">
                                🔒 Reclamado / Ya Tatuado
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-5xl font-serif font-bold text-[#f5f5f3] leading-tight">
                        {{ $flash->title }}
                    </h1>

                    @php
                        $userCurrency = session('currency', 'USD');
                        $priceDisplay = \App\Services\CurrencyService::format(
                            \App\Services\CurrencyService::convert((float)$flash->price_usd, 'USD', $userCurrency),
                            $userCurrency
                        );
                    @endphp

                    <div class="pt-2">
                        <span class="text-xs text-[#777] block uppercase tracking-wider">Valor total sesión</span>
                        <div class="text-3xl font-serif font-bold text-[#d8c49d] font-mono">
                            {{ $priceDisplay }}
                        </div>
                        <span class="text-[11px] text-[#8e8e93]">
                            Abono de reserva ${{ number_format(35000, 0, ',', '.') }} CLP ($35 USD) deducible del total final.
                        </span>
                    </div>
                </div>

                <div class="border-y border-[#232326] py-6 space-y-4">
                    <h4 class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">Ficha Técnica del Diseño</h4>
                    
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div class="p-3 rounded-lg bg-[#141417] border border-[#232326]">
                            <span class="text-[#777] block text-[10px]">Dimensiones Recomendadas</span>
                            <span class="font-mono font-bold text-white">{{ $flash->size_cm ?? '14 x 9 cm' }}</span>
                        </div>
                        <div class="p-3 rounded-lg bg-[#141417] border border-[#232326]">
                            <span class="text-[#777] block text-[10px]">Zona Anatómica Ideal</span>
                            <span class="font-bold text-white">{{ $flash->recommended_zone ?? 'Antebrazo, gemelo, costillas' }}</span>
                        </div>
                    </div>

                    <p class="text-xs md:text-sm text-[#a6a6aa] leading-relaxed">
                        {{ $flash->description ?? 'Diseño original a mano alzada de Fredosis. Se realiza con instrumental descartable de un solo uso, tintas veganas de alta saturación y técnica de línea fina para asegurar máxima nitidez en el tiempo.' }}
                    </p>
                </div>

                <!-- Call To Actions -->
                <div class="space-y-4">
                    @if(!$flash->is_claimed)
                        <a 
                            href="{{ route('booking', ['flash_id' => $flash->id]) }}" 
                            class="w-full py-4 rounded-xl bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-widest transition-all shadow-xl flex items-center justify-center gap-2"
                        >
                            <span>Apartar y Tatuarme esta Pieza</span>
                            <span>→</span>
                        </a>
                    @else
                        <div class="p-4 rounded-xl bg-[#1e1e22] text-center text-xs text-[#888]">
                            Este diseño ya ha sido tatuado. Fredosis no repite piezas exclusivas. Puedes solicitar una reinterpretación o proyecto personalizado.
                        </div>
                    @endif

                    <a 
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappPhone) }}?text=Hola%20Fredosis,%20me%20interesa%20el%20dise%C3%B1o%20flash%20'{{ urlencode($flash->title) }}'%20en%20Metro%20Santa%20Ana" 
                        target="_blank" 
                        rel="noopener" 
                        class="w-full py-3.5 rounded-xl border border-[#333] hover:border-emerald-500/50 hover:text-emerald-400 text-xs font-semibold tracking-wider transition-all flex items-center justify-center gap-2 text-[#ededeb]"
                    >
                        <span>Consultar por WhatsApp con Fredosis</span>
                    </a>
                </div>

                <!-- Exclusivity Box -->
                <div class="p-4 rounded-xl bg-amber-500/5 border border-amber-500/20 text-xs text-[#a6a6aa] space-y-1">
                    <p class="font-bold text-amber-400">🛡️ Garantía de Pieza Única</p>
                    <p class="text-[11px] text-[#8e8e93]">Al confirmar tu reserva, este diseño se retira permanentemente del catálogo disponible. Tu tatuaje será único en el mundo.</p>
                </div>
            </div>
        </div>

        <!-- Related Flashes -->
        @if($relatedFlashes->count() > 0)
            <div class="pt-16 border-t border-[#232326] space-y-8">
                <h3 class="font-serif text-2xl font-bold text-white">Otros Flashes Disponibles</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($relatedFlashes as $rel)
                        <a href="{{ route('flash.show', $rel->slug) }}" class="group bg-[#121214] border border-[#232326] rounded-xl overflow-hidden hover:border-[#d8c49d]/50 transition-all block">
                            <div class="aspect-[3/4] bg-black overflow-hidden">
                                <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4 space-y-1">
                                <h4 class="font-serif font-bold text-white text-sm group-hover:text-[#d8c49d] transition-colors">{{ $rel->title }}</h4>
                                <p class="text-xs text-[#d8c49d] font-mono">${{ number_format($rel->price_clp, 0, ',', '.') }} CLP</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

@endsection
