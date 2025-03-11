<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IzinController extends Controller
{
    public function create()
    {
        return view('izin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string',
        ]);

        // Cek apakah plat nomor ada di Area A atau Area B
        $parkingA = DB::table('parking_a')->where('license_plate', $request->license_plate)->first();
        $parkingB = DB::table('parking_b')->where('license_plate', $request->license_plate)->first();

        if ($parkingA) {
            DB::table('parking_a')->where('license_plate', $request->license_plate)->update(['status' => 'izin']);
        } elseif ($parkingB) {
            DB::table('parking_b')->where('license_plate', $request->license_plate)->update(['status' => 'izin']);
        } else {
            return redirect()->back()->with('error', 'Plat nomor tidak ditemukan');
        }

        return redirect()->route('parkir.index')->with('message', 'Izin berhasil dilakukan!');
    }
}
