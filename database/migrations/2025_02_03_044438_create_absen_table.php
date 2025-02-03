<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('absen', function (Blueprint $table) {
            $table->id();
            $table->string('plat_number', 255)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('parking_area_id');
            $table->string('img', 255)->nullable();
            $table->enum('attendance_status', ['Default', 'Success'])->default('Default');

            // Menambahkan foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parking_area_id')->references('id')->on('parking_area')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absen');
    }
};
