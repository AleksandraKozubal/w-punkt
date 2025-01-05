<?php

namespace Database\Factories;

use App\Models\Serie;
use App\Models\Target;
use Illuminate\Database\Eloquent\Factories\Factory;

class TargetFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $points = array_map(fn() => fake()->numberBetween(0, 10), range(1, 10));
        $pointsEarned = array_sum($points);

        return [
            "serie_id" => Serie::factory(),
            "points" => $points,
            "points_earned" => $pointsEarned,
            "points_max" => 100,
            "center_hits" => fake()->numberBetween(0, 10),
            "image" => '/storage/targets/target.jpeg',
        ];
    }
}

