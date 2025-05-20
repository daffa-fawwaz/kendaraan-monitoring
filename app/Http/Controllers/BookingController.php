<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\BookingApproval;
use App\Helpers\LogHelper;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\User;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['vehicle', 'driver', 'user', 'approvals'])->get();

        return view('bookings.index', compact('bookings'));
    }

    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Display the form to create a new booking.
     *
     * @return \Illuminate\Http\Response
     */
    /*******  ba45fa28-03ed-4630-8c64-ba0aba35a3b8  *******/
    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $users = User::where('role', 'approver')->get();
        return view('bookings.create', compact('vehicles', 'drivers', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'destination' => 'required|string',
        ]);

        $booking = Booking::create([
            'vehicle_id' => $validated['vehicle_id'],
            'driver_id' => $validated['driver_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'destination' => $validated['destination'],
            'status' => 'pending',
        ]);

        $approverLevel1 = User::where('email', 'approver1@company.com')->first();
        $approverLevel2 = User::where('email', 'approver2@company.com')->first();


        if ($approverLevel1 && $approverLevel2) {
            $booking->approvals()->createMany([
                [
                    'approver_id' => $approverLevel1->id,
                    'level' => 1,
                    'status' => 'pending',
                ],
                [
                    'approver_id' => $approverLevel2->id,
                    'level' => 2,
                    'status' => 'pending',
                ],
            ]);
        }

        LogHelper::add('create_booking', 'Membuat pemesanan kendaraan dengan ID : ' . $booking->id);

        return redirect()->route('bookings.index')->with('success', 'Pemesanan berhasil dibuat!');
    }

    public function destroy(Booking $booking)
    {
        $bookingId = $booking->id;
        $booking->delete();

        LogHelper::add('cancel_booking', "Admin membatalkan booking kendaraan dengan ID : " . $bookingId);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibatalkan');
    }
}
