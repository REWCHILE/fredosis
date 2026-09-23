@extends('layouts.app')

@section('title', 'Cuidados de un Tatuaje — Guía de Cicatrización y Cremas en Chile | FREDOSIS')
@section('meta_description', 'Guía médica y artística de cuidados post tatuaje en Chile. Protocolo paso a paso (días 1 al 14), cremas cicatrizantes recomendadas (Bepanthol, Aquaphor) y prevención por Fredosis Atelier.')

@section('structured_data')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@graph' => [
    [
      '@type' => 'HowTo',
      'name' => 'Cómo Cuidar un Tatuaje Recién Hecho: Protocolo Paso a Paso',
      'description' => 'Protocolo profesional para la cicatrización perfecta de tatuajes de línea fina, blackwork y surrealismo anatómico en Chile.',
      'totalTime' => 'P14D',
      'step' => [
        [
          '@type' => 'HowToStep',
          'name' => 'Primeras 2 a 4 horas: Retiro del vendaje',
          'text' => 'Retira el parche o film con manos limpias y lava con agua tibia y jabón neutro antibacteriano sin frotar.'
        ],
        [
          '@type' => 'HowToStep',
          'name' => 'Días 1 al 3: Lavado suave y secado al aire',
          'text' => 'Lavar 2 a 3 veces al día. Secar dando toques suaves con papel absorbente descartable, nunca con toalla de tela.'
        ],
        [
          '@type' => 'HowToStep',
          'name' => 'Días 3 al 14: Hidratación con crema cicatrizante',
          'text' => 'Aplica una capa ultrafina y transparente de crema cicatrizante (Bepanthol Tattoo o Aquaphor) 3 veces al día.'
        ],
        [
          '@type' => 'HowToStep',
          'name' => 'Cuidado permanente: Protección solar FPS 50+',
          'text' => 'Tras la cicatrización, aplica bloqueador solar cada vez que te expongas al sol para evitar la degradación de la tinta.'
        ]
      ]
    ],
    [
      '@type' => 'FAQPage',
      'mainEntity' => [
        [
          '@type' => 'Question',
          'name' => '¿Cuál es la mejor crema para cicatrizar tatuajes en Chile?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'Las opciones más recomendadas y disponibles en farmacias chilenas son Bepanthol Tattoo (con Dexpantenol al 5%) y Eucerin Aquaphor. Ambas crean una barrera transpirable que acelera la regeneración celular sin ahogar el poro.'
          ]
        ],
        [
          '@type' => 'Question',
          'name' => '¿Cuánto tiempo debo dejar el parche o apósito dérmico (segunda piel)?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'Si se te aplicó un parche adhesivo tipo Second Skin (Saniderm o Dermalize), déjalo entre 3 y 5 días continuos. Si es film plástico tradicional, debes retirarlo a las 2 a 4 horas como máximo.'
          ]
        ],
        [
          '@type' => 'Question',
          'name' => '¿Puedo hacer ejercicio o ir al gimnasio después de tatuarme?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'Se recomienda evitar ejercicio intenso durante los primeros 4 a 5 días para evitar la sudoración excesiva, el roce de prendas y el contacto con bacterias de máquinas y colchonetas de gimnasio.'
          ]
        ],
        [
          '@type' => 'Question',
          'name' => '¿Es normal que el tatuaje pique y se pele?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'Sí, entre el día 4 y el 8 la capa superficial de la epidermis se descama como una quemadura de sol leve. Es fundamental NUNCA rascarse ni arrancar las costras o pieles sueltas.'
          ]
        ]
      ]
    ]
  ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection

