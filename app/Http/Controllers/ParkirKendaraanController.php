<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingA;
use App\Models\ParkingB;
use Illuminate\Support\Facades\Auth;


class ParkirKendaraanController extends Controller
{
    public function showForm(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        return view('parkir_kendaraan.form', [
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

        // Cek apakah kendaraan sudah keluar parkir hari ini
        $parkirKeluarA = ParkingA::where('qr_code', $request->qr_code)
            ->whereDate('waktu_keluar', today())->exists();
        $parkirKeluarB = ParkingB::where('qr_code', $request->qr_code)
            ->whereDate('waktu_keluar', today())->exists();

        if ($parkirKeluarA || $parkirKeluarB) {
            return redirect('/absen')->with('error', 'Anda sudah keluar parkir hari ini dan tidak bisa parkir lagi.');
        }

        // Cek apakah kendaraan sudah absen di parkir A atau B
        $existingParkingA = ParkingA::where('qr_code', $request->qr_code)->exists();
        $existingParkingB = ParkingB::where('qr_code', $request->qr_code)->exists();

        if ($existingParkingA || $existingParkingB) {
            return redirect('/absen')->with('error', 'Anda sudah melakukan parkir kendaraan hari ini, silahkan parkir lagi besok!');
        }

        // Cek kapasitas parkir
        $parkingACount = ParkingA::count();
        if ($parkingACount < 500) {
            ParkingA::create([
                'qr_code' => $request->qr_code,
                'waktu_masuk' => now()
            ]);
        } else {
            $parkingBCount = ParkingB::count();
            if ($parkingBCount < 500) {
                ParkingB::create([
                    'qr_code' => $request->qr_code,
                    'waktu_masuk' => now()
                ]);
            } else {
                return redirect('/absen')->with('error', 'Parkir penuh! Tidak bisa absen.');
            }
        }

        app(HistoryController::class)->store('Memarkirkan kendaraan');

        return redirect('/parkir')->with('success', 'Kendaraan berhasil diparkir.');
    }
}