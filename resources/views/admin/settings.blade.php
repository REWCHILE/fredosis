@extends('layouts.admin')

@section('title', 'Ajustes — Admin FREDOSIS')
@section('page_title', 'Configuración de Pasarela de Pago & Notificaciones')

@section('content')
<div class="max-w-4xl space-y-8">
    <div class="bg-[#121214] border border-[#232326] rounded-2xl p-8 shadow-xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8 text-xs">
            @csrf

            <!-- 1. Pasarela de Pago (PayPal) -->
            <div class="space-y-4">
                <div class="border-b border-[#232326] pb-3 flex items-center gap-2.5">
                    <div class="p-2 rounded-lg bg-[#d8c49d]/10 text-[#d8c49d]">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="font-serif text-base font-bold text-white">Pasarela de Pago (PayPal)</h3>
                        <p class="text-[11px] text-[#8e8e93]">Configura las credenciales de cobro para ventas de dibujos, láminas y abonos.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Modo PayPal *</label>
                        <select 
                            name="paypal_mode" 
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                        >
                            <option value="sandbox" {{ ($settings['paypal_mode'] ?? '') == 'sandbox' ? 'selected' : '' }}>Pruebas (Sandbox)</option>
                            <option value="live" {{ ($settings['paypal_mode'] ?? '') == 'live' ? 'selected' : '' }}>En Vivo (Producción - Real)</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">PayPal Client ID *</label>
                        <input 
                            type="text" 
                            name="paypal_client_id" 
                            value="{{ old('paypal_client_id', $settings['paypal_client_id'] ?? 'sb') }}" 
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white font-mono focus:outline-none focus:border-[#d8c49d]"
                            required
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Moneda Base Tienda</label>
                        <select 
                            name="currency_default" 
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                        >
                            <option value="USD" {{ ($settings['currency_default'] ?? '') == 'USD' ? 'selected' : '' }}>USD ($ Dólar)</option>
                            <option value="CLP" {{ ($settings['currency_default'] ?? '') == 'CLP' ? 'selected' : '' }}>CLP ($ Peso Chileno)</option>
                            <option value="EUR" {{ ($settings['currency_default'] ?? '') == 'EUR' ? 'selected' : '' }}>EUR (€ Euro)</option>
                            <option value="MXN" {{ ($settings['currency_default'] ?? '') == 'MXN' ? 'selected' : '' }}>MXN ($ Peso Mexicano)</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Abono Tatuaje (CLP)</label>
                        <input 
                            type="number" 
                            name="deposit_amount_clp" 
                            value="{{ old('deposit_amount_clp', $settings['deposit_amount_clp'] ?? '35000') }}" 
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                        >
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Abono Tatuaje (USD)</label>
                        <input 
                            type="number" 
                            name="deposit_amount_usd" 
                            value="{{ old('deposit_amount_usd', $settings['deposit_amount_usd'] ?? '35') }}" 
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                        >
                    </div>
                </div>
            </div>

            <!-- 2. Configuración de Notificaciones & Contacto -->
            <div class="space-y-4 pt-4 border-t border-[#232326]">
                <div class="border-b border-[#232326] pb-3 flex items-center gap-2.5">
                    <div class="p-2 rounded-lg bg-emerald-500/10 text-emerald-400">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="font-serif text-base font-bold text-white">Configuración de Notificaciones & Contacto</h3>
                        <p class="text-[11px] text-[#8e8e93]">Gestiona cómo y dónde recibes los avisos de nuevas citas y ventas de láminas.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Email para Notificaciones</label>
                        <input 
                            type="email" 
                            name="notify_email" 
                            value="{{ old('notify_email', $settings['notify_email'] ?? '') }}" 
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                        >
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Teléfono / WhatsApp de Atención</label>
                        <input 
                            type="text" 
                            name="whatsapp_phone" 
                            value="{{ old('whatsapp_phone', $settings['whatsapp_phone'] ?? '') }}" 
                            placeholder="+56 9 ..."
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <label class="flex items-center gap-3 p-3.5 rounded-xl border border-[#26262a] bg-[#18181b] cursor-pointer text-white">
                        <input 
                            type="checkbox" 
                            name="notify_new_booking" 
                            value="1" 
                            {{ ($settings['notify_new_booking'] ?? '1') === '1' ? 'checked' : '' }}
                            class="rounded bg-[#121214] border-[#333] text-[#d8c49d] focus:ring-[#d8c49d]"
                        >
                        <span class="text-xs">Avisar por correo al recibir nueva solicitud de cita</span>
                    </label>

                    <label class="flex items-center gap-3 p-3.5 rounded-xl border border-[#26262a] bg-[#18181b] cursor-pointer text-white">
                        <input 
                            type="checkbox" 
                            name="notify_new_sale" 
                            value="1" 
                            {{ ($settings['notify_new_sale'] ?? '1') === '1' ? 'checked' : '' }}
                            class="rounded bg-[#121214] border-[#333] text-[#d8c49d] focus:ring-[#d8c49d]"
                        >
                        <span class="text-xs">Avisar por correo al confirmarse un pago de PayPal</span>
                    </label>
                </div>
            </div>

            <!-- 3. Estudio & Ubicación (Metro Santa Ana) -->
            <div class="space-y-4 pt-4 border-t border-[#232326]">
                <div class="border-b border-[#232326] pb-3 flex items-center gap-2.5">
                    <div class="p-2 rounded-lg bg-blue-500/10 text-blue-400">
                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="font-serif text-base font-bold text-white">Ubicación del Estudio (SEO & Dirección)</h3>
                        <p class="text-[11px] text-[#8e8e93]">Información visible para los clientes que agendan citas presenciales.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Referencia de Ubicación *</label>
                        <input 
                            type="text" 
                            name="studio_location" 
                            value="{{ old('studio_location', $settings['studio_location'] ?? '') }}" 
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                        >
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Dirección Detallada</label>
                        <input 
                            type="text" 
                            name="studio_address" 
                            value="{{ old('studio_address', $settings['studio_address'] ?? '') }}" 
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                        >
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-[#232326] flex justify-end">
                <button 
                    type="submit" 
                    class="px-8 py-3.5 rounded-xl bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-widest transition-all shadow-xl"
                >
                    Guardar Configuración
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
