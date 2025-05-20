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
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Log Aktivitas Admin
                    </h2>

                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap bg-white dark:bg-gray-800">
                                <thead>
                                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                                        <th class="px-4 py-3">Waktu</th>
                                        <th class="px-4 py-3">Admin</th>
                                        <th class="px-4 py-3">Aksi</th>
                                        <th class="px-4 py-3">Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach($logs as $log)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm">
                                            {{ $log->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $log->user->name ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ ucfirst(str_replace('_', ' ', $log->action)) }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $log->description }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $logs->links() }}
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </div>
</body>

</html>