<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SensorTypeSeeder::class,
            ActuatorTypeSeeder::class,
            ActuatorStateSeeder::class,
            HouseSeeder::class,
            ZoneSeeder::class,
            SensorSeeder::class,
            ActuatorSeeder::class,
        ]);
    }
}
