<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('parking_slots', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('is_booked');
        });
    }

    public function down()
    {
        Schema::table('parking_slots', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};

