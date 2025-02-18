<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cutis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('jenis'); // Sakit, Izin, Cuti
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('keterangan')->nullable();
            $table->string('status')->default('Menunggu Persetujuan'); // Menunggu, Disetujui, Ditolak
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cutis');
    }
};
