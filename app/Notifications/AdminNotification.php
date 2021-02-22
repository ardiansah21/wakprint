<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $opsi;
    public $id;
    private $opsiArr = [
        'pendaftaranPartner',
        'topupSaldoMember',
        'tarikSaldoPartner',
    ];

    private $title, $description, $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($opsi, $id)
    {
        if (!in_array($opsi, $this->opsiArr)) {
            throw new \Exception('Opsi notifikasi tidak tersedia');
        } else {
            $this->opsi = $opsi;
            $this->id = $id;

            switch ($opsi) {
                case 'pendaftaranPartner':
                    $this->title = "Ada Partner yang baru mendaftar";
                    $this->description = "Silahkan lakukan verifikasi partner yah";
                    $this->url = route('admin.partner.detail', $id);
                    break;
                case 'topupSaldoMember':
                    $this->title = "Ada Member yang baru topup saldo";
                    $this->description = "Silahkan verifikasi dan konfirmasi yah";
                    $this->url = route('admin.saldo');
                    break;
                case 'tarikSaldoPartner':
                    $this->title = "Ada Partner yang baru tarik saldo";
                    $this->description = "Silahkan verifikasi dan konfirmasi yah";
                    $this->url = route('admin.saldo');
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
        return ['mail'];
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
            ->greeting("Hay {$notifiable->nama}!")
            ->line($this->description)
            ->action('Periksa Selengkapnya', $this->url)
            ->line('Terima kasih telah mengabdi pada Wakprint!');
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
            //
        ];
    }
}
