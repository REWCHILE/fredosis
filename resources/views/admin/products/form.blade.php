@extends('layouts.admin')

@section('title', ($product ? 'Editar Producto' : 'Nuevo Producto') . ' — Admin FREDOSIS')
@section('page_title', $product ? 'Editar Producto / Lámina' : 'Agregar Dibujo a la Tienda')

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="bg-[#121214] border border-[#232326] rounded-2xl p-8 shadow-xl">
        <form 
            action="{{ $product ? route('admin.products.update', $product->id) : route('admin.products.store') }}" 
            method="POST" 
            class="space-y-6 text-xs"
        >
            @csrf
            @if($product)
                @method('PUT')
            @endif

            <div class="space-y-1.5">
                <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Título del Producto / Dibujo *</label>
                <input 
                    type="text" 
                    name="title" 
                    value="{{ old('title', $product->title ?? '') }}" 
                    placeholder="Ej: Ecos de la Percepción (Original & Prints)"
                    class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]" 
                    required
                >
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Categoría *</label>
                    <select 
                        name="category" 
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                        required
                    >
                        <option value="dibujos" {{ old('category', $product->category ?? '') == 'dibujos' ? 'selected' : '' }}>Dibujos</option>
                        <option value="originales" {{ old('category', $product->category ?? '') == 'originales' ? 'selected' : '' }}>Piezas Originales</option>
                        <option value="prints" {{ old('category', $product->category ?? '') == 'prints' ? 'selected' : '' }}>Láminas Fine Art</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">URL de la Imagen Principal *</label>
                    <input 
                        type="url" 
                        name="main_image" 
                        value="{{ old('main_image', $product->main_image ?? '') }}" 
                        placeholder="https://images.unsplash.com/..."
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]" 
                        required
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Técnica</label>
                    <input 
                        type="text" 
                        name="technique" 
                        value="{{ old('technique', $product->technique ?? '') }}" 
                        placeholder="Grafito y carbón sobre Fabriano 300g"
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                    >
                </div>

                <div class="space-y-1.5">
                    <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Dimensiones</label>
                    <input 
                        type="text" 
                        name="dimensions" 
                        value="{{ old('dimensions', $product->dimensions ?? '') }}" 
                        placeholder="42 x 59.4 cm (A2)"
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Precio Base (USD) *</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="base_price_usd" 
                        value="{{ old('base_price_usd', $product->base_price_usd ?? 50) }}" 
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]" 
                        required
                    >
                </div>

                <div class="space-y-1.5">
                    <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Precio Base (CLP) *</label>
                    <input 
                        type="number" 
                        step="1" 
                        name="base_price_clp" 
                        value="{{ old('base_price_clp', $product->base_price_clp ?? 45000) }}" 
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]" 
                        required
                    >
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Descripción Breve</label>
                <input 
                    type="text" 
                    name="short_description" 
                    value="{{ old('short_description', $product->short_description ?? '') }}" 
                    placeholder="Dibujo a grafito surrealista de alta precisión..."
                    class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                >
            </div>

            <div class="space-y-1.5">
                <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Descripción Completa & Datos de Conservación</label>
                <textarea 
                    name="description" 
                    rows="4" 
                    placeholder="Detalles de papel, tintas giclée, certificado de autenticidad..."
                    class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                >{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                <label class="flex items-center gap-2 cursor-pointer text-white">
                    <input 
                        type="checkbox" 
                        name="has_original" 
                        value="1" 
                        {{ old('has_original', $product->has_original ?? true) ? 'checked' : '' }}
                        class="rounded bg-[#18181b] border-[#2c2c30] text-[#d8c49d] focus:ring-[#d8c49d]"
                    >
                    <span>Incluye Pieza Original</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer text-white">
                    <input 
                        type="checkbox" 
                        name="original_sold" 
                        value="1" 
                        {{ old('original_sold', $product->original_sold ?? false) ? 'checked' : '' }}
                        class="rounded bg-[#18181b] border-[#2c2c30] text-[#d8c49d] focus:ring-[#d8c49d]"
                    >
                    <span>Original Vendido</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer text-white">
                    <input 
                        type="checkbox" 
                        name="is_featured" 
                        value="1" 
                        {{ old('is_featured', $product->is_featured ?? true) ? 'checked' : '' }}
                        class="rounded bg-[#18181b] border-[#2c2c30] text-[#d8c49d] focus:ring-[#d8c49d]"
                    >
                    <span>Destacado en Inicio</span>
                </label>
            </div>

            <div class="pt-4 border-t border-[#232326] flex items-center justify-between">
                <a href="{{ route('admin.products.index') }}" class="text-[#8e8e93] hover:text-white">
                    ← Cancelar
                </a>
                <button 
                    type="submit" 
                    class="px-8 py-3.5 rounded-xl bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-widest transition-all shadow-xl"
                >
                    {{ $product ? 'Guardar Cambios' : 'Crear Producto' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
