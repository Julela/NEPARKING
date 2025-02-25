<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\ParkingSlot;

// class ParkingController extends Controller
// {
//     public function index()
//     {
//         $slots = ParkingSlot::all();
//         return view('parking.index', compact('slots'));
//     }

//     // public function book(Request $request)
//     // {

//     //     $slot = ParkingSlot::where('slot_number', $request->slot_number)->first();

//     //     if (!$slot || $slot->is_booked) {
//     //         return response()->json(['error' => 'Slot sudah dipesan'], 400);
//     //     }

//     //     $slot->update(['is_booked' => true]);

//     //     return response()->json(['success' => 'Slot berhasil dipesan']);
//     // }

//     public function book(Request $request)
//     {
//         // Cek apakah user sudah memiliki slot
//         $existingBooking = ParkingSlot::where('user_id', auth()->id())->first();

//         if ($existingBooking) {
//             return redirect()->back()->with('error', 'Anda hanya bisa memilih satu slot parkir!');
//         }

//         // Cari slot berdasarkan nomor
//         $slot = ParkingSlot::where('slot_number', $request->slot_number)->first();

//         if (!$slot || $slot->is_booked) {
//             return redirect()->back()->with('error', 'Slot sudah terisi!');
//         }

//         // Tandai slot sebagai dipesan oleh user
//         $slot->update([
//             'is_booked' => true,
//             'user_id' => auth()->id()
//         ]);

//         return redirect()->back()->with('success', 'Slot berhasil dipesan!');
//     }



//     public function cancel(Request $request)
//     {
//         // Cek apakah user membatalkan slot yang dia pesan
//         $slot = ParkingSlot::where('slot_number', $request->slot_number)
//             ->where('user_id', auth()->id()) // Pastikan hanya user terkait yang bisa membatalkan
//             ->first();

//         if ($slot) {
//             $slot->update([
//                 'is_booked' => false,
//                 'user_id' => null
//             ]);

//             return redirect()->back()->with('success', 'Pemesanan berhasil dibatalkan.');
//         }

//         return redirect()->back()->with('error', 'Gagal membatalkan!');
//     }


//     // public function cancel(Request $request)
//     // {
//     //     $slot = ParkingSlot::where('slot_number', $request->slot_number)->first();

//     //     if ($slot && $slot->is_booked == false) {
//     //         $slot->is_booked = true;
//     //         $slot->save();

//     //         return response()->json(['success' => true]);
//     //     }

//     //     return response()->json(['success' => false, 'message' => 'Gagal membatalkan!']);
//     // }
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingA;
use App\Models\ParkingB;

class ParkingController extends Controller
{
    public function index()
    {
        $parkingA = ParkingA::all();
        $parkingB = ParkingB::all();
        return view('parking.index', compact('parkingA', 'parkingB'));
    }
    
    public function register(Request $request)
    {
        $request->validate(['license_plate' => 'required|string|unique:parking_a,license_plate|unique:parking_b,license_plate']);

        if (ParkingA::count() < 500) {
            ParkingA::create(['license_plate' => $request->license_plate]);
            return response()->json(['message' => 'Kendaraan terdaftar di Tabel A']);
        } elseif (ParkingB::count() < 500) {
            ParkingB::create(['license_plate' => $request->license_plate]);
            return response()->json(['message' => 'Kendaraan terdaftar di Tabel B']);
        } else {
            return response()->json(['message' => 'Parkir penuh!'], 400);
        }
    }

    public function check(Request $request)
    {
        $request->validate(['license_plate' => 'required|string']);

        if ($parking = ParkingA::where('license_plate', $request->license_plate)->first()) {
            return response()->json(['message' => 'Kendaraan terdaftar di Tabel A']);
        } elseif ($parking = ParkingB::where('license_plate', $request->license_plate)->first()) {
            return response()->json(['message' => 'Kendaraan terdaftar di Tabel B']);
        } else {
            return response()->json(['message' => 'Kendaraan tidak ditemukan!'], 404);
        }
    }
}
