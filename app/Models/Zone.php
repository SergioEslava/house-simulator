<?php

declare(strict_types= 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zone extends Model
{
    /** @use HasFactory<\Database\Factories\ZoneFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
    ];

    // RELATIONSHIPS
    public function house(): BelongsTo { return $this->belongsTo(House::class); }
    public function sensors(): HasMany { return $this->hasMany(Sensor::class); }
    public function actuators(): HasMany { return $this->hasMany(Actuator::class); }
}
