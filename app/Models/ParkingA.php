<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkingA extends Model
{
    use HasFactory;
    
    protected $table = 'parking_a';
    protected $fillable = ['license_plate'];
}
