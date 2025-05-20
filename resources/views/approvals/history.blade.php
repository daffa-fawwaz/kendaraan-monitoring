<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DashAdmin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./../assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./../assets/js/init-alpine.js"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Sidebar -->
        @include('components.sidebar-approvals')

        <div class="flex flex-col flex-1 w-full">
            <!-- Header -->
            @include('components.header')

            <main class="h-full overflow-y-auto">
                <div class="container px-6 py-8 mx-auto">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6 mt-10">Riwayat Persetujuan Saya</h1>

                    @forelse($approvedApprovals as $approval)
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-5">
                        <p class="text-gray-700 dark:text-gray-300 mb-2">
                            <strong>Kendaraan:</strong> {{ $approval->booking->vehicle->name }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2">
                            <strong>Driver:</strong> {{ $approval->booking->driver->name }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2">
                            <strong>Tujuan:</strong> {{ $approval->booking->destination }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2">
                            <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($approval->booking->start_time)->format('d M Y H:i') }} - {{ \Carbon\Carbon::parse($approval->booking->end_time)->format('d M Y H:i') }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2">
                            <strong>Level Persetujuan:</strong> {{ ucfirst($approval->level) }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 mb-2">
                            <strong>Disetujui pada:</strong> {{ \Carbon\Carbon::parse($approval->approved_at)->format('d M Y H:i') }}
                        </p>
                    </div>
                    @empty
                    <div class="text-gray-600 dark:text-gray-400">
                        Belum ada histori persetujuan.
                    </div>
                    @endforelse
                </div>
            </main>
        </div>
    </div>
</body>

</html>