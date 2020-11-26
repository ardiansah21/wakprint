@extends('layouts.member')

@section('content')
    @php
    $arrKonfigurasi = array();
    $hargaKonfigurasi = array();
    $biayaOngkir = 0;

    if (!empty($pesanan->konfigurasiFile)) {
    for ($i=0; $i < count($pesanan->konfigurasiFile); $i++) {
        array_push($arrKonfigurasi,$pesanan->konfigurasiFile[$i]->id_konfigurasi);
        array_push($hargaKonfigurasi,$pesanan->konfigurasiFile[$i]->biaya);
        $jumlahSubtotalFile = count($arrKonfigurasi);
        $hargaSubTotalFile = array_sum($hargaKonfigurasi);
        $hargaTotalPesanan = $hargaSubTotalFile + $biayaOngkir;
        $sisaSaldo = $member->jumlah_saldo - $hargaTotalPesanan;
        }
        }
        @endphp
        <current-pesanan :data="{{ $pesanan }}"></current-pesanan>
        <div class="container mt-5 mb-5">
            <label class="font-weight-bold" style="font-size:48px;">
                {{ __('Konfigurasi Pesanan') }}
            </label>
            <div class="row justify-content-between mb-5">
                <div class="col-md-4 mt-5" style="border-radius:10px;">
                    <div class="bg-light-purple pl-4 pr-4 pt-4 pb-4 mb-4" style="border-radius:10px;">
                        <label class="font-weight-bold mb-3" style="font-size: 24px;">
                            {{ __('Penerimaan') }}
                        </label>
                        <div class="form-group custom-control custom-radio mb-4" style="font-size: 14px;">
                            <input id="rbAmbilTempat" name="radio" class="custom-control-input" type="radio"
                                value="Ditempat" checked>
                            <label class="custom-control-label" for="rbAmbilTempat">
                                {{ __('Ambil di Tempat Percetakan') }}
                            </label>
                            <label class="text-truncate-multiline mb-2">
                                {{ $konfigurasi->product->partner->alamat_toko ?? '-' }}
                            </label>
                        </div>
                        <div class="form-group custom-control custom-radio mr-0 mb-4">
                            <div class="row justify-content-between ml-0">
                                <input id="rbAntarTempat" name="radio" class="custom-control-input" type="radio"
                                    value="Diantar">
                                <label class="custom-control-label" for="rbAntarTempat">
                                    {{ __('Pengantaran') }}
                                </label>
                                <a class="col-md-auto text-right mb-2" href="{{ route('alamat') }}"
                                    style="font-size: 12px;">
                                    @if (!empty($member->alamat))
                                        {{ __('Ubah') }}
                                    @else
                                        {{ __('Tambah Alamat') }}
                                    @endif
                                </a>
                            </div>
                            <label class="text-truncate SemiBold mb-2 ml-0">
                                @for ($i = 0; $i < count($member->alamat['alamat']); $i++)
                                    @if (!empty($member->alamat['alamat']))
                                        @if ($member->alamat['IdAlamatUtama'] === $i)
                                            {{ $member->alamat['alamat'][$i]['Nama Penerima'] }}
                                        @endif
                                    @else
                                        {{ $member->nama_lengkap }}
                                        @break
                                    @endif
                                @endfor
                            </label>
                            <label class="text-truncate-multiline mb-2 ml-0 mb-5">
                                @if (!empty($member->alamat))
                                    @for ($i = 0; $i < count($member->alamat['alamat']); $i++)
                                        @if ($member->alamat['IdAlamatUtama'] === $i)
                                            {{ $member->alamat['alamat'][$i]['Alamat Jalan'] }},
                                            {{ $member->alamat['alamat'][$i]['Kelurahan'] }},
                                            {{ $member->alamat['alamat'][$i]['Kecamatan'] }},
                                            {{ $member->alamat['alamat'][$i]['Kabupaten Kota'] }},
                                            {{ $member->alamat['alamat'][$i]['Provinsi'] }},
                                            {{ $member->alamat['alamat'][$i]['Kode Pos'] }}
                                        @endif
                                    @endfor
                                @else
                                    {{ __('-') }}
                                @endif
                            </label>
                        </div>
                        <div class="row justify-content-between">
                            <label class="col-md-auto font-weight-bold mb-2">
                                {{ __('Biaya') }}
                            </label>
                            <label id="biayaOngkir" class="col-md-auto font-weight-bold text-right mb-2">
                                Rp. {{ 0 }}
                            </label>
                        </div>
                    </div>
                    <div class="bg-light-purple pl-4 pr-4 pt-4 pb-4"
                        style="border-radius:10px;
                                                                                                                                                                                                                                font-size: 14px;">
                        <label class="font-weight-bold mb-3" style="font-size: 24px;">
                            {{ __('Ringkasan Pemesanan') }}
                        </label>
                        <div class="row justify-content-between">
                            <label id="subTotalFile" class="col-md-auto mb-2">
                                Subtotal {{ 5 }}file
                            </label>
                            <label id="hargaSubTotalFile" class="col-md-auto text-right mb-2">
                                Rp. {{ $hargaSubTotalFile ?? 0 }}
                            </label>
                        </div>
                        <div class="row justify-content-between mb-2">
                            <label class="col-md-auto mb-2">{{ __('Biaya Pengiriman') }}</label>
                            <input id="hargaOngkir" type="number" value="{{ 5000 }}" hidden>
                            <label id="biayaPengiriman" class="col-md-auto text-right mb-2">Rp. {{ 0 }}</label>
                        </div>
                        <div class="row justify-content-between">
                            <label class="col-md-auto SemiBold mb-2">{{ __('Total') }}</label>
                            <label id="totalHargaPesanan" class="col-md-auto SemiBold text-right mb-2">Rp.
                                {{ $hargaTotalPesanan ?? 0 }}</label>
                        </div>
                        <div class="row justify-content-between">
                            <label class="col-md-auto SemiBold mb-2">{{ __('Saldo Kamu') }}</label>
                            <input type="number" name="totalSaldo" id="totalSaldo" value="{{ $member->jumlah_saldo ?? 0 }}"
                                hidden>
                            <label id="totalSaldoLabel" class="col-md-auto SemiBold text-right mb-2">Rp.
                                {{ $member->jumlah_saldo ?? 0 }}</label>
                        </div>
                        <div class="row justify-content-between">
                            <label class="col-md-auto SemiBold mb-2">{{ __('Sisa Saldo Kamu') }}</label>
                            <label id="totalSisaSaldo" class="col-md-auto SemiBold text-right mb-3">Rp.
                                {{ $sisaSaldo ?? '0' }}</label>
                        </div>
                        <label id="warningSaldo" class="text-muted text-justify mb-2">
                            {{ __('Saldo kamu tidak mencukupi, silahkan melakukan pengisian saldo setelah pesanan kamu dibuat') }}


                        </label>
                    </div>
                </div>
                <div class="col-md-8 ml-0 mt-5" style="font-size: 18px;">
                    <konfigurasi-pesanan-file :kon-files="{{ $pesanan->konfigurasiFile }}"></konfigurasi-pesanan-file>

                    <label class="SemiBold mb-2 ml-0 mr-2">{{ __('ATK') }}</label>

                    <h1>forach atk</h1>
                    <konfigurasi-pesanan-atk :data="{{ $pesanan->partner->atk }}" :pesanan="{{ $pesanan }}">
                    </konfigurasi-pesanan-atk>

                </div>
            </div>
            <button class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold mb-5"
                style='border-radius:30px; font-size:24px;'>
                {{ __('Buat Pesanan') }}
            </button>
        </div>

    @endsection

    @section('script')
        <script src="{{ asset('js/vue.js') }}"></script>
    @endsection