@section('content')
<article class="py-16 md:py-24 px-6 md:px-16 max-w-5xl mx-auto space-y-16">
    <!-- Header -->
    <header class="text-center max-w-3xl mx-auto space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#18181b] border border-[#d8c49d]/30 text-xs text-[#d8c49d] font-mono tracking-wider">
            <span>GUÍA CLÍNICA & ARTÍSTICA • FREDOSIS</span>
        </div>
        <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#f5f5f3] tracking-tight leading-tight">
            Cuidados Post Tatuaje:<br>
            <span class="text-[#d8c49d] italic font-normal">La Ciencia de Curar una Obra de Arte</span>
        </h1>
        <p class="text-sm md:text-base text-[#a6a6aa] leading-relaxed max-w-2xl mx-auto">
            El 50% de la calidad final de un tatuaje depende de la técnica del artista; el otro 50% depende de cómo cuides tu piel durante los primeros 14 días. Sigue este protocolo oficial desarrollado para línea fina, micro-sombreados y blackwork de alta definición.
        </p>
    </header>

    <!-- Quick Summary Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-[#121214] border border-[#232326] rounded-2xl p-6 space-y-3">
            <div class="w-10 h-10 rounded-xl bg-[#d8c49d]/10 border border-[#d8c49d]/30 flex items-center justify-center text-[#d8c49d]">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <h3 class="font-serif text-lg font-bold text-white">Higiene Estricta</h3>
            <p class="text-xs text-[#8e8e93] leading-relaxed">
                Lava siempre con agua tibia y jabón neutro glicerina o antiséptico suave. Seca dando toques con toalla nova desechable, nunca con toalla de baño.
            </p>
        </div>

        <div class="bg-[#121214] border border-[#232326] rounded-2xl p-6 space-y-3">
            <div class="w-10 h-10 rounded-xl bg-[#d8c49d]/10 border border-[#d8c49d]/30 flex items-center justify-center text-[#d8c49d]">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
            </div>
            <h3 class="font-serif text-lg font-bold text-white">Capa Ultrafina</h3>
            <p class="text-xs text-[#8e8e93] leading-relaxed">
                Menos es más: aplica una cantidad mínima de crema cicatrizante que apenas humecte la piel. Si la zona brilla blanca o grasosa, retira el exceso.
            </p>
        </div>

        <div class="bg-[#121214] border border-[#232326] rounded-2xl p-6 space-y-3">
            <div class="w-10 h-10 rounded-xl bg-[#d8c49d]/10 border border-[#d8c49d]/30 flex items-center justify-center text-[#d8c49d]">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
            </div>
            <h3 class="font-serif text-lg font-bold text-white">Cero Sol y Agua Estancada</h3>
            <p class="text-xs text-[#8e8e93] leading-relaxed">
                Prohibido sumergirse en piscinas, tinajas, saunas o agua de mar por 15 días. Cero exposición solar directa hasta que la dermis cierre por completo.
            </p>
        </div>
    </div>

    <!-- Step-by-Step Healing Timeline (Días 1 al 14) -->
    <section class="space-y-8">
        <div class="border-b border-[#232326] pb-4">
            <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">CRONOGRAMA DE RECUPERACIÓN</span>
            <h2 class="text-2xl md:text-3xl font-serif font-bold text-[#f5f5f3]">
                Protocolo Paso a Paso Día a Día
            </h2>
        </div>

        <div class="space-y-6">
            <!-- Day 1 -->
            <div class="bg-[#121214] border border-[#232326] rounded-2xl p-6 md:p-8 space-y-4">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded bg-[#d8c49d] text-black font-bold text-xs uppercase tracking-wider">Día 1</span>
                    <h3 class="font-serif text-xl font-bold text-white">Las primeras 24 Horas: Retiro y Primer Lavado</h3>
                </div>
                <div class="text-xs md:text-sm text-[#a6a6aa] space-y-2 leading-relaxed">
                    <p>
                        <strong>Si usas film plástico tradicional:</strong> Retíralo pasadas 2 a 4 horas de terminada la sesión. Lava inmediatamente la zona con agua tibia tirando a fría y jabón neutro glicerina, realizando círculos suaves con las yemas de tus dedos (limpias) para retirar el plasma, exceso de tinta y linfa acumulada.
                    </p>
                    <p>
                        <strong>Si usas apósito adhesivo dérmico (Second Skin / Dermalize):</strong> Mantén el parche puesto de 3 a 5 días. Es normal que se acumule un líquido oscuro (tinta y plasma) debajo del parche; esto crea una cámara de curación húmeda estéril ideal.
                    </p>
                    <div class="p-3 bg-[#18181b] rounded-lg border-l-2 border-[#d8c49d] text-xs text-[#d8c49d]">
                        💡 <strong>Regla de oro:</strong> Seca siempre con toalla de papel desechable dando toques ligeros. Nunca frotes. Deja ventilar 10 minutos antes de aplicar cualquier crema.
                    </div>
                </div>
            </div>

            <!-- Days 2 to 5 -->
            <div class="bg-[#121214] border border-[#232326] rounded-2xl p-6 md:p-8 space-y-4">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded bg-[#2c2c30] text-[#d8c49d] font-bold text-xs uppercase tracking-wider">Días 2 a 5</span>
                    <h3 class="font-serif text-xl font-bold text-white">Regeneración Celular: Inicio de la Humectación</h3>
                </div>
                <div class="text-xs md:text-sm text-[#a6a6aa] space-y-2 leading-relaxed">
                    <p>
                        Lava el tatuaje 2 a 3 veces al día (mañana, tarde y noche). Tras secar, aplica una <strong>capa microscópica</strong> de crema cicatrizante recomendada. La piel debe quedar flexible e hidratada, nunca sofocada por una pasta blanca espesa.
                    </p>
                    <p>
                        Usa ropa holgada de algodón limpio que no frote la zona. Evita que mascotas toquen el tatuaje y duerme con sábanas limpias.
                    </p>
                </div>
            </div>

            <!-- Days 6 to 10 -->
            <div class="bg-[#121214] border border-[#232326] rounded-2xl p-6 md:p-8 space-y-4">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded bg-[#2c2c30] text-[#d8c49d] font-bold text-xs uppercase tracking-wider">Días 6 a 10</span>
                    <h3 class="font-serif text-xl font-bold text-white">Descamación Natural y Picazón: Prohibido Rascarse</h3>
                </div>
                <div class="text-xs md:text-sm text-[#a6a6aa] space-y-2 leading-relaxed">
                    <p>
                        La piel empezará a pelarse como si fuera una quemadura solar leve, desprendiendo pequeñas escamas con pigmento. <strong>Es 100% normal.</strong>
                    </p>
                    <p class="text-white font-medium">
                        ⚠️ <strong>ADVERTENCIA VITAL:</strong> Si arrancas una costra antes de tiempo, te llevarás la tinta inyectada en la dermis, dejando un parche blanco o una cicatriz. Si sientes picazón intensa, da pequeñas palmadas suaves con la mano limpia o aplica una gota de crema.
                    </p>
                </div>
            </div>

            <!-- Days 11 to 14+ -->
            <div class="bg-[#121214] border border-[#232326] rounded-2xl p-6 md:p-8 space-y-4">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded bg-[#2c2c30] text-[#d8c49d] font-bold text-xs uppercase tracking-wider">Días 11 en adelante</span>
                    <h3 class="font-serif text-xl font-bold text-white">Cicatrización Completa y Preservación de por Vida</h3>
                </div>
                <div class="text-xs md:text-sm text-[#a6a6aa] space-y-2 leading-relaxed">
                    <p>
                        La piel brillante ("piel de cebolla") se asentará en su textura natural. A partir de la tercera semana, puedes cambiar tu crema cicatrizante por una crema humectante corporal normal sin fragancia (como CeraVe o Cetaphil).
                    </p>
                    <p>
                        Para que las líneas finas y los contrastes de grafito sigan viéndose impecables dentro de 10 años, <strong>aplica siempre bloqueador solar FPS 50+</strong> antes de exponerte al sol.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison of Healing Creams in Chile -->
    <section class="space-y-8">
        <div class="border-b border-[#232326] pb-4">
            <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">GUÍA DE COMPRA EN FARMACIAS CHILENAS</span>
            <h2 class="text-2xl md:text-3xl font-serif font-bold text-[#f5f5f3]">
                ¿Qué Crema Cicatrizante Usar en Chile?
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Recommended -->
            <div class="bg-[#121214] border border-emerald-500/30 rounded-2xl p-6 space-y-4">
                <div class="flex items-center gap-2 text-emerald-400 font-bold text-xs uppercase tracking-wider">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                    <span>Cremas Altamente Recomendadas</span>
                </div>
                <ul class="space-y-3 text-xs md:text-sm text-[#ededeb]">
                    <li class="p-3 bg-[#161619] rounded-xl border border-[#26262a]">
                        <strong class="text-white">Bepanthol Tattoo (Bayer)</strong>
                        <p class="text-[#8e8e93] text-xs mt-1">Con provitamina B5 (Dexpantenol). Crea una película transpirable que estimula la regeneración cutánea sin asfixiar la dermis.</p>
                    </li>
                    <li class="p-3 bg-[#161619] rounded-xl border border-[#26262a]">
                        <strong class="text-white">Eucerin Aquaphor Pomada Reparadora</strong>
                        <p class="text-[#8e8e93] text-xs mt-1">Excelente tolerabilidad. Muy concentrada; se debe usar una cantidad mínima del tamaño de media arveja.</p>
                    </li>
                    <li class="p-3 bg-[#161619] rounded-xl border border-[#26262a]">
                        <strong class="text-white">CeraVe Ungüento Curativo</strong>
                        <p class="text-[#8e8e93] text-xs mt-1">Fórmula con 3 ceramidas esenciales y ácido hialurónico. Sin perfume y no comedogénico.</p>
                    </li>
                    <li class="p-3 bg-[#161619] rounded-xl border border-[#26262a]">
                        <strong class="text-white">Mantecas Vegetales Puras (Veganas)</strong>
                        <p class="text-[#8e8e93] text-xs mt-1">Manteca de karité o bálsamos especializados para tatuaje sin derivados del petróleo ni colorantes.</p>
                    </li>
                </ul>
            </div>

            <!-- Prohibited -->
            <div class="bg-[#121214] border border-rose-500/30 rounded-2xl p-6 space-y-4">
                <div class="flex items-center gap-2 text-rose-400 font-bold text-xs uppercase tracking-wider">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    <span>Productos Estrictamente Prohibidos</span>
                </div>
                <ul class="space-y-3 text-xs md:text-sm text-[#ededeb]">
                    <li class="p-3 bg-[#161619] rounded-xl border border-[#26262a]">
                        <strong class="text-rose-300">Vaselina pura sólida (Petrolato pesado)</strong>
                        <p class="text-[#8e8e93] text-xs mt-1">Es un derivado oclusivo que tapa los poros por completo, atrapa bacterias y puede provocar granitos e infecciones.</p>
                    </li>
                    <li class="p-3 bg-[#161619] rounded-xl border border-[#26262a]">
                        <strong class="text-rose-300">Cremas antibióticas sin receta (Neomicina / Bacitracina)</strong>
                        <p class="text-[#8e8e93] text-xs mt-1">No uses antibióticos tópicos a menos que un médico los prescriba. Causan reacciones alérgicas y alteran la expulsión de tinta.</p>
                    </li>
                    <li class="p-3 bg-[#161619] rounded-xl border border-[#26262a]">
                        <strong class="text-rose-300">Cremas con perfume, alcohol o blanqueadores</strong>
                        <p class="text-[#8e8e93] text-xs mt-1">Cremas corporales cosméticas comunes causan ardor severo y dermatitis por contacto.</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="space-y-8" x-data="{ activeFaq: null }">
        <div class="border-b border-[#232326] pb-4">
            <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">PREGUNTAS FRECUENTES</span>
            <h2 class="text-2xl md:text-3xl font-serif font-bold text-[#f5f5f3]">
                Dudas Comunes sobre Cicatrización
            </h2>
        </div>

        <div class="space-y-4">
            <!-- FAQ 1 -->
            <div class="border border-[#232326] rounded-xl bg-[#121214] overflow-hidden">
                <button 
                    type="button" 
                    @click="activeFaq = activeFaq === 1 ? null : 1"
                    class="w-full p-5 text-left flex items-center justify-between gap-4 text-white font-medium text-sm hover:text-[#d8c49d] transition-colors"
                >
                    <span>¿Puedo tomar alcohol después de tatuarme?</span>
                    <span x-text="activeFaq === 1 ? '−' : '+'" class="text-xl text-[#d8c49d]"></span>
                </button>
                <div x-show="activeFaq === 1" x-collapse class="px-5 pb-5 text-xs text-[#a6a6aa] leading-relaxed border-t border-[#1f1f23] pt-3">
                    Se recomienda moderar o evitar el consumo de alcohol en las primeras 24-48 horas, ya que el alcohol adelgaza la sangre, aumenta el sangrado/supuración y dificulta el descanso óptimo para la regeneración celular.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="border border-[#232326] rounded-xl bg-[#121214] overflow-hidden">
                <button 
                    type="button" 
                    @click="activeFaq = activeFaq === 2 ? null : 2"
                    class="w-full p-5 text-left flex items-center justify-between gap-4 text-white font-medium text-sm hover:text-[#d8c49d] transition-colors"
                >
                    <span>¿Cómo sé si mi tatuaje está infectado o solo cicatrizando?</span>
                    <span x-text="activeFaq === 2 ? '−' : '+'" class="text-xl text-[#d8c49d]"></span>
                </button>
                <div x-show="activeFaq === 2" x-collapse class="px-5 pb-5 text-xs text-[#a6a6aa] leading-relaxed border-t border-[#1f1f23] pt-3">
                    Un enrojecimiento leve, hinchazón y calor en las primeras 48 horas son normales. Señales de alarma: calor excesivo después del 4to día, secreción espesa amarilla o verdosa con mal olor, rayas rojas que se expanden o fiebre. Ante cualquiera de estos signos, consulta a un médico de inmediato y avísanos a nuestro WhatsApp.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="border border-[#232326] rounded-xl bg-[#121214] overflow-hidden">
                <button 
                    type="button" 
                    @click="activeFaq = activeFaq === 3 ? null : 3"
                    class="w-full p-5 text-left flex items-center justify-between gap-4 text-white font-medium text-sm hover:text-[#d8c49d] transition-colors"
                >
                    <span>¿Puedo bañarme en tina o darme baños de inmersión?</span>
                    <span x-text="activeFaq === 3 ? '−' : '+'" class="text-xl text-[#d8c49d]"></span>
                </button>
                <div x-show="activeFaq === 3" x-collapse class="px-5 pb-5 text-xs text-[#a6a6aa] leading-relaxed border-t border-[#1f1f23] pt-3">
                    Duchas rápidas de pie sí están permitidas (evitando que el chorro de agua caiga con fuerza directa sobre la herida). Los baños de tina, piscinas, jacuzzis y saunas están terminantemente prohibidos durante 15 días, ya que ablandan las costras y transmiten bacterias patógenas.
                </div>
            </div>
        </div>
    </section>

    <!-- Atelier Support Banner -->
    <section class="bg-gradient-to-r from-[#18181b] to-[#121214] border border-[#d8c49d]/30 rounded-3xl p-8 md:p-12 text-center space-y-6 shadow-2xl">
        <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">SOPORTE POST-TATUAJE CONTINUO</span>
        <h2 class="text-3xl md:text-4xl font-serif font-bold text-white max-w-xl mx-auto">
            ¿Tienes dudas sobre tu proceso de curación?
        </h2>
        <p class="text-xs md:text-sm text-[#a6a6aa] max-w-lg mx-auto">
            En FREDOSIS acompañamos a cada coleccionista desde el primer trazo en papel hasta la cicatrización total en la piel. Escríbenos directamente ante cualquier consulta.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
            <a 
                href="https://wa.me/56972004512?text=Hola%20Fredosis,%20tengo%20una%20consulta%20sobre%20el%20cuidado%20de%20mi%20tatuaje" 
                target="_blank" 
                rel="noopener"
                class="px-8 py-4 rounded-xl bg-[#25D366] hover:bg-[#20ba59] text-black font-bold text-xs uppercase tracking-wider transition-all shadow-lg flex items-center gap-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                <span>Consultar por WhatsApp</span>
            </a>
            <a 
                href="{{ route('booking') }}" 
                class="px-8 py-4 rounded-xl border border-[#d8c49d] hover:bg-[#d8c49d] text-[#d8c49d] hover:text-black font-bold text-xs uppercase tracking-wider transition-all"
            >
                Agendar Próxima Pieza
            </a>
        </div>
    </section>
</article>
@endsection
