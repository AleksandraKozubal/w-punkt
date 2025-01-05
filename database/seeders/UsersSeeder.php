<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    protected const DEFAULT_PASSWORD = "password";

    public function run(): void
    {
        User::firstOrCreate(
            ["email" => "admin@example.com"],
            ["role" => Role::Admin,
                "name" => "Administrator",
                "email_verified_at" => now(),
                "password" => Hash::make(static::DEFAULT_PASSWORD),
                "remember_token" => Str::random(10),
                "active" => true,
            ],
        );

        User::factory()->count(10)->create();
    }
}
