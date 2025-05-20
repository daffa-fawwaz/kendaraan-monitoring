<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DashAdmin</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./../../assets/css/tailwind.output.css" />
    <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer></script>
    <script src="./../../assets/js/init-alpine.js"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
        defer></script>
    <script src="./../../assets/js/charts-lines.js" defer></script>
    <script src="./../../assets/js/charts-pie.js" defer></script>
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
                <div class="container mx-auto p-4 max-w-lg">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Edit Kendaraan</h1>

                    @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('vehicles.update', $vehicle->id ?? '') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Nama Kendaraan</span>
                            <input type="text" name="name" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ old('name', $vehicle->name ?? '') }}" required>
                        </label>

                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Tipe Kendaraan</span>
                            <select name="type" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required>
                                <option value="">- Pilih Tipe -</option>
                                <option value="angkutan barang" @selected(old('type', $vehicle->type ?? '') == 'angkutan barang')>Angkutan Barang</option>
                                <option value="angkutan orang" @selected(old('type', $vehicle->type ?? '') == 'angkutan orang')>Angkutan Orang</option>
                            </select>
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Nomor Kendaraan</span>
                            <input type="text" name="license_plate" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{old('license_plate', $vehicle->license_plate ?? '') }}" required>
                        </label>

                        <label class="block mt-4 text-sm">Kepemilikan</label>
                        <select name="ownership" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required>
                            <option value="company" @selected(old('ownership', $vehicle->ownership ?? '') == 'company')>Perusahaan</option>
                            <option value="rental" @selected(old('ownership', $vehicle->ownership ?? '') == 'rental')>Sewa</option>
                        </select>

                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                            Simpan
                        </button>
                    </form>
                </div>
            </main>
        </div>
    </div>

</body>

</html>