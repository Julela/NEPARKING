<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;
use App\Notifications\QRRequestApproved;
use App\Notifications\QRRequestRejected;
use Carbon\Carbon;


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

            app(HistoryController::class)->store('Membuat Code QR');

            return response()->json([
                'status' => 'success',
                'message' => 'QR Code berhasil dibuat.',
                'qr_status' => 'approved'
            ]);
        }

        // Cek apakah masih ada pengajuan perubahan QR yang PENDING
        if ($user->qr_status === 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda masih memiliki pengajuan perubahan QR Code yang menunggu persetujuan admin. Harap tunggu hingga disetujui sebelum mengajukan perubahan lagi.',
                'qr_status' => 'pending'
            ]);
        }

        // Jika QR Code yang dimasukkan sama dengan yang sudah ada
        if ($user->qr_code == $newQRCode) {
            return response()->json([
                'status' => 'success',
                'message' => 'QR Code tidak ada perubahan.',
                'qr_status' => $user->qr_status
            ]);
        }

        // Jika user ingin mengubah QR Code yang sudah ada dan tidak ada perubahan pending sebelumnya
        $user->update([
            'qr_code_old' => $user->qr_code,
            'qr_code' => $newQRCode,
            'qr_status' => 'pending'
        ]);

        // Notifikasi ke admin (optional)
        $this->notifyAdmin($user, 'Permintaan perubahan QR Code baru dari ' . $user->name);

        app(HistoryController::class)->store('Meminta ubah Code QR');

        return response()->json([
            'status' => 'success',
            'message' => 'Permintaan perubahan QR Code telah dikirim ke admin.',
            'qr_status' => 'pending'
        ]);
    }


    // Fungsi untuk menampilkan daftar permintaan perubahan QR Code (untuk admin)
    public function pendingRequests(Request $request)
    {
        $status = $request->query('status', 'pending');

        $query = User::query();

        if ($status != 'all') {
            $query->where('qr_status', $status);
        } else {
            $query->whereNotNull('qr_code');
        }

        $users = $query->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.admin-requestqr', compact('users'));
    }

    public function countPendingRequests()
    {
        $count = User::where('qr_status', 'pending')->count();
        return response()->json(['count' => $count]);
    }


    public function approveQRUpdate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['qr_status' => 'approved']);

        // Simpan notifikasi ke database
        Notifikasi::create([
            'user_id' => $user->id,
            'title' => 'Permintaan QR Disetujui',
            'message' => 'Permintaan perubahan QR Code Anda telah disetujui oleh admin.',
            'is_read' => false
        ]);

        app(HistoryController::class)->store('Mengubah Code QR');

        return back()->with('message', 'QR Code berhasil disetujui.');
    }

    public function rejectQRUpdate($id)
    {
        $user = User::findOrFail($id);

        // Pulihkan QR code lama
        $user->update([
            'qr_code' => $user->qr_code_old,
            'qr_status' => 'rejected'
        ]);

        // Simpan notifikasi ke database
        Notifikasi::create([
            'user_id' => $user->id,
            'title' => 'Permintaan QR Ditolak',
            'message' => 'Permintaan perubahan QR Code Anda telah ditolak oleh admin.',
            'is_read' => false
        ]);

        return back()->with('message', 'Permintaan perubahan QR Code ditolak.');
    }


    // Fungsi untuk mengirim notifikasi ke admin (contoh)
    private function notifyAdmin($user, $message)
    {
        // Implementasi notifikasi ke admin (bisa menggunakan database notifications)
        // Contoh: Admin::all()->each->notify(new QRRequestPending($user));
    }
}
