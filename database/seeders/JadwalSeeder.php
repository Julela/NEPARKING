<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        Jadwal::create([
            'mata_pelajaran' => 'Matematika',
            'guru' => 'Budi Santoso',
            'hari' => 'Senin',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '09:30:00'
        ]);

        Jadwal::create([
            'mata_pelajaran' => 'Bahasa Indonesia',
            'guru' => 'Siti Aminah',
            'hari' => 'Selasa',
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '11:30:00'
        ]);
    }
}
