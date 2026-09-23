<?php

namespace App\Http\Controllers;

use App\Models\FlashTattoo;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class FlashController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        $query = FlashTattoo::query()->where('is_active', true)->orderBy('sort_order')->orderBy('created_at', 'desc');

        if ($status === 'available') {
            $query->where('is_claimed', false);
        } elseif ($status === 'claimed') {
            $query->where('is_claimed', true);
        }

        $flashes = $query->get();
        $totalCount = FlashTattoo::where('is_active', true)->count();
        $availableCount = FlashTattoo::where('is_active', true)->where('is_claimed', false)->count();
        $claimedCount = FlashTattoo::where('is_active', true)->where('is_claimed', true)->count();

        $activeCurrency = session('currency', 'USD');
        $whatsappPhone = SiteSetting::get('whatsapp_notifications', '+56972004512');

        return view('pages.flash', compact(
            'flashes',
            'status',
            'totalCount',
            'availableCount',
            'claimedCount',
            'activeCurrency',
            'whatsappPhone'
        ));
    }

    public function show(string $slug)
    {
        $flash = FlashTattoo::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedFlashes = FlashTattoo::where('is_active', true)
            ->where('id', '!=', $flash->id)
            ->where('is_claimed', false)
            ->take(3)
            ->get();

        $activeCurrency = session('currency', 'USD');
        $whatsappPhone = SiteSetting::get('whatsapp_notifications', '+56972004512');

        return view('pages.flash-detail', compact('flash', 'relatedFlashes', 'activeCurrency', 'whatsappPhone'));
    }
}
