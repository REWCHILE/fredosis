<?php

use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FlashAdminController;
use App\Http\Controllers\Admin\PortfolioAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\RequestsController;
use App\Http\Controllers\Admin\SettingsAdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FlashController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ShopController;
use App\Models\FlashTattoo;
use App\Models\PortfolioItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - FREDOSIS (Fine Art & Tattoo Atelier)
|--------------------------------------------------------------------------
*/

// Public Frontend
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/portafolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/tienda', [ShopController::class, 'index'])->name('shop');
Route::get('/tienda/{slug}', [ShopController::class, 'show'])->name('shop.detail');
Route::get('/prensa', [HomeController::class, 'press'])->name('press');
Route::get('/press', [HomeController::class, 'press'])->name('press.en');

// Flash Tattoos (Diseños Disponibles)
Route::get('/flash', [FlashController::class, 'index'])->name('flash.index');
Route::get('/disenos-disponibles', [FlashController::class, 'index'])->name('flash.alias');
Route::get('/flash/{slug}', [FlashController::class, 'show'])->name('flash.show');

// Dynamic SEO Sitemap XML
Route::get('/sitemap.xml', function () {
    $products = Product::where('is_active', true)->get();
    $flashes = FlashTattoo::where('is_active', true)->get();
    $artworks = PortfolioItem::all();

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    // Core pages
    $pages = [
        ['url' => url('/'), 'priority' => '1.0', 'freq' => 'daily'],
        ['url' => url('/portafolio'), 'priority' => '0.9', 'freq' => 'weekly'],
        ['url' => url('/tienda'), 'priority' => '0.9', 'freq' => 'daily'],
        ['url' => url('/flash'), 'priority' => '0.9', 'freq' => 'daily'],
        ['url' => url('/agenda'), 'priority' => '0.9', 'freq' => 'daily'],
        ['url' => url('/checkout'), 'priority' => '0.6', 'freq' => 'monthly'],
    ];

    foreach ($pages as $p) {
        $xml .= '<url>';
        $xml .= '<loc>'.htmlspecialchars($p['url']).'</loc>';
        $xml .= '<changefreq>'.$p['freq'].'</changefreq>';
        $xml .= '<priority>'.$p['priority'].'</priority>';
        $xml .= '</url>';
    }

    // Products
    foreach ($products as $prod) {
        $xml .= '<url>';
        $xml .= '<loc>'.htmlspecialchars(route('shop.detail', $prod->slug)).'</loc>';
        $xml .= '<lastmod>'.$prod->updated_at->toAtomString().'</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.8</priority>';
        $xml .= '</url>';
    }

    // Flashes
    foreach ($flashes as $fl) {
        $xml .= '<url>';
        $xml .= '<loc>'.htmlspecialchars(route('flash.show', $fl->slug)).'</loc>';
        $xml .= '<lastmod>'.$fl->updated_at->toAtomString().'</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>0.8</priority>';
        $xml .= '</url>';
    }

    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'text/xml');
})->name('sitemap');

// LLM & AI Context Endpoints (llms.txt standard)
Route::get('/llm.txt', function () {
    return response()->file(public_path('llm.txt'), ['Content-Type' => 'text/plain; charset=utf-8']);
});
Route::get('/llms.txt', function () {
    return response()->file(public_path('llms.txt'), ['Content-Type' => 'text/plain; charset=utf-8']);
});
Route::get('/fullllm.txt', function () {
    return response()->file(public_path('fullllm.txt'), ['Content-Type' => 'text/plain; charset=utf-8']);
});
Route::get('/llms-full.txt', function () {
    return response()->file(public_path('llms-full.txt'), ['Content-Type' => 'text/plain; charset=utf-8']);
});

// Tattoo Booking & Agenda
Route::get('/agenda', [BookingController::class, 'index'])->name('booking');
Route::get('/reserva', [BookingController::class, 'index'])->name('booking.alias');
Route::post('/reserva', [BookingController::class, 'store'])->name('booking.store');
Route::get('/reserva/confirmacion', [BookingController::class, 'success'])->name('booking.success');
Route::get('/api/calendar/reserved-days', [BookingController::class, 'apiReservedDays'])->name('api.reserved-days');

// Cart & Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/checkout/success/{order_number}', [CheckoutController::class, 'success'])->name('checkout.success');

// Cart API
Route::get('/api/cart', [ShopController::class, 'getCart'])->name('api.cart.get');
Route::post('/api/cart/add', [ShopController::class, 'addToCart'])->name('api.cart.add');
Route::post('/api/cart/update', [ShopController::class, 'updateCart'])->name('api.cart.update');
Route::post('/api/cart/remove', [ShopController::class, 'removeFromCart'])->name('api.cart.remove');
Route::post('/api/cart/clear', [ShopController::class, 'clearCart'])->name('api.cart.clear');

// PayPal Payment API
Route::post('/api/checkout/paypal/create-order', [CheckoutController::class, 'createPayPalOrder'])->name('api.paypal.create');
Route::post('/api/checkout/paypal/capture-order', [CheckoutController::class, 'capturePayPalOrder'])->name('api.paypal.capture');

// Locale & Currency switchers
Route::post('/api/set-locale', function (Request $request) {
    $locale = $request->input('locale', 'es');
    if (in_array($locale, ['es', 'en'])) {
        session()->put('locale', $locale);
    }

    return response()->json(['success' => true, 'locale' => session('locale', 'es')]);
})->name('api.set-locale');

Route::post('/api/set-currency', function (Request $request) {
    $currency = strtoupper($request->input('currency', 'USD'));
    if (in_array($currency, ['USD', 'CLP', 'EUR', 'MXN'])) {
        session()->put('currency', $currency);
    }

    return response()->json(['success' => true, 'currency' => session('currency', 'USD')]);
})->name('api.set-currency');

// Admin Authentication
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Portfolio Management
    Route::resource('portfolio', PortfolioAdminController::class)->names('portfolio');

    // Products / Shop Management
    Route::resource('products', ProductAdminController::class)->names('products');

    // Flash Tattoos Management
    Route::resource('flash', FlashAdminController::class)->names('flash');
    Route::post('flash/{id}/toggle', [FlashAdminController::class, 'toggleClaim'])->name('flash.toggle');

    // Tattoo Booking Requests
    Route::get('/requests', [RequestsController::class, 'index'])->name('requests');
    Route::post('/requests/{id}/approve', [RequestsController::class, 'approve'])->name('requests.approve');
    Route::post('/requests/{id}/reject', [RequestsController::class, 'reject'])->name('requests.reject');

    // Tattoo Agenda Calendar
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
    Route::post('/agenda/confirm-deposit/{id}', [AgendaController::class, 'confirmDeposit'])->name('agenda.confirm-deposit');
    Route::post('/agenda/release/{id}', [AgendaController::class, 'releaseSlot'])->name('agenda.release');
    Route::post('/agenda/create-block', [AgendaController::class, 'createBlock'])->name('agenda.create-block');

    // Settings (PayPal & Notifications)
    Route::get('/settings', [SettingsAdminController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsAdminController::class, 'update'])->name('settings.update');
});
