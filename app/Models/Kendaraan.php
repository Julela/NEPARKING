<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'user_id',      // ID pemilik kendaraan
        'nomor_plat',   // Nomor plat kendaraan
        'merk',         // Merk kendaraan (misal: Honda, Yamaha, Toyota)
        'model',        // Model kendaraan (misal: Vario 150, Avanza, dll.)
        'warna',        // Warna kendaraan
        'tipe',         // Motor atau Mobil
    ];

    /**
     * Relasi ke tabel users (pemilik kendaraan).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
