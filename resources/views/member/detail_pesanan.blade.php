@extends('layouts.member')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="mb-5">
            <label class="font-weight-bold mb-5" style="font-size: 48px;">
                Pesanan Kamu
            </label>

            @foreach ($pesanan->konfigurasiFile as $idx => $k)
                <div class="row justify-content-between shadow-sm mb-5 pt-3 ml-0 mr-0"
                    @if ($idx % 2 == 0)
                        style="background-color: #fdff97; border-radius:8px;"
                    @else
                        style="background-color: #ebebeb; border-radius:8px;"
                    @endif>
                        <div class="col-md-4">
                            @include('member.card_produk', ['p' => $k->product])
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <label class="SemiBold" style="font-size:24px;">
                                    {{ __('File Kamu') }}
                                </label>
                            </div>
                            <div class="row justify-content-left ml-0 mb-4">
                                @php
                                    $tokens = explode('/', $k->getMedia('file_konfigurasi')[0]->getUrl() );
                                    $url ='/'.$tokens[sizeof($tokens)-2].'/'.$tokens[sizeof($tokens)-1];
                                @endphp
                                <a class="text-truncate mb-2 mr-3" href="{{ '/storage' . $url }}" style="font-size:18px;">
                                    {{ $k->getMedia('file_konfigurasi')[0]->file_name }}
                                </a>
                                <label class="my-auto mb-2" style="font-size:14px;">
                                    {{ $k->jumlah_halaman_berwarna + $k->jumlah_halaman_hitamputih }} Halaman
                                </label>
                            </div>
                            <div class="mb-4">
                                <label class="SemiBold mb-1" style="font-size:24px;">
                                    {{ __('Halaman yang dipilih') }}
                                </label>
                                <br>
                                <label class="mb-2" style="font-size:18px;">
                                    @php
                                        if(count(explode(',', $k->halaman_terpilih)) == $k->jumlah_halaman_berwarna +
                                        $k->jumlah_halaman_hitamputih )
                                        echo "Semua halaman";
                                        else echo json_decode($k->halaman_terpilih);
                                    @endphp
                                </label>
                            </div>
                            <div class="mb-4">
                                <label class="SemiBold mb-1" style="font-size:24px;">
                                    {{ __('Jumlah Salinan') }}
                                </label>
                                <br>
                                <label class="mb-2" style="font-size:18px;">
                                    {{ $k->jumlah_salinan }}
                                </label>
                            </div>
                            <div class="mb-4">
                                <label class="SemiBold mb-1" style="font-size:24px;">
                                    {{ __('Cetak') }}
                                </label>
                                <br>
                                @if ($k->timbal_balik != 0)
                                    <label class="mb-2" style="font-size:18px;">
                                        {{ __('Timbal Balik') }}
                                    </label>
                                    <br>
                                @else
                                    <label class="mb-2" style="font-size:18px;">
                                        {{ __('Satu Sisi') }}
                                    </label>
                                    <br>
                                @endif
                                @if ($k->paksa_hitamputih != 0)
                                    <label class="mb-2" style="font-size:18px;">
                                        {{ __('Hitam Putih Seluruh Halaman') }}
                                    </label>
                                @endif
                            </div>
                            <label class="SemiBold mb-3" style="font-size:24px;">
                                {{ __('Catatan Tambahan') }}
                            </label>
                            <div class="mb-5" style="font-size:18px;">
                                <p class="mb-2">
                                    {{ $k->catatan_tambahan ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="SemiBold mb-1" style="font-size:24px;">
                                {{ __('Halaman Hitam-Putih') }}
                            </label>
                            <br>
                            @if ($k->timbal_balik != 0)
                                <div class="row justify-content-between px-3">
                                    <label class="mb-2" style="font-size:18px;">
                                        {{ $k->jumlah_halaman_hitamputih }} halaman
                                    </label>
                                    <label class="mb-2 text-right" style="font-size:18px;">
                                        {{ rupiah($k->jumlah_halaman_hitamputih * $k->product->harga_timbal_balik_hitam_putih) }}
                                    </label>
                                </div>
                            @else
                                <div class="row justify-content-between px-3">
                                    <label class="mb-2" style="font-size:18px;">
                                        {{ $k->jumlah_halaman_hitamputih }} halaman
                                    </label>
                                    <label class="mb-2 text-right" style="font-size:18px;">
                                        {{ rupiah($k->jumlah_halaman_hitamputih * $k->product->harga_hitam_putih) }}
                                    </label>
                                </div>
                            @endif
                            <br>
                            <label class="SemiBold mb-1" style="font-size:24px;">
                                {{ __('Halaman Berwarna') }}
                            </label>
                            <br>
                            @if ($k->timbal_balik != 0)
                                <div class="row justify-content-between px-3">
                                    <label class="mb-2" style="font-size:18px;">
                                        {{ $k->jumlah_halaman_berwarna }} halaman
                                    </label>
                                    <label class="mb-2 text-right" style="font-size:18px;">
                                        {{ rupiah($k->jumlah_halaman_berwarna * $k->product->harga_timbal_balik_berwarna) }}
                                    </label>
                                </div>
                            @else
                                <div class="row justify-content-between px-3">
                                    <label class="mb-2" style="font-size:18px;">
                                        {{ $k->jumlah_halaman_berwarna }} halaman
                                    </label>
                                    <label class="mb-2 text-right" style="font-size:18px;">
                                        {{ rupiah($k->jumlah_halaman_berwarna * $k->product->harga_berwarna) }}
                                    </label>
                                </div>
                            @endif
                            <br>
                            <label class="SemiBold mb-1" style="font-size:24px;">
                                {{ __('Fitur') }}
                            </label>
                            <br>
                            @if (!empty(json_decode($k->fitur_terpilih)))
                                @foreach (json_decode($k->fitur_terpilih) as $ft)
                                    <div class="row justify-content-between px-3">
                                        <label class="mb-2" style="font-size:18px;">
                                            {{ $ft->namaFitur }}
                                        </label>
                                        <label class="mb-2 text-right" style="font-size:18px;">
                                            {{ rupiah($ft->hargaFitur) }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                            <div class="row justify-content-between px-3">
                                <label class="mb-2" style="font-size:18px;">
                                    0 item
                                </label>
                                <label class="mb-2 text-right" style="font-size:18px;">
                                    Rp. 0
                                </label>
                            </div>
                            @endif
                            <br>
                            <label class="SemiBold mb-1" style="font-size:24px;">
                                {{ __('Total Biaya') }}
                            </label>
                            <br>
                            <label class="mb-2" style="font-size:18px;">
                                {{ rupiah($k->biaya) }}
                            </label>
                        </div>
                        @php
                            $arrSubtotal = [];
                            for ($i=0; $i < count($pesanan->konfigurasiFile); $i++) { 
                                array_push($arrSubtotal, $pesanan->konfigurasiFile[$i]->biaya);
                            }
                        @endphp
                </div>
            @endforeach

            <div class="bg-light-purple p-4 mb-5"
                    style="border-radius:10px;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      font-size:18px;">
                    <label class="font-weight-bold mb-4" style="font-size:36px;">
                        {{ __('Rincian Harga') }}
                    </label>
                    <div class="row justify-content-between mb-4">
                        <div class="col-md-auto text-left">
                            <label class="mb-2 SemiBold">
                                {{ count($konFileTerpilih) }} &nbsp;File
                            </label>
                        </div>
                        <div class="col-md-auto text-right">
                            <label class="SemiBold mb-2">
                                {{ rupiah(array_sum($arrSubtotal)) }}
                            </label>
                        </div>
                    </div>

                    <label class="SemiBold mb-2">
                        {{ __('ATK') }}
                    </label>
                    @foreach ($atks as $a)
                        @if (!empty($a[0]) && !empty($a[1]) && !empty($a[2]) && !empty($a[3]))
                            <div class="row justify-content-between">
                                <div class="col-md-6 text-left">
                                    <label>
                                        {{ $a[0] }} &nbsp;
                                        {{ rupiah($a[1]) }} &nbsp;
                                        (x{{ $a[2] }})
                                    </label>
                                </div>
                                <div class="col-md-6 SemiBold text-right">
                                    <label>
                                        {{ rupiah($a[3]) }}
                                    </label>
                                </div>
                            </div>
                        @else
                            <div class="row justify-content-between">
                                <div class="col-md-6 text-left">
                                    <label>
                                        Item (x0)
                                    </label>
                                </div>
                                <div class="col-md-6 SemiBold text-right">
                                    <label>
                                        Rp. 0
                                    </label>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="row row-bordered mt-2 mb-2">
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-md-6 text-left mb-2">
                            <label>
                                Total Biaya ATK
                            </label>
                        </div>
                        <div class="col-md-6 SemiBold text-right">
                            <label>
                                @if (!empty($a[0]) && !empty($a[1]) && !empty($a[2]) && !empty($a[3]))
                                    @php
                                        $t= 0;
                                        foreach ($atks as $a)
                                        $t+= $a[3]
                                    @endphp
                                @else
                                    @php
                                        $t= 0;
                                    @endphp
                                @endif
                                {{ rupiah($t) }}
                            </label>
                        </div>
                    </div>
                    <label class="font-weight-bold mt-3 mb-2">
                        {{ __('Penerimaan Dokumen') }}
                    </label>
                    <div class="row justify-content-between mb-2">
                        <div class="col-md-6 text-left">
                            <label>
                                {{ $penerimaan }}
                            </label>
                        </div>
                        <div class="col-md-6 SemiBold text-right">
                            <label>
                                {{ rupiah($penerimaan == 'Diantar' ? $ongkir : 0) }}
                            </label>
                        </div>
                    </div>
                    <div class="row row-bordered">
                    </div>
                    <div class="row justify-content-between SemiBold mt-2 mb-5">
                        <div class="col-md-6 text-left">
                            <label>
                                {{ __('Total Harga Pesanan') }}
                            </label>
                        </div>
                        <div class="col-md-6 text-right">
                            <label>
                                {{ rupiah($totalBiaya) }}
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-between mb-5">
                        <div class="col-md-10 text-left ml-0"
                            style="font-size: 36px;">
                            <label class="SemiBold">
                                {{__('Status Pesanan') }}
                            </label>
                        </div>
                        <div class="col-md-auto mr-0">
                            <div class="text-center"
                                style="font-size: 24px;">
                                @if ($pesanan->status === 'Pending' || $pesanan->status === 'Diproses')
                                    <label class="badge bg-primary-yellow pl-4 pr-4 pt-2 pb-2 font-weight-bold mt-3">
                                        {{$pesanan->status}}
                                    </label>
                                @elseif($pesanan->status === 'Selesai')
                                    <label class="badge bg-promo text-white pl-4 pr-4 pt-2 pb-2 font-weight-bold mt-3">
                                        {{$pesanan->status}}
                                    </label>
                                @else
                                    <label class="badge bg-primary-danger text-white pl-4 pr-4 pt-2 pb-2 font-weight-bold mt-3">
                                        {{$pesanan->status}}
                                    </label>
                                @endif

                            </div>
                        </div>
                    </div>
                    <label class="font-weight-bold"
                        style="font-size: 36px;">
                        {{__('Info Pesanan') }}
                    </label>
                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between text-right mt-4">
                        <div class="col-md-6 text-left ml-0">
                            <label>
                                {{__('ID Pesanan') }}
                            </label>
                        </div>
                        <div class="col-md-6 mr-0">
                            <label class="font-weight-bold">
                                {{$pesanan->id_pesanan}}
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-between text-right mt-1">
                        <div class="col-md-6 text-left ml-0">
                            <label>
                                {{__('Nama Pemesan') }}
                            </label>
                        </div>
                        <div class="col-md-6 mr-0">
                            <label class="text-truncate-multiline font-weight-bold">
                                {{$member->nama_lengkap}}
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-between text-right mt-1">
                        <div class="col-md-6 text-left ml-0">
                            <label>
                                {{__('Metode Pengambilan') }}
                            </label>
                        </div>
                        <div class="col-md-6 mr-0">
                            <label class="font-weight-bold">
                                @if ($pesanan->metode_penerimaan != "Ditempat")
                                    Antar ke Rumah
                                @else
                                    Ambil di Tempat
                                @endif
                            </label>
                        </div>
                    </div>

                    <div class="row justify-content-between text-right mt-1 mb-4">
                        @if ($pesanan->metode_penerimaan != "Ditempat")
                            <div class="col-md-6 text-left ml-0">
                                <label>
                                    {{__('Alamat Pemesan') }}
                                </label>
                            </div>
                            <div class="col-md-6 mr-0">
                                <label class="font-weight-bold">
                                    {{$pesanan->alamat_penerima}}
                                </label>
                            </div>
                        @else
                            <div class="col-md-6 text-left ml-0">
                                <label>
                                    {{__('Alamat Tempat Percetakan') }}
                                </label>
                            </div>
                            <div class="col-md-6 mr-0">
                                <label class="font-weight-bold mb-2" style="width: 100%;">
                                    {{$pesanan->partner->alamat_toko}}
                                </label>
                                <a href="{{$pesanan->partner->url_google_maps}}" class="text-truncate-multiline">
                                    {{$pesanan->partner->url_google_maps}}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
        </div>
        @if ($transaksiSaldo->status === "Berhasil" && $pesanan->status != "Batal")
            <div class="mb-5">
                <div class="row justify-content-left no-gutters">
                    <div class="align-self-center col-md-auto mr-4">
                        {{QrCode::size(200)->generate($pesanan->id_pesanan)}}
                        {{-- {{QrCode::size(200)->generate(route('konfirmasi.pesanan.selesai',$pesanan->id_pesanan))}} --}}
                        {{-- <img src="{{url('img/Qr-Code.png')}}" width="200" height="200" alt="no logo"> --}}
                    </div>
                    <div class="col-md-8 align-self-center">
                        <label class="SemiBold mb-1"
                            style="font-size: 36px;">
                                {{__('Kode QR Pesanan kamu') }}
                        </label>
                        <label class="mb-2" style="font-size: 18px;">
                            {{__('Kode ini dapat langsung di scan oleh pemilik toko melalui smartphone-nya untuk memastikan barang yang kamu pesan sudah sampai ditanganmu') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                @if ($pesanan->status === "Selesai")
                    <div class="col-md-12 mb-4">
                        <label class="badge btn-primary-wakprint btn-lg btn-block py-3 font-weight-bold pl-4 pr-4"
                            style="font-size: 24px;">{{__('Pesanan Selesai') }}
                        </label>
                    </div>
                @else
                    <div class="col-md-auto mb-4">
                        <button onclick="window.location.href='{{route('konfirmasi.pesanan.cancel',$pesanan->id_pesanan)}}'" class="btn btn-outline-danger-primary btn-lg btn-block font-weight-bold"
                            style="font-size: 24px;">
                            {{__('Batalkan Pemesanan') }}
                        </button>
                    </div>
                    <div class="col-md-auto mb-4">
                        <button class="btn btn-outline-purple btn-lg btn-block font-weight-bold pl-4 pr-4"
                            style="font-size: 24px;">
                            {{__('Chat Pengelola') }}
                        </button>
                    </div>
                    <div class="col-md-auto mb-4">
                        <button onclick="window.location.href='{{route('konfirmasi.pesanan.selesai',$pesanan->id_pesanan)}}'" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold pl-4 pr-4"
                            style="font-size: 24px;">{{__('Pesanan Sudah Ditangan') }}
                        </button>
                    </div>
                @endif
            </div>
        @else
            <div class="mb-5">
                <label class="font-weight-bold"
                    style="font-size: 48px;">
                    @if ($pesanan->status === "Batal")
                        {{__('Pembayaran Dibatalkan') }}
                    @else
                        {{__('Menunggu Pembayaran') }}
                    @endif
                </label>
                <br>
                <label class="mb-5" style="font-size: 18px;">
                    {{__('ID Transaksi Kamu : '.$transaksiSaldo->id_transaksi) }}
                </label>
                <div class="row justify-content-between">
                    <div class="col-md-7 mb-5">
                        <label class="SemiBold mt-2 mb-0"
                            style="font-size: 18px;">
                            {{__('Kode Pembayaran Kamu') }}
                        </label>
                        <br>
                        <label class="font-weight-bold text-primary-success mb-4"
                        style="font-size: 48px;">
                            {{$transaksiSaldo->kode_pembayaran}}
                        </label>
                        <br>
                        <label class="SemiBold mt-2 mb-0"
                            style="font-size: 18px;">
                            @if ($pesanan->status === "Batal")
                                {{__('Kode bayar Anda telah expired, dikarenakan telah dibatalkan pada') }}
                            @else
                                {{__('Kode bayar Anda akan berakhir pada') }}
                            @endif
                        </label>
                        <br>
                        <label class="text-primary-danger font-weight-bold"
                            style="font-size: 48px;">
                            @if ($pesanan->status === "Batal")
                                {{$waktuTransaksiExpired. ' WIB'}}
                            @else
                                {{$batasWaktuTransaksi.' WIB'}}
                            @endif
                        </label>
                        <br>
                        <label class="mt-2" style="font-size: 18px;">
                            @if ($pesanan->status != "Batal")
                                {{__('Mohon menyelesaikan pembayaran sebelum '.$batasWaktuTransaksi.' WIB') }}
                            @endif
                        </label>
                    </div>
                    <div class="col-md-5 mb-0">
                        <div class="card pt-4 pb-4 pl-4 pr-4 mb-5">
                            <label class="font-weight-bold mb-4 ml-0"
                                style="font-size: 24px;">
                                {{__('Panduan Pembayaran') }}
                            </label>
                            <div class="mb-2" style="font-size: 14px; list-style:none">
                                <li class="mb-2">{{__('1. Pilih menu “lainnya” > Transfer > Rekening Tabungan > Rekening BNI 762834629') }}</li>
                                <li class="mb-2">{{__('2. Masukkan jumlah pembayaran sesuai dengan jumlah transaksi') }}</li>
                                <li class="mb-2">{{__('3. Masukkan pilihan transaksi (optional)') }}</li>
                                <li class="mb-2">{{__('4. Konfirmasi pembayaran') }}</li>
                                <li>{{__('5. Bank Lain. Transfer ke Bank Lain > Kode BNI 009 > Isi nomor VA BNI > Nominal Pembayaran > Konfirmasi') }}</li>
                            </div>
                        </div>
                    </div>
                    <div class="container ml-0 mr-0">
                        @if ($pesanan->status === "Batal")
                            <label class="badge btn-outline-danger-primary btn-lg btn-block py-3 font-weight-bold mb-5"
                                style="font-size: 24px;">
                                    {{__('Pemesanan Dibatalkan') }}
                            </label>
                        @else
                            <button onclick="window.location.href='{{route('konfirmasi.pesanan.cancel',$pesanan->id_pesanan)}}'" class="btn btn-outline-danger-primary btn-lg btn-block font-weight-bold mb-5"
                                style="font-size: 24px;">
                                    {{__('Batalkan Pemesanan') }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
