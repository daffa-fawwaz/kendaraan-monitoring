<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\Booking;
use App\Models\BookingApproval;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingApprovalController extends Controller
{

    public function index()
    {
        $pendingApprovals = BookingApproval::with('booking')
            ->where('approver_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        return view('approvals.index', compact('pendingApprovals'));
    }

    public function approve(BookingApproval $approval)
    {
        // Pastikan hanya bisa approve yang masih pending
        if ($approval->status !== 'pending') {
            return back()->with('error', 'Permintaan ini sudah diproses.');
        }

        $approval->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        $booking = $approval->booking;

        if ($booking->level === (string)((int)$approval->level - 1)) {
            $booking->level = (string) $approval->level;
            $booking->save();
        }

        $allApproved = $booking->approvals()
            ->whereIn('level', [1, 2])
            ->where('status', 'approved')
            ->count() === 2;

        if ($allApproved) {
            $booking->status = 'approved';
            $booking->save();
        }

        LogHelper::add('approve_booking', 'Menyetujui booking : ' . $booking->id);
        return back()->with('success', 'Booking berhasil disetujui.');
    }

    public function reject(BookingApproval $approval)
    {
        if ($approval->status !== 'pending') {
            return back()->with('error', 'Permintaan ini sudah diproses.');
        }

        $approval->update([
            'status' => 'rejected',
            'approved_at' => Carbon::now(),
        ]);

        $approval->booking->update(['status' => 'rejected']);

        LogHelper::add('reject_booking', 'Menolak booking : ' . $approval->booking->id);

        return back()->with('success', 'Booking telah ditolak.');
    }

    public function history()
    {
        $approvedApprovals = BookingApproval::with(['booking', 'booking.vehicle', 'booking.user'])
            ->where('approver_id', Auth::id())
            ->where('status', 'approved')
            ->orderByDesc('approved_at')
            ->get();

        return view('approvals.history', compact('approvedApprovals'));
    }
}
