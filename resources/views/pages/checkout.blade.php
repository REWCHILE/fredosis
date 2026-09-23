@extends('layouts.app')

@section('title', 'Finalizar Adquisición — FREDOSIS | Colección de Autor')
@section('meta_description', 'Adquisición segura de láminas fine art y dibujos originales de Fredo (Fredosis).')

@section('content')
<section class="py-16 md:py-24 px-6 md:px-16 max-w-5xl mx-auto space-y-12">
    <!-- Header -->
    <div class="text-center max-w-xl mx-auto space-y-2">
        <span class="text-xs uppercase tracking-widest text-[#d8c49d] font-bold">Adquisición Segura de Obras</span>
        <h1 class="text-3xl md:text-5xl font-serif font-bold text-[#f5f5f3]">Finalizar Compra</h1>
        <p class="text-xs text-[#8e8e93]">
            Transacciones cifradas y protegidas directamente a través de <strong>PayPal</strong>.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start" x-data="checkoutEngine()">
        <!-- Left: Customer & Shipping Details Form -->
        <div class="lg:col-span-7 bg-[#121214] border border-[#232326] rounded-2xl p-8 shadow-xl space-y-6">
            <h2 class="font-serif text-lg font-bold text-[#f5f5f3] border-b border-[#232326] pb-3">
                1. Datos de Envío & Destinatario
            </h2>

            <div class="space-y-4 text-xs">
                <div class="space-y-1.5">
                    <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Nombre Completo *</label>
                    <input 
                        type="text" 
                        x-model="customer.name" 
                        placeholder="Nombre y Apellidos"
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                        required
                    >
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Correo Electrónico *</label>
                        <input 
                            type="email" 
                            x-model="customer.email" 
                            placeholder="tuemail@ejemplo.com"
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                            required
                        >
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Teléfono / WhatsApp *</label>
                        <input 
                            type="tel" 
                            x-model="customer.phone" 
                            placeholder="+56 9 ..."
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                            required
                        >
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Dirección de Entrega *</label>
                    <input 
                        type="text" 
                        x-model="customer.address" 
                        placeholder="Calle, número, depto / casa"
                        class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                        required
                    >
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Ciudad / Comuna *</label>
                        <input 
                            type="text" 
                            x-model="customer.city" 
                            placeholder="Ej: Santiago Centro / Providencia"
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                            required
                        >
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">País *</label>
                        <input 
                            type="text" 
                            x-model="customer.country" 
                            placeholder="Chile / International"
                            class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]"
                            required
                        >
                    </div>
                </div>
            </div>

            <!-- Error message if incomplete -->
            <p x-show="formError" class="text-rose-400 text-xs font-semibold" x-text="formError"></p>

            <div class="pt-4 border-t border-[#232326]">
                <h3 class="font-serif text-base font-bold text-[#f5f5f3] mb-3">
                    2. Pagar con PayPal
                </h3>
                <p class="text-xs text-[#8e8e93] mb-4">
                    Al presionar el botón de PayPal, se abrirá la pasarela segura para confirmar tu pago con tarjeta o saldo de cuenta.
                </p>

                <!-- PayPal Button Container -->
                <div id="paypal-button-container" class="min-h-[50px] relative z-10"></div>
            </div>
        </div>

        <!-- Right: Order Summary -->
        <div class="lg:col-span-5 bg-[#121214] border border-[#232326] rounded-2xl p-8 shadow-xl space-y-6 sticky top-24">
            <h2 class="font-serif text-lg font-bold text-[#f5f5f3] border-b border-[#232326] pb-3">
                Resumen de tu Pedido
            </h2>

            <!-- Items List -->
            <div class="space-y-3 max-h-[350px] overflow-y-auto pr-1">
                <template x-for="item in cartItems" :key="item.cart_key">
                    <div class="flex items-center gap-3 p-2.5 rounded-lg bg-[#18181b] border border-[#26262a]">
                        <img :src="item.image" :alt="item.title" class="w-12 h-14 object-cover rounded bg-black shrink-0">
                        <div class="flex-1 text-xs">
                            <h4 class="font-serif font-bold text-white line-clamp-1" x-text="item.title"></h4>
                            <p class="text-[10px] text-[#d8c49d]" x-text="item.format_name"></p>
                            <p class="text-[11px] text-[#8e8e93]" x-text="'Cant: ' + item.quantity + ' • ' + item.subtotal_formatted"></p>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Calculation breakdown -->
            <div class="border-t border-[#232326] pt-4 space-y-2 text-xs">
                <div class="flex justify-between text-[#8e8e93]">
                    <span>Subtotal:</span>
                    <span class="text-white" x-text="cartTotalFormatted"></span>
                </div>
                <div class="flex justify-between text-[#8e8e93]">
                    <span>Embalaje de Conservación:</span>
                    <span class="text-emerald-400 font-semibold">Incluido</span>
                </div>
                <div class="flex justify-between text-[#8e8e93]">
                    <span>Moneda de Cobro PayPal:</span>
                    <span class="text-white font-mono" x-text="activeCurrency"></span>
                </div>
                <div class="flex justify-between text-base font-bold pt-2 border-t border-[#232326] text-[#d8c49d]">
                    <span>Total a Pagar:</span>
                    <span x-text="cartTotalFormatted"></span>
                </div>
            </div>

            <!-- Guarantees badge -->
            <div class="p-3.5 rounded-xl bg-[#161619] border border-[#26262a] text-[11px] text-[#8e8e93] space-y-1">
                <p class="font-bold text-white">🛡️ Garantía de Colección</p>
                <p>Obras selladas y certificadas por Fredosis. Despacho protegido desde Santiago de Chile.</p>
            </div>
        </div>
    </div>
