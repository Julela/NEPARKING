<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function index()
    {
        // Ambil notifikasi dari database (bisa berdasarkan user)
        $notifikasis = Notifikasi::orderBy('created_at', 'desc')->get();

        return view('notifikasi.index', compact('notifikasis'));
    }
}
