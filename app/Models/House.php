<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class House extends Model
{
    /** @use HasFactory<\Database\Factories\HouseFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
    ];

    // RELATIONSHIPS
    public function zones(): HasMany { return $this->hasMany(Zone::class); }
}
