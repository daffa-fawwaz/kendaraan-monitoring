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
        @include('components.sidebar-approvals')
        <div class="flex flex-col flex-1 w-full">
            <!-- HEADER -->
            @include('components.header')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 py-8 flex flex-col">
                    <h2 class="text-xl font-semibold mb-4">Daftar Booking untuk Disetujui</h2>

                    @forelse ($pendingApprovals as $approval)
                    <div class="p-4 bg-white shadow rounded mb-3">
                        <p><strong>Mobil:</strong> {{ $approval->booking->vehicle->name }}</p>
                        <p><strong>Driver:</strong> {{ $approval->booking->driver->name }}</p>
                        <p><strong>Tujuan:</strong> {{ $approval->booking->destination }}</p>
                        <p><strong>Tanggal:</strong>
                            {{ \Carbon\Carbon::parse($approval->booking->start_time)->format('d M Y H:i') }} -
                            {{ \Carbon\Carbon::parse($approval->booking->end_time)->format('d M Y H:i') }}
                        </p>
                        <p><strong>Status Level:</strong> {{ $approval->booking->level }}</p>


                        <div class="flex gap-10 mt-4">
                            <form action="{{ route('booking-approvals.approve', $approval) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-blue-600 dark:bg-blue-700 text-white px-3 py-1 rounded">Setujui</button>
                            </form>

                            <form action="{{ route('booking-approvals.reject', $approval) }}" method="POST" class="inline ml-2">
                                @csrf
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Tolak</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-600 dark:text-gray-400">Belum ada booking</p>
                    @endforelse
                </div>
            </main>
        </div>
    </div>
</body>

</html>