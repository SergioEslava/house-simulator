<?php

declare(strict_types= 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SensorReading extends Model
{
    /** @use HasFactory<\Database\Factories\SensorReadingFactory> */
    use HasFactory;

    protected $fillable = [
        "sensor_id",
        "value",
        "recorded_at",
    ];

    protected function casts(): array
    {
        return ['recorded_at' => 'datetime', ];
    }

    // RELATIONSHIPS
    public function sensor(): BelongsTo {return $this->belongsTo(Sensor::class); }
}
