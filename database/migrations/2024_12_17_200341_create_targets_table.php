<?php

use App\Models\Serie;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignIdFor(Serie::class)->constrained()->cascadeOnDelete();
            $table->integer('points_earned');
            $table->integer('points_max');
            $table->integer('center_hits')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('targets');
    }
};
