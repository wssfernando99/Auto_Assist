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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('customerId');
            $table->string('vehicleId');
            $table->string('vehicleBrand');
            $table->string('vehicleType');
            $table->string('vehicleModel');
            $table->string('engineType');
            $table->string('numberPlate');
            $table->string('vehicleYear');
            $table->string('milage');
            $table->string('milagePer');
            $table->bigInteger('check');
            $table->bigInteger('isActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
