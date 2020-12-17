@extends('layouts.pengelola')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="container mt-5 mb-5">
        <h1 class="font-weight-bold mb-5">
            @if ($pesanan->status === "Diproses" && $pesanan->transaksiSaldo->status === "Berhasil")
                Pesanan Sedang Diproses
            @elseif ($pesanan->status === "Selesai" && $pesanan->transaksiSaldo->status === "Berhasil")
                Detail Pesanan
            @else
                Pesanan Masuk
            @endif
        </h1>
        {{-- <div class="row justify-content-between mb-5 ml-0 mr-0">
            <div class="col-md-6 border-primary-purple mr-5" style="max-width:500px; height:500px;
                        border-radius:10px;">
                <div class="my-custom-scrollbar-pesanan-masuk-1 p-4">
                    @for ($i = 0; $i < 10; $i++)
                        <div class="row justify-content-between mb-3">
                            <div class="col-md-4">
                                <div class="card shadow-sm" style="border-radius: 10px; min-height:90px;">
                                    <label class="text-primary-danger font-weight-bold text-center my-auto"
                                        style="font-size: 24px;">{{ __('PDF') }}</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="container mb-3">
                                    <button class="btn btn-block btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px;
                                                font-size:14px;">
                                        {{ __('Unduh') }}
                                    </button>
                                </div>
                                <div class="container mb-3">
                                    <button class="btn btn-block btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px;
                                                font-size:14px;">
                                        {{ __('Cetak') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-md-6 border-primary-purple" style="max-width:500px;
                        height:500px;
                        border-radius:10px;">
                <div class="my-custom-scrollbar-pesanan-masuk-2">
                    <div class="p-3">
                        <label class="SemiBold mb-1" style="font-size:14px;">
                            {{ __('Waktu Pemesanan') }}
                        </label>
                        <br>
                        <label class="mr-3 mb-4" style="font-size:16px;">
                            {{ __('09:34 5 Juli 2020') }}
                        </label>
                        <br>
                        <label class="font-weight-bold mb-1" style="font-size:14px;">
                            {{ __('Nama Pemesan') }}
                        </label>
                        <br>
                        <label class=" mr-3 mb-4" style="font-size:16px;">
                            {{ __('Tobey Maguire') }}
                        </label>
                        <br>
                        <label class="font-weight-bold mb-1" style="font-size:14px;">
                            {{ __('No Hp Pemesan') }}
                        </label>
                        <br>
                        <label class=" mr-3 mb-4" style="font-size:16px;">
                            {{ __('+6282176358392') }}
                        </label>
                        <br>
                        <label class="font-weight-bold mb-1" style="font-size:14px;">
                            {{ __('Jumlah Dokumen') }}
                        </label>
                        <br>
                        <label class=" mr-3 mb-4" style="font-size:16px;">
                            {{ __('2') }}
                        </label>
                        <br>
                        <label class="font-weight-bold mb-1" style="font-size:14px;">
                            {{ __('Metode Penerimaan') }}
                        </label>
                        <br>
                        <label class=" mr-3 mb-4" style="font-size:16px;">
                            {{ __('Antar ke Tempat') }}
                        </label>
                    </div>
                </div>
                <div class="row justify-content-between bg-light-purple pl-3 pr-3 pt-2 pb-2 mb-5"
                    style="border-radius:0px 0px 10px 10px;">
                    <div class="col-md-auto" style="border-radius:5px;">
                        <label class="font-weight-bold mr-3 mb-1" style="font-size:14px;">
                            {{ __('Jumlah Biaya') }}
                        </label>
                        <br>
                        <label class="mr-3" style="16px;">
                            {{ __('Rp. 20.000') }}
                        </label>
                    </div>
                    <div class="col-md-auto text-right align-self-center">
                        <button class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0" data-toggle="modal"
                            data-target="#detailBiayaModal" style="border-radius:30px;
                                        font-size:16px;">
                            {{ __('Detail Biaya') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="text-right">
                <div class="container mb-3">
                    <button class="btn btn-default text-primary-purple font-weight-bold pl-5 pr-5 mb-0" data-toggle="modal"
                        data-target="#tolakPesananModal" style="border-radius:30px;
                            font-size:18px;">
                        {{ __('Tolak') }}
                    </button>
                </div>
            </div>
            <div class="text-right">
                <div class="container mb-3">
                    <button type="button" class="btn btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px;
                            font-size:18px;">
                        {{ __('Terima') }}
                    </button>
                </div>
            </div>
        </div> --}}

        <div class="border-primary-purple mb-5" style="border-radius: 10px;">
            <div class="row justify-content-between bg-light-purple ml-0 mr-0 p-2" style="width: 100%; border-bottom: 1px solid #BC41BE; border-radius: 10px 10px 0px 0px;">
                <div class="col-md-3 my-auto">
                    <label class="font-weight-bold mb-0" style="font-size: 16px;">
                        {{ __('Waktu Pemesanan') }}
                    </label>
                    <br>
                    <label>
                        {{Carbon::parse($pesanan->updated_at)->translatedFormat('d F Y'). ', '. Carbon::parse($pesanan->updated_at)->translatedFormat('H:i'). ' WIB'}}
                    </label>
                </div>
                <div class="col-md-3 my-auto">
                    <label class="font-weight-bold mb-0" style="font-size: 16px;">
                        {{ __('Nama Pemesan') }}
                    </label>
                    <br>
                    <label>
                        {{$pesanan->member->nama_lengkap}}
                    </label>
                </div>
                <div class="col-md-3 my-auto">
                    <label class="font-weight-bold mb-0" style="font-size: 16px;">
                        {{ __('No HP Pemesan') }}
                    </label>
                    <br>
                    <label>
                        {{$pesanan->member->nomor_hp}}
                    </label>
                </div>
                <div class="col-md-3 my-auto">
                    <label class="font-weight-bold mb-0" style="font-size: 16px;">
                        {{ __('Metode Penerimaan') }}
                    </label>
                    <br>
                    <label>
                        @if ($pesanan->metode_penerimaan != "Ditempat")
                            {{__('Antar ke Rumah')}}
                        @else
                            {{__('Ambil di Tempat')}}
                        @endif
                    </label>
                </div>
            </div>
            @if ($pesanan->metode_penerimaan != "Ditempat")
                <div class="row justify-content-left bg-light-purple ml-0 mr-0 pl-2 pr-2 pt-3 pb-3" style="border-bottom: 1px solid #BC41BE;">
                    <div class="col-md-auto my-auto">
                        <label class="font-weight-bold mb-0" style="font-size: 16px;">
                            {{ __('Alamat Pemesan : ') }}
                        </label>
                    </div>
                    <div class="col-md-auto" style="font-size: 16px;">
                        <label class="my-auto">{{$pesanan->alamat_penerima}}</label>
                    </div>
                </div>
            @endif
            <div class="pl-4 pr-4 pt-3 pb-3">
                @foreach ($pesanan->konfigurasiFile as $p => $value)
                    <div class="pb-2 mb-4" style="border-bottom: 1px solid #EBD1EC">
                        <label class="font-weight-bold mb-4" style="font-size: 16px;">
                            {{ $value->nama_produk}}
                        </label>
                        <div class="row justify-content-between ml-0 mr-0 mb-2" style="width: 100%;">
                            <div class="col-md-auto">
                                <label class="font-weight-bold mb-0" style="font-size: 14px;">
                                    {{ ($p+1).'.' }}
                                </label>
                            </div>
                            <div class="col-md-2">
                                <div class="card shadow-sm cursor-pointer" onclick="window.location.href='{{$value->getFirstMediaUrl('file_konfigurasi')}}'" style="border-radius: 10px; min-height:90px;">
                                    <label class="cursor-pointer text-primary-danger font-weight-bold text-center my-auto"
                                        style="font-size: 24px;">{{ __('PDF') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="{{$value->getFirstMediaUrl('file_konfigurasi')}}" download="{{$value->nama_file}}" type="application/octet-stream" class="text-truncate" style="font-size: 14px;">
                                    {{$value->nama_file}}
                                </a>
                                <br>
                                <label class="mb-4" style="font-size: 12px;">
                                    {{$value->jumlah_halaman_berwarna + $value->jumlah_halaman_hitamputih}} Halaman
                                </label>
                                <br>
                                <label class="mb-1" style="font-size: 12px;">
                                    {{$value->jumlah_halaman_hitamputih}} Halaman Hitam Putih
                                </label>
                                <br>
                                <label class="mb-1" style="font-size: 12px;">
                                    {{$value->jumlah_halaman_berwarna}} Halaman Berwarna
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label class="font-weight-bold mb-1" style="font-size: 14px;">
                                    {{ __('Halaman') }}
                                </label>
                                <br>
                                <label class="mb-2" style="font-size: 14px;">
                                    {{json_decode($value->halaman_terpilih)}}
                                </label>
                                <br>
                                <label class="font-weight-bold mb-1" style="font-size: 14px;">
                                    {{ __('Cetak') }}
                                </label>
                                <br>
                                <label class="mb-2" style="font-size: 14px;">
                                    @if ($value->timbal_balik != 0)
                                        {{ __('Timbal Balik') }}
                                    @else
                                        {{ __('Satu Sisi') }}
                                    @endif
                                </label>
                                <br>
                                <label class="font-weight-bold mb-1" style="font-size: 14px;">
                                    {{ __('Jumlah Salinan') }}
                                </label>
                                <br>
                                <label class="mb-2" style="font-size: 14px;">
                                    {{$value->jumlah_salinan}}
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label class="font-weight-bold mb-1" style="font-size: 14px;">
                                    {{ __('Fitur Terpilih') }}
                                </label>
                                <br>
                                <div class="row justify-content-left">
                                    @if (!empty(json_decode($value->fitur_terpilih)))
                                        @foreach (json_decode($value->fitur_terpilih) as $ft)
                                            <div class="col-md-1">
                                                <i class="material-icons md-8">circle</i>
                                            </div>
                                            <div class="col-md-9">
                                                <label class="text-break mb-2" style="font-size: 14px; width:100%;">
                                                    {{$ft->namaFitur}}
                                                </label>
                                            </div>
                                        @endforeach
                                    @else
                                        <label class="col-md-12 mb-2" style="font-size: 14px;">
                                            Tidak Ada
                                        </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="font-weight-bold mb-1" style="font-size: 14px;">
                                    {{ __('Catatan Tambahan') }}
                                </label>
                                <br>
                                <label class="text-break mb-1" style="font-size: 14px; width:100%;">
                                    {{$value->catatan_tambahan ?? 'Tidak Ada'}}
                                </label>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="text-right">
                                <div class="container mb-3">
                                    <button class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0" onclick="window.location.href='{{$value->getFirstMediaUrl('file_konfigurasi')}}'" style="border-radius:30px; font-size:16px;">
                                        {{ __('Unduh') }}
                                    </button>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="container mb-3">
                                    @if ($pesanan->status === "Diproses" && $pesanan->transaksiSaldo->status === "Berhasil")
                                        <button id="btnCetak{{$p}}" class="btn btn-primary-yellow btnCheck font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px; font-size:16px;">
                                            {{ __('Cetak') }}
                                        </button>
                                    @elseif ($pesanan->status === "Selesai" && $pesanan->transaksiSaldo->status === "Berhasil")
                                        <label class="badge badge-pill font-weight-bold pl-5 pr-5 mb-0" style="font-size:16px; background-color: #E5E5E5; color: #BABABA; padding-top:12px; padding-bottom:12px;">
                                            {{ __('Dicetak') }}
                                        </label>
                                    @else
                                        <label class="badge badge-pill font-weight-bold pl-5 pr-5 mb-0" style="font-size:16px; background-color: #E5E5E5; color: #BABABA; padding-top:12px; padding-bottom:12px;">
                                            {{ __('Cetak') }}
                                        </label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="pb-2 mb-4" style="border-bottom: 1px solid #EBD1EC">
                    <label class="font-weight-bold mb-3" style="font-size: 16px;">
                        {{ __('ATK yang Dipesan') }}
                    </label>
                    <br>
                    @foreach ($atks as $idx => $a)
                        @if (!empty($a[0]) && !empty($a[1]) && !empty($a[2]) && !empty($a[3]))
                            <label>
                                {{ ($idx + 1).'.' }} &nbsp;
                                {{ $a[0] }}
                                (x{{ $a[2] }})
                            </label>
                            <br>
                        @else
                            <label>Tidak Ada</label>
                            <br>
                        @endif
                    @endforeach
                </div>
                <div class="row justify-content-left">
                    <div class="col-md-4">
                        <label class="font-weight-bold mb-1" style="font-size: 16px;">
                            {{ __('Jumlah Dokumen') }}
                        </label>
                        <br>
                        <label class="mb-2" style="font-size: 14px;">
                            {{count($pesanan->konfigurasiFile)}}
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="font-weight-bold mb-1" style="font-size: 16px;">
                            {{ __('Jumlah Produk') }}
                        </label>
                        <br>
                        <label class="mb-2" style="font-size: 14px;">
                            {{count($pesanan->konfigurasiFile)}}
                        </label>
                    </div>
                    <div class="col-md-4 ml-auto">
                        <div class="row justify-content-between ml-0 mr-0">
                            <div>
                                <label class="font-weight-bold mb-1" style="font-size: 16px;">
                                    {{ __('Jumlah Biaya') }}
                                </label>
                                <br>
                                <label class="mb-2" style="font-size: 14px;">
                                    {{rupiah($pesanan->biaya)}}
                                </label>
                            </div>
                            <div class="text-right align-self-center">
                                <button class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0" data-toggle="modal"
                                    data-target="#detailBiayaModal" style="border-radius:30px;
                                            font-size:16px;">
                                    {{ __('Detail Biaya') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            @if ($pesanan->status === "Pending" && $pesanan->transaksiSaldo->status === "Berhasil")
                <div class="text-right mr-0">
                    <div class="container mb-3">
                        <button class="btn btn-outline-danger-primary text-primary-danger font-weight-bold pl-5 pr-5 mb-0" onclick="window.location.href='{{route('partner.detail.pesanan.tolak',$pesanan->id_pesanan)}}'" style="border-radius:30px; font-size:18px;">
                            {{ __('Tolak') }}
                        </button>
                    </div>
                </div>
                <div class="text-right">
                    <div class="container mb-3">
                        <button class="btn btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0" onclick="window.location.href='{{route('partner.detail.pesanan.terima',$pesanan->id_pesanan)}}'" style="border-radius:30px; font-size:18px;">
                            {{ __('Terima') }}
                        </button>
                    </div>
                </div>
            @elseif ($pesanan->status === "Batal" && $pesanan->transaksiSaldo->status === "Gagal")
                <div class="text-right mr-0">
                    <div class="container mb-3">
                        <label class="badge badge-pill bg-white text-primary-danger font-weight-bold pl-5 pr-5 mb-0"style="opacity: 0.7; border-radius:30px; border: 1px solid #FF4949; padding-top:12px; padding-bottom:12px; font-size:18px;">
                            {{ __('Pesanan Dibatalkan') }}
                        </label>
                    </div>
                </div>
            @elseif($pesanan->status === "Diproses" && $pesanan->transaksiSaldo->status === "Berhasil")
                <div class="text-right">
                    <div class="container mb-3">
                        <button id="selesaikanBtn" class="btn btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0" disabled onclick="window.location.href='{{route('partner.detail.pesanan.selesai',$pesanan->id_pesanan)}}'" style="border-radius:30px; font-size:18px;">
                            {{ __('Selesai Mencetak') }}
                        </button>
                    </div>
                </div>
            @else
                <div class="text-right mr-0">
                    <div class="container mb-3">
                        <label class="badge badge-pill bg-primary-purple text-white font-weight-bold pl-5 pr-5 mb-0" style="opacity: 0.7; border-radius:30px; border: 1px solid #BC41BE; padding-top:12px; padding-bottom:12px; font-size:18px;">
                            {{ __('Pesanan Selesai') }}
                        </label>
                    </div>
                </div>
            @endif
        </div>

        {{-- pop up detail biaya --}}
        @include('pengelola.popup_detail_biaya')

        {{-- pop up tolak --}}
        {{-- @include('pengelola.popup_tolak_pesanan') --}}
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script>
        var arrCheckCetakBtn = [];
        var arrTotalIndex = [];

        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            swal({title: "Berhasil",
                text: msg,
                icon: "success",
                button:"OK",
                dangerMode: false,
            });
        }

        $('.btnCheck').each(function(index,value){
            arrTotalIndex.push(index);
            $('#btnCetak' + index).click(function(){
                arrCheckCetakBtn.push(index);
                $('#btnCetak' + index).css('background-color', '#E5E5E5', 'color', '#BABABA');
                $('#btnCetak' + index).css('color', '#BABABA');
                $('#btnCetak' + index).text('Dicetak');

                if (arrCheckCetakBtn.length === arrTotalIndex.length) {
                    $('#btnCetak' + index).prop('disabled', true);
                    $('#selesaikanBtn').prop('disabled', false);
                } else {
                    $('#btnCetak' + index).prop('disabled', false);
                    $('#selesaikanBtn').prop('disabled', true);
                }
            });
        })
    </script>
@endsection
