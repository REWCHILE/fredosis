<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashTattoo;
use App\Models\TattooStyle;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FlashAdminController extends Controller
{
    public function index()
    {
        $flashes = FlashTattoo::with('style')
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.flash.index', compact('flashes'));
    }

    public function create()
    {
        $styles = TattooStyle::all();
        return view('admin.flash.form', ['flash' => null, 'styles' => $styles]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string|max:500',
            'price_clp' => 'required|numeric|min:0',
            'price_usd' => 'nullable|numeric|min:0',
            'size_cm' => 'nullable|string|max:100',
            'recommended_zone' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'style_id' => 'nullable|exists:tattoo_styles,id',
            'is_claimed' => 'nullable|boolean',
            'claimed_by_name' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        // Process image upload or URL
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('flashes', 'public');
            $validated['image_url'] = '/storage/' . $path;
        } elseif (empty($validated['image_url'])) {
            return back()->withErrors(['image_file' => 'Debes subir un archivo de imagen o ingresar una URL de imagen.'])->withInput();
        }

        // Auto-compute price_usd if missing
        if (empty($validated['price_usd']) && !empty($validated['price_clp'])) {
            $validated['price_usd'] = CurrencyService::convert((float)$validated['price_clp'], 'CLP', 'USD');
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        $validated['is_claimed'] = $request->has('is_claimed');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        FlashTattoo::create($validated);

        return redirect()->route('admin.flash.index')->with('success', 'Diseño Flash publicado exitosamente.');
    }

    public function edit($id)
    {
        $flash = FlashTattoo::findOrFail($id);
        $styles = TattooStyle::all();
        return view('admin.flash.form', compact('flash', 'styles'));
    }

    public function update(Request $request, $id)
    {
        $flash = FlashTattoo::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string|max:500',
            'price_clp' => 'required|numeric|min:0',
            'price_usd' => 'nullable|numeric|min:0',
            'size_cm' => 'nullable|string|max:100',
            'recommended_zone' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'style_id' => 'nullable|exists:tattoo_styles,id',
            'is_claimed' => 'nullable|boolean',
            'claimed_by_name' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        // Process image upload
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('flashes', 'public');
            $validated['image_url'] = '/storage/' . $path;
        } elseif (empty($validated['image_url'])) {
            $validated['image_url'] = $flash->image_url;
        }

        if (empty($validated['price_usd']) && !empty($validated['price_clp'])) {
            $validated['price_usd'] = CurrencyService::convert((float)$validated['price_clp'], 'CLP', 'USD');
        }

        $validated['is_claimed'] = $request->has('is_claimed');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $flash->update($validated);

        return redirect()->route('admin.flash.index')->with('success', 'Diseño Flash actualizado correctamente.');
    }

    public function toggleClaim($id)
    {
        $flash = FlashTattoo::findOrFail($id);
        $flash->is_claimed = !$flash->is_claimed;
        if (!$flash->is_claimed) {
            $flash->claimed_by_name = null;
        }
        $flash->save();

        $statusMsg = $flash->is_claimed ? 'marcado como RECLAMADO / TATUADO' : 'marcado como DISPONIBLE';
        return redirect()->back()->with('success', "Diseño '{$flash->title}' {$statusMsg}.");
    }

    public function destroy($id)
    {
        $flash = FlashTattoo::findOrFail($id);
        $flash->delete();

        return redirect()->route('admin.flash.index')->with('success', 'Diseño Flash eliminado.');
    }
}
