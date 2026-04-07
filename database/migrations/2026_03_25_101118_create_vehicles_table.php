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
              // Vehicle
        $table->foreignId('ward_id')->constrained()->nullable();
        $table->string('vehicle_number');
        $table->string('vehicle_photo');
        $table->string('vehicle_type');
        $table->string('capacity');
        $table->string('rc_document');
        $table->string('fitness_certificate');

        // Owner
        $table->string('owner_name');
        $table->string('owner_mobile')->unique();
        $table->string('owner_email');
        $table->string('owner_address');
        $table->string('owner_photo');
        $table->string('owner_aadhaar_number');
        $table->string('owner_aadhaar_photo');
        $table->string('password');

        // Driver
        $table->boolean('driver_same_as_owner')->default(0);
        $table->string('driver_name');
        $table->string('driver_mobile');
        $table->string('driver_address');
        $table->string('driver_license_number');
        $table->string('driver_license_photo');
        $table->string('driver_aadhaar_number');
        $table->string('driver_aadhaar_photo');
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
