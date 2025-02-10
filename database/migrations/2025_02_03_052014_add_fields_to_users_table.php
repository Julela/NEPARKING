<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Pastikan menggunakan tipe data yang sama dengan id di tabel classes
            $table->foreignId('classes_id')
                  ->constrained('classes')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Perbaiki nama foreign key yang akan di-drop
            $table->dropForeign(['classes_id']);
            $table->dropColumn('classes_id');
        });
    }
};