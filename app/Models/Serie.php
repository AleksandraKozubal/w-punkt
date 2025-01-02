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
 * @property Carbon $date_time
 * @property SerieType $type
 * @property ?string $place
 * @property WeaponType $weapon
 * @property ?string $cover_image
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
        "date_time",
        "type",
        "place",
        "weapon",
        "cover_image",
        "note",
    ];
    protected $casts = [
        "date_time" => "datetime",
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
