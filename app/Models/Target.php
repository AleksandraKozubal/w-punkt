<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SerieType;
use App\Enums\WeaponType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @poperty int $id
 * @property Serie $serie_id
 * @property array $points
 * @property int $points_earned
 * @property int $points_max
 * @property ?int $center_hits
 * @property ?string $image
 * @property-read Serie $serie
 */
class Target extends Model
{
    use HasFactory;

    protected $fillable = [
        "serie_id",
        "points",
        "points_earned",
        "points_max",
        "center_hits",
        "image",
    ];
    protected $casts = [
        "points_earned" => "int",
        "points_max" => "int",
        "center_hits" => "int",
        "points" => "array",
    ];

    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }
}
