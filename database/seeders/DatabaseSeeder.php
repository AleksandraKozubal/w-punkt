<?php

namespace Database\Seeders;

use App\Models\Serie;
use App\Models\Target;
use Database\Seeders\UsersSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
   protected Collection $serie;
    public function run(): void
    {
        if (config("app.env") !== "local") {
            return;
        }

        $this->call(UsersSeeder::class);
        $this->serie = Serie::factory()->count(15)->create();
        foreach ($this->serie as $serie) {
            Target::factory()->count(rand(1,6))->create([
                'serie_id' => $serie->id,
            ]);
        }
    }
}
