@extends('layouts.admin')

@section('title', 'Diseños Flash — Admin FREDOSIS')
@section('page_title', 'Administración de Diseños Flash Disponibles')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-xs text-[#8e8e93]">Gestiona los diseños flash que Fredosis tiene disponibles para tatuar una sola vez.</p>
            <div class="flex items-center gap-4 mt-2 text-xs">
                <span class="text-[#d8c49d] font-bold">Total: {{ $flashes->count() }}</span>
                <span class="text-emerald-400 font-bold">• {{ $flashes->where('is_claimed', false)->count() }} Disponibles</span>
                <span class="text-[#888]">• {{ $flashes->where('is_claimed', true)->count() }} Reclamados / Tatuados</span>
            </div>
        </div>
        <a 
            href="{{ route('admin.flash.create') }}" 
            class="px-5 py-2.5 rounded-xl bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2"
        >
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Nuevo Diseño Flash</span>
        </a>
    </div>

    <!-- Flash Table -->
    <div class="bg-[#121214] border border-[#232326] rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#161619] border-b border-[#232326] text-[#8e8e93] uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="p-4">Diseño Flash</th>
                        <th class="p-4">Precio (CLP / USD)</th>
                        <th class="p-4">Medidas & Zona</th>
                        <th class="p-4">Disponibilidad</th>
                        <th class="p-4 text-center">Alternar Estado</th>
                        <th class="p-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#232326]">
                    @forelse($flashes as $flash)
                        <tr class="hover:bg-[#18181b] transition-colors">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $flash->image_url }}" alt="{{ $flash->title }}" class="w-12 h-14 object-cover rounded bg-black shrink-0 border border-[#26262a]">
                                    <div>
                                        <p class="font-bold text-white text-sm">{{ $flash->title }}</p>
                                        <p class="text-[11px] text-[#666] line-clamp-1">{{ $flash->description ?? 'Diseño exclusivo de autor' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="space-y-0.5">
                                    <p class="font-bold text-[#d8c49d] text-sm">${{ number_format($flash->price_clp, 0, ',', '.') }} CLP</p>
                                    <p class="text-[10px] text-[#777]">${{ number_format($flash->price_usd, 0) }} USD</p>
                                </div>
                            </td>
                            <td class="p-4 text-[#a6a6aa]">
                                <p class="font-mono text-xs text-white">{{ $flash->size_cm ?? 'Medida libre' }}</p>
                                <p class="text-[10px] text-[#777]">{{ $flash->recommended_zone ?? 'Zona adaptable' }}</p>
                            </td>
                            <td class="p-4">
                                @if(!$flash->is_claimed)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-semibold text-[10px]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        Disponible
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 font-semibold text-[10px]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                        Reclamado {{ $flash->claimed_by_name ? "({$flash->claimed_by_name})" : '' }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <form action="{{ route('admin.flash.toggle', $flash->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button 
                                        type="submit" 
                                        class="px-3 py-1.5 rounded-lg border text-[11px] font-semibold transition-all {{ $flash->is_claimed ? 'border-emerald-500/40 text-emerald-400 hover:bg-emerald-500/10' : 'border-amber-500/40 text-amber-400 hover:bg-amber-500/10' }}"
                                        title="{{ $flash->is_claimed ? 'Marcar como disponible nuevamente' : 'Marcar como reclamado' }}"
                                    >
                                        {{ $flash->is_claimed ? 'Liberar' : 'Marcar Tatuado' }}
                                    </button>
                                </form>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a 
                                        href="{{ route('admin.flash.edit', $flash->id) }}" 
                                        class="p-2 rounded-lg bg-[#1e1e22] hover:bg-[#d8c49d] text-white hover:text-black transition-all"
                                        title="Editar Flash"
                                    >
                                        <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <form action="{{ route('admin.flash.destroy', $flash->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este diseño flash?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="p-2 rounded-lg bg-[#1e1e22] hover:bg-rose-500 text-[#8e8e93] hover:text-white transition-all"
                                            title="Eliminar Flash"
                                        >
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-[#666]">
                                <i data-lucide="zap" class="w-8 h-8 mx-auto mb-2 text-[#444]"></i>
                                <p class="text-sm font-semibold">No hay diseños flash registrados</p>
                                <p class="text-xs text-[#555] mt-1">Sube el primer dibujo flash para que tus clientes puedan reservarlo directamente.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
