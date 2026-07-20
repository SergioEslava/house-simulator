<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ActuatorState;
use App\Models\ActuatorType;
use App\Support\Codes\ActuatorStateCode;
use App\Support\Codes\ActuatorTypeCode;
use Illuminate\Database\Seeder;

class ActuatorStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find references 
        $lamp = ActuatorType::query()
            ->where("code",ActuatorTypeCode::LAMP)
            ->firstOrFail();
        $ceilingLight = ActuatorType::query()
            ->where("code",ActuatorTypeCode::CEILING_LIGHT)
            ->firstOrFail();
        $blind = ActuatorType::query()
            ->where("code",ActuatorTypeCode::BLIND)
            ->firstOrFail();
        $door = ActuatorType::query()
            ->where("code",ActuatorTypeCode::DOOR)
            ->firstOrFail();

        // Creation of new states
        ActuatorState::query()->create([
            "actuator_type_id"=> $lamp->id, 
            "code"=> ActuatorStateCode::ON,
            "name"=> "On",
        ]);
        ActuatorState::query()->create([
            "actuator_type_id"=> $lamp->id, 
            "code"=> ActuatorStateCode::OFF,
            "name"=> "Off",
        ]);

        ActuatorState::query()->create([
            "actuator_type_id"=> $ceilingLight->id,
            "code"=> ActuatorStateCode::ON,
            "name"=> "On",
        ]);
        ActuatorState::query()->create([
            "actuator_type_id"=> $ceilingLight->id,
            "code"=> ActuatorStateCode::OFF,
            "name"=> "Off",
        ]);

        ActuatorState::query()->create([
            "actuator_type_id"=> $blind->id,
            "code"=> ActuatorStateCode::UP,
            "name"=> "Up",
        ]);
        ActuatorState::query()->create([
            "actuator_type_id"=> $blind->id,
            "code"=> ActuatorStateCode::DOWN,
            "name"=> "Down",
        ]);
        ActuatorState::query()->create([
            "actuator_type_id"=> $blind->id,
            "code"=> ActuatorStateCode::MOVING,
            "name"=> "Moving",
        ]);

        ActuatorState::query()->create([
            "actuator_type_id"=> $door->id,
            "code"=> ActuatorStateCode::OPEN,
            "name"=> "Open",
        ]);
        ActuatorState::query()->create([
            "actuator_type_id"=> $door->id,
            "code"=> ActuatorStateCode::CLOSED,
            "name"=> "Closed",
        ]);

    }
}
