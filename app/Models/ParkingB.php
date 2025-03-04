<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkingB extends Model
{
    use HasFactory;
    
    protected $table = 'parking_b';
    protected $fillable = ['license_plate','waktu_masuk'];
}
