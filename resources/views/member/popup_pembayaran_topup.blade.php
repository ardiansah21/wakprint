{{-- isi popup pembayaran topup --}}

<div class="modal fade" id="topUpModal" tabindex="-1" role="dialog" aria-labelledby="topUpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container ml-0 mr-0">
                    <button class="close material-icons md-32" data-dismiss="modal">
                        close
                    </button>
                    <label class="font-weight-bold" style="font-size: 48px;">
                        {{__('Menunggu Pembayaran') }}
                    </label>
                    <br>
                    
                    @foreach ($transaksi_saldo as $ts => $value)
                        @if ($value['id_transaksi'] === $ts)
                            <dd>{{ true }}</dd>
                        @endif
                        {{ $value['id_transaksi'] }}
                    @endforeach
                    {{-- @for ($i = 0; $i < count($transaksi_saldo); $i++) --}}
                        {{-- {{ $transaksi_saldo[$i]->id_transaksi }} --}}
                        {{-- Nomor Pemesanan Kamu :{{$transaksi_saldo[$i]->id_transaksi}} --}}
                        {{-- <label class="mb-5" id="idTransaksi" name="id_transaksi" style="font-size: 18px;">
                            Nomor Pemesanan Kamu :{{$transaksi_saldo[$i]->id_transaksi}}
                        </label> --}}
                    {{-- @endfor --}}
                    {{-- @foreach ($transaksi_saldo as $ts)
                        
                    @endforeach --}}
                    <label class="mb-5" id="idTransaksi" name="id_transaksi" style="font-size: 18px;">
                        {{-- Nomor Pemesanan Kamu :{{$transaksi_saldo->id_transaksi}} --}}
                    </label>
                    <div class="mb-5">
                        <label class="SemiBold mt-2 mb-0" style="font-size: 18px;">
                            {{__('Kode Pembayaran Kamu') }}
                        </label>
                        <br>
                        <label class="font-weight-bold text-primary-success mb-4" id="kodePembayaran" name="kode_pembayaran" style="font-size: 48px;">
                            {{-- {{$transaksi_saldo->kode_pembayaran}} --}}
                        </label>
                        <br>
                        <label class="SemiBold mt-2 mb-0" style="font-size: 18px;">
                            {{__('Kode Bayar akan Berakhir pada') }}
                        </label>
                        <br>
                        <label class="text-primary-danger font-weight-bold" id="waktuTransaksi" name="waktu" style="font-size: 48px;">
                            {{-- {{$transaksi_saldo->waktu}} --}}
                        </label>
                        <br>
                        <label class="mt-2" id="waktuTransaksi" name="waktu" style="font-size: 18px;">
                            {{-- {{__('Mohon menyelesaikan pembayaran sebelum') }} {{$transaksi_saldo->waktu}} --}}
                        </label>
                    </div>
                    <div class="card pt-4 pb-4 pl-4 pr-4 mb-5">
                        <label class="font-weight-bold mb-4 ml-0" style="font-size: 24px;">
                            {{__('Panduan Pembayaran') }}
                        </label>
                        <span class="mb-2 ml-0 mr-0" style="font-size: 14px;">
                            <label>
                                {{__('1. Pilih menu “lainnya” > Transfer > Rekening Tabungan > Rekening BNI 762834629') }}
                            </label>
                            <br>
                            <label>
                                {{__('2. Masukkan jumlah pembayaran sesuai dengan jumlah transaksi') }}
                            </label>
                            <br>
                            <label>
                                {{__('3. Masukkan pilihan transaksi (optional)') }}
                            </label>
                            <br>
                            <label>
                                {{__('4. Konfirmasi pembayaran') }}
                            </label>
                            <br>
                            <label>
                                {{__('5. Bank Lain. Transfer ke Bank Lain > Kode BNI 009 > Isi nomor VA BNI > Nominal Pembayaran > Konfirmasi') }}
                            </label>
                        </span>
                    </div>
                    <button class="btn btn-outline-danger-primary btn-lg btn-block font-weight-bold mb-5"
                        style="font-size: 24px;">
                        {{__('Batalkan Pemesanan') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>