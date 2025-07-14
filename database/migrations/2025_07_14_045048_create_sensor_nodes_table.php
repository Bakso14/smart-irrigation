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
        Schema::create('sensor_nodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('node');       // ID node sensor
            $table->float('tegangan');
            $table->integer('arus');
            $table->integer('sensor1');
            $table->integer('sensor2');
            $table->integer('sensor3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_nodes');
    }
};
