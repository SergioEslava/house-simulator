<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\SensorType;
use App\Support\Codes\SensorTypeCode;
use Illuminate\Database\Seeder;

final class SensorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SensorType::query()->create([
            "code" => SensorTypeCode::TEMPERATURE,
            "name" => "Temperature",
            "unit" => "ºC",
            "sampling_interval_seconds" => 10,
        ]);

        SensorType::query()->create([
            "code" => SensorTypeCode::PLANT_HUMIDITY,
            "name" => "Plant Humidity",
            "unit" => "%",
            "sampling_interval_seconds" => 1000,
        ]);
    }
}
