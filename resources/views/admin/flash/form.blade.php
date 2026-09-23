@extends('layouts.admin')

@section('title', ($flash ? 'Editar Flash' : 'Nuevo Flash') . ' — Admin FREDOSIS')
@section('page_title', $flash ? 'Editar Diseño Flash' : 'Publicar Nuevo Diseño Flash')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.flash.index') }}" class="text-xs text-[#8e8e93] hover:text-[#d8c49d] transition-colors flex items-center gap-1.5">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
            <span>Volver a Diseños Flash</span>
        </a>
    </div>

    <form 
        action="{{ $flash ? route('admin.flash.update', $flash->id) : route('admin.flash.store') }}" 
        method="POST" 
        enctype="multipart/form-data"
        class="bg-[#121214] border border-[#232326] rounded-2xl p-8 space-y-8 shadow-2xl"
        x-data="{
            previewUrl: '{{ $flash->image_url ?? '' }}',
            handleFileSelect(event) {
                const file = event.target.files[0];
                if (file) {
                    this.previewUrl = URL.createObjectURL(file);
                }
            }
        }"
    >
        @csrf
        @if($flash)
            @method('PUT')
        @endif

        @if($errors->any())
            <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs space-y-1">
                <p class="font-bold">Por favor corrige los siguientes campos:</p>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Image Upload Section -->
        <div class="space-y-4">
            <label class="block text-xs uppercase tracking-wider text-[#d8c49d] font-bold">
                1. Imagen del Dibujo / Diseño Flash *
            </label>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                <!-- Preview Box -->
                <div class="md:col-span-4">
                    <div class="aspect-[3/4] bg-black border border-[#26262a] rounded-xl overflow-hidden relative flex items-center justify-center group shadow-inner">
                        <template x-if="previewUrl">
                            <img :src="previewUrl" alt="Vista previa del flash" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!previewUrl">
                            <div class="text-center p-4 text-[#555] space-y-2">
                                <i data-lucide="image" class="w-10 h-10 mx-auto text-[#333]"></i>
                                <p class="text-xs">Sin imagen seleccionada</p>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Upload Controls -->
                <div class="md:col-span-8 space-y-4">
                    <!-- File Input -->
                    <div class="p-6 rounded-xl border-2 border-dashed border-[#2c2c30] hover:border-[#d8c49d]/50 bg-[#161619] transition-all text-center relative">
                        <input 
                            type="file" 
                            name="image_file" 
                            id="image_file" 
                            accept="image/*"
                            @change="handleFileSelect"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        >
                        <div class="space-y-2 pointer-events-none">
                            <i data-lucide="upload-cloud" class="w-8 h-8 mx-auto text-[#d8c49d]"></i>
                            <p class="text-xs font-semibold text-white">Haz clic aquí para seleccionar o arrastra una imagen</p>
                            <p class="text-[10px] text-[#777]">Formatos soportados: JPG, PNG, WEBP (Máx. 5MB)</p>
                        </div>
                    </div>

                    <!-- URL Fallback -->
                    <div class="space-y-1">
                        <label for="image_url" class="text-[11px] text-[#8e8e93]">O ingresa una URL directa de imagen (opcional):</label>
                        <input 
                            type="text" 
                            name="image_url" 
                            id="image_url" 
                            value="{{ old('image_url', $flash->image_url ?? '') }}" 
                            @input="if (!$refs.image_file?.value) previewUrl = $event.target.value"
                            placeholder="https://..." 
                            class="w-full px-4 py-2.5 rounded-xl bg-[#161619] border border-[#232326] text-white text-xs focus:outline-none focus:border-[#d8c49d]"
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-[#232326] pt-6 space-y-6">
            <label class="block text-xs uppercase tracking-wider text-[#d8c49d] font-bold">
                2. Información del Diseño & Precio
            </label>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="space-y-1.5 md:col-span-2">
                    <label for="title" class="text-xs font-semibold text-[#ededeb]">Título del Diseño *</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        value="{{ old('title', $flash->title ?? '') }}" 
                        required 
                        placeholder="Ej: El Abrazo de la Sombra" 
                        class="w-full px-4 py-3 rounded-xl bg-[#161619] border border-[#232326] text-white text-sm focus:outline-none focus:border-[#d8c49d]"
                    >
                </div>

                <!-- Price CLP -->
                <div class="space-y-1.5">
                    <label for="price_clp" class="text-xs font-semibold text-[#ededeb]">Precio en Pesos Chilenos (CLP) *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-xs text-[#777] font-mono">$</span>
                        <input 
                            type="number" 
                            step="1000" 
                            name="price_clp" 
                            id="price_clp" 
                            value="{{ old('price_clp', $flash->price_clp ?? 75000) }}" 
                            required 
                            placeholder="75000" 
                            class="w-full pl-8 pr-4 py-3 rounded-xl bg-[#161619] border border-[#232326] text-white text-sm font-mono focus:outline-none focus:border-[#d8c49d]"
                        >
                    </div>
                    <span class="text-[10px] text-[#666]">Valor estimado final de la sesión de este flash.</span>
                </div>

                <!-- Price USD -->
                <div class="space-y-1.5">
                    <label for="price_usd" class="text-xs font-semibold text-[#ededeb]">Precio en Dólares (USD)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-xs text-[#777] font-mono">$</span>
                        <input 
                            type="number" 
                            step="1" 
                            name="price_usd" 
                            id="price_usd" 
                            value="{{ old('price_usd', $flash->price_usd ?? 80) }}" 
                            placeholder="80" 
                            class="w-full pl-8 pr-4 py-3 rounded-xl bg-[#161619] border border-[#232326] text-white text-sm font-mono focus:outline-none focus:border-[#d8c49d]"
                        >
                    </div>
                    <span class="text-[10px] text-[#666]">Para clientes internacionales o pagos vía PayPal.</span>
                </div>

                <!-- Size in CM -->
                <div class="space-y-1.5">
                    <label for="size_cm" class="text-xs font-semibold text-[#ededeb]">Dimensiones sugeridas (cm)</label>
                    <input 
                        type="text" 
                        name="size_cm" 
                        id="size_cm" 
                        value="{{ old('size_cm', $flash->size_cm ?? '14 x 9 cm') }}" 
                        placeholder="Ej: 14 x 9 cm" 
                        class="w-full px-4 py-3 rounded-xl bg-[#161619] border border-[#232326] text-white text-sm focus:outline-none focus:border-[#d8c49d]"
                    >
                </div>

                <!-- Recommended Body Zone -->
                <div class="space-y-1.5">
                    <label for="recommended_zone" class="text-xs font-semibold text-[#ededeb]">Zona del cuerpo sugerida</label>
                    <input 
                        type="text" 
                        name="recommended_zone" 
                        id="recommended_zone" 
                        value="{{ old('recommended_zone', $flash->recommended_zone ?? 'Antebrazo, gemelo o tríceps') }}" 
                        placeholder="Ej: Antebrazo, gemelo, costillas" 
                        class="w-full px-4 py-3 rounded-xl bg-[#161619] border border-[#232326] text-white text-sm focus:outline-none focus:border-[#d8c49d]"
                    >
                </div>

                <!-- Tattoo Style -->
                <div class="space-y-1.5 md:col-span-2">
                    <label for="style_id" class="text-xs font-semibold text-[#ededeb]">Estilo de Tatuaje</label>
                    <select 
                        name="style_id" 
                        id="style_id" 
                        class="w-full px-4 py-3 rounded-xl bg-[#161619] border border-[#232326] text-white text-sm focus:outline-none focus:border-[#d8c49d]"
                    >
                        <option value="">Selecciona un estilo (opcional)</option>
                        @foreach($styles as $style)
                            <option value="{{ $style->id }}" {{ (old('style_id', $flash->style_id ?? '') == $style->id) ? 'selected' : '' }}>
                                {{ $style->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Description -->
                <div class="space-y-1.5 md:col-span-2">
                    <label for="description" class="text-xs font-semibold text-[#ededeb]">Descripción / Concepto Artístico</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="3" 
                        placeholder="Breve reseña sobre la técnica, claroscuro o detalles del diseño..."
                        class="w-full px-4 py-3 rounded-xl bg-[#161619] border border-[#232326] text-white text-sm focus:outline-none focus:border-[#d8c49d]"
                    >{{ old('description', $flash->description ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Availability Status -->
        <div class="border-t border-[#232326] pt-6 space-y-4">
            <label class="block text-xs uppercase tracking-wider text-[#d8c49d] font-bold">
                3. Estado de Disponibilidad & Exclusividad
            </label>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="flex items-start gap-3 p-4 rounded-xl bg-[#161619] border border-[#232326] cursor-pointer hover:border-[#d8c49d]/40 transition-colors">
                    <input 
                        type="checkbox" 
                        name="is_claimed" 
                        value="1" 
                        {{ old('is_claimed', $flash->is_claimed ?? false) ? 'checked' : '' }}
                        class="mt-1 w-4 h-4 rounded text-[#d8c49d] bg-black border-[#333] focus:ring-0"
                    >
                    <div>
                        <span class="text-xs font-bold text-white block">Marcar como Reclamado / Ya Tatuado</span>
                        <span class="text-[11px] text-[#777]">Si está marcado, se mostrará como no disponible en la web.</span>
                    </div>
                </label>

                <label class="flex items-start gap-3 p-4 rounded-xl bg-[#161619] border border-[#232326] cursor-pointer hover:border-[#d8c49d]/40 transition-colors">
                    <input 
                        type="checkbox" 
                        name="is_active" 
                        value="1" 
                        {{ old('is_active', $flash->is_active ?? true) ? 'checked' : '' }}
                        class="mt-1 w-4 h-4 rounded text-[#d8c49d] bg-black border-[#333] focus:ring-0"
                    >
                    <div>
                        <span class="text-xs font-bold text-white block">Visible en la Galería Pública</span>
                        <span class="text-[11px] text-[#777]">Publicar inmediatamente este diseño en `/flash`.</span>
                    </div>
                </label>
            </div>

            <!-- Optional Claimed By Name -->
            <div class="space-y-1.5 max-w-sm">
                <label for="claimed_by_name" class="text-[11px] text-[#8e8e93]">Nombre del cliente que lo reservó (opcional):</label>
                <input 
                    type="text" 
                    name="claimed_by_name" 
                    id="claimed_by_name" 
                    value="{{ old('claimed_by_name', $flash->claimed_by_name ?? '') }}" 
                    placeholder="Ej: Camila N." 
                    class="w-full px-4 py-2 rounded-xl bg-[#161619] border border-[#232326] text-white text-xs focus:outline-none focus:border-[#d8c49d]"
                >
            </div>
        </div>

        <div class="border-t border-[#232326] pt-6 flex items-center justify-end gap-4">
            <a href="{{ route('admin.flash.index') }}" class="px-5 py-2.5 rounded-xl border border-[#333] text-xs font-semibold text-[#8e8e93] hover:text-white transition-all">
                Cancelar
            </a>
            <button 
                type="submit" 
                class="px-8 py-3 rounded-xl bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-widest transition-all shadow-xl"
            >
                {{ $flash ? 'Guardar Cambios' : 'Publicar Flash' }}
            </button>
        </div>
    </form>
</div>
@endsection
