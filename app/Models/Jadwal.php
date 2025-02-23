<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals'; // Nama tabel di database

    protected $fillable = [
        'mata_pelajaran',
        'guru',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];
}
