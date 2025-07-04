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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->string('employeeId')->nullable();
            $table->string('month')->nullable();
            $table->string('salary')->nullable();
            $table->string('bonus')->nullable();
            $table->string('deduction')->nullable();
            $table->integer('leave')->nullable();
            $table->string('total')->nullable();
            $table->bigInteger('status')->nullable();
            $table->bigInteger('isActive')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
