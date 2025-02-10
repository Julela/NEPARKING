<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_name', 255)->nullable();
            $table->string('quota_per_class', 255)->nullable();
            // $table->unsignedBigInteger('user_id');

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
