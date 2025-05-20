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
                <div class="container mx-auto px-6 py-8">

                    <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 mb-6">Dashboard</h2>

                    <!-- Cards -->
                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <!-- Total Kendaraan -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h2l1 5h12l1-5h2M5 6h14l1 5H4l1-5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Kendaraan</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $totalVehicles }}</p>
                            </div>
                        </div>

                        <!-- Total Supir -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Supir</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $totalDrivers }}</p>
                            </div>
                        </div>

                        <!-- Booking Bulan Ini -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <div class="p-3 mr-4 text-yellow-500 bg-yellow-100 rounded-full dark:text-yellow-100 dark:bg-yellow-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Booking Bulan Ini</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $totalBookings }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Chart -->
                    <div class="w-full mt-8 p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <h4 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-300">
                            Grafik Pemakaian Kendaraan (12 Bulan Terakhir)
                        </h4>
                        <canvas
                            id="usageChart"
                            height="100"
                            data-usage='@json($usagePerMonth)'></canvas>
                    </div>

                    <form action="{{ route('laporan.export') }}" method="GET" class="mt-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <label for="from" class="text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Tanggal Mulai</span>
                                <input id="from" type="datetime-local" name="from"
                                    class="block w-full mt-2 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    required>
                            </label>

                            <label for="to" class="text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Tanggal Selesai</span>
                                <input id="to" type="datetime-local" name="to"
                                    class="block w-full mt-2 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    required>
                            </label>
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md transition-colors duration-150">
                                Export Excel
                            </button>
                        </div>
                    </form>


                </div>
            </main>
        </div>
    </div>

</body>

</html>