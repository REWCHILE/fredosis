@extends('layouts.app')

@section('title', "Sobre Mí — Sebastián, El Farfo")

@section('content')
<main class="bg-background">
    {{-- Hero & Trayectoria Section with Cinematic Video Background --}}
    <section class="relative overflow-hidden pt-32 pb-24 border-b border-border/40">
        {{-- Video Background --}}
        <div class="absolute inset-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <video
                autoplay
                muted
                loop
                playsinline
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 min-w-full min-h-full w-auto h-auto object-cover opacity-20 select-none"
                poster="{{ asset('videos/about/about_2.jpg') }}"
            >
                <source src="{{ asset('videos/about/about_2.mp4') }}" type="video/mp4">
            </video>

            {{-- Vignette and Ambient Gradient Overlays for High Contrast & Legibility --}}
            <div class="absolute inset-0 bg-gradient-to-b from-background via-background/85 to-background"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,transparent_0%,var(--background)_80%)] opacity-95"></div>
            <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-accent/5 rounded-full blur-[140px] pointer-events-none"></div>
        </div>

        {{-- Compact Container: Max-w-6xl for tighter, balanced editorial layout --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
            {{-- Hero Header --}}
            <div class="max-w-3xl mb-16 text-left">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full border border-accent/30 bg-accent/10 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent animate-ping"></span>
                    <span class="text-accent uppercase tracking-[0.3em] text-[10px] font-black">Artista Visual & Tatuador</span>
                </div>
                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-serif font-black uppercase tracking-tight mb-6 italic leading-[0.95]">
                    Sebastián, <span class="text-accent">El Farfo</span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg text-muted font-medium leading-relaxed uppercase tracking-wider">
                    De Profesor de Artes a Tatuador Profesional: Una evolución natural impulsada por la pasión y la técnica.
                </p>
            </div>

            {{-- Grid: Artist Portrait + Trayectoria + Why choose Sebastian card --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 items-start">
                
                {{-- Col 1: Sebastián Farfán Official Portrait Card (4 cols on lg) --}}
                <div class="lg:col-span-4 space-y-4">
                    <div class="relative group rounded-xl overflow-hidden border border-accent/30 bg-surface/80 backdrop-blur-md shadow-2xl p-2.5">
                        {{-- Ambient Gold Glow behind image --}}
                        <div class="absolute -inset-1 bg-gradient-to-t from-accent/20 to-transparent rounded-xl blur-lg opacity-40 group-hover:opacity-75 transition-opacity"></div>
                        
                        <div class="relative overflow-hidden rounded-lg aspect-[4/5] bg-black">
                            <img 
                                src="{{ asset('images/about/sebastian_farfan_clean.jpg') }}" 
                                alt="Sebastián Farfán - El Farfo" 
                                class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-85"></div>
                            <div class="absolute bottom-3 left-3 right-3 text-left">
                                <span class="text-[9px] uppercase tracking-[0.25em] text-accent font-black block">Farfos Tattoo Studio</span>
                                <h4 class="text-base font-serif font-bold text-white uppercase italic">Sebastián Farfán</h4>
                                <p class="text-[10px] text-muted tracking-wide mt-0.5">Santiago & Puerto Montt · Chile</p>
                            </div>
                        </div>

                        {{-- Badges below portrait --}}
                        <div class="pt-3 pb-1 px-2 space-y-2 border-t border-white/5 mt-2">
                            <div class="flex items-center gap-2 text-[11px] text-muted">
                                <i data-lucide="award" class="w-3.5 h-3.5 text-accent shrink-0"></i>
                                <span class="font-medium text-foreground/90">Profesor de Artes Visuales <span class="text-muted">(UMCE)</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-[11px] text-muted">
                                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-accent shrink-0"></i>
                                <span class="font-medium text-foreground/90">Magíster en Estudios de la Imagen <span class="text-muted">(UAH)</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Col 2: Trayectoria & Filosofía (4 cols on lg) --}}
                <div class="lg:col-span-4 space-y-6 bg-surface/50 backdrop-blur-md p-6 sm:p-7 rounded-xl border border-white/5">
                    <div class="space-y-3">
                        <h2 class="text-2xl font-serif font-bold uppercase italic tracking-tight text-white flex items-center gap-2">
                            <span class="w-1.5 h-5 bg-accent inline-block"></span>
                            Mi Trayectoria
                        </h2>
                        <p class="text-muted leading-relaxed text-xs sm:text-sm">
                            Comencé mi camino en el arte como <strong class="text-foreground">Profesor de Artes Visuales (UMCE)</strong>, profundizando luego en la pintura con un diplomado en la <strong class="text-foreground">Pontificia Universidad Católica</strong> y culminando con un <strong class="text-foreground">Magíster en Estudios de la Imagen en la Universidad Alberto Hurtado</strong>.
                        </p>
                        <p class="text-muted leading-relaxed text-xs sm:text-sm">
                            Toda esta formación académica ha nutrido profundamente mi visión estética y conceptual del tatuaje. Hoy, canalizo ese conocimiento en cada diseño, buscando dar sentido a las imágenes que acompañarán a cada persona de por vida.
                        </p>
                    </div>

                    <div class="space-y-3 pt-4 border-t border-border/60">
                        <h3 class="text-xl font-serif font-bold uppercase italic tracking-tight text-white flex items-center gap-2">
                            <span class="w-1.5 h-5 bg-accent inline-block"></span>
                            Arte y Pasión
                        </h3>
                        <p class="text-muted leading-relaxed text-xs sm:text-sm">
                            Trabajo profesionalmente como tatuador en Santiago de Chile, ofreciendo diseños personalizados que nacen del diálogo con cada cliente. Un tatuaje debe integrarse a la anatomía y cargarse de intención.
                        </p>
                        <p class="text-muted leading-relaxed text-xs sm:text-sm">
                            Busco reconectar con el <strong class="text-foreground">carácter ritual del tatuaje</strong>, entendiendo la piel como un soporte significativo.
                        </p>
                    </div>

                    {{-- Counters --}}
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-border/60">
                        <div>
                            <p class="text-3xl font-serif font-black text-accent mb-0.5">150+</p>
                            <p class="text-[9px] uppercase font-bold tracking-[0.2em] text-muted">Clientes Satisfechos</p>
                        </div>
                        <div>
                            <p class="text-3xl font-serif font-black text-accent mb-0.5">600+</p>
                            <p class="text-[9px] uppercase font-bold tracking-[0.2em] text-muted">Arte Único</p>
                        </div>
                    </div>
                </div>

                {{-- Col 3: Why choose Sebastian card (4 cols on lg) --}}
                <div class="lg:col-span-4 bg-surface/90 backdrop-blur-xl p-6 sm:p-7 rounded-xl border border-accent/20 shadow-2xl space-y-5 sticky top-28">
                    <h3 class="text-base sm:text-lg font-serif font-bold uppercase tracking-widest text-foreground pb-3 border-b border-border">
                        ¿Por qué tatuarte conmigo?
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex gap-3.5 items-start">
                            <div class="w-10 h-10 shrink-0 border border-accent/40 rounded-lg flex items-center justify-center text-accent bg-background/80">
                                <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="font-bold uppercase text-[11px] tracking-wider mb-0.5 font-serif italic text-accent">
                                    Formación Académica
                                </h4>
                                <p class="text-[11px] text-muted leading-relaxed">
                                    Visión estética respaldada por años de estudio formal en artes visuales e imagen.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3.5 items-start">
                            <div class="w-10 h-10 shrink-0 border border-accent/40 rounded-lg flex items-center justify-center text-accent bg-background/80">
                                <i data-lucide="palette" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="font-bold uppercase text-[11px] tracking-wider mb-0.5 font-serif italic text-accent">
                                    Diseño Autoral
                                </h4>
                                <p class="text-[11px] text-muted leading-relaxed">
                                    Cada pieza es única, diseñada específicamente para tu anatomía y mensaje.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3.5 items-start">
                            <div class="w-10 h-10 shrink-0 border border-accent/40 rounded-lg flex items-center justify-center text-accent bg-background/80">
                                <i data-lucide="heart" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="font-bold uppercase text-[11px] tracking-wider mb-0.5 font-serif italic text-accent">
                                    Compromiso Ético
                                </h4>
                                <p class="text-[11px] text-muted leading-relaxed">
                                    Máximos estándares de higiene, bioseguridad y atención personalizada.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-white/5">
                        <a 
                            href="{{ route('booking') }}" 
                            class="block w-full text-center bg-accent text-accent-foreground py-3.5 rounded-lg text-[10px] font-black uppercase tracking-[0.25em] hover:bg-accent/90 transition-all shadow-xl hover:shadow-[0_0_20px_rgba(212,175,55,0.3)]"
                        >
                            Reserva tu Sesión Ahora
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Featured Works Gallery Section (From Farfo's Latest Post) --}}
    <section class="py-20 border-b border-border/40 bg-surface/30 relative" x-data="{
        activeImg: null,
        works: [
            '{{ asset('images/about/works/work_01.jpg') }}',
            '{{ asset('images/about/works/work_02.jpg') }}',
            '{{ asset('images/about/works/work_03.jpg') }}',
            '{{ asset('images/about/works/work_04.jpg') }}',
            '{{ asset('images/about/works/work_05.jpg') }}',
            '{{ asset('images/about/works/work_06.jpg') }}',
            '{{ asset('images/about/works/work_07.jpg') }}',
            '{{ asset('images/about/works/work_08.jpg') }}',
            '{{ asset('images/about/works/work_09.jpg') }}',
            '{{ asset('images/about/works/work_10.jpg') }}',
            '{{ asset('images/about/works/work_11.jpg') }}',
            '{{ asset('images/about/works/work_12.jpg') }}',
            '{{ asset('images/about/works/work_13.jpg') }}',
            '{{ asset('images/about/works/work_14.jpg') }}'
        ]
    }">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-accent/30 bg-accent/10">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5 text-accent"></i>
                        <span class="text-accent uppercase tracking-[0.3em] text-[10px] font-black">Selección Autoral</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-serif font-black uppercase tracking-tight text-foreground">
                        Obras Recientes & <span class="text-accent italic">Tatuajes de Autor</span>
                    </h2>
                    <p class="text-muted text-xs uppercase tracking-[0.18em] font-semibold">
                        Fotografías del portafolio más reciente de Sebastián en gira y estudio. Haz clic en cualquiera para ampliarla.
                    </p>
                </div>

                <a 
                    href="https://www.instagram.com/farfos_tattoo/p/DdHBjVulkjV/" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 text-xs uppercase tracking-widest text-accent hover:text-accent/80 font-bold border border-accent/30 px-4 py-2.5 rounded-md bg-accent/5 hover:bg-accent/10 transition-all self-start md:self-auto shrink-0"
                >
                    <i data-lucide="instagram" class="w-4 h-4"></i>
                    Ver Post en Instagram
                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            {{-- Grid of Works --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-3 sm:gap-4">
                <template x-for="(img, idx) in works" :key="idx">
                    <div 
                        @click="activeImg = img; $nextTick(() => { if (window.lucide) window.lucide.createIcons(); })"
                        class="group relative aspect-[3/4] rounded-lg overflow-hidden border border-border/80 hover:border-accent/80 bg-card cursor-pointer transition-all duration-300 shadow-md hover:shadow-[0_0_15px_rgba(212,175,55,0.25)]"
                    >
                        <img 
                            :src="img" 
                            :alt="'Tatuaje de autor por Sebastián Farfán ' + (idx + 1)"
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-2.5">
                            <span class="text-[9px] uppercase tracking-wider font-bold text-accent flex items-center gap-1">
                                <i data-lucide="maximize-2" class="w-3 h-3"></i> Ampliar
                            </span>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Lightbox Modal --}}
            <div 
                x-show="activeImg" 
                x-transition.opacity
                style="display: none;"
                @click.self="activeImg = null"
                @keydown.escape.window="activeImg = null"
                class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md flex items-center justify-center p-4"
            >
                <div class="relative max-w-xl w-full max-h-[90vh] flex flex-col items-center">
                    <button 
                        @click="activeImg = null" 
                        class="absolute -top-12 right-0 text-white hover:text-accent p-2 transition-colors cursor-pointer"
                        title="Cerrar"
                    >
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                    <img 
                        :src="activeImg" 
                        alt="Detalle de obra Farfos Tattoo" 
                        class="max-h-[80vh] w-auto rounded-lg border border-accent/40 shadow-2xl object-contain"
                    />
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        {{-- Video Reels & Filosofía Section --}}
        <section 
            id="filosofia-reels"
            x-data="{
                activeReel: 0,
                videoPlaying: true,
                reels: [
                    {
                        id: '01',
                        title: 'Ilustración Digital & Flashes de Autor',
                        category: 'Génesis Creativa',
                        tag: 'Bocetaje Digital',
                        desc: 'Todo tatuaje nace en el trazo libre: Sebastián diseña e ilustra cada pieza desde lo digital, explorando simetría, color y composición anatómica antes de llevar la aguja a la piel.',
                        video: '{{ asset('videos/about/about_6.mp4') }}',
                        poster: '{{ asset('videos/about/about_6.jpg') }}',
                        instagram: 'https://www.instagram.com/reel/C_LLaT_OjTd/',
                        quote: 'El dibujo digital es la cocina de la idea: donde la libertad visual encuentra la armonía perfecta con el cuerpo.'
                    },
                    {
                        id: '02',
                        title: 'El Origen del Tatuaje',
                        category: 'Filosofía de Creación',
                        tag: 'Bocetaje & Diálogo',
                        desc: 'No todos los tatuajes parten en la piel: algunos comienzan en una conversación profunda, traduciendo memorias, ideas y significados en bocetos de autor.',
                        video: '{{ asset('videos/about/about_2.mp4') }}',
                        poster: '{{ asset('videos/about/about_2.jpg') }}',
                        instagram: 'https://www.instagram.com/reel/DXxpPD1v37T/',
                        quote: 'El diálogo consciente con el cliente es la verdadera matriz de una obra irrepetible.'
                    },
                    {
                        id: '03',
                        title: 'Sin Encasillarme: Múltiples Estilos',
                        category: 'Estilos & Dominio',
                        tag: 'Versatilidad Artística',
                        desc: 'No tengo un solo estilo porque nunca he sido de encasillarme. Blackwork, Realismo, Anime y Cover Up convergen bajo un mismo estándar de rigor y pulcritud.',
                        video: '{{ asset('videos/about/about_4.mp4') }}',
                        poster: '{{ asset('videos/about/about_4.jpg') }}',
                        instagram: 'https://www.instagram.com/reel/DMu8O6xuLgg/',
                        quote: 'La maestría no consiste en repetir una fórmula, sino en dominar los fundamentos para crear libremente.'
                    },
                    {
                        id: '04',
                        title: 'La Batalla del Tattoo en Santiago',
                        category: 'Competición en Vivo',
                        tag: 'Evento & Técnica',
                        desc: 'Viví una de esas experiencias que te recuerdan por qué amas lo que haces. Creación bajo presión, técnica pura y pasión frente al público en La Batalla del Tattoo.',
                        video: '{{ asset('videos/about/about_1.mp4') }}',
                        poster: '{{ asset('videos/about/about_1.jpg') }}',
                        instagram: 'https://www.instagram.com/reel/DQ5WD0XD0Fl/',
                        quote: 'Cuando la adrenalina y la disciplina formal se encuentran en cada línea sobre la piel.'
                    },
                    {
                        id: '05',
                        title: 'El Dolor en el Tatuaje',
                        category: 'Ritual y Biología',
                        tag: 'Conciencia Corporal',
                        desc: 'El dolor no es tu enemigo: es la señal de que tu cuerpo despierta, tu sistema inmune se activa y la experiencia se graba en tu memoria física y espiritual.',
                        video: '{{ asset('videos/about/about_3.mp4') }}',
                        poster: '{{ asset('videos/about/about_3.jpg') }}',
                        instagram: 'https://www.instagram.com/reel/DNWj1ycvoJF/',
                        quote: 'Traspasar la barrera del dolor transforma el acto de tatuarse en un rito de paso personal.'
                    },
                    {
                        id: '06',
                        title: 'En el Estudio: Visión y Método',
                        category: 'Experiencia Farfo',
                        tag: 'La Sesión',
                        desc: 'Sebastián reflexiona directamente desde su estudio sobre lo que sucede en cada sesión: la calma, el respeto por el lienzo humano y la intención puesta en la aguja.',
                        video: '{{ asset('videos/about/about_5.mp4') }}',
                        poster: '{{ asset('videos/about/about_5.jpg') }}',
                        instagram: 'https://www.instagram.com/reel/DMf6SBsxG1_/',
                        quote: 'El estudio es un espacio de concentración y respeto donde tu historia cobra vida eterna.'
                    }
                ],
                selectReel(index) {
                    this.activeReel = index;
                    this.videoPlaying = true;
                    this.$nextTick(() => {
                        if (this.$refs.aboutVideo) {
                            this.$refs.aboutVideo.load();
                            this.$refs.aboutVideo.play().catch(() => {});
                        }
                        if (window.lucide) {
                            window.lucide.createIcons({ icons: window.lucide.icons });
                        }
                    });
                },
                nextReel() {
                    this.selectReel((this.activeReel + 1) % this.reels.length);
                },
                prevReel() {
                    this.selectReel((this.activeReel - 1 + this.reels.length) % this.reels.length);
                },
                toggleVideo() {
                    if (!this.$refs.aboutVideo) return;
                    if (this.$refs.aboutVideo.paused) {
                        this.$refs.aboutVideo.play();
                        this.videoPlaying = true;
                    } else {
                        this.$refs.aboutVideo.pause();
                        this.videoPlaying = false;
                    }
                },
                init() {
                    this.$nextTick(() => {
                        if (this.$refs.aboutVideo) {
                            this.$refs.aboutVideo.play().catch(() => {});
                        }
                        if (window.lucide) {
                            window.lucide.createIcons({ icons: window.lucide.icons });
                        }
                    });
                }
            }"
            class="mt-32 pt-20 border-t border-border/50 relative"
        >
            {{-- Header --}}
            <div class="max-w-3xl mb-14 space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-accent/30 bg-accent/10">
                    <i data-lucide="video" class="w-3.5 h-3.5 text-accent animate-pulse"></i>
                    <span class="text-accent uppercase tracking-[0.35em] text-[10px] font-black">La Voz del Artista</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-serif font-black uppercase tracking-tight text-foreground leading-[1.05]">
                    Reflexiones, Método & <span class="text-accent italic">Sesiones en Vivo</span>
                </h2>
                <p class="text-muted text-xs uppercase tracking-[0.18em] font-semibold leading-relaxed">
                    Seis miradas directas sobre la génesis creativa en dibujo digital, la filosofía de trabajo, el manejo del dolor, la versatilidad de estilos y el ritual del tatuaje según Sebastián.
                </p>
            </div>

            {{-- Interactive Spotlight Grid: Video Player + Playlist --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                {{-- Left: Active Vertical Reel Spotlight with Gold Wave Border (5 cols on lg) --}}
                <div class="lg:col-span-5 flex flex-col justify-start">
                    <div class="relative w-full max-w-[420px] mx-auto">
                        
                        {{-- Ambient Brand Golden Wave Breathing in Background --}}
                        <div class="absolute -inset-3 bg-gradient-to-tr from-accent/20 via-accent/35 to-accent/10 rounded-[32px] blur-xl opacity-60 animate-gold-wave pointer-events-none"></div>

                        {{-- Encapsulated Luxury Frame with Animated Golden Border Wave --}}
                        <div class="relative p-[2.5px] rounded-[28px] overflow-hidden shadow-[0_25px_60px_rgba(0,0,0,0.95)] border border-accent/40">
                            
                            {{-- Rotating Golden Conic Wave --}}
                            <div class="absolute -inset-[150%] bg-[conic-gradient(from_0deg_at_50%_50%,transparent_0deg,transparent_75deg,rgba(212,175,55,0.1)_105deg,rgba(212,175,55,0.95)_135deg,rgba(255,245,190,1)_150deg,rgba(212,175,55,0.95)_165deg,rgba(212,175,55,0.1)_195deg,transparent_225deg)] animate-spin-slow pointer-events-none"></div>

                            {{-- Inner Chassis --}}
                            <div class="relative bg-black rounded-[26px] overflow-hidden flex flex-col border border-white/5">
                                
                                {{-- Top Badge Bar --}}
                                <div class="px-4 py-3 bg-black/90 backdrop-blur-md border-b border-white/10 flex items-center justify-between z-20">
                                    <div class="flex items-center gap-2">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-accent"></span>
                                        </span>
                                        <span class="text-[10px] uppercase tracking-[0.2em] font-black text-accent truncate" x-text="reels[activeReel].tag"></span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-mono tracking-widest text-muted">
                                            <span class="text-accent font-bold" x-text="'0' + (activeReel + 1)"></span>/0<span x-text="reels.length"></span>
                                        </span>
                                        <a 
                                            :href="reels[activeReel].instagram"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="text-muted hover:text-accent p-1 transition-colors"
                                            title="Ver reel original en Instagram"
                                        >
                                            <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                                        </a>
                                    </div>
                                </div>

                                {{-- Reel Video Viewport --}}
                                <div class="relative aspect-[9/16] bg-card overflow-hidden group/video flex items-center justify-center">
                                    <video
                                        x-ref="aboutVideo"
                                        :src="reels[activeReel].video"
                                        :poster="reels[activeReel].poster"
                                        autoplay
                                        muted
                                        loop
                                        playsinline
                                        class="w-full h-full object-cover group-hover/video:scale-105 transition-transform duration-700"
                                    ></video>

                                    {{-- Vignette Overlay --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-transparent to-black/30 pointer-events-none"></div>

                                    {{-- Arrows Overlay --}}
                                    <button
                                        @click="prevReel()"
                                        class="absolute left-3 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-full bg-black/80 border border-white/20 text-white hover:border-accent hover:text-accent hover:scale-110 flex items-center justify-center backdrop-blur-md shadow-lg transition-all focus:outline-none cursor-pointer"
                                        title="Anterior"
                                    >
                                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                    </button>

                                    <button
                                        @click="nextReel()"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-full bg-black/80 border border-white/20 text-white hover:border-accent hover:text-accent hover:scale-110 flex items-center justify-center backdrop-blur-md shadow-lg transition-all focus:outline-none cursor-pointer"
                                        title="Siguiente"
                                    >
                                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                    </button>

                                    {{-- Play/Pause Button --}}
                                    <button
                                        @click="toggleVideo()"
                                        class="absolute bottom-4 right-4 z-20 w-10 h-10 rounded-full bg-black/85 border border-accent/40 text-accent flex items-center justify-center hover:scale-110 hover:bg-accent hover:text-accent-foreground transition-all backdrop-blur-md shadow-lg focus:outline-none cursor-pointer"
                                        :title="videoPlaying ? 'Pausar' : 'Reproducir'"
                                    >
                                        <i :data-lucide="videoPlaying ? 'pause' : 'play'" class="w-4 h-4"></i>
                                    </button>

                                    {{-- Title Tag --}}
                                    <div class="absolute bottom-4 left-4 z-20 max-w-[70%] bg-black/85 backdrop-blur-sm border border-white/10 px-3 py-1.5 text-[10px] uppercase tracking-wider text-foreground/90 font-bold flex items-center gap-1.5">
                                        <i data-lucide="video" class="w-3 h-3 text-accent shrink-0"></i>
                                        <span class="truncate" x-text="reels[activeReel].title"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Playlist & Reflection Details (7 cols on lg) --}}
                <div class="lg:col-span-7 flex flex-col justify-start space-y-5">
                    
                    {{-- Active Reel Details Card --}}
                    <div class="bg-surface border border-border/80 p-6 sm:p-7 relative overflow-hidden shadow-xl space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-accent text-[10px] uppercase tracking-[0.3em] font-black" x-text="reels[activeReel].category"></span>
                            <a 
                                :href="reels[activeReel].instagram" 
                                target="_blank" 
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-1.5 text-[11px] uppercase tracking-widest text-muted hover:text-accent font-bold transition-colors"
                            >
                                <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
                                Ver en Instagram
                                <i data-lucide="arrow-up-right" class="w-3 h-3"></i>
                            </a>
                        </div>

                        <h3 class="text-2xl sm:text-3xl font-serif font-black uppercase tracking-tight text-foreground" x-text="reels[activeReel].title"></h3>
                        <p class="text-xs sm:text-sm text-foreground/80 leading-relaxed font-sans" x-text="reels[activeReel].desc"></p>

                        <div class="p-3.5 bg-background/70 border-l-2 border-accent space-y-1">
                            <div class="text-accent text-[10px] uppercase tracking-widest font-black flex items-center gap-1.5">
                                <i data-lucide="quote" class="w-3 h-3"></i> Sebastián · El Farfo
                            </div>
                            <p class="text-xs italic text-foreground/90 leading-relaxed" x-text="reels[activeReel].quote"></p>
                        </div>
                    </div>

                    {{-- Playlist of 6 Videos --}}
                    <div class="space-y-2">
                        <div class="text-[10px] uppercase tracking-[0.25em] text-accent font-black mb-2 flex items-center gap-2">
                            <i data-lucide="list-video" class="w-3.5 h-3.5"></i>
                            Serie de Videos (6 Capítulos)
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <template x-for="(reel, index) in reels" :key="index">
                                <button
                                    @click="selectReel(index)"
                                    :class="activeReel === index 
                                        ? 'bg-accent/15 border-accent text-accent shadow-[0_0_15px_rgba(212,175,55,0.2)]' 
                                        : 'bg-card/70 border-border/70 text-foreground/70 hover:border-accent/40 hover:text-foreground'"
                                    class="p-3 border text-left transition-all duration-300 flex items-start gap-3 group focus:outline-none cursor-pointer"
                                >
                                    <span 
                                        :class="activeReel === index ? 'text-accent font-black' : 'text-muted font-bold'"
                                        class="text-xs font-mono shrink-0 pt-0.5" 
                                        x-text="reel.id"
                                    ></span>
                                    <div class="min-w-0 flex-1">
                                        <h5 class="text-xs font-serif font-bold uppercase truncate" x-text="reel.title"></h5>
                                        <p class="text-[10px] text-muted truncate uppercase tracking-wider mt-0.5" x-text="reel.category"></p>
                                    </div>
                                    <span :class="activeReel === index ? 'bg-accent text-accent-foreground' : 'bg-border text-muted'" class="w-5 h-5 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="play" class="w-2.5 h-2.5 fill-current"></i>
                                    </span>
                                </button>
                            </template>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
</main>
@endsection
