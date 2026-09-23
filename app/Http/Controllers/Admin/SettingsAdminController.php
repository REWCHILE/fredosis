<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsAdminController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => SiteSetting::get('site_name', 'FREDOSIS'),
            'artist_name' => SiteSetting::get('artist_name', 'Fredosis'),
            'artist_bio_es' => SiteSetting::get('artist_bio_es', ''),
            'artist_bio_en' => SiteSetting::get('artist_bio_en', ''),
            'studio_location' => SiteSetting::get('studio_location', 'Metro Santa Ana, Santiago Centro, Chile'),
            'studio_address' => SiteSetting::get('studio_address', 'Estudio privado a pasos de Metro Santa Ana, Santiago Centro'),
            'whatsapp_phone' => SiteSetting::get('whatsapp_phone', '+56972004512'),
            'contact_email' => SiteSetting::get('contact_email', 'contacto@fredosis.art'),
            'paypal_client_id' => SiteSetting::get('paypal_client_id', 'sb'),
            'paypal_mode' => SiteSetting::get('paypal_mode', 'sandbox'),
            'currency_default' => SiteSetting::get('currency_default', 'USD'),
            'deposit_amount_clp' => SiteSetting::get('deposit_amount_clp', '35000'),
            'deposit_amount_usd' => SiteSetting::get('deposit_amount_usd', '35'),
            'notify_email' => SiteSetting::get('notify_email', 'fredosis@art.cl'),
            'notify_new_booking' => SiteSetting::get('notify_new_booking', '1'),
            'notify_new_sale' => SiteSetting::get('notify_new_sale', '1'),
        ];

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = [
            'site_name',
            'artist_name',
            'artist_bio_es',
            'artist_bio_en',
            'studio_location',
            'studio_address',
            'whatsapp_phone',
            'contact_email',
            'paypal_client_id',
            'paypal_mode',
            'currency_default',
            'deposit_amount_clp',
            'deposit_amount_usd',
            'notify_email',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                SiteSetting::set($field, $request->input($field));
            }
        }

        SiteSetting::set('notify_new_booking', $request->has('notify_new_booking') ? '1' : '0');
        SiteSetting::set('notify_new_sale', $request->has('notify_new_sale') ? '1' : '0');

        return redirect()->back()->with('success', 'Configuración de pasarela de pago y notificaciones guardada correctamente.');
    }
}
