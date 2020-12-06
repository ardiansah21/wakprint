<?php

namespace App\Mail;

use App\Pengelola_Percetakan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class TolakPartnerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $partner;
    public $isiAlasan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pengelola_Percetakan $partner, $isiAlasan)
    {
        $this->partner = $partner;
        $this->isiAlasan = $isiAlasan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd(Auth::user()->email);
        // dd($this->laporan);
        return $this->from(Auth::user()->email)->view('admin.email_tolak_partner');
    }
}
