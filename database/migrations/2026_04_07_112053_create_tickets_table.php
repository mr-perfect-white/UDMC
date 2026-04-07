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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('register_id')->constrained('register_forms')->cascadeOnDelete();

            $table->string('application_id');

            $table->double('quantity');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('photo')->nullable();

            $table->enum('status', ['pending', 'processing', 'completed'])->default('pending');

            $table->foreignId('vehicle_id')->nullable()->constrained()->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
