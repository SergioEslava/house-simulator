<?php

declare(strict_types= 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class ActuatorType extends Model
{
    /** @use HasFactory<\Database\Factories\ActuatorTypeFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
    ];

    // RELATIONSHIPS
    public function actuators(): HasMany { return $this->hasMany(Actuator::class); }
    public function states(): HasMany { return $this->hasMany(ActuatorState::class); }
}
