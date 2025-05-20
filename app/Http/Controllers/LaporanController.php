<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BookingExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function export(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        return Excel::download(new BookingExport($request->from, $request->to), 'laporan-booking.xlsx');
    }
}
