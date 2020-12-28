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
                    $this->title = "Menunggu Pembayaran Anda";
                    $this->description = "Silahkan lakukan pembayaran sesuai dengan kode pembayaran yang Anda terima sebelum masa berlakunya habis yah";
                    $this->url = route('konfirmasi.pembayaran', $pesanan->id_pesanan);
                    break;
                case 'pembayaranBerhasil':
                    $this->title = "Pembayaran Anda Berhasil";
                    $this->description = "Pesanan Anda sedang menunggu konfirmasi dari pihak percetakan, silahkan tunggu beberapa saat dan konfirmasi ke pihak percetakan melalui chat yah :)";
                    $this->url = route('konfirmasi.pembayaran', $pesanan->id_pesanan);
                    break;
                case 'pesananDiterimaPercetakan':
                    $this->title = "Pesanan Anda Diterima Pihak Percetakan";
                    $this->description = "Pesanan Anda telah diterima oleh pihak percetakan, silahkan tunggu hingga proses pencetakan pesanan Anda selesai yah :)";
                    $this->url = route('konfirmasi.pembayaran', $pesanan->id_pesanan);
                    break;
                case 'pesananSelesaiDiCetak':
                    $this->title = "Pesanan Anda Telah Dicetak oleh Pihak Percetakan";
                    $this->description = "Pesanan Anda telah selesai dicetak oleh pihak percetakan, silahkan melakukan pengambilan dokumen sesuai dengan metode yang Anda pilih yah :)";
                    $this->url = route('konfirmasi.pembayaran', $pesanan->id_pesanan);
                    break;
                case 'pesananSelesai':
                    $this->title = "Pesanan Anda Selesai";
                    $this->description = "Pesanan Anda telah dikonfirmasi selesai dan sudah berada di tangan Anda, terima kasih telah melakukan pemesanan bersama kami yah :)";
                    $this->url = route('konfirmasi.pembayaran', $pesanan->id_pesanan);
                    break;
                case 'pesananDiTolak':
                    $this->title = "Pesanan Anda Ditolak";
                    $this->description = "Maaf, pesanan Anda telah ditolak oleh pihak percetakan, mohon maaf atas ketidaknyamanannya yah";
                    $this->url = route('konfirmasi.pembayaran', $pesanan->id_pesanan);
                    break;
                case 'pesananDiBatalkan':
                    $this->title = "Pesanan Anda Dibatalkan";
                    $this->description = "Maaf, pesanan telah Anda batalkan, mohon maaf atas ketidaknyamanannya yah";
                    $this->url = route('konfirmasi.pembayaran', $pesanan->id_pesanan);
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
