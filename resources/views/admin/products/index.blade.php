@extends('layouts.admin')

@section('title', 'Tienda — Admin FREDOSIS')
@section('page_title', 'Administración de Dibujos & Láminas en Venta')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-xs text-[#8e8e93]">Gestiona los dibujos originales, láminas giclée y precios en la tienda e-commerce.</p>
        <a 
            href="{{ route('admin.products.create') }}" 
            class="px-5 py-2.5 rounded-xl bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2"
        >
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Nuevo Producto / Lámina</span>
        </a>
    </div>

    <!-- Products Table -->
    <div class="bg-[#121214] border border-[#232326] rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#161619] border-b border-[#232326] text-[#8e8e93] uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="p-4">Producto</th>
                        <th class="p-4">Categoría / Técnica</th>
                        <th class="p-4">Formatos & Precios</th>
                        <th class="p-4">Original</th>
                        <th class="p-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#232326]">
                    @forelse($products as $prod)
                        <tr class="hover:bg-[#18181b] transition-colors">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $prod->main_image }}" alt="{{ $prod->title }}" class="w-12 h-14 object-cover rounded bg-black shrink-0">
                                    <div>
                                        <p class="font-bold text-white text-sm">{{ $prod->title }}</p>
                                        <p class="text-[11px] text-[#666]">Base: ${{ number_format($prod->base_price_usd, 0) }} USD (${{ number_format($prod->base_price_clp, 0, ',', '.') }} CLP)</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-[#a6a6aa]">
                                <span class="px-2 py-0.5 rounded bg-[#1e1e22] text-[#d8c49d] font-semibold text-[10px] uppercase">
                                    {{ $prod->category }}
                                </span>
                                <p class="text-[11px] text-[#777] mt-1">{{ $prod->technique }}</p>
                            </td>
                            <td class="p-4 text-[#a6a6aa]">
                                <span class="font-bold text-white">{{ $prod->variants->count() }} variantes</span>
                                <div class="text-[11px] text-[#777] mt-0.5">
                                    @foreach($prod->variants->take(2) as $v)
                                        <span>{{ $v->format_name }}: ${{ number_format($v->price_usd, 0) }} USD</span><br>
                                    @endforeach
                                </div>
                            </td>
                            <td class="p-4">
                                @if(!$prod->has_original)
                                    <span class="text-[#555] text-[11px]">Solo Prints</span>
                                @elseif($prod->original_sold)
                                    <span class="px-2 py-0.5 rounded bg-black text-[#8e8e93] border border-[#333] text-[10px] font-bold">VENDIDO</span>
                                @else
                                    <span class="px-2 py-0.5 rounded bg-[#d8c49d]/20 text-[#d8c49d] font-bold text-[10px]">DISPONIBLE</span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a 
                                        href="{{ route('admin.products.edit', $prod->id) }}" 
                                        class="p-2 rounded bg-[#1c1c1f] hover:bg-[#28282d] text-white transition-all"
                                        title="Editar producto"
                                    >
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="p-2 rounded bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 transition-all"
                                            title="Eliminar producto"
                                        >
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-[#666]">No hay productos en la tienda aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
