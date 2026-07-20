<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Actuator;
use App\Models\ActuatorState;
use App\Models\ActuatorType;
use App\Models\Zone;
use App\Support\Codes\ActuatorStateCode;
use App\Support\Codes\ActuatorTypeCode;
use Illuminate\Database\Seeder;

class ActuatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Zones
        $zones = Zone::query()
            ->get()
            ->keyBy('name');

        // Actuator types
        $lampType = ActuatorType::query()
            ->where('code', ActuatorTypeCode::LAMP)
            ->firstOrFail();
        $ceilingLightType = ActuatorType::query()
            ->where('code', ActuatorTypeCode::CEILING_LIGHT)
            ->firstOrFail();
        $blindType = ActuatorType::query()
            ->where('code', ActuatorTypeCode::BLIND)
            ->firstOrFail();
        $doorType = ActuatorType::query()
            ->where('code', ActuatorTypeCode::DOOR)
            ->firstOrFail();

        // Actuator states
        $lightOff = ActuatorState::query()
            ->where('actuator_type_id', $ceilingLightType->id)
            ->where('code', ActuatorStateCode::OFF)
            ->firstOrFail();
        $lampOff = ActuatorState::query()
            ->where('actuator_type_id', $lampType->id)
            ->where('code', ActuatorStateCode::OFF)
            ->firstOrFail();
        $blindDown = ActuatorState::query()
            ->where('actuator_type_id', $blindType->id)
            ->where('code', ActuatorStateCode::DOWN)
            ->firstOrFail();
        $doorClosed = ActuatorState::query()
            ->where('actuator_type_id', $doorType->id)
            ->where('code', ActuatorStateCode::CLOSED)
            ->firstOrFail();

        // Actuators for living room
        Actuator::query()->create([
            'zone_id' => $zones['Living Room']->id,
            'actuator_type_id' => $ceilingLightType->id,
            'actuator_state_id' => $lightOff->id,
            'name' => 'Ceiling Light',
        ]);
        Actuator::query()->create([
            'zone_id' => $zones['Living Room']->id,
            'actuator_type_id' => $lampType->id,
            'actuator_state_id' => $lampOff->id,
            'name' => 'Lamp',
        ]);
        Actuator::query()->create([
            'zone_id' => $zones['Living Room']->id,
            'actuator_type_id' => $blindType->id,
            'actuator_state_id' => $blindDown->id,
            'name' => 'Blind',
        ]);
        Actuator::query()->create([
            'zone_id' => $zones['Living Room']->id,
            'actuator_type_id' => $doorType->id,
            'actuator_state_id' => $doorClosed->id,
            'name' => 'Main Door',
        ]);

        // Master Bedroom
        Actuator::query()->create([
            'zone_id' => $zones['Master Bedroom']->id,
            'actuator_type_id' => $ceilingLightType->id,
            'actuator_state_id' => $lightOff->id,
            'name' => 'Ceiling Light',
        ]);
        Actuator::query()->create([
            'zone_id' => $zones['Master Bedroom']->id,
            'actuator_type_id' => $blindType->id,
            'actuator_state_id' => $blindDown->id,
            'name' => 'Blind',
        ]);

        // Secondary Bedroom
        Actuator::query()->create([
            'zone_id' => $zones['Secondary Bedroom']->id,
            'actuator_type_id' => $ceilingLightType->id,
            'actuator_state_id' => $lightOff->id,
            'name' => 'Ceiling Light',
        ]);
        Actuator::query()->create([
            'zone_id' => $zones['Secondary Bedroom']->id,
            'actuator_type_id' => $blindType->id,
            'actuator_state_id' => $blindDown->id,
            'name' => 'Blind',
        ]);

        // Kitchen
        Actuator::query()->create([
            'zone_id' => $zones['Kitchen']->id,
            'actuator_type_id' => $ceilingLightType->id,
            'actuator_state_id' => $lightOff->id,
            'name' => 'Ceiling Light',
        ]);
        Actuator::query()->create([
            'zone_id' => $zones['Kitchen']->id,
            'actuator_type_id' => $blindType->id,
            'actuator_state_id' => $blindDown->id,
            'name' => 'Blind Left',
        ]);
        Actuator::query()->create([
            'zone_id' => $zones['Kitchen']->id,
            'actuator_type_id' => $blindType->id,
            'actuator_state_id' => $blindDown->id,
            'name' => 'Blind Right',
        ]);

        // Patio
        Actuator::query()->create([
            'zone_id' => $zones['Patio']->id,
            'actuator_type_id' => $ceilingLightType->id,
            'actuator_state_id' => $lightOff->id,
            'name' => 'Main Light',
        ]);
        Actuator::query()->create([
            'zone_id' => $zones['Patio']->id,
            'actuator_type_id' => $ceilingLightType->id,
            'actuator_state_id' => $lightOff->id,
            'name' => 'Secondary Light',
        ]);
        Actuator::query()->create([
            'zone_id' => $zones['Patio']->id,
            'actuator_type_id' => $doorType->id,
            'actuator_state_id' => $doorClosed->id,
            'name' => 'Patio Door',
        ]);
    }
}
