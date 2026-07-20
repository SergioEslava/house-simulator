<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        House::query()->create([
            "name"=> "Simulación Casa de Alejandro",
        ]);
    }
}
