<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ScanController extends Controller
{
    public function index()
    {
        return view('scan.index');
    }

    public function processQrCode(Request $request)
    {
        $platNumber = $request->qr_content;
        
        // Cari user berdasarkan plat nomor
        $user = User::where('plat_number', $platNumber)->first();
        
        if ($user) {
            // Redirect ke form absensi dengan data user
            return redirect()->route('parkir_kendaraan.form', [
                'license_plate' => $user->plat_number,
                'name' => $user->name,
                'nik' => $user->nis,
                'class' => $user->class
            ]);
        }
        
        return redirect()->route('scanner.index')->with('error', 'Data kendaraan tidak ditemukan');
    }


}
