<?php

declare(strict_types= 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SensorType extends Model
{
    /** @use HasFactory<\Database\Factories\SensorTypeFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
        "unit",
        "sampling_interval_seconds",
    ];

    // RELATIONSHIPS
    public function sensors(): HasMany { return $this->hasMany(Sensor::class); }
}
