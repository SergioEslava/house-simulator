<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\House;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $house = House::query()->firstOrFail();

        Zone::query()->create([
            "house_id"=> $house->id,
            "name"=> "Living Room",
            "description"=> "Tipical spanish living room.",
        ]);
        Zone::query()->create([
            "house_id"=> $house->id,
            "name"=> "Master Bedroom",
            "description"=> "It's the main room.",
        ]);
        Zone::query()->create([
            "house_id"=> $house->id,
            "name"=> "Secondary Bedroom",
            "description"=> "It's a bedroom for friends.",
        ]);
        Zone::query()->create([
            "house_id"=> $house->id,
            "name"=> "Kitchen",
            "description"=> "A great place to make some dishes.",
        ]);
        Zone::query()->create([
            "house_id"=> $house->id,
            "name"=> "Patio",
            "description"=> "A place to relax and take some drinks in a summer night.",
        ]);
    }
}
