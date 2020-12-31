<?php

namespace App\Notifications;

use App\Pesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\PusherPushNotifications\PusherChannel;
use NotificationChannels\PusherPushNotifications\PusherMessage;

class PesananPartnerNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $pesanan;

    private $opsi;
    private $opsiArr = [
        'pesananMasuk',
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
                case 'pesananMasuk':
                    $this->title = "Pesanan Masuk";
                    $this->description = "Anda telah menerima pesanan masuk dari pelanggan, silahkan konfirmasi pesanan yang Anda terima yah :)";
                    $this->url = route('partner.detail.pesanan', $pesanan->id_pesanan);
                    break;
                case 'pesananSelesai':
                    $this->title = "Pesanan Selesai Dicetak";
                    $this->description = "Anda telah menyelesaikan proses pencetakan dokumen pesanan dari pelanggan, silahkan konfirmasi kembali ke pelanggan melalui chat yah :)";
                    $this->url = route('partner.detail.pesanan', $pesanan->id_pesanan);
                    break;
                case 'pesananDiTolak':
                    $this->title = "Pesanan Ditolak";
                    $this->description = "Anda telah menolak pesanan dari pelanggan, mohon maaf atas ketidaknyamanannya";
                    $this->url = route('partner.pesanan');
                    break;
                case 'pesananDibatalkan':
                    $this->title = "Pesanan Dibatalkan";
                    $this->description = "Pelanggan telah membatalkan pesanannya secara sepihak, mohon maaf atas ketidaknyamanannya";
                    $this->url = route('partner.pesanan');
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
            case 'pesananDiBatalkan':
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
            ->link($this->url)
            ->withAndroid(
                PusherMessage::create()
                    ->title($this->title)
                    ->body($this->description)
                    ->sound('')
            );
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

}
