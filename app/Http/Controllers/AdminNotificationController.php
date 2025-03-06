<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class AdminNotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user(); 
        $notifications = $user->unreadNotifications()->where('type', 'App\Notifications\QRRequestNotification')->paginate(10);
        
        return view('admin.notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = DatabaseNotification::find($id);

        if ($notification && $notification->notifiable_id == $user->id) {
            $notification->markAsRead();
            return back()->with('message', 'Notifikasi telah ditandai sebagai dibaca.');
        }

        return back()->with('error', 'Notifikasi tidak ditemukan.');
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return back()->with('message', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }
}

