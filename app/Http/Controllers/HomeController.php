<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\TattooStyle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $featuredArtworks = PortfolioItem::where('is_featured', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with('variants')
            ->take(4)
            ->get();

        $tattooStyles = TattooStyle::all();

        $studioLocation = SiteSetting::get('studio_location', 'Metro Santa Ana, Santiago Centro, Chile');
        $studioAddress = SiteSetting::get('studio_address', 'Estudio privado a pasos de Metro Santa Ana, Santiago');
        $whatsappPhone = SiteSetting::get('whatsapp_phone', '+56972004512');
        $depositClp = SiteSetting::get('deposit_amount_clp', '35000');
        $depositUsd = SiteSetting::get('deposit_amount_usd', '35');

        return view('pages.home', compact(
            'featuredArtworks',
            'featuredProducts',
            'tattooStyles',
            'studioLocation',
            'studioAddress',
            'whatsappPhone',
            'depositClp',
            'depositUsd'
        ));
    }

    public function press()
    {
        return view('pages.press');
    }

    public function aftercare()
    {
        return view('pages.aftercare');
    }

    public function firstTattoo()
    {
        return view('pages.first-tattoo');
    }
}
