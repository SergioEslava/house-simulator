<?php

declare(strict_types= 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Sensor extends Model
{
    /** @use HasFactory<\Database\Factories\SensorFactory> */
    use HasFactory;

    protected $fillable = [
        "zone_id",
        "sensor_type_id",
        "name",
    ];


    // RELATIONSHIPS
    public function zone(): BelongsTo { return $this->belongsTo(Zone::class); }
    public function type(): BelongsTo { return $this->belongsTo(SensorType::class, 'sensor_type_id'); }
    public function readings(): HasMany { return $this->hasMany(SensorReading::class); }
}
