@extends('layouts.app')

@section('title', 'Agenda de Tatuajes — FREDOSIS | Citas en Metro Santa Ana, Santiago')
@section('meta_description', 'Agenda tu sesión de tatuaje de autor con Fredosis en Santiago Centro (a pasos de Metro Santa Ana). Calendario en vivo, consulta de disponibilidad y abono de reserva.')

@section('content')
<div class="py-16 md:py-24 px-6 md:px-16 max-w-4xl mx-auto space-y-12" x-data="bookingWizard()">
    <!-- Header -->
    <div class="text-center max-w-2xl mx-auto space-y-3">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-[#d8c49d]/30 bg-[#161619] text-xs font-semibold text-[#d8c49d]">
            <span>📍 Estudio Privado • Metro Santa Ana, Santiago Centro</span>
        </div>
        <h1 class="text-4xl md:text-6xl font-serif font-bold text-[#f5f5f3]">Agenda de Tatuajes</h1>
        <p class="text-xs md:text-sm text-[#8e8e93]">
            Paso <span x-text="step" class="text-white font-bold"></span> de 3 — 
            <span x-show="step === 1">Idea y Detalles del Tatuaje</span>
            <span x-show="step === 2">Datos de Contacto</span>
            <span x-show="step === 3">Calendario & Horario en Metro Santa Ana</span>
        </p>
    </div>

    <!-- Wizard Form Card -->
    <div class="bg-[#121214] border border-[#232326] rounded-2xl p-8 md:p-12 shadow-2xl relative overflow-hidden">
        <!-- Progress Line -->
        <div class="absolute top-0 left-0 w-full h-1 bg-[#232326]">
            <div class="h-full bg-[#d8c49d] transition-all duration-500 ease-out" :style="'width: ' + ((step / 3) * 100) + '%'"></div>
        </div>

        @if(isset($errors) && $errors->any())
            <div class="mb-8 p-4 bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs rounded-lg">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="booking-form" action="{{ route('booking.store') }}" method="POST" @submit="handleSubmit">
            @csrf

            @if(isset($selectedFlash) && $selectedFlash)
                <input type="hidden" name="flash_tattoo_id" value="{{ $selectedFlash->id }}">
                <div class="mb-6 p-4 rounded-xl bg-[#161619] border border-[#d8c49d]/40 flex items-center gap-4 shadow-lg">
                    <img src="{{ $selectedFlash->image_url }}" alt="{{ $selectedFlash->title }}" class="w-16 h-20 object-cover rounded-lg bg-black border border-[#232326] shrink-0">
                    <div class="space-y-1">
                        <span class="text-[10px] uppercase font-mono text-[#d8c49d] tracking-wider font-bold">✨ Diseño Flash Seleccionado</span>
                        <h4 class="font-serif text-base font-bold text-white">{{ $selectedFlash->title }}</h4>
                        <p class="text-xs text-[#8e8e93]">
                            Valor sesión: <strong class="text-[#d8c49d] font-mono">${{ number_format($selectedFlash->price_clp, 0, ',', '.') }} CLP</strong> (~${{ number_format($selectedFlash->price_usd, 0) }} USD)
                        </p>
                        <p class="text-[11px] text-[#666]">
                            Medida sugerida: {{ $selectedFlash->size_cm ?? 'Libre' }} • Zona: {{ $selectedFlash->recommended_zone ?? 'Adaptable' }}
                        </p>
                    </div>
                </div>
            @endif

            <!-- STEP 1: TATTOO IDEA & STYLE -->
            <div x-show="step === 1" x-transition class="space-y-6">
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold block">
                        Describe tu concepto o idea de tatuaje *
                    </label>
                    <textarea 
                        name="description" 
                        x-model="formData.description"
                        rows="4"
                        placeholder="Ejemplo: Quiero un diseño de línea fina y micro-texturas con motivos botánicos y una figura anatómica surrealista en el antebrazo..."
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-4 text-xs md:text-sm text-white focus:outline-none focus:border-[#d8c49d]"
                        required
                    >{{ old('description') }}</textarea>
                    <p x-show="step1Error" class="text-rose-400 text-xs" x-text="step1Error"></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold block">Tamaño aproximado (cm) *</label>
                        <select 
                            name="size" 
                            x-model="formData.size"
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-xs text-white focus:outline-none focus:border-[#d8c49d]"
                            required
                        >
                            <option value="">Selecciona una dimensión aproximada...</option>
                            <option value="S (5-10 cm)">Pequeño (5-10 cm)</option>
                            <option value="M (10-18 cm)">Mediano (10-18 cm)</option>
                            <option value="L (18-28 cm)">Grande (18-28 cm)</option>
                            <option value="XL (Manga / Espalda)">Pieza Completa (Manga, Espalda o Torso)</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold block">Zona del Cuerpo *</label>
                        <input 
                            type="text" 
                            name="body_zone" 
                            x-model="formData.body_zone"
                            value="{{ old('body_zone') }}"
                            placeholder="Ej: Antebrazo, Costillas, Pantorrilla..."
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-xs text-white focus:outline-none focus:border-[#d8c49d]"
                            required
                        >
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold block">Presupuesto estimado (Opcional)</label>
                    <input 
                        type="text" 
                        name="budget" 
                        x-model="formData.budget"
                        value="{{ old('budget') }}"
                        placeholder="Ej: $120.000 - $180.000 CLP"
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-xs text-white focus:outline-none focus:border-[#d8c49d]"
                    >
                </div>

                <div class="pt-4 flex justify-end">
                    <button 
                        type="button" 
                        @click="validateStep1()"
                        class="px-8 py-3.5 rounded-full bg-[#d8c49d] text-black font-bold text-xs uppercase tracking-widest hover:bg-[#ebd7b1] transition-all shadow-lg"
                    >
                        Continuar a Datos de Contacto →
                    </button>
                </div>
            </div>

            <!-- STEP 2: CONTACT INFO -->
            <div x-show="step === 2" x-cloak x-transition class="space-y-6">
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold block">Nombre Completo *</label>
                    <input 
                        type="text" 
                        name="name" 
                        x-model="formData.name"
                        value="{{ old('name') }}"
                        placeholder="Tu nombre y apellido"
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-xs text-white focus:outline-none focus:border-[#d8c49d]"
                        required
                    >
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold block">Correo Electrónico *</label>
                        <input 
                            type="email" 
                            name="email" 
                            x-model="formData.email"
                            value="{{ old('email') }}"
                            placeholder="tuemail@ejemplo.com"
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-xs text-white focus:outline-none focus:border-[#d8c49d]"
                            required
                        >
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold block">WhatsApp / Teléfono *</label>
                        <input 
                            type="tel" 
                            name="phone" 
                            x-model="formData.phone"
                            value="{{ old('phone') }}"
                            placeholder="+56 9 ..."
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-xs text-white focus:outline-none focus:border-[#d8c49d]"
                            required
                        >
                    </div>
                </div>

                <p x-show="step2Error" class="text-rose-400 text-xs" x-text="step2Error"></p>

                <div class="pt-4 flex justify-between">
                    <button 
                        type="button" 
                        @click="step = 1"
                        class="px-6 py-3 rounded-full border border-[#333] text-[#8e8e93] hover:text-white text-xs uppercase font-semibold transition-all"
                    >
                        ← Volver
                    </button>
                    <button 
                        type="button" 
                        @click="validateStep2()"
                        class="px-8 py-3.5 rounded-full bg-[#d8c49d] text-black font-bold text-xs uppercase tracking-widest hover:bg-[#ebd7b1] transition-all shadow-lg"
                    >
                        Elegir Fecha en Calendario →
                    </button>
                </div>
            </div>

            <!-- STEP 3: CALENDAR & STUDIO AT METRO SANTA ANA -->
            <div x-show="step === 3" x-cloak x-transition class="space-y-8">
                <!-- Location Indicator -->
                <div class="p-4 rounded-xl bg-[#18181b] border border-[#2c2c30] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-[#d8c49d]/10 text-[#d8c49d] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-white">Estudio Privado Fredosis</p>
                            <p class="text-[11px] text-[#8e8e93]">Santiago Centro • A pasos de Metro Santa Ana (Línea 2 y 5)</p>
                        </div>
                    </div>
                    <input type="hidden" name="location" value="Metro Santa Ana - Santiago Centro">
                    <span class="text-[10px] px-2.5 py-1 rounded bg-[#d8c49d]/10 text-[#d8c49d] font-bold border border-[#d8c49d]/20">Confirmado</span>
                </div>

                <!-- Custom Calendar Widget -->
                <div class="space-y-3">
                    <label class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold block">
                        Selecciona el día de tu preferencia en el calendario *
                    </label>

                    <input type="hidden" name="preferred_date" x-model="formData.preferred_date" required>

                    <div class="p-6 rounded-2xl bg-[#161619] border border-[#26262a] shadow-inner space-y-6">
                        <!-- Month Navigation -->
                        <div class="flex items-center justify-between">
                            <h3 class="font-serif text-xl font-bold text-[#f5f5f3]" x-text="currentMonthName"></h3>
                            <div class="flex gap-2">
                                <button type="button" @click="prevMonth" class="p-2 rounded-lg border border-[#2c2c30] text-[#8e8e93] hover:text-white hover:bg-[#1e1e22]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                </button>
                                <button type="button" @click="nextMonth" class="p-2 rounded-lg border border-[#2c2c30] text-[#8e8e93] hover:text-white hover:bg-[#1e1e22]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Days of Week Header -->
                        <div class="grid grid-cols-7 text-center text-[10px] font-bold text-[#666] uppercase tracking-wider">
                            <span>Lun</span><span>Mar</span><span>Mié</span><span>Jue</span><span>Vie</span><span>Sáb</span><span>Dom</span>
                        </div>

                        <!-- Days Grid -->
                        <div class="grid grid-cols-7 gap-1">
                            <template x-for="day in calendarDays" :key="day.dateStr">
                                <div 
                                    @click="!day.isPast && !isDayReserved(day.dateStr) && selectDate(day.dateStr)"
                                    :class="{
                                        'bg-[#1e1e22] hover:bg-[#28282d] text-white cursor-pointer': !day.isPast && !isDayReserved(day.dateStr),
                                        'opacity-20 cursor-not-allowed text-[#555]': day.isPast,
                                        'bg-rose-950/40 border-rose-800 text-rose-400 cursor-not-allowed': isDayReserved(day.dateStr),
                                        'border-2 border-[#d8c49d] bg-[#d8c49d]/20 text-[#d8c49d] font-bold': formData.preferred_date === day.dateStr,
                                        'border border-[#26262a]': formData.preferred_date !== day.dateStr
                                    }"
                                    class="h-12 md:h-14 rounded-lg flex flex-col items-center justify-center relative transition-all"
                                >
                                    <span class="text-xs font-semibold" x-text="day.dayNum"></span>
                                    <span x-show="isDayReserved(day.dateStr)" class="text-[8px] text-rose-400">Ocupado</span>
                                </div>
                            </template>
                        </div>
                    </div>
                    <p x-show="step3Error" class="text-rose-400 text-xs" x-text="step3Error"></p>
                </div>

                <!-- Time Slot -->
                <div class="space-y-3">
                    <label class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold block">Jornada de Preferencia *</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="preferred_time_slot" value="Morning" x-model="formData.preferred_time_slot" class="hidden peer">
                            <div class="p-4 rounded-xl border border-[#26262a] bg-[#18181b] peer-checked:border-[#d8c49d] peer-checked:bg-[#d8c49d]/10 text-center transition-all">
                                <p class="text-xs font-bold text-white">Mañana</p>
                                <p class="text-[11px] text-[#8e8e93]">11:00 hrs a 15:00 hrs</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="preferred_time_slot" value="Afternoon" x-model="formData.preferred_time_slot" class="hidden peer">
                            <div class="p-4 rounded-xl border border-[#26262a] bg-[#18181b] peer-checked:border-[#d8c49d] peer-checked:bg-[#d8c49d]/10 text-center transition-all">
                                <p class="text-xs font-bold text-white">Tarde</p>
                                <p class="text-[11px] text-[#8e8e93]">15:30 hrs a 20:00 hrs</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Deposit Information Notice -->
                <div class="p-4 rounded-xl bg-[#161619] border border-[#d8c49d]/30 flex items-start gap-3">
                    <div class="text-[#d8c49d] shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    </div>
                    <div class="text-xs space-y-1">
                        <p class="font-bold text-white">Abono de Reserva: ${{ number_format($depositClp, 0, ',', '.') }} CLP (~${{ $depositUsd }} USD)</p>
                        <p class="text-[#8e8e93] leading-relaxed">
                            Una vez revisada tu solicitud, Fredosis confirmará tu hora y te facilitará los medios de transferencia o pago PayPal para fijar el bloque en la agenda. El abono se descuenta del valor total.
                        </p>
                    </div>
                </div>

                <div class="pt-4 flex justify-between">
                    <button 
                        type="button" 
                        @click="step = 2"
                        class="px-6 py-3 rounded-full border border-[#333] text-[#8e8e93] hover:text-white text-xs uppercase font-semibold transition-all"
                    >
                        ← Volver
                    </button>
                    <button 
                        type="submit"
                        class="px-10 py-4 rounded-full bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-widest transition-all shadow-xl hover:scale-105"
                    >
                        Confirmar y Enviar Solicitud de Cita
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function bookingWizard() {
        return {
            step: 1,
            step1Error: '',
            step2Error: '',
            step3Error: '',
            formData: {
                description: '{{ old("description", (isset($selectedFlash) && $selectedFlash) ? "Deseo tatuarme el diseño flash \"" . addslashes($selectedFlash->title) . "\". " . addslashes($selectedFlash->description ?? "") : "") }}',
                size: '{{ old("size", (isset($selectedFlash) && $selectedFlash) ? "M (10-18 cm)" : "") }}',
                body_zone: '{{ old("body_zone", (isset($selectedFlash) && $selectedFlash) ? addslashes($selectedFlash->recommended_zone ?? "Antebrazo") : "") }}',
                budget: '{{ old("budget", (isset($selectedFlash) && $selectedFlash) ? "$" . number_format($selectedFlash->price_clp, 0, ",", ".") . " CLP" : "") }}',
                name: '{{ old("name", "") }}',
                email: '{{ old("email", "") }}',
                phone: '{{ old("phone", "") }}',
                preferred_date: '{{ old("preferred_date", "") }}',
                preferred_time_slot: '{{ old("preferred_time_slot", "Morning") }}',
            },
            currentMonth: new Date().getMonth(),
            currentYear: new Date().getFullYear(),
            calendarDays: [],
            reservedDays: [],

            init() {
                this.buildCalendar();
                this.fetchReservedDays();
            },

            get currentMonthName() {
                const date = new Date(this.currentYear, this.currentMonth, 1);
                return date.toLocaleString('es-CL', { month: 'long', year: 'numeric' });
            },

            prevMonth() {
                if (this.currentMonth === 0) {
                    this.currentMonth = 11;
                    this.currentYear--;
                } else {
                    this.currentMonth--;
                }
                this.buildCalendar();
                this.fetchReservedDays();
            },

            nextMonth() {
                if (this.currentMonth === 11) {
                    this.currentMonth = 0;
                    this.currentYear++;
                } else {
                    this.currentMonth++;
                }
                this.buildCalendar();
                this.fetchReservedDays();
            },

            buildCalendar() {
                const days = [];
                const firstDayOfMonth = new Date(this.currentYear, this.currentMonth, 1);
                const lastDayOfMonth = new Date(this.currentYear, this.currentMonth + 1, 0);

                let startDay = firstDayOfMonth.getDay() - 1; // Mon = 0
                if (startDay === -1) startDay = 6;

                const today = new Date();
                today.setHours(0, 0, 0, 0);

                // Previous month padding
                const prevLastDay = new Date(this.currentYear, this.currentMonth, 0).getDate();
                for (let i = startDay - 1; i >= 0; i--) {
                    const d = prevLastDay - i;
                    days.push({ dayNum: d, dateStr: '', isCurrentMonth: false, isPast: true });
                }

                // Current month days
                for (let d = 1; d <= lastDayOfMonth.getDate(); d++) {
                    const dateObj = new Date(this.currentYear, this.currentMonth, d);
                    const monthStr = String(this.currentMonth + 1).padStart(2, '0');
                    const dayStr = String(d).padStart(2, '0');
                    const dateStr = `${this.currentYear}-${monthStr}-${dayStr}`;

                    days.push({
                        dayNum: d,
                        dateStr: dateStr,
                        isCurrentMonth: true,
                        isPast: dateObj < today,
                    });
                }

                this.calendarDays = days;
            },

            fetchReservedDays() {
                fetch(`{{ route('api.reserved-days') }}?month=${this.currentMonth + 1}&year=${this.currentYear}`)
                    .then(r => r.json())
                    .then(data => {
                        this.reservedDays = data || [];
                    })
                    .catch(() => {});
            },

            isDayReserved(dateStr) {
                return this.reservedDays.includes(dateStr);
            },

            selectDate(dateStr) {
                this.formData.preferred_date = dateStr;
                this.step3Error = '';
            },

            validateStep1() {
                if (!this.formData.description || this.formData.description.trim().length < 10) {
                    this.step1Error = 'Por favor detalla tu idea con al menos 10 caracteres.';
                    return;
                }
                if (!this.formData.size) {
                    this.step1Error = 'Por favor selecciona el tamaño aproximado.';
                    return;
                }
                if (!this.formData.body_zone) {
                    this.step1Error = 'Por favor indica la zona del cuerpo para tu tatuaje.';
                    return;
                }
                this.step1Error = '';
                this.step = 2;
            },

            validateStep2() {
                if (!this.formData.name || this.formData.name.trim().length < 2) {
                    this.step2Error = 'Ingresa tu nombre completo.';
                    return;
                }
                if (!this.formData.email || !this.formData.email.includes('@')) {
                    this.step2Error = 'Ingresa un correo electrónico válido.';
                    return;
                }
                if (!this.formData.phone || this.formData.phone.length < 8) {
                    this.step2Error = 'Ingresa tu WhatsApp o teléfono con al menos 8 dígitos.';
                    return;
                }
                this.step2Error = '';
                this.step = 3;
            },

            handleSubmit(e) {
                if (!this.formData.preferred_date) {
                    e.preventDefault();
                    this.step3Error = 'Por favor selecciona un día disponible en el calendario.';
                    return false;
                }
                return true;
            }
        }
    }
</script>
@endsection
