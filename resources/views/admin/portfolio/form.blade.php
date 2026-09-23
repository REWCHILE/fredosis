@extends('layouts.admin')

@section('title', ($artwork ? 'Editar Obra' : 'Nueva Obra') . ' — Admin FREDOSIS')
@section('page_title', $artwork ? 'Editar Obra de Arte' : 'Agregar Nueva Obra')

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="bg-[#121214] border border-[#232326] rounded-2xl p-8 shadow-xl">
        <form 
            action="{{ $artwork ? route('admin.portfolio.update', $artwork->id) : route('admin.portfolio.store') }}" 
            method="POST" 
            class="space-y-6 text-xs"
        >
            @csrf
            @if($artwork)
                @method('PUT')
            @endif

            <div class="space-y-1.5">
                <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Título de la Obra *</label>
                <input 
                    type="text" 
                    name="title" 
                    value="{{ old('title', $artwork->title ?? '') }}" 
                    placeholder="Ej: Ecos de la Percepción"
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
                        <option value="drawings" {{ old('category', $artwork->category ?? '') == 'drawings' ? 'selected' : '' }}>Dibujos a Grafito</option>
                        <option value="paintings" {{ old('category', $artwork->category ?? '') == 'paintings' ? 'selected' : '' }}>Pinturas</option>
                        <option value="tattoos" {{ old('category', $artwork->category ?? '') == 'tattoos' ? 'selected' : '' }}>Tatuajes & Flash</option>
                        <option value="sketches" {{ old('category', $artwork->category ?? '') == 'sketches' ? 'selected' : '' }}>Bocetos & Estudios</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">URL de la Imagen *</label>
                    <input 
                        type="url" 
                        name="image_url" 
                        value="{{ old('image_url', $artwork->image_url ?? '') }}" 
                        placeholder="https://images.unsplash.com/..."
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]" 
                        required
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-1.5">
                    <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Técnica</label>
                    <input 
                        type="text" 
                        name="medium" 
                        value="{{ old('medium', $artwork->medium ?? '') }}" 
                        placeholder="Grafito sobre papel Fabriano 300g"
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                    >
                </div>

                <div class="space-y-1.5">
                    <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Dimensiones</label>
                    <input 
                        type="text" 
                        name="dimensions" 
                        value="{{ old('dimensions', $artwork->dimensions ?? '') }}" 
                        placeholder="42 x 59.4 cm (A2)"
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                    >
                </div>

                <div class="space-y-1.5">
                    <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Año</label>
                    <input 
                        type="text" 
                        name="year" 
                        value="{{ old('year', $artwork->year ?? date('Y')) }}" 
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                    >
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Descripción o Declaración de la Obra</label>
                <textarea 
                    name="description" 
                    rows="4" 
                    placeholder="Detalles conceptuales de la obra..."
                    class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                >{{ old('description', $artwork->description ?? '') }}</textarea>
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer text-white">
                    <input 
                        type="checkbox" 
                        name="is_featured" 
                        value="1" 
                        {{ old('is_featured', $artwork->is_featured ?? false) ? 'checked' : '' }}
                        class="rounded bg-[#18181b] border-[#2c2c30] text-[#d8c49d] focus:ring-[#d8c49d]"
                    >
                    <span>Mostrar como obra destacada en Inicio</span>
                </label>
            </div>

            <div class="pt-4 border-t border-[#232326] flex items-center justify-between">
                <a href="{{ route('admin.portfolio.index') }}" class="text-[#8e8e93] hover:text-white">
                    ← Cancelar
                </a>
                <button 
                    type="submit" 
                    class="px-8 py-3.5 rounded-xl bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-widest transition-all shadow-xl"
                >
                    {{ $artwork ? 'Guardar Cambios' : 'Publicar Obra' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
