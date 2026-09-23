<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use App\Models\TattooStyle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioAdminController extends Controller
{
    public function index()
    {
        $artworks = PortfolioItem::with('style')
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.portfolio.index', compact('artworks'));
    }

    public function create()
    {
        $styles = TattooStyle::all();
        return view('admin.portfolio.form', ['artwork' => null, 'styles' => $styles]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'required|url',
            'category' => 'required|in:drawings,paintings,tattoos,sketches',
            'medium' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:100',
            'year' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'style_id' => 'nullable|exists:tattoo_styles,id',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        PortfolioItem::create($validated);

        return redirect()->route('admin.portfolio.index')->with('success', 'Obra agregada exitosamente al portafolio.');
    }

    public function edit($id)
    {
        $artwork = PortfolioItem::findOrFail($id);
        $styles = TattooStyle::all();
        return view('admin.portfolio.form', compact('artwork', 'styles'));
    }

    public function update(Request $request, $id)
    {
        $artwork = PortfolioItem::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'required|url',
            'category' => 'required|in:drawings,paintings,tattoos,sketches',
            'medium' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:100',
            'year' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'style_id' => 'nullable|exists:tattoo_styles,id',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $artwork->update($validated);

        return redirect()->route('admin.portfolio.index')->with('success', 'Obra actualizada correctamente.');
    }

    public function destroy($id)
    {
        $artwork = PortfolioItem::findOrFail($id);
        $artwork->delete();

        return redirect()->route('admin.portfolio.index')->with('success', 'Obra eliminada del portafolio.');
    }
}
