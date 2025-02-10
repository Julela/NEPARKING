<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void 
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengubah kolom yang sudah ada untuk menambahkan default value
            $table->foreignId('classes_id')
                  ->default(1)  // Ganti dengan default value yang diinginkan
                  ->change();
        });
    }

    public function down(): void 
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengembalikan kolom ke kondisi semula tanpa default value
            $table->foreignId('classes_id')
                  ->change();
        });
    }
};