@extends('layouts.admin')

@section('title', 'Portafolio — Admin FREDOSIS')
@section('page_title', 'Administración de Portafolio & Obras')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-xs text-[#8e8e93]">Gestiona las obras expuestas en la galería pública de Fredosis.</p>
        <a 
            href="{{ route('admin.portfolio.create') }}" 
            class="px-5 py-2.5 rounded-xl bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2"
        >
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Nueva Obra</span>
        </a>
    </div>

    <!-- Artworks Table -->
    <div class="bg-[#121214] border border-[#232326] rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#161619] border-b border-[#232326] text-[#8e8e93] uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="p-4">Obra</th>
                        <th class="p-4">Categoría</th>
                        <th class="p-4">Técnica / Dimensiones</th>
                        <th class="p-4">Destacado</th>
                        <th class="p-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#232326]">
                    @forelse($artworks as $art)
                        <tr class="hover:bg-[#18181b] transition-colors">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $art->image_url }}" alt="{{ $art->title }}" class="w-12 h-14 object-cover rounded bg-black shrink-0">
                                    <div>
                                        <p class="font-bold text-white text-sm">{{ $art->title }}</p>
                                        <p class="text-[11px] text-[#666]">Año: {{ $art->year ?? '2026' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 rounded bg-[#1e1e22] text-[#d8c49d] font-semibold text-[10px] uppercase">
                                    {{ $art->category }}
                                </span>
                            </td>
                            <td class="p-4 text-[#a6a6aa]">
                                <p class="line-clamp-1">{{ $art->medium ?? 'Grafito' }}</p>
                                <p class="text-[10px] text-[#666]">{{ $art->dimensions ?? 'Dimensiones de autor' }}</p>
                            </td>
                            <td class="p-4">
                                @if($art->is_featured)
                                    <span class="text-emerald-400 font-bold text-[11px]">★ Sí</span>
                                @else
                                    <span class="text-[#555] text-[11px]">No</span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a 
                                        href="{{ route('admin.portfolio.edit', $art->id) }}" 
                                        class="p-2 rounded bg-[#1c1c1f] hover:bg-[#28282d] text-white transition-all"
                                        title="Editar obra"
                                    >
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.portfolio.destroy', $art->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta obra?')">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="p-2 rounded bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 transition-all"
                                            title="Eliminar obra"
                                        >
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-[#666]">No hay obras registradas en el portafolio.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
