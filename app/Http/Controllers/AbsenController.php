<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingA;
use App\Models\ParkingB;
use Illuminate\Support\Facades\Auth;


class AbsenController extends Controller
{
    public function showForm(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        return view('absen.form', [
            'qr_code' => $user->qr_code ?? '',
            'name' => $user->name ?? '',
            'nis' => $user->nis ?? '',
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string',
            'name' => 'required|string',
            'nis' => 'required|string',
        ]);

        // Cek apakah kendaraan sudah absen di parkir A atau B
        $existingParkingA = ParkingA::where('qr_code', $request->qr_code)->exists();
        $existingParkingB = ParkingB::where('qr_code', $request->qr_code)->exists();

        if ($existingParkingA || $existingParkingB) {
            return redirect('/absen')->with('error', 'Anda sudah melakukan parkir kendaraan!');
        }

        // Cek kapasitas parkir A (maksimal 500)
        $parkingACount = ParkingA::count();
        if ($parkingACount < 500) {
            ParkingA::create([
                'qr_code' => $request->qr_code,
                'waktu_masuk' => now() // Simpan waktu saat ini
            ]);
        } else {
            // Jika parkir A penuh, cek parkir B (maksimal 500)
            $parkingBCount = ParkingB::count();
            if ($parkingBCount < 500) {
                ParkingB::create([
                    'qr_code' => $request->qr_code,
                    'waktu_masuk' => now() // Simpan waktu saat ini
                ]);
            } else {
                return redirect('/absen')->with('error', 'Parkir penuh! Tidak bisa absen.');
            }
        }

        return redirect('/parkir')->with('success', 'Kendaraan berhasil diparkir.');
    }
}
