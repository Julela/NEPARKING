<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;
use Auth;

class CutiController extends Controller
{
    public function index()
    {
        return view('cuti.index'); // Menuju tampilan form izin/cuti
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'nullable|string'
        ]);

        Cuti::create([
            'user_id' => Auth::id(),
            'jenis' => $request->jenis,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keterangan' => $request->keterangan,
            'status' => 'Menunggu Persetujuan' // Default status
        ]);

        return redirect()->route('cuti.index')->with('success', 'Pengajuan izin/cuti berhasil dikirim.');
    }
}
