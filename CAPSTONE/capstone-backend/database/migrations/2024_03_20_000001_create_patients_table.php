<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('owner_contact');
            $table->text('owner_address')->nullable();
            $table->string('pet_name');
            $table->string('pet_species');
            $table->string('pet_breed')->nullable();
            $table->integer('pet_age');
            $table->string('pet_gender');
            $table->decimal('pet_weight', 5, 2)->nullable();
            $table->text('medical_history')->nullable();
            $table->text('allergies')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
}; 