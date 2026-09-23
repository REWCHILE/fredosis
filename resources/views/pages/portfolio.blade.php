@extends('layouts.app')

@section('title', 'Portafolio de Arte — FREDOSIS | Dibujos a Grafito, Pinturas & Tatuajes')
@section('meta_description', 'Explora el archivo completo de obras, dibujos surrealistas a grafito y piezas de tatuaje de Fredosis. Técnica pura y detalle anatómico.')

@section('content')

    <section class="py-20 px-6 md:px-16 max-w-7xl mx-auto space-y-12">
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-semibold">Archivo de Obras</span>
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#f5f5f3]">Portafolio Artístico</h1>
            <p class="text-xs md:text-sm text-[#8e8e93]">
                Una selección cronológica de dibujos a grafito, plumilla, pinturas al óleo y tatuajes de autor. Haz clic en cualquier pieza para ampliar y explorar los detalles.
            </p>
        </div>

        <!-- Filter Category Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 border-b border-[#232326] pb-6">
            <a 
                href="{{ route('portfolio') }}" 
                class="px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all {{ empty($category) ? 'bg-[#d8c49d] text-black shadow-md' : 'bg-[#18181b] text-[#8e8e93] hover:text-white border border-[#2c2c30]' }}"
            >
                Todas las Obras
            </a>
            <a 
                href="{{ route('portfolio', ['category' => 'drawings']) }}" 
                class="px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all {{ $category === 'drawings' ? 'bg-[#d8c49d] text-black shadow-md' : 'bg-[#18181b] text-[#8e8e93] hover:text-white border border-[#2c2c30]' }}"
            >
                Dibujos a Grafito
            </a>
            <a 
                href="{{ route('portfolio', ['category' => 'paintings']) }}" 
                class="px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all {{ $category === 'paintings' ? 'bg-[#d8c49d] text-black shadow-md' : 'bg-[#18181b] text-[#8e8e93] hover:text-white border border-[#2c2c30]' }}"
            >
                Pinturas
            </a>
            <a 
                href="{{ route('portfolio', ['category' => 'tattoos']) }}" 
                class="px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all {{ $category === 'tattoos' ? 'bg-[#d8c49d] text-black shadow-md' : 'bg-[#18181b] text-[#8e8e93] hover:text-white border border-[#2c2c30]' }}"
            >
                Tatuajes & Flash
            </a>
        </div>

        <!-- Artworks Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($artworks as $art)
                <div 
                    @click="openLightbox({
                        title: '{{ addslashes($art->title) }}',
                        image_url: '{{ $art->image_url }}',
                        category: '{{ $art->category }}',
                        medium: '{{ addslashes($art->medium) }}',
                        dimensions: '{{ addslashes($art->dimensions) }}',
                        year: '{{ $art->year }}',
                        description: '{{ addslashes($art->description) }}'
                    })"
                    class="fine-art-card group cursor-pointer bg-[#121214] border border-[#232326] rounded-xl overflow-hidden hover:border-[#d8c49d]/40 transition-all"
                >
                    <div class="aspect-[4/5] overflow-hidden bg-black relative">
                        <img 
                            src="{{ $art->image_url }}" 
                            alt="{{ $art->title }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="px-4 py-2 rounded-full bg-white/90 text-black text-xs font-bold tracking-wider uppercase">
                                Ampliar Detalle
                            </span>
                        </div>
                    </div>
                    <div class="p-5 space-y-1.5">
                        <div class="flex items-center justify-between text-[11px] text-[#d8c49d]">
                            <span class="uppercase tracking-widest font-semibold">{{ $art->category }}</span>
                            <span>{{ $art->year ?? '2026' }}</span>
                        </div>
                        <h3 class="font-serif text-xl font-bold text-[#ededeb] group-hover:text-[#d8c49d] transition-colors">
                            {{ $art->title }}
                        </h3>
                        <p class="text-xs text-[#8e8e93]">{{ $art->medium }}</p>
                        @if($art->dimensions)
                            <p class="text-[11px] text-[#666]">{{ $art->dimensions }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 py-20 text-center text-[#8e8e93]">
                    <p class="font-serif text-lg text-[#d8c49d]">No hay obras en esta categoría actualmente.</p>
                </div>
            @endforelse
        </div>
    </section>

@endsection
