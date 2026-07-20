<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSensorRequest;
use App\Http\Resources\SensorResource;
use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index(Request $request){ 
        $query = Sensor::with(['zone', 'type']);

        $query->when($request->zone, function ($query, $zone) {
            $query->where('zone_id', $zone);
        });

        return SensorResource::collection($query->get());
    }

    public function store(StoreSensorRequest $request){
        $sensor = Sensor::create($request->validated());

        $sensor->load(['zone', 'type']);

        return new SensorResource($sensor);
    }

    public function show(Sensor $sensor){ 
        $sensor->load('zone', 'type');
        return new SensorResource($sensor); 
    }

    public function update(Request $request, Sensor $sensor)
    {
        $sensor->update($request->validated());

        $sensor->load(['zone', 'type']);

        return new SensorResource($sensor);
    }    
    
    public function destroy(Sensor $sensor){
        return response()->noContent();
    }
}
