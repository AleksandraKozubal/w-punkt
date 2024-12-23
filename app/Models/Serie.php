<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SerieType;
use App\Enums\WeaponType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @poperty string $id
 * @property string $title
 * @property User $user_id
 * @property ?Carbon $dateTime
 * @property SerieType $type
 * @property ?string $place
 * @property WeaponType $weapon
 * @property ?string $coverImage
 * @property ?string $note
 * @property-read User $user
 * @property-read Collection<Target> $targets
 */
class Serie extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        "title",
        "user_id",
        "dateTime",
        "type",
        "place",
        "weapon",
        "coverImage",
        "note",
    ];
    protected $casts = [
        "dateTime" => "datetime",
        "type" => SerieType::class,
        "weapon" => WeaponType::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function targets(): HasMany
    {
        return $this->hasMany(Target::class);
    }
}
