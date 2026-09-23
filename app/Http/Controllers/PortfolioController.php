<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Models\TattooStyle;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $query = PortfolioItem::query()->orderBy('sort_order')->orderBy('created_at', 'desc');

        if ($category && in_array($category, ['drawings', 'paintings', 'tattoos', 'sketches'])) {
            $query->where('category', $category);
        }

        $artworks = $query->get();
        $categories = [
            'all' => 'Todas las Obras',
            'drawings' => 'Dibujos a Grafito',
            'paintings' => 'Pinturas',
            'tattoos' => 'Tatuajes & Flash',
        ];

        return view('pages.portfolio', compact('artworks', 'category', 'categories'));
    }
}
