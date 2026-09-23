@extends('layouts.admin')

@section('title', 'Dashboard — FREDOSIS ART')
@section('page_title', 'Resumen General del Atelier')

@section('content')
<div class="space-y-8">
    <!-- Top Statistics Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <!-- 1. Obras en Portafolio -->
        <div class="p-5 rounded-2xl bg-[#121214] border border-[#232326] space-y-2">
            <span class="text-[10px] uppercase tracking-widest text-[#8e8e93] font-semibold">Obras en Galería</span>
            <div class="flex items-center justify-between">
                <span class="font-serif text-2xl font-bold text-white">{{ $portfolioCount }}</span>
                <div class="p-2 rounded-lg bg-[#d8c49d]/10 text-[#d8c49d]">
                    <i data-lucide="image" class="w-4 h-4"></i>
                </div>
            </div>
            <a href="{{ route('admin.portfolio.index') }}" class="text-[11px] text-[#d8c49d] hover:underline font-semibold block pt-1">
                Portafolio →
            </a>
        </div>

        <!-- 2. Productos & Láminas -->
        <div class="p-5 rounded-2xl bg-[#121214] border border-[#232326] space-y-2">
            <span class="text-[10px] uppercase tracking-widest text-[#8e8e93] font-semibold">Láminas & Tienda</span>
            <div class="flex items-center justify-between">
                <span class="font-serif text-2xl font-bold text-white">{{ $productsCount }}</span>
                <div class="p-2 rounded-lg bg-emerald-500/10 text-emerald-400">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                </div>
            </div>
            <a href="{{ route('admin.products.index') }}" class="text-[11px] text-emerald-400 hover:underline font-semibold block pt-1">
                Tienda →
            </a>
        </div>

        <!-- 3. Flashes Disponibles -->
        <div class="p-5 rounded-2xl bg-[#121214] border border-[#232326] space-y-2">
            <span class="text-[10px] uppercase tracking-widest text-[#8e8e93] font-semibold">Flashes Disponibles</span>
            <div class="flex items-center justify-between">
                <span class="font-serif text-2xl font-bold text-amber-400">{{ $flashAvailableCount }}</span>
                <div class="p-2 rounded-lg bg-amber-500/10 text-amber-400">
                    <i data-lucide="zap" class="w-4 h-4"></i>
                </div>
            </div>
            <a href="{{ route('admin.flash.index') }}" class="text-[11px] text-amber-400 hover:underline font-semibold block pt-1">
                Diseños Flash →
            </a>
        </div>

        <!-- 4. Solicitudes de Tatuajes Pendientes -->
        <div class="p-5 rounded-2xl bg-[#121214] border border-[#232326] space-y-2">
            <span class="text-[10px] uppercase tracking-widest text-[#8e8e93] font-semibold">Solicitudes Citas</span>
            <div class="flex items-center justify-between">
                <span class="font-serif text-2xl font-bold text-white">{{ $pendingRequestsCount }}</span>
                <div class="p-2 rounded-lg bg-rose-500/10 text-rose-400">
                    <i data-lucide="message-square" class="w-4 h-4"></i>
                </div>
            </div>
            <a href="{{ route('admin.requests') }}" class="text-[11px] text-rose-400 hover:underline font-semibold block pt-1">
                Solicitudes →
            </a>
        </div>

        <!-- 5. Citas Confirmadas Agenda -->
        <div class="p-5 rounded-2xl bg-[#121214] border border-[#232326] space-y-2">
            <span class="text-[10px] uppercase tracking-widest text-[#8e8e93] font-semibold">Citas Confirmadas</span>
            <div class="flex items-center justify-between">
                <span class="font-serif text-2xl font-bold text-white">{{ $activeAppointmentsCount }}</span>
                <div class="p-2 rounded-lg bg-blue-500/10 text-blue-400">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                </div>
            </div>
            <a href="{{ route('admin.agenda') }}" class="text-[11px] text-blue-400 hover:underline font-semibold block pt-1">
                Agenda en vivo →
            </a>
        </div>
    </div>

    <!-- Two-Column Overview: Recent Orders & Upcoming Tattoo Appointments -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Orders (PayPal) -->
        <div class="bg-[#121214] border border-[#232326] rounded-2xl p-6 shadow-xl space-y-4">
            <div class="flex items-center justify-between border-b border-[#232326] pb-4">
                <h3 class="font-serif text-base font-bold text-white flex items-center gap-2">
                    <i data-lucide="credit-card" class="w-4 h-4 text-[#d8c49d]"></i>
                    <span>Órdenes de Tienda (PayPal)</span>
                </h3>
                <span class="text-xs text-[#8e8e93]">{{ $ordersCount }} totales</span>
            </div>

            <div class="space-y-3">
                @forelse($recentOrders as $order)
                    <div class="p-3.5 rounded-xl bg-[#18181b] border border-[#26262a] flex items-center justify-between text-xs">
                        <div>
                            <p class="font-bold text-white">{{ $order->order_number }}</p>
                            <p class="text-[#8e8e93]">{{ $order->customer_name }} • {{ $order->customer_email }}</p>
                            <p class="text-[11px] text-[#666]">{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="text-right">
                            <span class="font-bold text-[#d8c49d] block">${{ number_format($order->total_amount, 2) }} {{ $order->currency }}</span>
                            <span class="text-[10px] px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 font-bold">
                                {{ $order->payment_status }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-[#666] py-6 text-center">No hay órdenes registradas aún.</p>
                @endforelse
            </div>
        </div>

        <!-- Pending Tattoo Requests (Metro Santa Ana) -->
        <div class="bg-[#121214] border border-[#232326] rounded-2xl p-6 shadow-xl space-y-4">
            <div class="flex items-center justify-between border-b border-[#232326] pb-4">
                <h3 class="font-serif text-base font-bold text-white flex items-center gap-2">
                    <i data-lucide="calendar-clock" class="w-4 h-4 text-[#d8c49d]"></i>
                    <span>Solicitudes Recientes de Tatuaje</span>
                </h3>
                <a href="{{ route('admin.requests') }}" class="text-xs text-[#d8c49d] hover:underline">Ver todas</a>
            </div>

            <div class="space-y-3">
                @forelse($recentRequests as $req)
                    <div class="p-3.5 rounded-xl bg-[#18181b] border border-[#26262a] flex items-center justify-between text-xs">
                        <div class="space-y-1">
                            <p class="font-bold text-white">{{ $req->client->name }}</p>
                            <p class="text-[#8e8e93] line-clamp-1">{{ $req->description }}</p>
                            <p class="text-[11px] text-[#d8c49d]">
                                {{ \Carbon\Carbon::parse($req->preferred_date)->format('d/m/Y') }} • {{ $req->size }}
                            </p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <form action="{{ route('admin.requests.approve', $req->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 rounded bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[10px] uppercase">
                                    Aprobar
                                </button>
                            </form>
                            <form action="{{ route('admin.requests.reject', $req->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-2 py-1.5 rounded border border-[#333] hover:bg-rose-500/20 text-rose-400 text-[10px]">
                                    ✕
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-[#666] py-6 text-center">No hay solicitudes pendientes en este momento.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
