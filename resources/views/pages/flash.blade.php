@extends('layouts.app')

@section('title', 'Diseños Flash Disponibles — FREDOSIS | Tatuajes de Autor en Santiago Centro')
@section('meta_description', 'Explora el catálogo exclusivo de diseños flash disponibles de Fredosis en Santiago Centro (Metro Santa Ana). Piezas de autor concebidas para tatuarse una única vez.')
@section('meta_keywords', 'flashes disponibles santiago, flash tattoo chile, tatuajes cerca de mi, diseños de tatuajes, tatuajes metro santa ana, linea fina, blackwork flash, fredosis tattoo')

@section('content')

    <section class="py-16 md:py-24 px-6 md:px-16 max-w-7xl mx-auto space-y-12">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-amber-500/30 bg-amber-500/10 text-xs font-semibold text-amber-400">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                <span>Piezas Únicas • Se tatúan una sola vez</span>
            </div>

            <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#f5f5f3] tracking-tight">
                Diseños Flash Disponibles
            </h1>

            <p class="text-xs md:text-sm text-[#8e8e93] leading-relaxed">
                Cada uno de estos diseños ha sido dibujado a mano por Fredosis bajo la premisa de exclusividad absoluta: <strong>una vez que un cliente reserva una pieza, no se vuelve a tatuar</strong>. Haz clic en tu favorito para reservar tu hora en nuestro atelier de <strong>Metro Santa Ana, Santiago Centro</strong>.
            </p>

            <!-- Filter Tabs -->
            <div class="flex flex-wrap items-center justify-center gap-2 pt-2">
                <a 
                    href="{{ route('flash.index', ['status' => 'all']) }}" 
                    class="px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all {{ $status === 'all' ? 'bg-[#d8c49d] text-black shadow-md' : 'bg-[#18181b] text-[#8e8e93] hover:text-white border border-[#2c2c30]' }}"
                >
                    Todos ({{ $totalCount }})
                </a>
                <a 
                    href="{{ route('flash.index', ['status' => 'available']) }}" 
                    class="px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all {{ $status === 'available' ? 'bg-emerald-500 text-black shadow-md font-bold' : 'bg-[#18181b] text-[#8e8e93] hover:text-emerald-400 border border-[#2c2c30]' }}"
                >
                    ✨ Disponibles ({{ $availableCount }})
                </a>
                <a 
                    href="{{ route('flash.index', ['status' => 'claimed']) }}" 
                    class="px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all {{ $status === 'claimed' ? 'bg-[#333] text-white shadow-md' : 'bg-[#18181b] text-[#8e8e93] hover:text-white border border-[#2c2c30]' }}"
                >
                    🔒 Reclamados / Tatuados ({{ $claimedCount }})
                </a>
            </div>
        </div>

        <!-- Flash Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($flashes as $flash)
                @php
                    $userCurrency = session('currency', 'USD');
                    $priceDisplay = \App\Services\CurrencyService::format(
                        \App\Services\CurrencyService::convert((float)$flash->price_usd, 'USD', $userCurrency),
                        $userCurrency
                    );
                @endphp

                <div class="bg-[#121214] border border-[#232326] rounded-2xl overflow-hidden flex flex-col justify-between group hover:border-[#d8c49d]/50 transition-all duration-300 shadow-xl relative {{ $flash->is_claimed ? 'opacity-70' : '' }}">
                    
                    <!-- Status Badge Floating -->
                    <div class="absolute top-4 left-4 z-10">
                        @if(!$flash->is_claimed)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/80 backdrop-blur-md border border-emerald-500/40 text-emerald-400 font-bold text-[10px] uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                Disponible
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/80 backdrop-blur-md border border-[#444] text-[#888] font-bold text-[10px] uppercase tracking-wider">
                                <span>🔒 Ya Tatuado</span>
                            </span>
                        @endif
                    </div>

                    <!-- Image with Zoom Lightbox -->
                    <div class="aspect-[3/4] bg-black overflow-hidden relative cursor-pointer" @click="openLightbox('{{ $flash->image_url }}', '{{ addslashes($flash->title) }}')">
                        <img 
                            src="{{ $flash->image_url }}" 
                            alt="{{ $flash->title }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center p-4">
                            <span class="px-4 py-2 rounded-full bg-black/90 text-[11px] text-[#d8c49d] border border-[#d8c49d]/30 font-semibold tracking-wider">
                                Click para ampliar detalle
                            </span>
                        </div>
                    </div>

                    <!-- Details Content -->
                    <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                        <div class="space-y-2">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="font-serif text-lg md:text-xl font-bold text-[#f5f5f3] group-hover:text-[#d8c49d] transition-colors leading-snug">
                                    <a href="{{ route('flash.show', $flash->slug) }}">{{ $flash->title }}</a>
                                </h3>
                            </div>

                            <p class="text-xs text-[#8e8e93] line-clamp-2 leading-relaxed">
                                {{ $flash->description ?? 'Diseño de autor en tinta y grafito con degradados anatómicos.' }}
                            </p>

                            <!-- Size & Zone Info -->
                            <div class="pt-2 flex flex-wrap items-center gap-3 text-[11px] text-[#aaa]">
                                @if($flash->size_cm)
                                    <span class="inline-flex items-center gap-1 font-mono text-[#d8c49d]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                                        {{ $flash->size_cm }}
                                    </span>
                                @endif
                                @if($flash->recommended_zone)
                                    <span class="inline-flex items-center gap-1 text-[#888]">
                                        📍 {{ $flash->recommended_zone }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Price & CTA Action -->
                        <div class="pt-4 border-t border-[#232326] flex items-center justify-between gap-4">
                            <div>
                                <span class="text-[10px] text-[#777] uppercase tracking-wider block">Valor sesión</span>
                                <span class="text-base font-bold text-[#d8c49d] font-mono">
                                    {{ $priceDisplay }}
                                </span>
                            </div>

                            @if(!$flash->is_claimed)
                                <a 
                                    href="{{ route('booking', ['flash_id' => $flash->id]) }}" 
                                    class="px-4 py-2.5 rounded-xl bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-1.5"
                                    title="Reservar este diseño en la agenda"
                                >
                                    <span>Tatuarme</span>
                                    <span>→</span>
                                </a>
                            @else
                                <span class="px-3 py-2 rounded-xl bg-[#1e1e22] text-[#666] text-xs font-semibold">
                                    No disponible
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-[#666] space-y-3">
                    <p class="text-lg font-serif">No se encontraron diseños para este filtro.</p>
                    <a href="{{ route('flash.index') }}" class="text-xs text-[#d8c49d] underline">Ver todos los flashes</a>
                </div>
            @endforelse
        </div>

        <!-- Sticky Studio Consultation Notice -->
        <div class="p-8 rounded-2xl bg-[#141417] border border-[#232326] max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 shadow-2xl">
            <div class="space-y-1 text-center md:text-left">
                <span class="text-[11px] font-mono text-[#d8c49d] uppercase tracking-widest">¿Tienes una idea propia o cover-up?</span>
                <h4 class="font-serif text-lg font-bold text-white">También creamos diseños 100% personalizados</h4>
                <p class="text-xs text-[#8e8e93]">Si ninguno de estos flashes calza con tu idea, puedes solicitar un diseño a medida en nuestro estudio de Metro Santa Ana.</p>
            </div>
            <a 
                href="{{ route('booking') }}" 
                class="px-6 py-3 rounded-xl border border-[#d8c49d]/50 hover:bg-[#d8c49d] text-[#d8c49d] hover:text-black font-bold text-xs uppercase tracking-wider transition-all shrink-0"
            >
                Agendar Proyecto Personalizado
            </a>
        </div>
    </section>

@endsection