</section>

<!-- PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id={{ $paypalClientId }}&currency=USD"></script>

<script>
    function checkoutEngine() {
        return {
            customer: {
                name: '',
                email: '',
                phone: '',
                address: '',
                city: 'Santiago',
                country: 'Chile'
            },
            formError: '',

            init() {
                this.$nextTick(() => {
                    this.renderPayPalButtons();
                });
            },

            validateForm() {
                if (!this.customer.name || this.customer.name.trim().length < 2) {
                    this.formError = 'Por favor ingresa tu nombre completo.';
                    return false;
                }
                if (!this.customer.email || !this.customer.email.includes('@')) {
                    this.formError = 'Por favor ingresa un correo electrónico válido.';
                    return false;
                }
                if (!this.customer.address || this.customer.address.trim().length < 4) {
                    this.formError = 'Por favor ingresa la dirección de entrega.';
                    return false;
                }
                this.formError = '';
                return true;
            },

            renderPayPalButtons() {
                const self = this;
                if (typeof paypal === 'undefined') return;

                paypal.Buttons({
                    style: {
                        color: 'gold',
                        shape: 'rect',
                        label: 'pay',
                        height: 48
                    },

                    createOrder: function(data, actions) {
                        if (!self.validateForm()) {
                            alert(self.formError);
                            return false;
                        }

                        return fetch('{{ route("api.paypal.create") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                customer_name: self.customer.name,
                                customer_email: self.customer.email,
                                customer_phone: self.customer.phone,
                                shipping_address: self.customer.address,
                                shipping_city: self.customer.city,
                                shipping_country: self.customer.country,
                                currency: 'USD'
                            })
                        })
                        .then(r => r.json())
                        .then(orderData => {
                            if (orderData.error) {
                                alert(orderData.error);
                                throw new Error(orderData.error);
                            }
                            window.createdFredosisOrderId = orderData.order_id;
                            
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: orderData.total,
                                        currency_code: 'USD'
                                    },
                                    description: 'Compra de Arte Fredosis - Orden ' + orderData.order_number
                                }]
                            });
                        });
                    },

                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            return fetch('{{ route("api.paypal.capture") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    order_id: window.createdFredosisOrderId,
                                    paypal_order_id: data.orderID,
                                    paypal_payer_id: details.payer.payer_id || ''
                                })
                            })
                            .then(r => r.json())
                            .then(res => {
                                if (res.redirect_url) {
                                    window.location.href = res.redirect_url;
                                }
                            });
                        });
                    },

                    onError: function(err) {
                        console.error('PayPal Checkout error:', err);
                    }
                }).render('#paypal-button-container');
            }
        }
    }
</script>
@endsection
