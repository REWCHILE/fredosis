@extends('layouts.app')

@section('title', 'Tu Primer Tatuaje en Chile — Guía de Preparación, Dolor y Diseño | FREDOSIS')
@section('meta_description', '¿Pensando en hacerte tu primer tatuaje? Descubre cómo preparar tu idea, el mapa de dolor por zonas del cuerpo, qué esperar en la sesión y cómo diseñar una pieza única con Fredosis.')

@section('structured_data')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'Article',
  'headline' => 'Guía Completa para tu Primer Tatuaje: Del Boceto a la Piel',
  'description' => 'Todo lo que necesitas saber antes de tu primera sesión de tatuaje: dolor por zonas, preparación, elección del diseño y cuidados esenciales.',
  'author' => [
    '@type' => 'Person',
    'name' => 'Wladimir Inostroza (Fredo / Fredosis)'
  ],
  'publisher' => [
    '@type' => 'Organization',
    'name' => 'FREDOSIS Atelier',
    'url' => 'https://fredosis.cl'
  ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection

@section('content')
<article class="py-16 md:py-24 px-6 md:px-16 max-w-5xl mx-auto space-y-16">
    <!-- Header -->
    <header class="text-center max-w-3xl mx-auto space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#18181b] border border-[#d8c49d]/30 text-xs text-[#d8c49d] font-mono tracking-wider">
            <span>GUÍA PARA PRIMERIZOS • ARTE DE AUTOR</span>
        </div>
        <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#f5f5f3] tracking-tight leading-tight">
            Tu Primer Tatuaje:<br>
            <span class="text-[#d8c49d] italic font-normal">Sin Miedos, Sin Clichés</span>
        </h1>
        <p class="text-sm md:text-base text-[#a6a6aa] leading-relaxed max-w-2xl mx-auto">
            Hacerte tu primer tatuaje no debería ser una experiencia intimidante ni genérica. En FREDOSIS convertimos tu concepto en una pieza artística personalizada que se adapta orgánicamente a las curvas y proporciones de tu cuerpo.
        </p>
    </header>

    <!-- Key Steps to your First Tattoo -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-[#121214] border border-[#232326] rounded-2xl p-6 space-y-3">
            <span class="text-xs font-mono text-[#d8c49d]">01 / CONCEPTO</span>
            <h3 class="font-serif text-lg font-bold text-white">Diseño Exclusivo</h3>
            <p class="text-xs text-[#8e8e93] leading-relaxed">
                Olvídate de copiar plantillas de Pinterest o Google. Diseñamos bocetos anatómicos únicos a partir de tus referencias y emociones.
            </p>
        </div>

        <div class="bg-[#121214] border border-[#232326] rounded-2xl p-6 space-y-3">
            <span class="text-xs font-mono text-[#d8c49d]">02 / PREPARACIÓN</span>
            <h3 class="font-serif text-lg font-bold text-white">Preparación Física</h3>
            <p class="text-xs text-[#8e8e93] leading-relaxed">
                Duerme 8 horas, toma desayuno contundente rico en carbohidratos para mantener niveles de glucosa estables e hidrata tu piel días antes.
            </p>
        </div>

        <div class="bg-[#121214] border border-[#232326] rounded-2xl p-6 space-y-3">
            <span class="text-xs font-mono text-[#d8c49d]">03 / SESIÓN</span>
            <h3 class="font-serif text-lg font-bold text-white">Espacio Privado</h3>
            <p class="text-xs text-[#8e8e93] leading-relaxed">
                Estudio privado e íntimo en Santiago Centro (Metro Santa Ana). Música relajante, pausas a tu ritmo y material 100% descartable estéril.
            </p>
        </div>
    </section>

    <!-- Pain Map Table / Breakdown -->
    <section class="space-y-6">
        <div class="border-b border-[#232326] pb-4">
            <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">UMBRAL DE SENSIBILIDAD</span>
            <h2 class="text-2xl md:text-3xl font-serif font-bold text-[#f5f5f3]">
                ¿Cuánto Duele? Mapa de Dolor por Zonas
            </h2>
            <p class="text-xs text-[#8e8e93] mt-1">
                La molestia es comparable a un rasguño continuo con una vibración cálida. El dolor varía según la densidad nerviosa y la proximidad al hueso:
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Low Pain -->
            <div class="bg-[#141416] border border-emerald-500/20 rounded-2xl p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-serif text-lg font-bold text-emerald-400">Nivel Leve / Cómodo</h3>
                    <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 text-[10px] font-bold">1 - 3 / 10</span>
                </div>
                <p class="text-xs text-[#a6a6aa]">Ideal para tu primera experiencia. Zonas carnosas y con menor densidad de terminaciones nerviosas:</p>
                <ul class="text-xs space-y-2 text-[#ededeb] list-disc list-inside">
                    <li>Antebrazo externo e interno</li>
                    <li>Parte externa del brazo (bíceps/tríceps)</li>
                    <li>Muslo frontal y lateral</li>
                    <li>Espalda alta (lejos de la columna)</li>
                </ul>
            </div>

            <!-- Medium Pain -->
            <div class="bg-[#141416] border border-amber-500/20 rounded-2xl p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-serif text-lg font-bold text-amber-400">Nivel Moderado</h3>
                    <span class="px-2 py-0.5 rounded bg-amber-500/10 text-amber-400 text-[10px] font-bold">4 - 6 / 10</span>
                </div>
                <p class="text-xs text-[#a6a6aa]">Molestia manejable con respiración controlada y pausas breves:</p>
                <ul class="text-xs space-y-2 text-[#ededeb] list-disc list-inside">
                    <li>Hombro y clavícula</li>
                    <li>Pantorrilla y gemelos</li>
                    <li>Muñeca superior</li>
                    <li>Pectoral o pecho</li>
                </ul>
            </div>

            <!-- Intense Pain -->
            <div class="bg-[#141416] border border-rose-500/20 rounded-2xl p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-serif text-lg font-bold text-rose-400">Nivel Intenso</h3>
                    <span class="px-2 py-0.5 rounded bg-rose-500/10 text-rose-400 text-[10px] font-bold">7 - 9 / 10</span>
                </div>
                <p class="text-xs text-[#a6a6aa]">Piel muy delgada y contacto directo sobre cartílago o hueso:</p>
                <ul class="text-xs space-y-2 text-[#ededeb] list-disc list-inside">
                    <li>Costillas y caja torácica</li>
                    <li>Estómago y abdomen</li>
                    <li>Empeine del pie y tobillo</li>
                    <li>Cuello, garganta y columna</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Checklist: The Day Before -->
    <section class="bg-[#121214] border border-[#232326] rounded-3xl p-8 md:p-12 space-y-6">
        <div class="space-y-2">
            <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">CHECKLIST OBLIGATORIO</span>
            <h2 class="text-2xl md:text-3xl font-serif font-bold text-white">
                Qué Hacer el Día Antes y el Día de tu Cita
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs md:text-sm text-[#a6a6aa]">
            <div class="space-y-3">
                <div class="flex items-start gap-3">
                    <span class="text-emerald-400 font-bold">✓</span>
                    <p><strong class="text-white">Aliméntate bien:</strong> Come una comida rica en proteínas y carbohidratos 1 a 2 horas antes de la sesión para evitar mareos por baja de azúcar.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-emerald-400 font-bold">✓</span>
                    <p><strong class="text-white">Ropa cómoda:</strong> Lleva prendas sueltas, oscuras y de fácil acceso a la zona del cuerpo a tatuar.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-emerald-400 font-bold">✓</span>
                    <p><strong class="text-white">Hidratación:</strong> Bebe bastante agua el día anterior para que la dermis reciba la aguja con máxima elasticidad.</p>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex items-start gap-3">
                    <span class="text-rose-400 font-bold">✕</span>
                    <p><strong class="text-white">Cero alcohol 24 horas antes:</strong> El alcohol adelgaza la sangre, provocando más sangrado y expulsión prematura de pigmento.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-rose-400 font-bold">✕</span>
                    <p><strong class="text-white">No tomes aspirinas:</strong> El ácido acetilsalicílico actúa como anticoagulante.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-rose-400 font-bold">✕</span>
                    <p><strong class="text-white">No rasures la zona con irritación:</strong> Si te da miedo cortarte, el artista rasurará la piel con navaja descartable esterilizada en el estudio.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="text-center space-y-6 pt-4">
        <h2 class="text-3xl md:text-4xl font-serif font-bold text-white">
            ¿Listo para dar el primer paso?
        </h2>
        <p class="text-xs md:text-sm text-[#8e8e93] max-w-md mx-auto">
            Cuéntanos tu idea o elige uno de los diseños exclusivos disponibles en nuestro catálogo flash.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a 
                href="{{ route('booking') }}" 
                class="px-8 py-4 rounded-xl bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-widest transition-all shadow-xl hover:scale-105"
            >
                Cotizar Mi Primer Tatuaje
            </a>
            <a 
                href="{{ route('flash.index') }}" 
                class="px-8 py-4 rounded-xl border border-[#333] hover:border-[#d8c49d] text-white hover:text-[#d8c49d] font-semibold text-xs uppercase tracking-wider transition-all"
            >
                Ver Diseños Flash Disponibles
            </a>
        </div>
    </section>
</article>
@endsection
