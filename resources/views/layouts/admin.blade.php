<!DOCTYPE html>
<html lang="es" class="h-full antialiased dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "Admin Panel — FREDOSIS ART")</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full flex bg-[#0c0c0e] text-[#ededeb] font-sans selection:bg-[#d8c49d] selection:text-black">

    <div 
        x-data="{ 
            sidebarOpen: window.innerWidth >= 1024,
            isMobile: window.innerWidth < 1024
        }" 
        x-init="
            window.addEventListener('resize', () => {
                isMobile = window.innerWidth < 1024;
                if (isMobile) sidebarOpen = false;
            });
            if (window.innerWidth < 1024) sidebarOpen = false;
        "
        class="min-h-screen w-full flex relative"
    >
        <!-- Mobile Backdrop Overlay -->
        <div 
            x-show="sidebarOpen && isMobile" 
            @click="sidebarOpen = false"
            x-cloak
            class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 lg:hidden"
        ></div>

        <!-- Sidebar -->
        <aside 
            :class="{
                'translate-x-0': sidebarOpen,
                '-translate-x-full lg:translate-x-0': !sidebarOpen,
                'lg:w-64': sidebarOpen,
                'lg:w-20': !sidebarOpen
            }" 
            class="fixed inset-y-0 left-0 z-50 w-72 lg:static lg:z-auto bg-[#121214] border-r border-[#232326] transition-all duration-300 flex flex-col shrink-0 shadow-2xl lg:shadow-none"
        >
            <div class="p-6 h-20 flex items-center justify-between border-b border-[#232326]">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="w-8 h-8 rounded-full border border-[#d8c49d]/40 flex items-center justify-center bg-[#18181b] shrink-0">
                        <span class="font-serif text-xs font-bold text-[#d8c49d]">FR</span>
                    </div>
                    <span x-show="sidebarOpen || isMobile" class="font-serif font-bold tracking-widest text-[#f5f5f3] text-base truncate">
                        FREDOSIS
                    </span>
                </div>
                <button 
                    type="button"
                    @click="sidebarOpen = !sidebarOpen" 
                    class="text-[#8e8e93] hover:text-white p-1 rounded hover:bg-white/5" 
                    aria-label="Toggle Sidebar"
                >
                    <svg x-show="sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    <svg x-show="!sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-grow py-6 px-3 space-y-1.5 overflow-y-auto">
                @php
                    $links = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'bar-chart-3'],
                        ['route' => 'admin.portfolio.index', 'label' => 'Portafolio de Arte', 'icon' => 'image'],
                        ['route' => 'admin.products.index', 'label' => 'Dibujos & Tienda', 'icon' => 'shopping-bag'],
                        ['route' => 'admin.flash.index', 'label' => 'Diseños Flash', 'icon' => 'zap'],
                        ['route' => 'admin.agenda', 'label' => 'Agenda Tatuajes', 'icon' => 'calendar'],
                        ['route' => 'admin.requests', 'label' => 'Solicitudes Citas', 'icon' => 'message-square'],
                        ['route' => 'admin.settings', 'label' => 'PayPal & Notificaciones', 'icon' => 'settings'],
                    ];
                @endphp

                @foreach($links as $link)
                    @php $isActive = request()->routeIs(str_replace('.index', '', $link['route']).'*'); @endphp
                    <a 
                        href="{{ route($link['route']) }}" 
                        @click="if (isMobile) sidebarOpen = false"
                        class="flex items-center gap-3.5 px-3.5 py-3 text-xs font-semibold uppercase tracking-wider rounded-lg transition-all {{ $isActive ? 'bg-[#d8c49d] text-black font-bold shadow-md' : 'text-[#8e8e93] hover:text-white hover:bg-[#1a1a1d]' }}"
                    >
                        <i data-lucide="{{ $link['icon'] }}" class="w-4 h-4 shrink-0 {{ $isActive ? 'text-black' : 'text-[#d8c49d]' }}"></i>
                        <span x-show="sidebarOpen || isMobile" class="truncate">{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="p-4 border-t border-[#232326] space-y-2">
                <a 
                    href="{{ route('home') }}" 
                    target="_blank"
                    class="w-full flex items-center gap-3.5 px-3.5 py-2.5 text-xs text-[#8e8e93] hover:text-[#d8c49d] hover:bg-[#1a1a1d] rounded-lg transition-all"
                >
                    <i data-lucide="external-link" class="w-4 h-4 shrink-0"></i>
                    <span x-show="sidebarOpen || isMobile">Ver Sitio Web</span>
                </a>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3.5 px-3.5 py-2.5 text-xs text-rose-400 hover:bg-rose-500/10 rounded-lg transition-all">
                        <i data-lucide="log-out" class="w-4 h-4 shrink-0"></i>
                        <span x-show="sidebarOpen || isMobile">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-grow flex flex-col overflow-hidden min-w-0">
            <!-- Topbar -->
            <header class="h-20 border-b border-[#232326] bg-[#121214] flex items-center justify-between px-6 shrink-0">
                <div class="flex items-center gap-3">
                    <button 
                        type="button"
                        @click="sidebarOpen = !sidebarOpen" 
                        class="lg:hidden p-2 text-[#d8c49d] hover:text-white" 
                        aria-label="Abrir Menú"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>
                    <h2 class="font-serif text-lg font-bold text-white">@yield('page_title', 'Administración')</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right text-xs">
                        <span class="font-bold text-white block">{{ auth('admin')->user()->name ?? 'Fredosis' }}</span>
                        <span class="text-[10px] text-[#8e8e93]">Estudio Metro Santa Ana</span>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-[#d8c49d]/20 border border-[#d8c49d]/40 flex items-center justify-center text-xs font-bold text-[#d8c49d]">
                        FD
                    </div>
                </div>
            </header>

            <!-- Alerts -->
            @if(session('success'))
                <div class="m-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-semibold flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button type="button" @click="$el.parentElement.remove()" class="text-emerald-400 hover:text-white">&times;</button>
                </div>
            @endif

            @if(session('info'))
                <div class="m-6 p-4 rounded-xl bg-blue-500/10 border border-blue-500/30 text-blue-400 text-xs font-semibold flex items-center justify-between">
                    <span>{{ session('info') }}</span>
                    <button type="button" @click="$el.parentElement.remove()" class="text-blue-400 hover:text-white">&times;</button>
                </div>
            @endif

            <!-- Body View -->
            <main class="flex-grow p-6 lg:p-8 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
