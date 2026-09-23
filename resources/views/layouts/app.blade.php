<!DOCTYPE html>
<html lang="{{ session('locale', 'es') }}" class="h-full antialiased dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FREDOSIS — Fine Art, Dibujos & Tatuajes en Metro Santa Ana, Santiago')</title>
    <meta name="description" content="@yield('meta_description', 'Fredosis Art & Tattoo Atelier en Santiago Centro (Metro Santa Ana). Galería de arte surrealista, venta de dibujos originales y láminas fine art con PayPal, y agenda de tatuajes de autor.')">
    <meta name="keywords" content="@yield('meta_keywords', 'tatuajes cerca de mi, tattoo cerca de mi, estudio de tatuajes santiago centro, metro santa ana, tatuajes santiago, precio tatuajes, diseños de tatuajes, linea fina, fine line tattoo, blackwork, cover up, dibujos a grafito, arte surrealista, compra de arte original, paypal chile')">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="{{ session('locale', 'es') == 'es' ? 'es_CL' : 'en_US' }}">
    <meta property="og:site_name" content="FREDOSIS — Fine Art & Tattoo Atelier">
    <meta property="og:title" content="@yield('title', 'FREDOSIS — Fine Art, Dibujos & Tatuajes en Metro Santa Ana, Santiago')">
    <meta property="og:description" content="@yield('meta_description', 'Fredosis Art & Tattoo Atelier en Santiago Centro (Metro Santa Ana). Galería de arte surrealista, venta de dibujos originales y láminas fine art con PayPal, y agenda de tatuajes de autor.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', 'https://images.unsplash.com/photo-1579783902614-a3fb3927b675?q=80&w=1200')">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'FREDOSIS — Fine Art, Dibujos & Tatuajes en Metro Santa Ana')">
    <meta name="twitter:description" content="@yield('meta_description', 'Estudio de tatuajes y bellas artes en Santiago Centro a pasos de Metro Santa Ana.')">
    <meta name="twitter:image" content="@yield('og_image', 'https://images.unsplash.com/photo-1579783902614-a3fb3927b675?q=80&w=1200')">

    <!-- Geo Local SEO (Santiago Centro, Metro Santa Ana) -->
    <meta name="geo.region" content="CL-RM">
    <meta name="geo.placename" content="Santiago Centro, Metro Santa Ana">
    <meta name="geo.position" content="-33.4372;-70.6553">
    <meta name="ICBM" content="-33.4372, -70.6553">

    <!-- Structured Data (JSON-LD) for LocalBusiness, Tattoo Studio & Art Gallery -->
    <script type="application/ld+json">
    {!! json_encode([
      '@context' => 'https://schema.org',
      '@type' => ['TattooParlor', 'ArtGallery'],
      'name' => 'FREDOSIS — Fine Art & Tattoo Atelier',
      'image' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b675?q=80&w=1200',
      'url' => url('/'),
      'telephone' => '+56972004512',
      'priceRange' => '$$',
      'description' => 'Estudio privado de tatuajes de autor y galería de arte en Santiago Centro, a pasos de Metro Santa Ana. Especialista en línea fina, blackwork, surrealismo anatómico y dibujos originales a grafito.',
      'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Huérfanos / San Martín a pasos de Metro Santa Ana',
        'addressLocality' => 'Santiago Centro',
        'addressRegion' => 'Región Metropolitana',
        'postalCode' => '8320000',
        'addressCountry' => 'CL',
      ],
      'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => -33.4372,
        'longitude' => -70.6553,
      ],
      'openingHoursSpecification' => [
        [
          '@type' => 'OpeningHoursSpecification',
          'dayOfWeek' => ['Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
          'opens' => '11:00',
          'closes' => '20:00',
        ],
      ],
      'paymentAccepted' => 'Cash, Credit Card, PayPal, WebPay, Transferencia',
      'currenciesAccepted' => 'CLP, USD, EUR, MXN',
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script>

    @yield('structured_data')

    <!-- Fonts: Playfair Display & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body 
    x-data="fredosisApp()" 
    x-init="initApp()" 
    :class="{ 'sidebar-is-pinned': isPinned }"
    class="min-h-full flex flex-col bg-[#0b0b0c] text-[#ededeb] selection:bg-[#d8c49d] selection:text-[#0b0b0c]"
>

    <!-- ========================================================
         1. LEFT COLLAPSIBLE / PINNABLE SIDEBAR NAVIGATION
         "Menú horizontal hacia la izquierda con el logotipo de Fredosis,
          que se oculte sin mouse, se expanda con hover y tenga botón
          para anclar este fenómeno"
         ======================================================== -->
    <aside 
        id="fredosis-sidebar"
        :class="{ 'is-pinned': isPinned, 'mobile-open': mobileNavOpen }"
        class="fixed top-0 left-0 h-screen z-50 bg-[#121214]/95 backdrop-blur-md border-r border-[#232326] flex flex-col justify-between overflow-hidden shadow-2xl select-none"
    >
        <!-- Top Section: Logo & Pin Anchor Button -->
        <div>
            <div class="h-20 flex items-center justify-between px-5 border-b border-[#232326]/60">
                <!-- Brand / Logo Link -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group overflow-hidden">
                    <!-- Fredosis Monogram Emblem -->
                    <div class="w-10 h-10 rounded-full border border-[#d8c49d]/40 flex items-center justify-center bg-[#18181b] group-hover:border-[#d8c49d] transition-colors shrink-0 shadow-inner">
                        <span class="font-serif text-lg font-bold tracking-tighter text-[#d8c49d]">FR</span>
                    </div>
                    <!-- Full Text Logo (visible when hovered or pinned) -->
                    <div class="sidebar-full-label flex flex-col whitespace-nowrap overflow-hidden">
                        <span class="font-serif text-lg font-bold tracking-widest text-[#f5f5f3] group-hover:text-[#d8c49d] transition-colors">
                            FREDOSIS
                        </span>
                        <span class="text-[9px] uppercase tracking-[0.25em] text-[#8e8e93]">
                            Fine Art & Tattoo
                        </span>
                    </div>
                </a>

                <!-- PIN / ANCLAR BUTTON ("anclar este fenómeno") -->
                <button 
                    type="button"
                    @click="togglePin()"
                    :title="isPinned ? 'Desanclar menú (modo auto-ocultable)' : 'Anclar menú (fijo permanente)'"
                    :class="{ 'active': isPinned }"
                    class="pin-btn sidebar-full-label p-2 rounded-md border border-[#2c2c30] text-[#8e8e93] hover:text-[#d8c49d] hover:border-[#d8c49d]/50 transition-all shrink-0 ml-auto"
                >
                    <!-- Pin Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="17" x2="12" y2="22"></line>
                        <path d="M5 17h14v-1.76a2 2 0 0 0-1.11-1.79l-1.78-.9A2 2 0 0 1 15 10.76V6h1a2 2 0 0 0 0-4H8a2 2 0 0 0 0 4h1v4.76a2 2 0 0 1-1.11 1.79l-1.78.9A2 2 0 0 0 5 15.24Z"></path>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links List -->
            <nav class="p-3 space-y-1">
                <!-- 1. Portafolio -->
                <a 
                    href="{{ route('portfolio') }}" 
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('portfolio') ? 'bg-[#1e1e22] text-[#d8c49d]' : 'text-[#a6a6aa] hover:bg-[#1a1a1d] hover:text-[#f2f2f0]' }}"
                >
                    <div class="w-7 h-7 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-110 transition-transform">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                            <circle cx="9" cy="9" r="2"/>
                            <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                        </svg>
                    </div>
                    <span class="sidebar-full-label whitespace-nowrap" x-text="t('menu_portfolio')">Portafolio</span>
                </a>

                <!-- 2. Dibujos / Productos (Tienda) -->
                <a 
                    href="{{ route('shop') }}" 
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('shop*') ? 'bg-[#1e1e22] text-[#d8c49d]' : 'text-[#a6a6aa] hover:bg-[#1a1a1d] hover:text-[#f2f2f0]' }}"
                >
                    <div class="w-7 h-7 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-110 transition-transform">
                            <path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"/>
                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/>
                            <path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"/>
                            <path d="M2 7h20"/>
                        </svg>
                    </div>
                    <div class="sidebar-full-label flex items-center justify-between w-full whitespace-nowrap">
                        <span x-text="t('menu_shop')">Dibujos & Láminas</span>
                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-[#d8c49d]/10 text-[#d8c49d] border border-[#d8c49d]/20">Tienda</span>
                    </div>
                </a>

                <!-- 3. Agenda Tatuajes (Súper importante) -->
                <a 
                    href="{{ route('booking') }}" 
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('booking*') ? 'bg-[#1e1e22] text-[#d8c49d]' : 'text-[#a6a6aa] hover:bg-[#1a1a1d] hover:text-[#f2f2f0]' }}"
                >
                    <div class="w-7 h-7 flex items-center justify-center shrink-0 text-[#d8c49d]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-110 transition-transform">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <div class="sidebar-full-label flex items-center justify-between w-full whitespace-nowrap">
                        <span x-text="t('menu_booking')" class="font-semibold text-[#f5f5f3]">Agenda Tatuajes</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse" title="Citas disponibles"></span>
                    </div>
                </a>

                <!-- 3b. Flashes Disponibles -->
                <a 
                    href="{{ route('flash.index') }}" 
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('flash*') ? 'bg-[#1e1e22] text-[#d8c49d]' : 'text-[#a6a6aa] hover:bg-[#1a1a1d] hover:text-[#f2f2f0]' }}"
                >
                    <div class="w-7 h-7 flex items-center justify-center shrink-0 text-amber-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-110 transition-transform">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                        </svg>
                    </div>
                    <div class="sidebar-full-label flex items-center justify-between w-full whitespace-nowrap">
                        <span class="font-semibold">Flashes Disponibles</span>
                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-amber-500/10 text-amber-400 border border-amber-500/20 font-mono">Únicos</span>
                    </div>
                </a>

                <!-- 3c. Prensa & Bio -->
                <a 
                    href="{{ route('press') }}" 
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-lg text-sm font-medium transition-all group {{ request()->routeIs('press*') ? 'bg-[#1e1e22] text-[#d8c49d]' : 'text-[#a6a6aa] hover:bg-[#1a1a1d] hover:text-[#f2f2f0]' }}"
                >
                    <div class="w-7 h-7 flex items-center justify-center shrink-0 text-[#d8c49d]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-110 transition-transform">
                            <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                            <path d="M18 14h-8"/>
                            <path d="M15 18h-5"/>
                            <path d="M10 6h8v4h-8V6Z"/>
                        </svg>
                    </div>
                    <div class="sidebar-full-label flex items-center justify-between w-full whitespace-nowrap">
                        <span class="font-semibold">Prensa & Bio</span>
                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-[#d8c49d]/10 text-[#d8c49d] border border-[#d8c49d]/20">Global</span>
                    </div>
                </a>

                <!-- 4. Pasarela de Pago & Carrito -->
                <button 
                    type="button"
                    @click="cartOpen = true"
                    class="w-full flex items-center gap-3.5 px-3.5 py-3 rounded-lg text-sm font-medium transition-all group text-[#a6a6aa] hover:bg-[#1a1a1d] hover:text-[#f2f2f0] text-left"
                >
                    <div class="w-7 h-7 flex items-center justify-center shrink-0 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-110 transition-transform">
                            <rect width="20" height="14" x="2" y="5" rx="2"/>
                            <line x1="2" y1="10" x2="22" y2="10"/>
                        </svg>
                        <!-- Cart count badge -->
                        <span 
                            x-show="cartCount > 0" 
                            x-text="cartCount"
                            class="absolute -top-1 -right-1 bg-[#d8c49d] text-[#0b0b0c] text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center shadow-md"
                        ></span>
                    </div>
                    <div class="sidebar-full-label flex items-center justify-between w-full whitespace-nowrap">
                        <span x-text="t('menu_payment')">Pasarela de Pago</span>
                        <span class="text-[10px] text-[#8e8e93]" x-text="cartTotalFormatted"></span>
                    </div>
                </button>

                <!-- 5. Notificaciones & Contacto -->
                <a 
                    href="{{ route('home') }}#contacto" 
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-lg text-sm font-medium transition-all group text-[#a6a6aa] hover:bg-[#1a1a1d] hover:text-[#f2f2f0]"
                >
                    <div class="w-7 h-7 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-110 transition-transform">
                            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                        </svg>
                    </div>
                    <span class="sidebar-full-label whitespace-nowrap" x-text="t('menu_notifications')">Notificaciones & WhatsApp</span>
                </a>
            </nav>
        </div>

        <!-- Bottom Section: Language & Currency Selectors, Admin Link -->
        <div class="p-4 border-t border-[#232326]/60 bg-[#0f0f11] space-y-3">
            <!-- Selectors Widget (visible in expanded sidebar) -->
            <div class="sidebar-full-label space-y-2.5">
                <!-- Currency Selector -->
                <div class="flex items-center justify-between text-xs text-[#8e8e93]">
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/></svg>
                        <span x-text="t('currency_label')">Divisa:</span>
                    </span>
                    <select 
                        x-model="activeCurrency" 
                        @change="setCurrency(activeCurrency)"
                        class="bg-[#18181b] border border-[#2c2c30] rounded px-2 py-1 text-xs text-[#d8c49d] font-semibold focus:outline-none focus:border-[#d8c49d]"
                    >
                        <option value="CLP">CLP ($)</option>
                        <option value="USD">USD ($)</option>
                        <option value="EUR">EUR (€)</option>
                        <option value="MXN">MXN ($)</option>
                    </select>
                </div>

                <!-- Language Selector -->
                <div class="flex items-center justify-between text-xs text-[#8e8e93]">
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                        <span x-text="t('language_label')">Idioma:</span>
                    </span>
                    <div class="inline-flex rounded-md border border-[#2c2c30] p-0.5 bg-[#18181b]">
                        <button 
                            type="button"
                            @click="setLocale('es')"
                            :class="activeLocale === 'es' ? 'bg-[#d8c49d] text-[#0b0b0c] font-bold' : 'text-[#8e8e93] hover:text-white'"
                            class="px-2 py-0.5 rounded text-[11px] transition-all"
                        >ES</button>
                        <button 
                            type="button"
                            @click="setLocale('en')"
                            :class="activeLocale === 'en' ? 'bg-[#d8c49d] text-[#0b0b0c] font-bold' : 'text-[#8e8e93] hover:text-white'"
                            class="px-2 py-0.5 rounded text-[11px] transition-all"
                        >EN</button>
                    </div>
                </div>
            </div>

            <!-- Compact Icons Bar (Visible when sidebar collapsed) -->
            <div class="md:block md:group-hover:hidden" :class="{ 'hidden': isPinned }">
                <div class="flex flex-col items-center gap-3">
                    <button 
                        type="button"
                        @click="setLocale(activeLocale === 'es' ? 'en' : 'es')"
                        class="w-8 h-8 rounded border border-[#2c2c30] text-[11px] font-bold text-[#d8c49d] flex items-center justify-center hover:bg-[#1f1f23]"
                        :title="'Idioma actual: ' + activeLocale.toUpperCase()"
                    >
                        <span x-text="activeLocale.toUpperCase()"></span>
                    </button>

                    <button 
                        type="button"
                        @click="cartOpen = true"
                        class="w-8 h-8 rounded border border-[#2c2c30] text-[#a6a6aa] hover:text-[#d8c49d] flex items-center justify-center relative hover:bg-[#1f1f23]"
                        title="Ver Carrito"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                        <span x-show="cartCount > 0" class="absolute -top-1 -right-1 w-2.5 h-2.5 rounded-full bg-[#d8c49d]"></span>
                    </button>
                </div>
            </div>

            <!-- Admin Access Link -->
            <div class="sidebar-full-label pt-2 border-t border-[#232326]/60 flex items-center justify-between text-[11px] text-[#6b6b70]">
                <a href="{{ route('admin.login') }}" class="hover:text-[#d8c49d] transition-colors flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span>Portal Admin</span>
                </a>
                <span class="text-[9px] text-[#555]">v2.4</span>
            </div>
        </div>
    </aside>

    <!-- Mobile Drawer Overlay Backdrop -->
    <div 
        x-show="mobileNavOpen" 
        @click="mobileNavOpen = false"
        x-cloak
        class="fixed inset-0 bg-black/80 z-40 md:hidden backdrop-blur-sm"
    ></div>


    <!-- ========================================================
         2. MOBILE TOP NAVIGATION BAR
         ======================================================== -->
    <header class="md:hidden fixed top-0 left-0 right-0 h-16 bg-[#0b0b0c]/90 backdrop-blur-md border-b border-[#232326] z-30 flex items-center justify-between px-4">
        <button 
            type="button" 
            @click="mobileNavOpen = !mobileNavOpen"
            class="p-2 text-[#ededeb] hover:text-[#d8c49d]"
            aria-label="Abrir Menú"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
        </button>

        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <span class="font-serif text-lg font-bold tracking-widest text-[#f5f5f3]">FREDOSIS</span>
        </a>

        <div class="flex items-center gap-2">
            <button 
                type="button" 
                @click="cartOpen = true"
                class="p-2 text-[#ededeb] hover:text-[#d8c49d] relative"
                aria-label="Carrito"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                <span x-show="cartCount > 0" x-text="cartCount" class="absolute top-1 right-1 w-4 h-4 rounded-full bg-[#d8c49d] text-black font-bold text-[9px] flex items-center justify-center"></span>
            </button>
        </div>
    </header>


    <!-- ========================================================
         3. MAIN CONTENT CONTAINER
         ======================================================== -->
    <main id="main-content" class="flex-1 transition-all pt-16 md:pt-0">
        @yield('content')
    </main>


    <!-- ========================================================
         4. SLIDE-OVER SHOPPING CART DRAWER
         ======================================================== -->
    <div 
        x-show="cartOpen" 
        x-cloak
        class="fixed inset-0 z-50 overflow-hidden"
    >
        <!-- Backdrop -->
        <div 
            @click="cartOpen = false" 
            class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity"
        ></div>

        <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="w-screen max-w-md bg-[#121214] border-l border-[#232326] flex flex-col justify-between shadow-2xl">
                <!-- Cart Header -->
                <div class="p-6 border-b border-[#232326] flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <span class="font-serif text-xl font-bold text-[#f5f5f3]" x-text="t('cart_title')">Tu Carrito</span>
                        <span class="px-2 py-0.5 text-xs rounded bg-[#d8c49d]/10 text-[#d8c49d] font-semibold" x-text="cartCount + ' items'"></span>
                    </div>
                    <button 
                        type="button" 
                        @click="cartOpen = false" 
                        class="text-[#8e8e93] hover:text-[#f5f5f3] p-1.5"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                    </button>
                </div>

                <!-- Cart Items List -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4">
                    <template x-if="cartItems.length === 0">
                        <div class="py-16 text-center text-[#8e8e93] space-y-3">
                            <div class="w-16 h-16 rounded-full border border-[#232326] mx-auto flex items-center justify-center text-[#444]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                            </div>
                            <p class="font-serif text-base text-[#d8c49d]" x-text="t('cart_empty')">Tu carrito está vacío</p>
                            <p class="text-xs text-[#777]" x-text="t('cart_empty_sub')">Descubre dibujos originales y láminas fine art en la tienda.</p>
                            <a href="{{ route('shop') }}" @click="cartOpen = false" class="inline-block mt-4 px-5 py-2 rounded-full border border-[#d8c49d] text-[#d8c49d] text-xs font-semibold hover:bg-[#d8c49d] hover:text-black transition-all">
                                Explorar Tienda
                            </a>
                        </div>
                    </template>

                    <template x-for="item in cartItems" :key="item.cart_key">
                        <div class="flex gap-4 p-3 rounded-lg bg-[#18181b] border border-[#26262a]">
                            <img :src="item.image" :alt="item.title" class="w-20 h-24 object-cover rounded bg-black shrink-0">
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <h4 class="font-serif text-sm font-semibold text-[#ededeb] line-clamp-1" x-text="item.title"></h4>
                                    <p class="text-xs text-[#d8c49d] mt-0.5" x-text="item.format_name"></p>
                                    <p class="text-xs font-bold text-[#f5f5f3] mt-1" x-text="item.price_formatted"></p>
                                </div>
                                <div class="flex items-center justify-between pt-2 border-t border-[#26262a]">
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center border border-[#333] rounded">
                                        <button 
                                            type="button"
                                            @click="updateItemQuantity(item.cart_key, item.quantity - 1)"
                                            class="px-2 py-0.5 text-xs text-[#8e8e93] hover:text-white"
                                        >-</button>
                                        <span class="px-2 text-xs font-medium text-white" x-text="item.quantity"></span>
                                        <button 
                                            type="button"
                                            @click="updateItemQuantity(item.cart_key, item.quantity + 1)"
                                            class="px-2 py-0.5 text-xs text-[#8e8e93] hover:text-white"
                                        >+</button>
                                    </div>
                                    <!-- Remove Button -->
                                    <button 
                                        type="button" 
                                        @click="removeItem(item.cart_key)" 
                                        class="text-xs text-rose-400 hover:underline"
                                    >Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Cart Footer / Checkout with PayPal -->
                <div x-show="cartItems.length > 0" class="p-6 border-t border-[#232326] bg-[#161619] space-y-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-[#8e8e93]" x-text="t('subtotal')">Subtotal</span>
                        <span class="font-bold text-lg text-[#d8c49d]" x-text="cartTotalFormatted"></span>
                    </div>
                    <p class="text-[11px] text-[#777]">
                        * Envíos de láminas y originales asegurados en tubos rígidos de conservación. Aceptamos PayPal internacional.
                    </p>
                    <a 
                        href="{{ route('checkout') }}" 
                        class="w-full flex items-center justify-center gap-2.5 py-3.5 px-4 rounded-lg bg-[#d8c49d] hover:bg-[#ebd7b1] text-[#0b0b0c] font-bold text-sm uppercase tracking-wider transition-all shadow-lg hover:shadow-[#d8c49d]/20"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                        <span x-text="t('checkout_paypal')">Pagar con PayPal</span>
                    </a>
                </div>
            </div>
        </section>
    </div>


    <!-- ========================================================
         5. FINE ART LIGHTBOX VIEWER
         ======================================================== -->
    <div 
        x-show="lightboxOpen" 
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4 md:p-10 bg-black/95 backdrop-blur-md"
    >
        <button 
            type="button" 
            @click="lightboxOpen = false" 
            class="absolute top-6 right-6 text-[#ededeb] hover:text-[#d8c49d] p-2 z-10"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
        </button>

        <div class="max-w-6xl w-full max-h-[90vh] flex flex-col md:flex-row items-center gap-8 bg-[#111113] border border-[#26262a] rounded-xl p-6 overflow-hidden shadow-2xl">
            <div class="flex-1 h-[55vh] md:h-[75vh] w-full flex items-center justify-center overflow-hidden bg-black/50 rounded-lg">
                <img :src="lightboxItem.image_url" :alt="lightboxItem.title" class="max-w-full max-h-full object-contain cursor-zoom-in">
            </div>
            <div class="w-full md:w-80 space-y-4 shrink-0">
                <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold" x-text="lightboxItem.category"></span>
                <h3 class="font-serif text-2xl font-bold text-[#f5f5f3]" x-text="lightboxItem.title"></h3>
                <div class="space-y-1.5 text-xs text-[#a6a6aa] border-y border-[#26262a] py-3">
                    <p><strong class="text-white">Técnica:</strong> <span x-text="lightboxItem.medium || 'Grafito de alta densidad'"></span></p>
                    <p><strong class="text-white">Dimensiones:</strong> <span x-text="lightboxItem.dimensions || 'Original de autor'"></span></p>
                    <p><strong class="text-white">Año:</strong> <span x-text="lightboxItem.year || '2026'"></span></p>
                </div>
                <p class="text-xs text-[#8e8e93] leading-relaxed" x-text="lightboxItem.description"></p>
                <div class="pt-2 flex flex-col gap-2">
                    <a href="{{ route('booking') }}" class="w-full text-center py-2.5 px-4 rounded border border-[#d8c49d] text-[#d8c49d] hover:bg-[#d8c49d] hover:text-black font-semibold text-xs transition-all">
                        Cotizar Tatuaje con este estilo
                    </a>
                    <a href="{{ route('shop') }}" class="w-full text-center py-2.5 px-4 rounded bg-[#1e1e22] text-[#f5f5f3] hover:bg-[#28282c] font-semibold text-xs transition-all">
                        Ver Láminas Disponibles
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- ========================================================
         6. ALPINE.JS APP LOGIC & TRANSLATIONS
         ======================================================== -->
    <script>
        function fredosisApp() {
            return {
                isPinned: localStorage.getItem('fredosis_menu_pinned') === 'true',
                mobileNavOpen: false,
                cartOpen: false,
                cartItems: [],
                cartCount: 0,
                cartTotal: 0,
                cartTotalFormatted: '$0',
                activeCurrency: '{{ session("currency", "USD") }}',
                activeLocale: '{{ session("locale", "es") }}',
                lightboxOpen: false,
                lightboxItem: {},

                // Translation dictionary (ES / EN)
                i18n: {
                    es: {
                        menu_portfolio: 'Portafolio',
                        menu_shop: 'Dibujos & Láminas',
                        menu_booking: 'Agenda Tatuajes',
                        menu_payment: 'Pasarela de Pago',
                        menu_notifications: 'Notificaciones & Contacto',
                        currency_label: 'Divisa',
                        language_label: 'Idioma',
                        cart_title: 'Tu Carrito',
                        cart_empty: 'Tu carrito está vacío',
                        cart_empty_sub: 'Descubre dibujos originales y láminas fine art en la tienda.',
                        subtotal: 'Subtotal',
                        checkout_paypal: 'Pagar con PayPal',
                    },
                    en: {
                        menu_portfolio: 'Portfolio',
                        menu_shop: 'Drawings & Prints',
                        menu_booking: 'Tattoo Booking',
                        menu_payment: 'Payment Gateway',
                        menu_notifications: 'Notifications & Contact',
                        currency_label: 'Currency',
                        language_label: 'Language',
                        cart_title: 'Your Cart',
                        cart_empty: 'Your cart is empty',
                        cart_empty_sub: 'Explore original drawings and archival fine art prints in the shop.',
                        subtotal: 'Subtotal',
                        checkout_paypal: 'Pay with PayPal',
                    }
                },

                t(key) {
                    return this.i18n[this.activeLocale]?.[key] || this.i18n['es'][key] || key;
                },

                initApp() {
                    this.fetchCart();
                },

                togglePin() {
                    this.isPinned = !this.isPinned;
                    localStorage.setItem('fredosis_menu_pinned', this.isPinned ? 'true' : 'false');
                },

                openLightbox(item) {
                    this.lightboxItem = item;
                    this.lightboxOpen = true;
                },

                setLocale(locale) {
                    this.activeLocale = locale;
                    fetch('{{ route("api.set-locale") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ locale })
                    });
                },

                setCurrency(curr) {
                    this.activeCurrency = curr;
                    fetch('{{ route("api.set-currency") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ currency: curr })
                    }).then(() => {
                        this.fetchCart();
                        // Optional page reload or dispatch event
                        window.dispatchEvent(new CustomEvent('currency-changed', { detail: { currency: curr } }));
                    });
                },

                fetchCart() {
                    fetch('{{ route("api.cart.get") }}?currency=' + this.activeCurrency)
                        .then(r => r.json())
                        .then(data => {
                            this.cartItems = data.items;
                            this.cartCount = data.count;
                            this.cartTotal = data.total;
                            this.cartTotalFormatted = data.total_formatted;
                        });
                },

                addToCart(variantId, quantity = 1) {
                    fetch('{{ route("api.cart.add") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ variant_id: variantId, quantity })
                    })
                    .then(r => r.json())
                    .then(data => {
                        this.cartItems = data.items;
                        this.cartCount = data.count;
                        this.cartTotal = data.total;
                        this.cartTotalFormatted = data.total_formatted;
                        this.cartOpen = true;
                    });
                },

                updateItemQuantity(cartKey, quantity) {
                    fetch('{{ route("api.cart.update") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ cart_key: cartKey, quantity })
                    })
                    .then(r => r.json())
                    .then(data => {
                        this.cartItems = data.items;
                        this.cartCount = data.count;
                        this.cartTotal = data.total;
                        this.cartTotalFormatted = data.total_formatted;
                    });
                },

                removeItem(cartKey) {
                    fetch('{{ route("api.cart.remove") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ cart_key: cartKey })
                    })
                    .then(r => r.json())
                    .then(data => {
                        this.cartItems = data.items;
                        this.cartCount = data.count;
                        this.cartTotal = data.total;
                        this.cartTotalFormatted = data.total_formatted;
                    });
                }
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
