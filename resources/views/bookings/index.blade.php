<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DashAdmin</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./../assets/css/tailwind.output.css" />
    <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer></script>
    <script src="./../assets/js/init-alpine.js"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
        defer></script>
    <script src="./../assets/js/charts-lines.js" defer></script>
    <script src="./../assets/js/charts-pie.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>

<body>
    <div
        class="flex h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- sidebar -->
        @include('components.sidebar')
        <div class="flex flex-col flex-1 w-full">
            <!-- HEADER -->
            @include('components.header')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 py-8 flex flex-col">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 mt-4">Daftar Booking</h1>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="w-full whitespace-no-wrap bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden mb-4">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr class="text-gray-600 dark:text-gray-300 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Kendaraan</th>
                                <th class="py-3 px-6 text-left">Driver</th>
                                <th class="py-3 px-6 text-left">Mulai</th>
                                <th class="py-3 px-6 text-left">Selesai</th>
                                <th class="py-3 px-6 text-left">Status</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-400 text-sm font-light">
                            @forelse($bookings as $booking)
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span>{{ $booking->vehicle->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span>{{ $booking->driver->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y') }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ \Carbon\Carbon::parse($booking->end_time)->format('d M Y') }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($booking->status == 'pending') bg-yellow-200 text-yellow-800
                                        @elseif($booking->status == 'approved') bg-green-200 text-green-800
                                        @elseif($booking->status == 'rejected') bg-red-200 text-red-800
                                        @elseif($booking->status == 'completed') bg-blue-200 text-blue-800
                                        @else bg-gray-200 text-gray-800 @endif
                                        ">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center space-x-2">

                                        @if($booking->status == 'pending')
                                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Yakin ingin batalkan booking?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 font-medium text-sm px-2 py-1 border border-red-500 rounded">Batal</button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-4 px-6 text-center text-gray-500 dark:text-gray-400">Belum ada booking</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="w-32 mt-6">
                        <a href="{{ route('bookings.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow-md transition duration-200">
                            Buat Booking Baru
                        </a>
                    </div>
                </div>

            </main>
        </div>
    </div>
</body>

</html>