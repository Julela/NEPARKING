<?php

namespace App\Http\Controllers;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class NotifikasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifikasis = Notifikasi::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('notifikasi.index', compact('notifikasis'));
    }

    // Mengambil jumlah notifikasi belum dibaca untuk badge notifikasi
    public function getUnreadCount()
    {
        $count = Notifikasi::where('user_id', Auth::id())->where('is_read', false)->count();
        return response()->json(['count' => $count]);
    }

    // Menandai notifikasi sebagai telah dibaca
    public function markAsRead (Request $request)
    {
        Notifikasi::where('user_id', Auth::id())->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
}



