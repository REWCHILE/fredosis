@extends('layouts.app')

@section('title', 'Prensa & Reconocimientos Internacionales — Wladimir Inostroza (Fredo) | FREDOSIS')
@section('meta_description', 'Apariciones en The Sun, Daily Mail, el libro mundial Ripley\'s Believe It or Not! (pág. 221), TVN y el documental sobre Tool "The Holy Gift". Trayectoria y maestría del artista chileno.')

@section('content')

    <section class="py-16 md:py-24 px-6 md:px-16 max-w-7xl mx-auto space-y-16">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-semibold">Media & Global Recognition</span>
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#f5f5f3] tracking-tight">
                Prensa & Cobertura Internacional
            </h1>
            <p class="text-xs md:text-sm text-[#8e8e93] leading-relaxed">
                El trabajo de <strong>Wladimir Inostroza ("Fredo" / "Fredosis")</strong> revolucionó la escena artística internacional con sus dibujos de ilusión 3D y anamorfosis sobre papel plano, siendo documentado por los principales medios editoriales del mundo.
            </p>
        </div>

        <!-- Featured Media Graphic Banner -->
        <div class="bg-[#121214] border border-[#232326] rounded-2xl overflow-hidden shadow-2xl relative group">
            <img 
                src="{{ asset('images/press/prensa.jpg') }}" 
                alt="Prensa internacional - Ripley's Believe It or Not, Daily Mail, TVN, The Holy Gift" 
                class="w-full h-auto object-cover max-h-[550px] w-full mx-auto"
                loading="lazy"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-8">
                <div class="space-y-1 text-white">
                    <p class="text-xs font-mono uppercase tracking-widest text-[#d8c49d]">Archivo Histórico de Publicaciones</p>
                    <p class="text-sm text-[#ccc]">De Santiago de Chile al circuito mediático de Londres, Nueva York y festivales internacionales.</p>
                </div>
            </div>
        </div>

        <!-- Press Clippings Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- 1. The Sun -->
            <div class="bg-[#141416] border border-[#26262a] rounded-2xl p-8 flex flex-col justify-between hover:border-[#d8c49d]/50 transition-all shadow-xl">
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-[#232326] pb-3">
                        <span class="font-serif font-bold text-lg text-[#f5f5f3]">The Sun</span>
                        <span class="text-[11px] font-mono text-[#888]">Reino Unido • 2011</span>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#d8c49d] leading-snug">
                        "Artist's amazing 3D images"
                    </h3>
                    <p class="text-xs text-[#777] font-mono">Por Alison Maloney</p>
                    <blockquote class="text-xs text-[#a6a6aa] leading-relaxed italic border-l-2 border-[#d8c49d] pl-3 py-1">
                        "A YOUNG artist is making a huge impression on the art world with his 3D drawings. The incredible pictures by Chilean etcher Fredo were drawn using only pencil and paper and seem to jump out of the page..."
                    </blockquote>
                    <p class="text-xs text-[#8e8e93] leading-relaxed">
                        El diario británico destacó cómo a sus tempranos 20 años, Wladimir descubrió la técnica anamórfica de manera intuitiva mientras dibujaba en su habitación en Santiago, logrando que sus figuras parecieran flotar físicamente fuera del plano.
                    </p>
                </div>
            </div>

            <!-- 2. Daily Mail -->
            <div class="bg-[#141416] border border-[#26262a] rounded-2xl p-8 flex flex-col justify-between hover:border-[#d8c49d]/50 transition-all shadow-xl">
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-[#232326] pb-3">
                        <span class="font-serif font-bold text-lg text-[#f5f5f3]">Daily Mail</span>
                        <span class="text-[11px] font-mono text-[#888]">Reino Unido • 2011</span>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#d8c49d] leading-snug">
                        "The incredible 3D images that pop off the page... created with just a pencil and paper"
                    </h3>
                    <p class="text-xs text-[#777] font-mono">Por Lee Moran</p>
                    <blockquote class="text-xs text-[#a6a6aa] leading-relaxed italic border-l-2 border-[#d8c49d] pl-3 py-1">
                        "He's a modern day master making incredible 3D images that pop off the page - armed only with a pencil and a piece of paper. At just 20-years-old, Chilean artist Fredo is quickly captivating the online art world..."
                    </blockquote>
                    <p class="text-xs text-[#8e8e93] leading-relaxed">
                        Extenso reportaje fotográfico analizando sus técnicas de esfumado, sombreado graduado en carboncillo y el dominio de la perspectiva forzada.
                    </p>
                </div>
            </div>

            <!-- 3. Ripley's Believe It or Not! -->
            <div class="bg-[#141416] border border-[#26262a] rounded-2xl p-8 flex flex-col justify-between hover:border-[#d8c49d]/50 transition-all shadow-xl">
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-[#232326] pb-3">
                        <span class="font-serif font-bold text-lg text-[#f5f5f3]">Ripley's Believe It or Not!</span>
                        <span class="text-[11px] font-mono text-[#888]">Libro Oficial • Pág. 221</span>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#d8c49d] leading-snug">
                        "Deep Drawings" (Inside Strikingly True)
                    </h3>
                    <p class="text-xs text-[#777] font-mono">Anuario de Récords y Prodigios Globales</p>
                    <blockquote class="text-xs text-[#a6a6aa] leading-relaxed italic border-l-2 border-[#d8c49d] pl-3 py-1">
                        "Chilean artist Fredo creates mind-boggling 3-D pencil drawings that appear to rise out of the page. Despite its 3-D appearance, all his work is pencil on flat paper..."
                    </blockquote>
                    <p class="text-xs text-[#8e8e93] leading-relaxed">
                        Publicado en el icónico compendio de curiosidades y genialidades humanas de Ripley's, reconociendo su precocidad y virtuosismo desde los 17 años.
                    </p>
                </div>
            </div>

            <!-- 4. TVN Chile -->
            <div class="bg-[#141416] border border-[#26262a] rounded-2xl p-8 flex flex-col justify-between hover:border-[#d8c49d]/50 transition-all shadow-xl">
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-[#232326] pb-3">
                        <span class="font-serif font-bold text-lg text-[#f5f5f3]">TVN (Televisión Nacional)</span>
                        <span class="text-[11px] font-mono text-[#888]">Chile • 2013</span>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#d8c49d] leading-snug">
                        "Fredo Art, el joven prodigio del arte 3D"
                    </h3>
                    <p class="text-xs text-[#777] font-mono">Noticiero Central / Especial Cultural</p>
                    <blockquote class="text-xs text-[#a6a6aa] leading-relaxed italic border-l-2 border-[#d8c49d] pl-3 py-1">
                        "Un talento nacional que traspasó fronteras sin más herramientas que hojas blancas y barras de grafito, convirtiendo a Santiago en foco de asombro global."
                    </blockquote>
                    <p class="text-xs text-[#8e8e93] leading-relaxed">
                        Reportaje televisivo en horario estelar donde Fredo demostró frente a las cámaras el proceso en vivo de construcción de volumen geométrico e ilusión anamórfica.
                    </p>
                </div>
            </div>

            <!-- 5. The Holy Gift (Documental Tool) -->
            <div class="bg-[#141416] border border-[#26262a] rounded-2xl p-8 flex flex-col justify-between hover:border-[#d8c49d]/50 transition-all shadow-xl md:col-span-2 lg:col-span-2">
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-[#232326] pb-3">
                        <span class="font-serif font-bold text-lg text-[#f5f5f3]">The Holy Gift (Documentary)</span>
                        <span class="text-[11px] font-mono text-[#888]">Cine Documental Internacional</span>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#d8c49d] leading-snug">
                        Aparición en el Documental Oficial sobre la banda TOOL y el Arte Visionario
                    </h3>
                    <p class="text-xs text-[#777] font-mono">www.theholygift.com</p>
                    <blockquote class="text-xs text-[#a6a6aa] leading-relaxed italic border-l-2 border-[#d8c49d] pl-3 py-1">
                        "Participación destacada junto a creadores de diversas latitudes explorando la trascendencia espiritual, el ocultismo psicológico, la geometría sagrada y la metamorfosis del cuerpo en las artes visuales contemporáneas."
                    </blockquote>
                    <p class="text-xs text-[#8e8e93] leading-relaxed">
                        Fredo fue seleccionado como uno de los artistas visuales de referencia en la confluencia entre surrealismo anatómico oscuro y el universo sonoro de Tool, mostrando sus pinturas al óleo y piezas de gran formato.
                    </p>
                </div>
            </div>
        </div>

        <!-- Conversion Call to Action -->
        <div class="p-10 rounded-2xl bg-gradient-to-r from-[#18181b] to-[#121214] border border-[#d8c49d]/30 flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl">
            <div class="space-y-2 text-center md:text-left">
                <h3 class="font-serif text-2xl font-bold text-white">¿Deseas adquirir una obra original o tatuarte con Fredo?</h3>
                <p class="text-xs text-[#8e8e93] max-w-xl">
                    Explora el catálogo de obras originales disponibles para envíos a todo el mundo o reserva tu sesión personalizada en nuestro estudio privado de Santiago Centro.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-4 shrink-0">
                <a href="{{ route('shop') }}" class="px-6 py-3 rounded-lg bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-wider transition-all shadow-md">
                    Ver Obras en Venta
                </a>
                <a href="{{ route('booking') }}" class="px-6 py-3 rounded-lg border border-[#2c2c30] text-white hover:border-[#d8c49d] hover:text-[#d8c49d] text-xs font-semibold uppercase tracking-wider transition-all">
                    Agendar Tatuaje
                </a>
            </div>
        </div>
    </section>

@endsection
