<?php

use App\Enums\SerieType;
use App\Enums\WeaponType;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('series', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->foreignIdFor(User::class)->constrained();
            $table->dateTime('date_time');
            $table->string('place')->nullable();
            $table->string('cover_image')->nullable();
            $table->text('note')->nullable();
            $table->enum('type', array_column(SerieType::cases(), 'value'));
            $table->enum('weapon', array_column(WeaponType::cases(), 'value'));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
