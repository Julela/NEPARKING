<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class IzinController extends Controller
{
    public function create()
    {
        return view('izin.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'qr_code' => 'required|string',
        ]);

        // Cek apakah plat nomor ada di Area A atau Area B
        $parkingA = DB::table('parking_a')->where('qr_code', $request->qr_code)->first();
        $parkingB = DB::table('parking_b')->where('qr_code', $request->qr_code)->first();

        if ($parkingA) {
            DB::table('parking_a')->where('qr_code', $request->qr_code)->update(['status' => 'izin']);
        } elseif ($parkingB) {
            DB::table('parking_b')->where('qr_code', $request->qr_code)->update(['status' => 'izin']);
        } else {
            return redirect()->back()->with('error', 'Plat nomor tidak ditemukan');
        }

        return redirect()->route('parkir.index')->with('message', 'Izin berhasil dilakukan!');
    }
}
