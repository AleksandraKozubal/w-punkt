<?php

namespace Database\Factories;

use App\Enums\SerieType;
use App\Enums\WeaponType;
use App\Models\Serie;
use App\Models\Target;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Target>
 */
class TargetFactory extends Factory
{
    protected static ?string $password;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "serie_id" => Serie::factory(),
            "points_earned" => fake()->numberBetween(0, 100),
            "points_max" => 100,
            "center_hits" => fake()->numberBetween(0, 10),
            "image" => '/storage/factory/target.jpeg',
        ];
    }
}
