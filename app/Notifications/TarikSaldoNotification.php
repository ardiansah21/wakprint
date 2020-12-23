<?php

namespace App\Notifications;

use App\Transaksi_saldo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\PusherPushNotifications\PusherChannel;
use NotificationChannels\PusherPushNotifications\PusherMessage;

class TarikSaldoNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $transaksi, $status;
    private $statusArr = [
        'pending',
        'berhasil',
        'gagal',
    ];
    private $title, $description, $url;
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
                    $this->title = "Tarik Saldo Sedang Diproses";
                    $this->description = "Tarik saldo Anda sedang dikonfirmasi kembali oleh Admin kami, mohon tunggu beberapa saat, terima kasih :)";
                    $this->url = route('partner.riwayat.saldo', $transaksi->id_transaksi);
                    break;
                case 'berhasil':
                    $this->title = "Tarik Saldo Berhasil";
                    $this->description = "Saldo telah dicairkan ke rekening akun Anda, terima kasih telah melakukan transaksi bersama kami :)";
                    $this->url = route('partner.riwayat.saldo', $transaksi->id_transaksi);
                    break;
                case 'gagal':
                    $this->title = "Tarik Saldo Gagal";
                    $this->description = "Penarikan saldo Anda gagal diproses dikarenakan ada masalah pada proses konfirmasi melalui Admin kami, silahkan lakukan penarikan ulang saldo Anda kembali, mohon maaf atas ketidaknyamanannya.";
                    $this->url = route('partner.riwayat.saldo', $transaksi->id_transaksi);
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
