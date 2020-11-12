<?php

namespace App\Mail;

use App\Lapor_produk;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class TanggapiKeluhanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $laporan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Lapor_produk $laporan)
    {
        $this->laporan = $laporan;
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
        return $this->from(Auth::user()->email)->view('admin.email_tanggapan_keluhan');
    }
}
