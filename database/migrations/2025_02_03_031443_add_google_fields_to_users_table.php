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
            $table->string('img', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['google_token', 'google_refresh_token', 'location', 'img']);
        });
    }
};
