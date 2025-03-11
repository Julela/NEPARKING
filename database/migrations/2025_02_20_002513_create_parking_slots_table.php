<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Schema::create('parking_slots', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('slot_number')->unique();
        //     $table->boolean('is_booked')->default(false);
        //     $table->timestamps();
        // });
        Schema::create('parking_a', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->unique();
            $table->enum('status', ['parkir', 'izin'])->default('parkir');
            $table->timestamps();
        });

        Schema::create('parking_b', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->unique();
            $table->enum('status', ['parkir', 'izin'])->default('parkir');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('parking_slots');
        Schema::dropIfExists('parking_a');
        Schema::dropIfExists('parking_b');
    }
};
