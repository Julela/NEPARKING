<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkingB extends Model
{
    use HasFactory;

    protected $table = 'parking_b';
    protected $fillable = ['qr_code', 'waktu_masuk', 'waktu_keluar'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($parking) {
            $parking->waktu_keluar = now()->setTime(14, 0, 0); // Atur ke jam 14:00
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'qr_code', 'qr_code');
    }
}
