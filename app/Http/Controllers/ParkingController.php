<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingSlot;

class ParkingController extends Controller
{
    public function index()
    {
        $slots = ParkingSlot::all();
        return view('parking.index', compact('slots'));
    }

    // public function book(Request $request)
    // {

    //     $slot = ParkingSlot::where('slot_number', $request->slot_number)->first();

    //     if (!$slot || $slot->is_booked) {
    //         return response()->json(['error' => 'Slot sudah dipesan'], 400);
    //     }

    //     $slot->update(['is_booked' => true]);

    //     return response()->json(['success' => 'Slot berhasil dipesan']);
    // }

    public function book(Request $request)
    {
        $existingBooking = ParkingSlot::where('user_id', auth()->id())->first();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'Anda hanya bisa memilih satu slot parkir!');
        }

        $slot = ParkingSlot::where('slot_number', $request->slot_number)->first();

        if (!$slot || $slot->is_booked) {
            return redirect()->back()->with('error', 'Slot sudah terisi!');
        }

        $slot->update([
            'is_booked' => true,
            'user_id' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Slot berhasil dipesan!');
    }



    public function cancel(Request $request)
    {
        $slot = ParkingSlot::where('slot_number', $request->slot_number)->first();

        if ($slot && $slot->is_booked) {
            $slot->update(['is_booked' => false]);
            return redirect()->back()->with('success', 'Pemesanan berhasil dibatalkan.');
        }

        return redirect()->back()->with('error', 'Gagal membatalkan!');
    }


    // public function cancel(Request $request)
    // {
    //     $slot = ParkingSlot::where('slot_number', $request->slot_number)->first();

    //     if ($slot && $slot->is_booked == false) {
    //         $slot->is_booked = true;
    //         $slot->save();

    //         return response()->json(['success' => true]);
    //     }

    //     return response()->json(['success' => false, 'message' => 'Gagal membatalkan!']);
    // }
}
