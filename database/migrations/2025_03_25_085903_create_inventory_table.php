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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inventory_category_id');
            $table->string('name');
            $table->text('description');
            $table->string('sku');
            $table->integer('quantity')->default(0);
            $table->double('price', 10, 2);
            $table->bigInteger('supplier_id');
            $table->integer('reorder_level')->default(0);
            $table->bigInteger('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventroys');
    }
};
