<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all(); // Mengambil semua data jadwal dari database
        return view('jadwal.index', compact('jadwal'));
    }
}

