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
    Schema::create('register_forms', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('mobile',10);
        $table->string('email');

        $table->string('property_type');
        $table->string('demolition_type')->nullable();

        $table->text('site_address');

        $table->unsignedBigInteger('ward_id');

        $table->decimal('latitude',10,7);
        $table->decimal('longitude',10,7);

        $table->decimal('built_up_area',10,2);
        $table->decimal('estimated_waste',10,2);
        $table->string('application_id')->nullable()->unique();
        $table->string('status')->default('pending'); // pending, approved, rejected
        $table->string('plant_id')->nullable();
        $table->string('qr_code')->nullable(); // store file path
        $table->string('pdf_file')->nullable(); // store file path

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_forms');
    }
};
