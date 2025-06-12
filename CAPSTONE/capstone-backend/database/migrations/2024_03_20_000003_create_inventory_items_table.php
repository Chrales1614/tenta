<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // medication, supplies, food, equipment
            $table->string('subcategory')->nullable(); // antibiotics, vaccines, surgical supplies, etc.
            $table->integer('quantity');
            $table->integer('min_quantity');
            $table->string('unit');
            $table->decimal('price', 10, 2);
            $table->date('expiry_date')->nullable();
            $table->date('last_restock_date')->nullable();
            $table->string('supplier')->nullable();
            $table->text('description')->nullable();
            $table->boolean('requires_prescription')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
}; 