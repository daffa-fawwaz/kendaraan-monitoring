<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::create([
            'name' => 'Toyota Hiace',
            'type' => 'angkutan orang',
            'license_plate' => 'B 1234 CD',
            'ownership' => 'company',
        ]);

        Vehicle::create([
            'name' => 'Isuzu Traga',
            'type' => 'angkutan barang',
            'license_plate' => 'B 5678 EF',
            'ownership' => 'rental',
        ]);
    }
}
