<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ActuatorType;
use App\Support\Codes\ActuatorTypeCode;
use Illuminate\Database\Seeder;

class ActuatorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ActuatorType::query()->create([
            "code"=> ActuatorTypeCode::LAMP,
            "name"=> "Lamp",
        ]);

        ActuatorType::query()->create([
            "code"=> ActuatorTypeCode::BLIND,
            "name"=> "Blind",
        ]); 

        ActuatorType::query()->create([
            "code"=> ActuatorTypeCode::CEILING_LIGHT,
            "name"=> "Ceiling Lamp",
        ]);

        ActuatorType::query()->create([
            "code"=> ActuatorTypeCode::DOOR,
            "name"=> "Door",
        ]);
    }
}
