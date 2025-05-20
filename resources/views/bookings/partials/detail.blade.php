<p><strong>Kendaraan:</strong> {{ $booking->vehicle->name ?? '-' }}</p>
<p><strong>Driver:</strong> {{ $booking->driver->name ?? '-' }}</p>
<p><strong>Tujuan:</strong> {{ $booking->destination }}</p>
<p><strong>Keperluan:</strong> {{ $booking->purpose }}</p>
<p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('d M Y H:i') }}</p>
<p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>

<h3 class="mt-4 font-semibold">Daftar Approver:</h3>
<ul class="list-disc list-inside">
    @foreach($booking->approvals as $approval)
    <li>{{ $approval->approver->name }} - {{ ucfirst($approval->status) }}</li>
    @endforeach
</ul>