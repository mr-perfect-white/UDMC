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
        Schema::create('wards', function (Blueprint $table) {
            $table->id();

            $table->integer('constituency_id')->nullable();
            $table->string('name');
            $table->integer('number');

            $table->tinyInteger('status')->default(1);
            $table->string('type')->nullable();

            $table->longText('boundry')->nullable();

            $table->decimal('x_min', 12, 8)->nullable();
            $table->decimal('x_max', 12, 8)->nullable();
            $table->decimal('y_min', 12, 8)->nullable();
            $table->decimal('y_max', 12, 8)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};
