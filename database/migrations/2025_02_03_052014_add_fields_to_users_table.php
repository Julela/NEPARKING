<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_token', 255)->nullable();
            $table->string('google_refresh_token', 255)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('qr_code', 255)->nullable();
            $table->string('plat_number', 255)->nullable();
            $table->string('class', 255)->nullable();
            $table->string('img', 255)->nullable();
            $table->unsignedBigInteger('class_id');


            $table->foreign('class_id')->references('id')->on('class')->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropColumn([
                'google_token', 
                'google_refresh_token', 
                'location', 
                'qr_code', 
                'plat_number', 
                'class', 
                'img', 
                'class_id'
            ]);
        });
    }
};
