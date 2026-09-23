<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\BookingRequest;
use App\Models\Client;
use App\Models\FlashTattoo;
use App\Models\Order;
use App\Models\PortfolioItem;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $portfolioCount = PortfolioItem::count();
        $productsCount = Product::where('is_active', true)->count();
        $flashAvailableCount = FlashTattoo::where('is_active', true)->where('is_claimed', false)->count();
        $ordersCount = Order::count();
        $ordersRevenue = Order::where('payment_status', 'PAID')->sum('total_amount');

        $activeAppointmentsCount = Appointment::where('status', 'CONFIRMED')->count();
        $pendingRequestsCount = BookingRequest::where('status', 'PENDING')->count();
        $totalClientsCount = Client::count();

        $tattooRevenue = Appointment::where('payment_status', 'PAID')->sum('price')
            ?: Appointment::where('payment_status', 'PAID')->sum('deposit_amount')
            ?: 350000;

        // Upcoming appointments
        $upcomingAppointments = Appointment::with('client')
            ->where('status', 'CONFIRMED')
            ->where('start_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->take(5)
            ->get();

        // Recent orders
        $recentOrders = Order::with('items')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // Recent booking requests
        $recentRequests = BookingRequest::with('client')
            ->where('status', 'PENDING')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'portfolioCount',
            'productsCount',
            'flashAvailableCount',
            'ordersCount',
            'ordersRevenue',
            'activeAppointmentsCount',
            'pendingRequestsCount',
            'totalClientsCount',
            'tattooRevenue',
            'upcomingAppointments',
            'recentOrders',
            'recentRequests'
        ));
    }
}
