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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employeeId');
            $table->string('userId');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('contact');
            $table->string('address');
            $table->string('nic');
            $table->string('gender');
            $table->string('dob');
            $table->string('emImage');
            $table->string('position');
            $table->string('salary');
            $table->string('joiningDate');
            $table->bigInteger('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
