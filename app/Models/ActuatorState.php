<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class ActuatorState extends Model
{
    /** @use HasFactory<\Database\Factories\ActuatorStateFactory> */
    use HasFactory;

    protected $fillable = [
        "actuator_type_id",
        "code",
        "name",
    ];

    // RELATIONSHIPS
    public function type(): BelongsTo { return $this->belongsTo(ActuatorType::class, 'actuator_type_id'); }
}
