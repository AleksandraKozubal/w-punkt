<?php

namespace Database\Seeders;

use App\Models\Serie;
use App\Models\Target;
use Database\Seeders\UsersSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (config("app.env") !== "local") {
            return;
        }

        $this->call(UsersSeeder::class);
        Serie::factory()->count(10)->create();

        Target::factory()->count(100)->create()->each(function ($target) {
            $target->update([
                'serie_id' => Serie::all()->random()->id,
            ]);
        });

    }
}
