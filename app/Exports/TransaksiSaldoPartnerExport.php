<?php

namespace App\Exports;

use App\Transaksi_saldo;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransaksiSaldoPartnerExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaksi_saldo::where('jenis_transaksi', '=', 'Tarik')
            ->orWhere('jenis_transaksi', '=', 'Pembayaran')
            ->where('status', '=', 'Berhasil')
            ->orWhere('status', '=', 'Gagal')
            ->get();
    }
}
