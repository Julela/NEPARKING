<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QRRequestRejected extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Permintaan perubahan QR Code Anda telah ditolak.')
                    ->line('QR Code Anda tetap menggunakan QR Code yang lama.')
                    ->action('Lihat QR Code', url('/qr-code'))
                    ->line('Jika Anda memiliki pertanyaan, silakan hubungi admin.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Permintaan perubahan QR Code Anda telah ditolak.',
            'user_id' => auth()->id() ?? 1, // Admin ID
            'action' => '/qr-code'
        ];
    }
}