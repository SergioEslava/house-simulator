<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Sensor;
use App\Models\SensorType;
use App\Models\Zone;
use App\Support\Codes\SensorTypeCode;
use Illuminate\Database\Seeder;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sensor Types
        $temperatureType = SensorType::query()
            ->where('code', SensorTypeCode::TEMPERATURE)
            ->firstOrFail();
        $plantHumidityType = SensorType::query()
            ->where('code', SensorTypeCode::PLANT_HUMIDITY)
            ->firstOrFail();

        // Zones
        $zones = Zone::query()
            ->get()
            ->keyBy('name');

        // Temperature Sensors
        Sensor::query()->create([
            'zone_id' => $zones['Living Room']->id,
            'sensor_type_id' => $temperatureType->id,
            'name' => 'Temperature Sensor',
        ]);
        Sensor::query()->create([
            'zone_id' => $zones['Master Bedroom']->id,
            'sensor_type_id' => $temperatureType->id,
            'name' => 'Temperature Sensor',
        ]);
        Sensor::query()->create([
            'zone_id' => $zones['Secondary Bedroom']->id,
            'sensor_type_id' => $temperatureType->id,
            'name' => 'Temperature Sensor',
        ]);
        Sensor::query()->create([
            'zone_id' => $zones['Kitchen']->id,
            'sensor_type_id' => $temperatureType->id,
            'name' => 'Temperature Sensor',
        ]);

        // Humidity Sensors
        for ($i = 1; $i <= 8; $i++) {

            Sensor::query()->create([
                'zone_id' => $zones['Patio']->id,
                'sensor_type_id' => $plantHumidityType->id,
                'name' => "Plant Humidity Sensor {$i}",
            ]);

        }

    }
}
