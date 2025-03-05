<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingA;
use App\Models\ParkingB;

class AbsenController extends Controller
{
    public function showForm(Request $request)
    {
        return view('absen.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string',
            'name' => 'required|string',
            'nik' => 'required|string',
            'class' => 'required|string',
        ]);

        // Cek kapasitas parkir A (max 500)
        $parkingACount = ParkingA::count();
        if ($parkingACount < 500) {
            ParkingA::create([
                'license_plate' => $request->license_plate,
                'waktu_masuk' => now() // Menyimpan waktu saat ini
            ]);
        } else {
            // Jika parkir A penuh, cek parkir B (max 500)
            $parkingBCount = ParkingB::count();
            if ($parkingBCount < 500) {
                ParkingB::create([
                    'license_plate' => $request->license_plate,
                    'waktu_masuk' => now() // Menyimpan waktu saat ini
                ]);
            } else {
                return redirect('/absen')->with('message', 'Parkir penuh! Tidak bisa absen.');
            }
        }

        return redirect('/parkir')->with('message', 'Kendaraan berhasil diparkir.');

        app(HistoryController::class)->store('Memarkirkan kendaraan');
    }
}
