<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingA;
use App\Models\ParkingB;
use Carbon\Carbon;

class ParkingController extends Controller
{

    public function index()
    {
        return view('parking.index', [
            'parkingA' => ParkingA::all(),
            'parkingB' => ParkingB::all()
        ]);
    }

    // public function index()
    // {
    //     $parkingA = ParkingA::whereNull('waktu_keluar')->orWhere('waktu_keluar', '>', now())->get();
    //     $parkingB = ParkingB::whereNull('waktu_keluar')->orWhere('waktu_keluar', '>', now())->get();

    //     return view('parkir.index', compact('parkingA', 'parkingB'));
    // }


    public function register(Request $request)
    {
        // Validasi input dengan memastikan nomor plat unik di kedua tabel
        $request->validate([
            'license_plate' => 'required|string|unique:parking_a,license_plate|unique:parking_b,license_plate'
        ]);

        // Cek kapasitas parkir
        if (ParkingA::count() < 500) {
            ParkingA::create(['license_plate' => $request->license_plate]);
            return response()->json(['message' => 'Kendaraan terdaftar di Parkir A']);
        } elseif (ParkingB::count() < 500) {
            ParkingB::create(['license_plate' => $request->license_plate]);
            return response()->json(['message' => 'Kendaraan terdaftar di Parkir B']);
        } else {
            return response()->json(['message' => 'Parkir penuh!'], 400);
        }
    }

    public function check(Request $request)
    {
        // Validasi input
        $request->validate(['license_plate' => 'required|string']);

        // Cek apakah kendaraan sudah terdaftar
        if (ParkingA::where('license_plate', $request->license_plate)->exists()) {
            return response()->json(['message' => 'Kendaraan terdaftar di Parkir A']);
        } elseif (ParkingB::where('license_plate', $request->license_plate)->exists()) {
            return response()->json(['message' => 'Kendaraan terdaftar di Parkir B']);
        } else {
            return response()->json(['message' => 'Kendaraan tidak ditemukan!'], 404);
        }
    }
    public function showForm(Request $request)
    {
        $currentTime = Carbon::now()->format('H:i');
        if ($currentTime > '07:15') {
            return redirect()->back()->with('message', 'Form absensi sudah ditutup pada pukul 07:15.');
        }
        return view('parking.form');
    }

    public function storeAttendance(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string',
            'name' => 'required|string',
            'nik' => 'required|string',
            'class' => 'required|string',
        ]);

        // Cek kapasitas parkir
        if (ParkingA::count() < 500) {
            ParkingA::create(['license_plate' => $request->license_plate]);
            $message = 'Kendaraan Anda telah terdaftar di Parkir A';
        } elseif (ParkingB::count() < 500) {
            ParkingB::create(['license_plate' => $request->license_plate]);
            $message = 'Kendaraan Anda telah terdaftar di Parkir B';
        } else {
            return redirect()->back()->with('message', 'Parkir penuh. Tidak dapat mendaftarkan kendaraan.');
        }

        return redirect()->route('parking.list')->with('message', $message);
    }

    public function exitParking($qr_code)
    {
        $parkirA = ParkingA::where('qr_code', $qr_code)
            ->whereDate('waktu_masuk', today())->first();
        $parkirB = ParkingB::where('qr_code', $qr_code)
            ->whereDate('waktu_masuk', today())->first();

        if ($parkirA) {
            $parkirA->update(['waktu_keluar' => now()]);
            $parkirA->delete();
        } elseif ($parkirB) {
            $parkirB->update(['waktu_keluar' => now()]);
            $parkirB->delete();
        } else {
            return redirect()->back()->with('error', 'Anda tidak sedang parkir hari ini.');
        }

        return redirect()->back()->with('success', 'Anda telah keluar dari parkir.');
    }
}
