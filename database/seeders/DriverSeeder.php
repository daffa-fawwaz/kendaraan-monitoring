<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    public function run(): void
    {
        Driver::create([
            'name' => 'Pak Budi',
            'phone' => '08123456789',
        ]);

        Driver::create([
            'name' => 'Pak Joko',
            'phone' => '08198765432',
        ]);
    }
}
