<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('zone_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sensor_type_id')->constrained()->restrictOnDelete();

            $table->string('name');
            $table->boolean('enabled')->default(true);

            $table->timestamps();

            $table->unique(['zone_id','name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
};
