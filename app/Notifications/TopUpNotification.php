<?php

namespace App\Notifications;

use App\Transaksi_saldo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TopUpNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $transaksi, $status;
    private $stausArr = [
        'pending',
        'berhasil',
        'gagal',
    ];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($status, Transaksi_saldo $transaksi)
    {
        $this->transaksi = $transaksi;
        $this->status = $status;

        if (!in_array($status, $this->statusArr)) {
            throw new \Exception('status notifikasi tidak tersedia');
        } else {
            $this->status = $status;
            $this->transaksi = $transaksi;

            switch ($status) {
                case 'pending':
                    $this->title = "pending";
                    $this->description = " pending ini deskpripsi, tapi pendek, beneran pendek loh, ahh tapi sekarang udah panjang";
                    $this->url = route('faq');
                    break;

                default:

                    break;
            }

        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database', PusherChannel::class, 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->title)
            ->greeting("Hay {$notifiable->nama_lengkap}!")
            ->line($this->description)
            ->action('Periksa Selengkapnya', $this->url)
            ->line('Terima kasih telah menggunkan aplikasi Wakprint!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'created_at' => date("d M Y H:i:s"),
        ];
    }

    public function toPushNotification($notifiable)
    {

        // $notifiable == user
        return PusherMessage::create()
            ->web()
            ->sound('success')
            ->title($this->title)
            ->body($this->description)
            ->link($this->url);

    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'created_at' => date("d M Y H:i:s"),
        ]);
    }
}
