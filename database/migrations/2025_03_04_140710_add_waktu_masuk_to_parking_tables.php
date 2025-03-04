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
        Schema::table('parking_a', function (Blueprint $table) {
            $table->timestamp('waktu_masuk')->nullable()->after('license_plate');
        });

        Schema::table('parking_b', function (Blueprint $table) {
            $table->timestamp('waktu_masuk')->nullable()->after('license_plate');
        });
    }
    /**
     * Reverse the migrations.
     */

    public function down()
    {
        Schema::table('parking_a', function (Blueprint $table) {
            $table->dropColumn('waktu_masuk');
        });

        Schema::table('parking_b', function (Blueprint $table) {
            $table->dropColumn('waktu_masuk');
        });
    }
};
