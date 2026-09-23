<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use App\Models\Client;
use App\Models\SiteSetting;
use App\Models\TattooStyle;
use App\Services\BookingEngineService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $styles = TattooStyle::all();
        $studioLocation = SiteSetting::get('studio_location', 'Metro Santa Ana, Santiago Centro, Chile');
        $studioAddress = SiteSetting::get('studio_address', 'Estudio privado a pasos de Metro Santa Ana, Santiago');
        $depositClp = SiteSetting::get('deposit_amount_clp', '35000');
        $depositUsd = SiteSetting::get('deposit_amount_usd', '35');

        $selectedFlash = null;
        if ($request->has('flash_id')) {
            $selectedFlash = \App\Models\FlashTattoo::where('id', $request->query('flash_id'))->first();
        }

        return view('pages.booking', compact('styles', 'studioLocation', 'studioAddress', 'depositClp', 'depositUsd', 'selectedFlash'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'flash_tattoo_id' => 'nullable|exists:flash_tattoos,id',
            'description' => 'required|string|min:10',
            'size' => 'required|string',
            'body_zone' => 'required|string',
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'phone' => 'required|string|min:8',
            'preferred_date' => 'required|date',
            'preferred_time_slot' => 'required|in:Morning,Afternoon',
            'location' => 'nullable|string',
            'budget' => 'nullable|string',
        ], [
            'description.min' => 'Por favor, describe tu idea con más detalle (mínimo 10 caracteres).',
            'size.required' => 'Elige un tamaño aproximado para tu diseño.',
            'body_zone.required' => 'Indica en qué zona del cuerpo deseas tu tatuaje.',
            'name.required' => 'Tu nombre completo es necesario.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'phone.required' => 'Ingresa tu teléfono de contacto o WhatsApp.',
            'preferred_date.required' => 'Selecciona un día en el calendario interactivo.',
        ]);

        // 1. Client
        $client = Client::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'],
                'phone' => $validated['phone'],
            ]
        );

        $client->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
        ]);

        // 2. Booking Request
        $bookingRequest = BookingRequest::create([
            'client_id' => $client->id,
            'flash_tattoo_id' => $validated['flash_tattoo_id'] ?? null,
            'description' => $validated['description'],
            'size' => $validated['size'],
            'body_zone' => $validated['body_zone'],
            'preferred_date' => Carbon::parse($validated['preferred_date']),
            'preferred_time_slot' => $validated['preferred_time_slot'],
            'budget' => $validated['budget'] ?? null,
            'location' => $validated['location'] ?? SiteSetting::get('studio_location', 'Metro Santa Ana, Santiago Centro'),
            'status' => 'PENDING',
        ]);

        return redirect()->route('booking.success')->with('booking_id', $bookingRequest->id);
    }

    public function success()
    {
        $bookingId = session('booking_id');
        $booking = $bookingId ? BookingRequest::with('client')->find($bookingId) : null;
        $whatsappPhone = SiteSetting::get('whatsapp_phone', '+56972004512');

        return view('pages.booking-success', compact('booking', 'whatsappPhone'));
    }

    public function apiReservedDays(Request $request, BookingEngineService $service)
    {
        $month = (int) $request->input('month', now()->month);
        $year = (int) $request->input('year', now()->year);

        $days = $service->getReservedDays($month, $year);

        return response()->json($days);
    }
}
