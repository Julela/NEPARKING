<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('parking_area', function (Blueprint $table) {
            $table->id();
            $table->string('area', 255)->nullable();
            $table->enum('status_area', ['Available', 'NotavAilable'])->default('NotavAilable');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parking_area');
    }
};
