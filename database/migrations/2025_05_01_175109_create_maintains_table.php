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
        Schema::create('maintains', function (Blueprint $table) {
            $table->id();
            $table->string('vehicleId');
            $table->string('customerId');
            $table->string('tMileage');
            $table->string('Note');
            $table->string('lastService');
            $table->string('lastBrake');
            $table->string('lastOil');
            $table->string('lastEngine');
            $table->string('lastTire');
            $table->string('predictedDate');
            $table->bigInteger('send');
            $table->bigInteger('sentCount');
            $table->string('lastSentDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
