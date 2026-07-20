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
        Schema::create('actuators', function (Blueprint $table) {
            $table->id();

            $table->foreignId('zone_id')->constrained()->cascadeOnDelete();
            $table->foreignId('actuator_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('actuator_state_id')->constrained()->restrictOnDelete();

            $table->string('name');

            $table->timestamps();

            $table->unique(['zone_id','name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actuators');
    }
};
