<?php

namespace App\Notifications;

use App\Pesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\PusherPushNotifications\PusherChannel;
use NotificationChannels\PusherPushNotifications\PusherMessage;

class PesananNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $pesanan;

    private $opsi;
    private $opsiArr = [
        'pembayaranPending',
        'pembayaranBerhasil',
        'pesananDiterimaPercetakan',
        'pesananSelesaiDiCetak',
        'pesananSelesai',
        'pesananDiTolak',
        'pesananDiBatalkan',
    ];
    private $title, $description, $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($opsi, Pesanan $pesanan)
    {
        if (!in_array($opsi, $this->opsiArr)) {
            throw new \Exception('Opsi notifikasi tidak tersedia');
        } else {
            $this->opsi = $opsi;
            $this->pesanan = $pesanan;

            switch ($opsi) {
                case 'pembayaranPending':
                    $this->title = "Pembayaran pending, hahahha MIskin ya wkwkw";
                    $this->description = "ini deskpripsi, tapi pendek, beneran pendek loh, ahh tapi sekarang udah panjang";
                    $this->url = route('tentang');
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
        switch ($this->opsi) {
            case 'pembayaranPending':
            case 'pembayaranBerhasil':
            case 'pesananSelesai':
                return ['broadcast', 'database', PusherChannel::class, 'mail'];
                break;

            default:
                return ['broadcast', 'database', PusherChannel::class];
                break;
        }
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
