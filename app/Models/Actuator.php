<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Actuator extends Model
{
    /** @use HasFactory<\Database\Factories\ActuatorFactory> */
    use HasFactory;

    protected $fillable = [
        "zone_id",
        "actuator_type_id",
        "actuator_state_id",
        "name",
    ];

    // RELATIONSHIPS
    public function zone(): BelongsTo { return $this->belongsTo(Zone::class); }
    public function type(): BelongsTo { return $this->belongsTo(ActuatorType::class, 'actuator_type_id'); }
    public function state(): BelongsTo { return $this->belongsTo(ActuatorState::class,'actuator_state_id'); }
}
