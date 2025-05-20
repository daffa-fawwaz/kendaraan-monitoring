<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $totalDrivers = Driver::count();

        $totalBookings = Booking::whereMonth('created_at', now()->month)->count();

        $usagePerMonth = Booking::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');


        return view('dashboard.index', [
            'totalVehicles' => $totalVehicles,
            'totalDrivers' => $totalDrivers,
            'totalBookings' => $totalBookings,
            'usagePerMonth' => $usagePerMonth,
        ]);
    }
}
