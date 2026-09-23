@extends('layouts.app')

@section('title', 'Solicitud Enviada con Éxito — FREDOSIS Tattoo Atelier')

@section('content')
<section class="py-24 px-6 max-w-xl mx-auto text-center space-y-8">
    <div class="w-20 h-20 rounded-full bg-[#d8c49d]/10 border-2 border-[#d8c49d] mx-auto flex items-center justify-center text-[#d8c49d] shadow-xl">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
    </div>

    <div class="space-y-3">
        <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">Solicitud Registrada</span>
        <h1 class="text-3xl md:text-5xl font-serif font-bold text-[#f5f5f3]">¡Solicitud Recibida!</h1>
        <p class="text-sm text-[#8e8e93] leading-relaxed">
            Tu propuesta de tatuaje ha ingresado a la agenda de Fredosis en el estudio cercano a <strong>Metro Santa Ana, Santiago Centro</strong>.
        </p>
    </div>

    @if($booking)
        <div class="p-6 rounded-2xl bg-[#141416] border border-[#232326] text-left space-y-3 text-xs">
            <div class="flex justify-between border-b border-[#232326] pb-2">
                <span class="text-[#8e8e93]">Código de Solicitud:</span>
                <span class="font-bold text-white">#FRD-{{ $booking->id }}</span>
            </div>
            <div class="flex justify-between border-b border-[#232326] pb-2">
                <span class="text-[#8e8e93]">Cliente:</span>
                <span class="font-bold text-white">{{ $booking->client->name }}</span>
            </div>
            <div class="flex justify-between border-b border-[#232326] pb-2">
                <span class="text-[#8e8e93]">Fecha Solicitada:</span>
                <span class="font-bold text-[#d8c49d]">{{ \Carbon\Carbon::parse($booking->preferred_date)->isoFormat('dddd D [de] MMMM, YYYY') }} ({{ $booking->preferred_time_slot == 'Morning' ? 'Mañana' : 'Tarde' }})</span>
            </div>
            <div class="flex justify-between">
                <span class="text-[#8e8e93]">Ubicación:</span>
                <span class="font-bold text-white">Metro Santa Ana, Santiago</span>
            </div>
        </div>
    @endif

    <div class="space-y-4 pt-4">
        <a 
            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappPhone) }}?text=Hola%20Fredosis,%20acabo%20de%20enviar%20mi%20solicitud%20de%20cita%20en%20el%20sitio%20web%20(Solicitud%20#{{ $booking->id ?? 'WEB' }}).%20%C2%BFMe%20podr%C3%ADas%20confirmar%20disponibilidad?"
            target="_blank"
            rel="noopener"
            class="w-full flex items-center justify-center gap-2.5 py-4 px-6 rounded-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs uppercase tracking-widest transition-all shadow-xl"
        >
            <span>Notificar Directo por WhatsApp</span>
        </a>

        <a 
            href="{{ route('home') }}" 
            class="inline-block text-xs uppercase tracking-widest text-[#8e8e93] hover:text-[#d8c49d] transition-colors"
        >
            ← Volver a la Galería Principal
        </a>
    </div>
</section>
@endsection
