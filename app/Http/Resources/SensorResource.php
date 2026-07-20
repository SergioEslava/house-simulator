<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SensorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name"    => $this->name,
            "zone"      => new ZoneResource($this->whenLoaded("zone")),
            "type"      => new SensorTypeResource($this->whenLoaded("type")),
            "readings"   => $this->readings,
        ];
    }
}
