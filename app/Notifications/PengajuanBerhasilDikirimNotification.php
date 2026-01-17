<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PengajuanBerhasilDikirimNotification extends Notification
{
    use Queueable;
    protected $type;

    /**
     * Create a new notification instance.
     * $type example: 'Ruangan', 'Laboratorium', 'Ruangan Support'
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Pengajuan Berhasil Dikirim',
            'message' => 'Permohonan peminjaman ' . $this->type . ' Anda berhasil dikirim dan sedang menunggu persetujuan.',
            'url' => route('users.pengajuan.status'),
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pengajuan Peminjaman Berhasil Dikirim')
            ->line('Permohonan peminjaman ' . $this->type . ' Anda berhasil dikirim.')
            ->line('Silahkan cek status pengajuan Anda secara berkala.')
            ->action('Cek Status', route('users.pengajuan.status'))
            ->line('Terima kasih!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
