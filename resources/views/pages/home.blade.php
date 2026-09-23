@extends('layouts.app')

@section('title', 'FREDOSIS — Fine Art, Dibujos & Tatuajes en Metro Santa Ana, Santiago Centro')
@section('meta_description', 'Plataforma oficial del artista Fredosis. Galería de dibujos surrealistas a grafito estilo Miles Johnston, tienda de láminas fine art y agenda de tatuajes en Santiago Centro (Metro Santa Ana).')
@section('meta_keywords', 'tatuajes cerca de mi, tattoo cerca de mi, estudio de tatuajes santiago centro, tatuajes metro santa ana, precio tatuajes, cuanto cuesta un tatuaje en santiago, tatuaje linea fina, fine line tattoo chile, blackwork santiago, cover up tatuajes, dibujos a grafito, arte surrealista miles johnston, compra de arte original, paypal chile')

@section('structured_data')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'FAQPage',
  'mainEntity' => [
    [
      '@type' => 'Question',
      'name' => '¿Dónde queda el estudio de tatuajes de Fredosis en Santiago?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'El estudio privado de Fredosis se ubica en Santiago Centro a pasos de la estación Metro Santa Ana (combinación Línea 2 y Línea 5). Ofrece máxima comodidad y accesibilidad desde Providencia, Las Condes, Maipú, Ñuñoa y San Miguel. Atención exclusivamente privada y con reserva previa.',
      ],
    ],
    [
      '@type' => 'Question',
      'name' => '¿Cuánto cuesta un tatuaje en Santiago y cómo se calcula el precio?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Los precios parten desde $50.000 CLP para piezas de autor. Se evalúa el tamaño en cm, la zona del cuerpo y la complejidad técnica (línea fina, blackwork o microrealismo). Para agendar tu hora en el calendario se realiza un abono de reserva de $35.000 CLP ($35 USD vía PayPal), 100% deducible del total el día de la sesión.',
      ],
    ],
    [
      '@type' => 'Question',
      'name' => '¿Qué estilos de tatuaje realiza Fredosis?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Fredosis está especializado en Tatuaje de Línea Fina (Fine Line de precisión quirúrgica), Blackwork con sombras profundas, motivos botánicos y composiciones anatómicas surrealistas inspiradas en sus dibujos a grafito clásico.',
      ],
    ],
    [
      '@type' => 'Question',
      'name' => '¿Realizan Cover-Up (tapado de tatuajes antiguos)?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Sí. Realizamos proyectos de Cover-Up estudiando la pigmentación previa para diseñar una pieza con contrastes blackwork y anatomía que disimule o integre el tatuaje anterior armoniosamente.',
      ],
    ],
    [
      '@type' => 'Question',
      'name' => '¿Cómo comprar láminas Fine Art y dibujos originales con PayPal?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'A través de nuestra tienda online oficial puedes comprar dibujos originales y láminas giclée impresas en papel Hahnemühle Photo Rag 308g 100% algodón. Aceptamos PayPal con selector de divisas (USD, CLP, EUR, MXN) y despachos protegidos a todo Chile y el mundo.',
      ],
    ],
    [
      '@type' => 'Question',
      'name' => '¿Cuáles son los cuidados recomendados después de tatuarse?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Mantener el parche dérmico de 24 a 48 hrs, lavar con jabón neutro sin perfumes, aplicar crema cicatrizante en capa fina 3 veces al día, y evitar sol directo, piscinas y saunas por 21 días. Incluye retoque gratuito a los 30 días si fuese necesario.',
      ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection

@section('content')

    <!-- ========================================================
         HERO SECTION: FINE ART SHOWCASE (ESTILO MILES JOHNSTON)
         ======================================================== -->
    <section class="relative min-h-[90vh] flex items-center justify-center px-6 md:px-16 overflow-hidden border-b border-[#232326]">
        <!-- Subtle Ambient Background Light -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#141417]/40 via-[#0b0b0c] to-[#0b0b0c] pointer-events-none"></div>

        <div class="relative z-10 max-w-5xl mx-auto text-center space-y-8 py-20">
            <!-- Subtitle / Artist discipline badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-[#d8c49d]/30 bg-[#161619]/80 backdrop-blur-md text-[11px] uppercase tracking-[0.25em] text-[#d8c49d]">
                <span class="w-1.5 h-1.5 rounded-full bg-[#d8c49d]"></span>
                Atelier de Arte & Tatuajes • Santiago Centro
            </div>

            <!-- Main Artist Name Headline -->
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-serif font-bold tracking-tight text-[#f5f5f3] leading-none">
                FREDOSIS
            </h1>

            <p class="max-w-2xl mx-auto text-sm md:text-base text-[#a6a6aa] leading-relaxed font-light">
                Exploración de la anatomía humana, el surrealismo psicológico y la introspección visual a través del grafito puro, plumilla de alta densidad y tatuaje de autor.
            </p>

            <!-- CTA Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
                <a 
                    href="{{ route('portfolio') }}" 
                    class="px-8 py-3.5 rounded-full bg-[#ededeb] text-[#0b0b0c] font-semibold text-xs uppercase tracking-widest hover:bg-[#d8c49d] transition-all shadow-xl hover:scale-105"
                >
                    Explorar Portafolio
                </a>
                <a 
                    href="{{ route('shop') }}" 
                    class="px-8 py-3.5 rounded-full border border-[#333] text-[#ededeb] font-semibold text-xs uppercase tracking-widest hover:border-[#d8c49d] hover:text-[#d8c49d] transition-all"
                >
                    Adquirir Dibujos & Prints
                </a>
                <a 
                    href="{{ route('booking') }}" 
                    class="px-8 py-3.5 rounded-full border border-[#d8c49d]/60 bg-[#d8c49d]/10 text-[#d8c49d] font-semibold text-xs uppercase tracking-widest hover:bg-[#d8c49d] hover:text-black transition-all"
                >
                    Agendar Tatuaje
                </a>
            </div>

            <!-- Studio location indicator -->
            <div class="pt-10 flex items-center justify-center gap-2 text-xs text-[#8e8e93]">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#d8c49d]"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                <span>Estudio privado a pasos de <strong>Metro Santa Ana</strong> (Línea 2 y 5), Santiago Centro</span>
            </div>
        </div>
    </section>


    <!-- ========================================================
         FEATURED ARTWORKS GALLERY (INSPIRADO EN MILES JOHNSTON)
         ======================================================== -->
    <section class="py-24 px-6 md:px-16 max-w-7xl mx-auto space-y-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#232326] pb-8">
            <div class="space-y-2">
                <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-semibold">Selección de Obras</span>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[#f5f5f3]">Galería de Autor</h2>
                <p class="text-xs md:text-sm text-[#8e8e93]">Haz clic en cualquier pieza para ampliar en alta definición y examinar los detalles técnicos.</p>
            </div>
            <a href="{{ route('portfolio') }}" class="text-xs uppercase tracking-widest text-[#d8c49d] hover:underline font-semibold flex items-center gap-1">
                <span>Ver Portafolio Completo</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        </div>

        <!-- Masonry / Fine Art Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredArtworks as $art)
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
                    class="fine-art-card group cursor-pointer bg-[#121214] border border-[#232326] rounded-xl overflow-hidden"
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
                                Examinar Detalle
                            </span>
                        </div>
                    </div>
                    <div class="p-5 space-y-1.5">
                        <div class="flex items-center justify-between text-[11px] text-[#d8c49d]">
                            <span class="uppercase tracking-widest">{{ $art->category }}</span>
                            <span>{{ $art->year ?? '2026' }}</span>
                        </div>
                        <h3 class="font-serif text-lg font-bold text-[#ededeb] group-hover:text-[#d8c49d] transition-colors">
                            {{ $art->title }}
                        </h3>
                        <p class="text-xs text-[#8e8e93] line-clamp-1">{{ $art->medium }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    <!-- ========================================================
         STORE & PRINTS SHOWCASE (DIBUJOS EN VENTA + PAYPAL)
         ======================================================== -->
    <section class="py-24 bg-[#0e0e10] border-y border-[#232326]">
        <div class="px-6 md:px-16 max-w-7xl mx-auto space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="space-y-2">
                    <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-semibold">Tienda de Arte</span>
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-[#f5f5f3]">Dibujos Originales & Láminas Fine Art</h2>
                    <p class="text-xs md:text-sm text-[#8e8e93]">
                        Ediciones limitadas en papel de algodón Hahnemühle y piezas únicas con certificado. Pagos internacionales protegidos con PayPal.
                    </p>
                </div>
                <a href="{{ route('shop') }}" class="text-xs uppercase tracking-widest text-[#d8c49d] hover:underline font-semibold flex items-center gap-1">
                    <span>Ver Catálogo en Tienda</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </a>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    @php
                        $primaryVariant = $product->variants->where('is_available', true)->first() ?: $product->variants->first();
                    @endphp
                    <div class="bg-[#141417] border border-[#232326] rounded-xl overflow-hidden flex flex-col justify-between group hover:border-[#d8c49d]/50 transition-all">
                        <div>
                            <div class="aspect-square overflow-hidden bg-black relative">
                                <a href="{{ route('shop.detail', $product->slug) }}">
                                    <img 
                                        src="{{ $product->main_image }}" 
                                        alt="{{ $product->title }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    >
                                </a>
                                @if($product->has_original && !$product->original_sold)
                                    <span class="absolute top-3 left-3 px-2 py-1 rounded bg-[#d8c49d] text-black text-[10px] font-bold uppercase tracking-wider">
                                        Original Disponible
                                    </span>
                                @elseif($product->original_sold)
                                    <span class="absolute top-3 left-3 px-2 py-1 rounded bg-black/80 text-[#8e8e93] text-[10px] font-bold uppercase tracking-wider border border-[#333]">
                                        Original Vendido
                                    </span>
                                @endif
                            </div>
                            <div class="p-4 space-y-1.5">
                                <span class="text-[10px] uppercase tracking-widest text-[#8e8e93]">{{ $product->category }}</span>
                                <h4 class="font-serif text-base font-bold text-[#f5f5f3] line-clamp-1 group-hover:text-[#d8c49d] transition-colors">
                                    <a href="{{ route('shop.detail', $product->slug) }}">{{ $product->title }}</a>
                                </h4>
                                <p class="text-xs text-[#8e8e93] line-clamp-2">{{ $product->short_description }}</p>
                            </div>
                        </div>

                        <div class="p-4 pt-0 border-t border-[#232326] mt-4 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-[#777] block">Desde</span>
                                <span class="text-sm font-bold text-[#d8c49d]">
                                    ${{ number_format($product->base_price_usd, 0) }} USD
                                </span>
                            </div>
                            @if($primaryVariant)
                                <button 
                                    type="button"
                                    @click="addToCart({{ $primaryVariant->id }})"
                                    class="p-2.5 rounded-lg bg-[#1e1e22] hover:bg-[#d8c49d] text-[#ededeb] hover:text-black transition-all"
                                    title="Añadir lámina al carrito"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- ========================================================
         TATTOO ATELIER & AGENDA SECTION (METRO SANTA ANA)
         ======================================================== -->
    <section class="py-24 px-6 md:px-16 max-w-7xl mx-auto space-y-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-emerald-500/30 bg-emerald-500/10 text-xs font-semibold text-emerald-400">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Agenda Abierta — Santiago Centro
                </div>

                <h2 class="text-3xl md:text-5xl font-serif font-bold text-[#f5f5f3] leading-tight">
                    Tatuajes de Autor en Santiago Centro
                </h2>

                <p class="text-sm md:text-base text-[#a6a6aa] leading-relaxed">
                    Cada sesión en el estudio de Fredosis se concibe como una obra pictórica sobre la piel. Especializado en <strong>línea fina (fine line)</strong>, <strong>blackwork de alto contraste</strong>, motivos botánicos y composiciones anatómicas surrealistas.
                </p>

                <!-- Key Studio Highlights -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="p-4 rounded-lg bg-[#141417] border border-[#232326] space-y-1">
                        <span class="text-[#d8c49d] font-bold text-xs uppercase tracking-wider block">📍 Ubicación Estratégica</span>
                        <p class="text-xs text-[#8e8e93]">Estudio privado a pasos de <strong>Metro Santa Ana</strong> (L2 y L5), cómodo, seguro y accesible.</p>
                    </div>
                    <div class="p-4 rounded-lg bg-[#141417] border border-[#232326] space-y-1">
                        <span class="text-[#d8c49d] font-bold text-xs uppercase tracking-wider block">🛡️ Máxima Higiene & Autoclave</span>
                        <p class="text-xs text-[#8e8e93]">Materiales desechables premium, tintas veganas certificadas y esterilización de grado quirúrgico.</p>
                    </div>
                    <div class="p-4 rounded-lg bg-[#141417] border border-[#232326] space-y-1">
                        <span class="text-[#d8c49d] font-bold text-xs uppercase tracking-wider block">✍️ Diseño Exclusivo</span>
                        <p class="text-xs text-[#8e8e93]">No se repiten piezas grandes. Cada tatuaje se adapta armónicamente a la anatomía muscular.</p>
                    </div>
                    <div class="p-4 rounded-lg bg-[#141417] border border-[#232326] space-y-1">
                        <span class="text-[#d8c49d] font-bold text-xs uppercase tracking-wider block">🔒 Reserva Transparente</span>
                        <p class="text-xs text-[#8e8e93]">Abono de reserva ${{ number_format($depositClp, 0, ',', '.') }} CLP deducible del valor final de tu sesión.</p>
                    </div>
                </div>

                <div class="pt-4 flex flex-wrap gap-4 items-center">
                    <a 
                        href="{{ route('booking') }}" 
                        class="px-8 py-3.5 rounded-full bg-[#d8c49d] hover:bg-[#ebd7b1] text-[#0b0b0c] font-bold text-xs uppercase tracking-widest transition-all shadow-xl"
                    >
                        Reservar Hora en la Agenda
                    </a>
                    <a 
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappPhone) }}?text=Hola%20Fredosis,%20vengo%20del%20sitio%20web%20y%20me%20gustar%C3%ADa%20cotizar%20un%20tatuaje%20en%20Metro%20Santa%20Ana" 
                        target="_blank"
                        rel="noopener"
                        class="px-6 py-3.5 rounded-full border border-[#333] hover:border-emerald-500/50 hover:text-emerald-400 text-xs font-semibold tracking-wider transition-all flex items-center gap-2"
                    >
                        <span>WhatsApp Directo</span>
                    </a>
                </div>
            </div>

            <!-- Visual Preview Card -->
            <div class="lg:col-span-5 relative">
                <div class="aspect-[3/4] rounded-2xl overflow-hidden border border-[#26262a] shadow-2xl relative">
                    <img 
                        src="https://images.unsplash.com/photo-1598371839696-5c5bb00bdc28?q=80&w=1000" 
                        alt="Tatuaje en Estudio Fredosis Santiago" 
                        class="w-full h-full object-cover"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent flex flex-col justify-end p-8 space-y-2">
                        <span class="text-xs font-serif italic text-[#d8c49d]">Estudio Fredosis • Santiago</span>
                        <h4 class="font-serif text-2xl font-bold text-white">Línea Fina & Surrealismo</h4>
                        <p class="text-xs text-[#aaa]">Sesiones privadas y personalizadas en Metro Santa Ana.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========================================================
         AFTERCARE GUIDE (CUIDADOS POSTERIORES DEL TATUAJE)
         Basado en el análisis de palabras clave con alta búsqueda
         ======================================================== -->
    <section class="py-20 bg-[#121214] border-t border-[#232326]">
        <div class="px-6 md:px-16 max-w-7xl mx-auto space-y-12">
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-semibold">Guía Profesional</span>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-[#f5f5f3]">Cuidados Posteriores del Tatuaje</h2>
                <p class="text-xs md:text-sm text-[#8e8e93]">El 50% del resultado final de tu tatuaje depende de la curación durante las primeras semanas.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="p-6 rounded-xl bg-[#18181b] border border-[#26262a] space-y-3">
                    <div class="w-10 h-10 rounded-full bg-[#d8c49d]/10 border border-[#d8c49d]/30 text-[#d8c49d] font-bold flex items-center justify-center text-sm">
                        01
                    </div>
                    <h3 class="font-serif text-base font-bold text-white">Retiro del Parche</h3>
                    <p class="text-xs text-[#8e8e93] leading-relaxed">
                        Mantén el film dérmico entre 24 y 48 horas según indicación. Retira suavemente bajo agua tibia con jabón neutro sin fragancias.
                    </p>
                </div>

                <div class="p-6 rounded-xl bg-[#18181b] border border-[#26262a] space-y-3">
                    <div class="w-10 h-10 rounded-full bg-[#d8c49d]/10 border border-[#d8c49d]/30 text-[#d8c49d] font-bold flex items-center justify-center text-sm">
                        02
                    </div>
                    <h3 class="font-serif text-base font-bold text-white">Hidratación Controlada</h3>
                    <p class="text-xs text-[#8e8e93] leading-relaxed">
                        Aplica una capa muy delgada de crema cicatrizante (Aquaphor, Bepanthol o pomada recomendada) 3 veces al día. No satures la piel.
                    </p>
                </div>

                <div class="p-6 rounded-xl bg-[#18181b] border border-[#26262a] space-y-3">
                    <div class="w-10 h-10 rounded-full bg-[#d8c49d]/10 border border-[#d8c49d]/30 text-[#d8c49d] font-bold flex items-center justify-center text-sm">
                        03
                    </div>
                    <h3 class="font-serif text-base font-bold text-white">Cero Sol y Piscinas</h3>
                    <p class="text-xs text-[#8e8e93] leading-relaxed">
                        Evita piscinas, saunas, mar y exposición solar directa por 15 a 21 días. Nunca arranques las pequeñas costras naturales.
                    </p>
                </div>

                <div class="p-6 rounded-xl bg-[#18181b] border border-[#26262a] space-y-3">
                    <div class="w-10 h-10 rounded-full bg-[#d8c49d]/10 border border-[#d8c49d]/30 text-[#d8c49d] font-bold flex items-center justify-center text-sm">
                        04
                    </div>
                    <h3 class="font-serif text-base font-bold text-white">Garantía de Retoque</h3>
                    <p class="text-xs text-[#8e8e93] leading-relaxed">
                        Una vez cicatrizado a los 30 días, evaluamos tu pieza. Si necesitas un ajuste menor en líneas finas, está incluido.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ========================================================
         SEO & FAQ SECTION: PREGUNTAS FRECUENTES SOBRE TATUAJES
         Optimizado para: 'tatuajes cerca de mi', 'precio tatuajes',
         'metro santa ana', 'linea fina', 'blackwork', 'cover up', 'paypal'
         ======================================================== -->
    <section id="faq-seo" class="py-24 px-6 md:px-16 max-w-5xl mx-auto space-y-12">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-[#d8c49d]/30 bg-[#161619] text-xs font-semibold text-[#d8c49d]">
                <span>🔍 Respuestas Rápidas & Cotizaciones</span>
            </div>
            <h2 class="text-3xl md:text-5xl font-serif font-bold text-[#f5f5f3]">
                Preguntas Frecuentes sobre Tatuajes & Estudio
            </h2>
            <p class="text-xs md:text-sm text-[#8e8e93]">
                Todo lo que necesitas saber sobre precios, ubicación a pasos de Metro Santa Ana, estilos (Fine Line & Blackwork) y pagos protegidos con PayPal.
            </p>
        </div>

        <div class="space-y-4" x-data="{ activeFaq: 1 }">
            <!-- Question 1 -->
            <div class="border border-[#232326] bg-[#121214] rounded-xl overflow-hidden transition-colors" :class="{ 'border-[#d8c49d]/50 bg-[#151518]': activeFaq === 1 }">
                <button 
                    type="button" 
                    @click="activeFaq = (activeFaq === 1 ? null : 1)" 
                    class="w-full p-6 text-left flex items-center justify-between gap-4 focus:outline-none"
                >
                    <span class="font-serif text-base md:text-lg font-bold text-[#f5f5f3] flex items-center gap-3">
                        <span class="text-xs font-mono text-[#d8c49d]">01.</span>
                        ¿Dónde queda el estudio de tatuajes y cómo llegar desde Metro Santa Ana?
                    </span>
                    <span class="w-6 h-6 rounded-full border border-[#333] flex items-center justify-center text-xs text-[#aaa] shrink-0" x-text="activeFaq === 1 ? '−' : '+'"></span>
                </button>
                <div x-show="activeFaq === 1" x-collapse class="px-6 pb-6 text-xs md:text-sm text-[#a6a6aa] leading-relaxed border-t border-[#232326]/50 pt-4">
                    Nuestro atelier privado está ubicado en pleno <strong>Santiago Centro</strong>, a escasos pasos de la estación <strong>Metro Santa Ana</strong> (combinación Línea 2 y Línea 5), sobre el eje de calle Huérfanos con San Martín. Esta ubicación céntrica permite una conexión expedita desde Providencia, Las Condes, Maipú, Ñuñoa, San Miguel y toda la Región Metropolitana. Se atiende estrictamente con reserva previa en un espacio higiénico, reservado y sin interrupciones.
                </div>
            </div>

            <!-- Question 2 -->
            <div class="border border-[#232326] bg-[#121214] rounded-xl overflow-hidden transition-colors" :class="{ 'border-[#d8c49d]/50 bg-[#151518]': activeFaq === 2 }">
                <button 
                    type="button" 
                    @click="activeFaq = (activeFaq === 2 ? null : 2)" 
                    class="w-full p-6 text-left flex items-center justify-between gap-4 focus:outline-none"
                >
                    <span class="font-serif text-base md:text-lg font-bold text-[#f5f5f3] flex items-center gap-3">
                        <span class="text-xs font-mono text-[#d8c49d]">02.</span>
                        ¿Cuánto cuesta un tatuaje en Santiago y cómo cotizar?
                    </span>
                    <span class="w-6 h-6 rounded-full border border-[#333] flex items-center justify-center text-xs text-[#aaa] shrink-0" x-text="activeFaq === 2 ? '−' : '+'"></span>
                </button>
                <div x-show="activeFaq === 2" x-collapse class="px-6 pb-6 text-xs md:text-sm text-[#a6a6aa] leading-relaxed border-t border-[#232326]/50 pt-4">
                    El valor de cada tatuaje se calcula de manera transparente según su tamaño en centímetros, la zona corporal elegida y la complejidad técnica (precisión de línea fina, saturación de sombras o realismo botánico). Los proyectos de autor comienzan desde <strong>$50.000 CLP</strong>. Para agendar y apartar tu fecha en la agenda online se solicita un abono de reserva de <strong>$35.000 CLP</strong> (o $35 USD mediante PayPal), el cual se descuenta íntegramente del precio total el día de tu cita.
                </div>
            </div>

            <!-- Question 3 -->
            <div class="border border-[#232326] bg-[#121214] rounded-xl overflow-hidden transition-colors" :class="{ 'border-[#d8c49d]/50 bg-[#151518]': activeFaq === 3 }">
                <button 
                    type="button" 
                    @click="activeFaq = (activeFaq === 3 ? null : 3)" 
                    class="w-full p-6 text-left flex items-center justify-between gap-4 focus:outline-none"
                >
                    <span class="font-serif text-base md:text-lg font-bold text-[#f5f5f3] flex items-center gap-3">
                        <span class="text-xs font-mono text-[#d8c49d]">03.</span>
                        ¿Qué estilos artísticos desarrolla Fredosis?
                    </span>
                    <span class="w-6 h-6 rounded-full border border-[#333] flex items-center justify-center text-xs text-[#aaa] shrink-0" x-text="activeFaq === 3 ? '−' : '+'"></span>
                </button>
                <div x-show="activeFaq === 3" x-collapse class="px-6 pb-6 text-xs md:text-sm text-[#a6a6aa] leading-relaxed border-t border-[#232326]/50 pt-4">
                    Fredosis enfoca su obra en <strong>Línea Fina (Fine Line)</strong> de alta precisión y mínima invasión dérmica, <strong>Blackwork de alto contraste</strong>, motivos botánicos y composiciones anatómicas con tintes de surrealismo figurativo (influenciado por maestros del dibujo contemporáneo como Miles Johnston). Cada pieza es un diseño original concebido para fluir con la anatomía viva del cliente.
                </div>
            </div>

            <!-- Question 4 -->
            <div class="border border-[#232326] bg-[#121214] rounded-xl overflow-hidden transition-colors" :class="{ 'border-[#d8c49d]/50 bg-[#151518]': activeFaq === 4 }">
                <button 
                    type="button" 
                    @click="activeFaq = (activeFaq === 4 ? null : 4)" 
                    class="w-full p-6 text-left flex items-center justify-between gap-4 focus:outline-none"
                >
                    <span class="font-serif text-base md:text-lg font-bold text-[#f5f5f3] flex items-center gap-3">
                        <span class="text-xs font-mono text-[#d8c49d]">04.</span>
                        ¿Realizan Cover-Up o tapado de tatuajes anteriores?
                    </span>
                    <span class="w-6 h-6 rounded-full border border-[#333] flex items-center justify-center text-xs text-[#aaa] shrink-0" x-text="activeFaq === 4 ? '−' : '+'"></span>
                </button>
                <div x-show="activeFaq === 4" x-collapse class="px-6 pb-6 text-xs md:text-sm text-[#a6a6aa] leading-relaxed border-t border-[#232326]/50 pt-4">
                    Sí, realizamos evaluaciones para <strong>Cover-Up</strong>. Analizamos la tonalidad y saturación del tatuaje antiguo para diseñar una composición con contrastes sólidos y texturas de sombra que cubran o reinventen la pieza original sin dejar rastros toscos. Puedes enviar fotografías actuales y bien iluminadas desde el formulario de la agenda o vía WhatsApp para darte un diagnóstico previo.
                </div>
            </div>

            <!-- Question 5 -->
            <div class="border border-[#232326] bg-[#121214] rounded-xl overflow-hidden transition-colors" :class="{ 'border-[#d8c49d]/50 bg-[#151518]': activeFaq === 5 }">
                <button 
                    type="button" 
                    @click="activeFaq = (activeFaq === 5 ? null : 5)" 
                    class="w-full p-6 text-left flex items-center justify-between gap-4 focus:outline-none"
                >
                    <span class="font-serif text-base md:text-lg font-bold text-[#f5f5f3] flex items-center gap-3">
                        <span class="text-xs font-mono text-[#d8c49d]">05.</span>
                        ¿Cómo comprar dibujos originales y láminas con PayPal o divisa local?
                    </span>
                    <span class="w-6 h-6 rounded-full border border-[#333] flex items-center justify-center text-xs text-[#aaa] shrink-0" x-text="activeFaq === 5 ? '−' : '+'"></span>
                </button>
                <div x-show="activeFaq === 5" x-collapse class="px-6 pb-6 text-xs md:text-sm text-[#a6a6aa] leading-relaxed border-t border-[#232326]/50 pt-4">
                    En nuestra galería de tienda e-commerce puedes seleccionar el formato de lámina (A4, A3, A2 giclée sobre papel de algodón Hahnemühle) o pieza original a grafito. Contamos con <strong>Smart Buttons oficiales de PayPal</strong> y soporte multi-divisa (USD, CLP, EUR, MXN) para comprar desde cualquier país con total protección al comprador y seguimiento internacional.
                </div>
            </div>

            <!-- Question 6 -->
            <div class="border border-[#232326] bg-[#121214] rounded-xl overflow-hidden transition-colors" :class="{ 'border-[#d8c49d]/50 bg-[#151518]': activeFaq === 6 }">
                <button 
                    type="button" 
                    @click="activeFaq = (activeFaq === 6 ? null : 6)" 
                    class="w-full p-6 text-left flex items-center justify-between gap-4 focus:outline-none"
                >
                    <span class="font-serif text-base md:text-lg font-bold text-[#f5f5f3] flex items-center gap-3">
                        <span class="text-xs font-mono text-[#d8c49d]">06.</span>
                        ¿Qué estándares de bioseguridad y esterilización se aplican?
                    </span>
                    <span class="w-6 h-6 rounded-full border border-[#333] flex items-center justify-center text-xs text-[#aaa] shrink-0" x-text="activeFaq === 6 ? '−' : '+'"></span>
                </button>
                <div x-show="activeFaq === 6" x-collapse class="px-6 pb-6 text-xs md:text-sm text-[#a6a6aa] leading-relaxed border-t border-[#232326]/50 pt-4">
                    La seguridad de tu piel es primordial. Utilizamos material 100% descartable estéril de un solo uso abierto frente a ti, tintas veganas de grado profesional aprobadas por estándares internacionales, y barreras de bioseguridad clínicas. El estudio opera con protocolos estrictos de desinfección grado hospitalario.
                </div>
            </div>
        </div>

        <div class="pt-6 text-center">
            <p class="text-xs text-[#8e8e93]">¿Tienes una consulta específica sobre tu proyecto de tatuaje o lámina de arte?</p>
            <a 
                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappPhone) }}?text=Hola%20Fredosis,%20tengo%20una%20consulta%20para%20un%20tatuaje%20en%20Metro%20Santa%20Ana" 
                target="_blank" 
                rel="noopener" 
                class="inline-flex items-center gap-2 mt-3 px-6 py-2.5 rounded-full bg-[#18181b] border border-[#d8c49d]/40 text-[#d8c49d] hover:bg-[#d8c49d] hover:text-black transition-all text-xs font-semibold tracking-wider"
            >
                <span>Chatear por WhatsApp con Fredosis</span>
                <span>→</span>
            </a>
        </div>
    </section>


    <!-- ========================================================
         CONTACT & FOOTER
         ======================================================== -->
    <footer id="contacto" class="py-20 px-6 md:px-16 border-t border-[#232326] bg-[#09090a]">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="space-y-4 md:col-span-2">
                <span class="font-serif text-2xl font-bold tracking-widest text-[#f5f5f3]">FREDOSIS</span>
                <p class="text-xs text-[#8e8e93] max-w-md leading-relaxed">
                    Atelier de Bellas Artes, Dibujo y Tatuaje Contemporáneo. Obras originales, láminas giclée de conservación y sesiones privadas en Santiago Centro, Chile.
                </p>
                <div class="pt-2 text-xs text-[#d8c49d] flex items-center gap-2">
                    <span>📍 Metro Santa Ana, Santiago Centro, Región Metropolitana</span>
                </div>
            </div>

            <div class="space-y-3">
                <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">Navegación</span>
                <ul class="space-y-2 text-xs text-[#8e8e93]">
                    <li><a href="{{ route('portfolio') }}" class="hover:text-white transition-colors">Portafolio de Obras</a></li>
                    <li><a href="{{ route('shop') }}" class="hover:text-white transition-colors">Tienda de Dibujos & Láminas</a></li>
                    <li><a href="{{ route('booking') }}" class="hover:text-white transition-colors">Agenda de Tatuajes</a></li>
                    <li><a href="{{ route('checkout') }}" class="hover:text-white transition-colors">Pasarela de Pago PayPal</a></li>
                    <li><a href="{{ route('admin.login') }}" class="hover:text-white transition-colors">Acceso de Administración</a></li>
                </ul>
            </div>

            <div class="space-y-3">
                <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">Contacto Directo</span>
                <ul class="space-y-2 text-xs text-[#8e8e93]">
                    <li>Email: <a href="mailto:contacto@fredosis.art" class="hover:text-white transition-colors">contacto@fredosis.art</a></li>
                    <li>WhatsApp: <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappPhone) }}" target="_blank" class="hover:text-white transition-colors">{{ $whatsappPhone }}</a></li>
                    <li>Atención: Martes a Sábado (11:00 a 20:00 hrs)</li>
                    <li>Medios de pago: PayPal, Transferencia bancaria, Tarjetas</li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto pt-12 mt-12 border-t border-[#232326]/60 flex flex-col sm:flex-row items-center justify-between text-xs text-[#555] gap-4">
            <p>© 2026 FREDOSIS. Todos los derechos reservados.</p>
            <p>Inspirado en la estética de bellas artes de Miles Johnston.</p>
        </div>
    </footer>

@endsection
