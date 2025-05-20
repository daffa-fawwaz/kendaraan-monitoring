<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingExport implements FromCollection, WithHeadings
{
    private $from;
    private $to;
    public $fileName = 'laporan-booking.xlsx';

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function collection()
    {
        return Booking::with(['vehicle', 'driver'])
            ->whereBetween('start_time', [$this->from, $this->to])
            ->get()
            ->map(function ($booking) {
                return [
                    'ID' => $booking->id,
                    'Nama Driver' => $booking->driver->name,
                    'Kendaraan' => $booking->vehicle->name,
                    'Tujuan' => $booking->destination,
                    'Tanggal Mulai' => $booking->start_time,
                    'Tanggal Selesai' => $booking->end_time,
                    'Status' => $booking->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Driver',
            'Kendaraan',
            'Tujuan',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Status',
        ];
    }
}
