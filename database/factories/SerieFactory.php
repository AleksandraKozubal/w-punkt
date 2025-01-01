<?php

namespace Database\Factories;

use App\Enums\SerieType;
use App\Enums\WeaponType;
use App\Models\Serie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Serie>
 */
class SerieFactory extends Factory
{
    protected static ?string $password;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(),
            "user_id" => User::factory(),
            "dateTime" => fake()->dateTime(),
            "place" => fake()->sentence(),
            "coverImage" => fake()->boolean(50)
                ? '/storage/series/shooters.jpeg'
                : null,
            "note" => fake()->paragraph(),
            "type" => fake()->randomElement(array_column(SerieType::cases(), "value")),
            "weapon" => fake()->randomElement(array_column(WeaponType::cases(), "value")),
        ];
    }
}
