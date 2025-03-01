<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class QrController extends Controller
{
    public function index()
    {
        return view('qr.index');
    }

    public function requestQRUpdate(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string',
        ]);

        $user = Auth::user();
        $newQRCode = $request->qr_code;

        // Jika user belum pernah membuat QR Code (pertama kali)
        if (!$user->qr_code) {
            $user->update([
                'qr_code' => $newQRCode,
                'qr_status' => 'approved'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'QR Code berhasil dibuat.',
                'qr_status' => 'approved'
            ]);
        }
        
        // Jika user ingin mengubah QR Code yang sudah ada
        if ($user->qr_code != $newQRCode) {
            $user->update([
                'qr_code' => $newQRCode,
                'qr_status' => 'pending'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Permintaan perubahan QR Code telah dikirim ke admin.',
                'qr_status' => 'pending'
            ]);
        }

        // Jika QR Code yang dimasukkan sama dengan yang sudah ada
        return response()->json([
            'status' => 'success',
            'message' => 'QR Code tidak ada perubahan.',
            'qr_status' => $user->qr_status
        ]);
    }

    public function approveQRUpdate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['qr_status' => 'approved']);

        return back()->with('message', 'QR Code berhasil disetujui.');
    }

    public function rejectQRUpdate($id)
    {
        $user = User::findOrFail($id);
        
        // Simpan QR code yang lama
        $oldQRCode = $user->qr_code_old ?? $user->qr_code;
        
        $user->update([
            'qr_code' => $oldQRCode,
            'qr_status' => 'rejected'
        ]);

        return back()->with('message', 'Permintaan perubahan QR Code ditolak.');
    }
    
    // Fungsi untuk menampilkan daftar permintaan perubahan QR Code (untuk admin)
    public function pendingRequests()
    {
        $pendingUsers = User::where('qr_status', 'pending')->get();
        return view('admin.qr-requests', compact('pendingUsers'));
    }
}

