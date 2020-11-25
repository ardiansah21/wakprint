@extends('layouts.member')

@section('content')
    <div class="container mb-5 mt-5">
        <div>
            <label class="font-weight-bold mb-5" style="font-size:48px;">
                {{ __('Pesanan Kamu') }}
            </label>


            @foreach ($konFileTerpilih as $k)
                @php
                // dd($konFileTerpilih);
                @endphp
                <div class="row justify-content-between mb-5 mr-0">
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
                                {{-- {{ count(explode(',', $k->halaman_terpilih)) }} Halaman
                                --}}
                                @php
                                if(count(explode(',', $k->halaman_terpilih)) == $k->jumlah_halaman_berwarna +
                                $k->jumlah_halaman_hitamputih )
                                echo "Semua halaman";
                                else echo json_decode($k->halaman_terpilih)
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
                            {{--
                            //TODO merubah database konfigurasi menjadi ada colom timbal balik dan
                            Hitam_putih_seluruh_halaman
                            --}}
                            <label class="mb-2" style="font-size:18px;">
                                {{ __('Timbal Balik') }}
                            </label>
                            <br>
                            <label class="mb-2" style="font-size:18px;">
                                {{ __('Hitam Putih Seluruh Halaman') }}
                            </label>
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
                        {{-- <label class="SemiBold mb-3" style="font-size:24px;">
                            {{ __('Catatan Tambahan') }}
                        </label>
                        <div class="card pt-2 pb-2 pl-4 pr-4 mb-5" style="width:370px; min-height:120px; font-size:18px;">
                            <p class="mb-2">
                                {{ $k->catatan_tambahan }}
                            </p>
                        </div> --}}
                        <label class="SemiBold mb-1" style="font-size:24px;">
                            {{ __('Halaman Hitam-Putih') }}
                        </label>
                        <br>

                        {{-- //TODO cek apakah timbal balik
                        --}}
                        <div class="row justify-content-between px-3">
                            <label class="mb-2" style="font-size:18px;">
                                {{ $k->jumlah_halaman_hitamputih }} halaman
                            </label>
                            <label class="mb-2 text-right" style="font-size:18px;">
                                {{ rupiah($k->jumlah_halaman_hitamputih * $k->product->harga_hitam_putih) }}
                            </label>
                        </div>
                        <br>
                        <label class="SemiBold mb-1" style="font-size:24px;">
                            {{ __('Halaman Berwarna') }}
                        </label>
                        <br>
                        <div class="row justify-content-between px-3">
                            <label class="mb-2" style="font-size:18px;">
                                {{ $k->jumlah_halaman_berwarna }} halaman
                            </label>
                            <label class="mb-2 text-right" style="font-size:18px;">
                                {{ rupiah($k->jumlah_halaman_berwarna * $k->product->harga_berwarna) }}
                            </label>
                        </div>
                        <br>
                        <label class="SemiBold mb-1" style="font-size:24px;">
                            {{ __('Fitur') }}
                        </label>
                        <br>
                        <label class="mb-2" style="font-size:18px;">
                            TODO
                        </label>
                        <br>
                        <label class="SemiBold mb-1" style="font-size:24px;">
                            {{ __('Total Biaya') }}
                        </label>
                        <br>
                        <label class="mb-2" style="font-size:18px;">
                            {{ rupiah($k->biaya) }}
                        </label>
                    </div>
                </div>
            @endforeach

            <div class="bg-light-purple p-4 mb-5"
                style="border-radius:10px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                font-size:18px;">
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
                            {{ rupiah($subTotalFile) }}
                        </label>
                    </div>
                </div>
                {{-- <div class="row row-bordered mt-2 mb-4">
                </div> --}}

                {{-- @foreach ($collection as $item)
                    --}}
                    {{-- <label class="font-weight-bold mt-2 mb-3">
                        {{ __('Cetak Skripsi Mahasiswa') }}
                    </label>
                    <br>
                    <label class="font-weight-bold mb-2">
                        {{ __('Skripsi.pdf') }}
                    </label>
                    <div class="row justify-content-between">
                        <div class="col-md-6 text-left">
                            <label>
                                {{ __('25 Halaman Hitam-Putih') }}
                            </label>
                        </div>
                        <div class="col-md-6 SemiBold text-right">
                            <label>
                                {{ __('Rp. 10.000') }}
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-md-6 text-left">
                            <label>{{ __('25 Halaman Berwarna') }}</label>
                        </div>
                        <div class="col-md-6 SemiBold text-right">
                            <label>
                                {{ __('Rp. 15.000') }}
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-between mb-2">
                        <div class="col-md-6 text-left">
                            <label>
                                {{ __('Jumlah Salinan') }}
                            </label>
                        </div>
                        <div class="col-md-6 SemiBold text-right">
                            <label>
                                {{ __('1') }}
                            </label>
                        </div>
                    </div>
                    <label class="font-weight-bold mt-2 mb-2">
                        {{ __('Fitur') }}
                    </label> --}}

                    {{-- @foreach ($collection as $item)
                        --}}
                        {{-- <div class="row justify-content-between mb-2">
                            <div class="col-md-6 text-left">
                                <label>
                                    {{ __('Paket Jilid Lakban Hitam') }}
                                </label>
                            </div>
                            <div class="col-md-6 SemiBold text-right">
                                <label>
                                    {{ __('Rp. 10.000') }}
                                </label>
                            </div>
                        </div> --}}
                        {{--
                    @endforeach --}}

                    {{-- <div class="row row-bordered mt-2 mb-4">
                    </div> --}}

                    {{--
                @endforeach --}}

                <label class="SemiBold mb-2">
                    {{ __('ATK') }}
                </label>

                @foreach ($atks as $a)
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
                            @php
                            $t= 0;
                            foreach ($atks as $a)
                            $t+= $a[3]
                            @endphp
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
                <div class="row justify-content-between SemiBold mt-2">
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
            </div>
        </div>
        <div class="row justify-content-end mb-5 mr-0">
            <button class="btn btn-outline-danger-primary btn-lg text-primary-danger font-weight-bold mr-4"
                style="border-radius:30px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                font-size:24px;">
                {{ __('Batalkan Pemesanan') }}
            </button>
            <button class="btn btn-primary-wakprint btn-lg font-weight-bold pl-4 pr-4"
                style="border-radius:30px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                font-size:24px;">
                {{ __('Konfirmasi dan Lanjutkan') }}
            </button>
        </div>
    </div>
@endsection
