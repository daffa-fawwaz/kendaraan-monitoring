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
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Daftar Kendaraan</h2>

                    @if(session('success'))
                    <div class="mb-4 text-green-600 dark:text-green-400">{{ session('success') }}</div>
                    @endif

                    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                                <tr>
                                    <th class="px-6 py-3">Nama</th>
                                    <th class="px-6 py-3">Tipe</th>
                                    <th class="px-6 py-3">Plat</th>
                                    <th class="px-6 py-3">Kepemilikan</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $vehicle)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $vehicle->name }}</td>
                                    <td class="px-6 py-4">{{ $vehicle->type }}</td>
                                    <td class="px-6 py-4">{{ $vehicle->license_plate }}</td>
                                    <td class="px-6 py-4 capitalize">{{ $vehicle->ownership }}</td>
                                    <td class="px-6 py-4 flex space-x-2">
                                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 font-medium text-sm px-2 py-1 border border-red-500 rounded">Batal</button>
                                        </form>
                                        <a href="{{ route('vehicles.edit', $vehicle) }}"
                                            class="inline-block text-white bg-blue-600 hover:bg-blue-700 font-medium text-sm px-4 py-1 rounded">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="p-4">
                            {{ $vehicles->links() }}
                        </div>
                    </div>
                    <div class="w-32 mt-6">
                        <a href="{{ route('vehicles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow-md transition duration-200">
                            + Tambah Kendaraan
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>

</html>