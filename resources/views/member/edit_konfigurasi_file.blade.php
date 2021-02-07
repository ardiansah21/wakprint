<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container">
    <div class="mt-5 mb-5">
        <label class="font-weight-bold" style="font-size:48px;">{{__('Konfigurasi File') }}</label>
        <br>
        <label class="mb-0 mt-4" style="font-size:24px;">{{ __('Tampilan Preview File Anda') }}</label>
        <div id="konfigurasi" class="row justify-content-between mb-5">
            <div class="col-md-auto mt-5 mr-0">
                <div class="border-primary-purple" style="width:515px; height:560px; position:relative; float: none; display: table-cell; vertical-align: bottom;">
                    <embed
                        @if (session()->has('fileUpload'))
                            src="{{url('tmp/upload/',(session()->get('fileUpload'))->name)."#pagemode=thumbs&statusbar=0&messages=0&navpanes=0&toolbar=0"}}"
                        @else
                            src="{{$konfigurasi->getFirstMedia('file_konfigurasi')->getFullUrl()}}"
                        @endif
                        type="application/pdf" height="567px" width="515px" frameborder="0" onload="" />
                </div>
            </div>
            <div class="col-md-6 mt-5">
                <div class="bg-light-purple p-2 mb-4" width="100%" style="border-radius:5px;">
                    <div class="col-md-12 row align-self-center">
                        <div class="col-md-1 d-flex justify-content-center">
                            <div class="align-self-center">
                                <img src="https://img.icons8.com/nolan/96/pdf-2.png" width="48px" />
                            </div>
                        </div>
                        <div class="col-md-8 text-truncate align-self-center">
                            <a class="" href="
                                @if (session()->has('fileUpload'))
                                    {{url('tmp/upload',(session()->get('fileUpload'))->name)}}
                                @else
                                    {{$konfigurasi->getFirstMedia('file_konfigurasi')->getFullUrl()}}
                                @endif" target="_blank" style="font-size: 18px;">
                                @if (session()->has('fileUpload'))
                                    {{(session()->get('fileUpload'))->name}}
                                @else
                                    {{$konfigurasi->getMedia('file_konfigurasi')->first()->file_name}}
                                @endif
                            </a>
                            <br>
                            <label class="text-muted" style="font-size: 12px;">
                                @if (session()->has('fileUpload'))
                                    {{ (session()->get('fileUpload'))->countPage }} {{ __('Halaman') }}
                                @else
                                    {{ $countPage }} {{ __('Halaman') }}
                                @endif
                            </label>
                        </div>
                        <div class="col-md-3 align-self-center text-right p-0">
                            <button class="btn btn-primary-yellow btn-rounded font-weight-bold py-1 px-4"
                                style="border-radius:35px;font-size: 16px;" onclick="openDialogChange()">
                                {{__('Ubah') }}
                            </button>
                            <script>
                                function openDialogChange() {
                                    document.getElementById('fileid').click();
                                }
                                function submitFormChange() {
                                    document.getElementById('change-form').submit();
                                }
                            </script>
                            <form id="change-form" action="{{ route('konfigurasi.upload') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                                @csrf
                                <input type='file' name="fileUpload" id="fileid" onchange="submitFormChange()"
                                    accept="application/pdf" hidden />
                            </form>
                        </div>
                    </div>
                </div>
                @if (session()->has('fileUpload'))
                    <div class="row justify-content-between mx-0">
                        <div class="col-md-7">
                            <label class="SemiBold mb-3 mt-2" style="font-size: 24px;">
                                {{__('Pilih Halaman') }}
                            </label>
                            <div class="form-group custom-control custom-radio mb-4" style="font-size: 18px;">
                                <input id="rbSemuaHal" name="radio" class="custom-control-input" type="radio" value="Semua"
                                    onchange="document.getElementById('halamanAwal').disabled; document.getElementById('halamanAkhir').disabled; document.getElementById('halamanKustom').disabled;"
                                    checked>
                                <label class="custom-control-label" for="rbSemuaHal">
                                    {{__('Semua') }}
                                </label>
                                <input id="semuaHal" type="text" class="form-input semua" value="{{session()->get('fileUpload')->countPage}}" hidden>
                            </div>
                            <div class="form-group custom-control custom-radio mb-4" style="font-size: 18px;">
                                <input id="rbSampaiHal" name="radio" class="custom-control-input" type="radio" value="Range">
                                <label class="custom-control-label" for="rbSampaiHal" onclick="document.getElementById('rbSampaiHal').click() ">
                                    <input id="halamanAwal" type="number" min="1"
                                        max="{{ (session()->get('fileUpload'))->countPage}}" value="1" class="sampai"
                                        disabled class="form-input mr-2" for="rbSampaiHal" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                                        if(document.getElementById('halamanAkhir').value < this.value){
                                            document.getElementById('halamanAkhir').value = this.value
                                        }
                                        " style="width:48px;">
                                    {{__('Sampai') }}
                                    <input id="halamanAkhir" type="number" value="{{ (session()->get('fileUpload'))->countPage}}" class="form-input ml-2 sampai" disabled
                                        for="rbSampaiHal" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                                        if(document.getElementById('halamanAwal').value > this.value){
                                            document.getElementById('halamanAwal').value = this.value
                                        }
                                        " style="width:48px;" min="1" max="{{ (session()->get('fileUpload'))->countPage}}">
                                </label>
                            </div>
                            <div class="form-group custom-control custom-radio mb-4" style="font-size: 18px;"
                                onclick="document.getElementById('rbKustomHal').click(); document.getElementById('halamanKustom').focus()">
                                <input id="rbKustomHal" name="radio" class="custom-control-input" type="radio" value="Kustom">
                                <label class="custom-control-label" for="rbKustomHal">
                                    {{__('Kustom') }}
                                </label>
                                <br>
                                <input id="halamanKustom" type="text mr-4" class="form-input kustom" for="rbKustomHal" placeholder="Contoh: 1,3,4-7" value="" disabled oninput="this.value = this.value.replace(/[^0-9,-]/g, '').replace(/(\,.*)\./g, '$1');">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="card-title font-weight-bold mb-3" style="font-size: 24px;">
                                {{__('Jumlah Salinan') }}
                            </label>
                            <div class="form-group mb-4" style="font-size: 18px;">
                                <label id="btnMinus" class="pointer">
                                    <i class="fa fa-minus ml-2 mr-2"></i>
                                </label>
                                <input id="jumlahSalin" type="number" class="form-input" min="1"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{$konfigurasi->jumlah_salinan}}" style="width:48px;">
                                <label class="label pointer" id="btnPlus">
                                    <i class="fa fa-plus ml-2 mr-2"></i>
                                </label>
                            </div>
                            <label class="SemiBold mb-2 mt-2" style="font-size: 24px;">
                                {{__('Cetak') }}
                            </label>
                            <div class="form-group custom-control custom-checkbox mt-2 ml-0" style="font-size: 18px;">
                                <input type="checkbox" class="custom-control-input" id="checkboxTimbalBalik" value="Timbal Balik"
                                    @if ($konfigurasi->timbal_balik != 0)
                                        checked
                                    @endif>
                                <label class="custom-control-label" for="checkboxTimbalBalik">
                                    {{__('Timbal Balik') }}
                                </label>
                            </div>
                            <div class="form-group custom-control custom-checkbox mt-2 ml-0" style="font-size: 18px;">
                                <input type="checkbox" class="custom-control-input" id="checkboxPaksaHitamPutih" value="Hitam Putih"
                                    @if ($konfigurasi->paksa_hitamputih != 0)
                                        checked
                                    @endif>
                                <label class="custom-control-label" for="checkboxPaksaHitamPutih">
                                    {{__('Paksa Hitam Putih') }}
                                </label>
                            </div>
                        </div>
                        <div class="bg-primary-yellow mt-4 p-2" style="border-radius: 5px; width:100%">
                            <label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">
                                <i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>
                                <label id="jumlahHal">{{ (session()->get('fileUpload'))->countPage}}</label>
                                {{ __(' Halaman Akan Dicetak')}}
                            </label>
                        </div>
                    </div>
                @else
                    <div class="row justify-content-between mx-0">
                        <div class="col-md-7">
                            <label class="SemiBold mb-3 mt-2" style="font-size: 24px;">
                                {{__('Pilih Halaman') }}
                            </label>
                            <div class="form-group custom-control custom-radio mb-4" style="font-size: 18px;">
                                <input id="rbSemuaHal" name="radio" class="custom-control-input" type="radio" value="Semua"
                                    onchange="document.getElementById('halamanAwal').disabled; document.getElementById('halamanAkhir').disabled; document.getElementById('halamanKustom').disabled;"
                                    @if ($konfigurasi->status_halaman === 'Semua')
                                        checked
                                    @endif>
                                <label class="custom-control-label" for="rbSemuaHal">
                                    {{__('Semua') }}
                                </label>
                                <input id="semuaHal" type="text" class="form-input semua" value="{{$countPage}}" hidden>
                            </div>
                            <div class="form-group custom-control custom-radio mb-4" style="font-size: 18px;">
                                <input id="rbSampaiHal" name="radio" class="custom-control-input" type="radio" value="Range"
                                    @if ($konfigurasi->status_halaman === 'Range')
                                        checked
                                    @endif>
                                <label class="custom-control-label" for="rbSampaiHal" onclick="document.getElementById('rbSampaiHal').click() ">
                                    @php
                                        $ht = json_decode($konfigurasi->halaman_terpilih);
                                        $arrHt = explode(",", $ht);
                                        $min = reset($arrHt);
                                        $max = end($arrHt)
                                    @endphp
                                    <input id="halamanAwal" type="number" class="sampai"
                                        @if ($konfigurasi->status_halaman != 'Range')
                                            min="1" max="{{ $countPage }}" value="1" disabled
                                        @else
                                            min="1" max="{{ $countPage }}" value="{{intval($min)}}"
                                        @endif
                                        class="form-input mr-2" for="rbSampaiHal" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                                        if(document.getElementById('halamanAkhir').value < this.value){
                                            document.getElementById('halamanAkhir').value = this.value
                                        }
                                        " style="width:48px;">
                                    {{__('Sampai') }}
                                    <input id="halamanAkhir" type="number" class="form-input ml-2 sampai"
                                        @if ($konfigurasi->status_halaman != 'Range')
                                            min="1" max="{{ $countPage }}" value="{{ $countPage }}" disabled
                                        @else
                                            min="1" max="{{ $countPage }}" value="{{ intval($max) }}"
                                        @endif
                                        for="rbSampaiHal" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                                        if(document.getElementById('halamanAwal').value > this.value){
                                            document.getElementById('halamanAwal').value = this.value
                                        }
                                        " style="width:48px;">
                                </label>
                            </div>
                            <div class="form-group custom-control custom-radio mb-4" style="font-size: 18px;"
                                onclick="document.getElementById('rbKustomHal').click(); document.getElementById('halamanKustom').focus()">
                                <input id="rbKustomHal" name="radio" class="custom-control-input" type="radio" value="Kustom"
                                    @if ($konfigurasi->status_halaman === 'Kustom')
                                        checked
                                    @endif>
                                <label class="custom-control-label" for="rbKustomHal">
                                    {{__('Kustom') }}
                                </label>
                                <br>
                                <input id="halamanKustom" type="text mr-4" class="form-input kustom" for="rbKustomHal"
                                    @if ($konfigurasi->status_halaman != 'Kustom')
                                        value=""
                                        disabled
                                    @else
                                        value="{{json_decode($konfigurasi->halaman_terpilih)}}"
                                    @endif
                                    oninput="this.value = this.value.replace(/[^0-9,-]/g, '').replace(/(\,.*)\./g, '$1');">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="card-title font-weight-bold mb-3" style="font-size: 24px;">
                                {{__('Jumlah Salinan') }}
                            </label>
                            <div class="form-group mb-4" style="font-size: 18px;">
                                <label id="btnMinus" class="pointer">
                                    <i class="fa fa-minus ml-2 mr-2"></i>
                                </label>
                                <input id="jumlahSalin" type="number" class="form-input" min="1"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{$konfigurasi->jumlah_salinan}}" style="width:48px;">
                                <label class="label pointer" id="btnPlus">
                                    <i class="fa fa-plus ml-2 mr-2"></i>
                                </label>
                            </div>
                            <label class="SemiBold mb-2 mt-2" style="font-size: 24px;">
                                {{__('Cetak') }}
                            </label>
                            <div class="form-group custom-control custom-checkbox mt-2 ml-0" style="font-size: 18px;">
                                <input type="checkbox" class="custom-control-input" id="checkboxTimbalBalik" value="{{$konfigurasi->timbal_balik}}"
                                    @if ($konfigurasi->timbal_balik != 0)
                                        checked
                                    @endif>
                                <label class="custom-control-label" for="checkboxTimbalBalik">
                                    {{__('Timbal Balik') }}
                                </label>
                            </div>
                            <div class="form-group custom-control custom-checkbox mt-2 ml-0" style="font-size: 18px;">
                                <input type="checkbox" class="custom-control-input" id="checkboxPaksaHitamPutih" value="{{$konfigurasi->paksa_hitamputih}}"
                                    @if ($konfigurasi->paksa_hitamputih != 0)
                                        checked
                                    @endif>
                                <label class="custom-control-label" for="checkboxPaksaHitamPutih">
                                    {{__('Paksa Hitam Putih') }}
                                </label>
                            </div>
                        </div>
                        <div class="bg-primary-yellow mt-4 p-2" style="border-radius: 5px; width:100%">
                            <label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">
                                <i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>
                                <label id="jumlahHal">
                                    {{ count(explode(',', $konfigurasi->halaman_terpilih)) }}
                                </label>
                                {{ __(' Halaman yang Akan Dicetak')}}
                            </label>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <label id="lblproduk" class="font-weight-bold" style="font-size:36px;">{{__('Produk') }}</label>
        @php
            if(session()->has('produkKonfigurasiFile')){
                if(session()->get('produkKonfigurasiFile')->status_diskon != "Tersedia"){
                    $hargaHitamPutih = session()->get('produkKonfigurasiFile')->harga_hitam_putih;
                    $hargaBerwarna = session()->get('produkKonfigurasiFile')->harga_berwarna;
                }
                else{
                    $jumlahDiskonGray = session()->get('produkKonfigurasiFile')->harga_hitam_putih * session()->get('produkKonfigurasiFile')->jumlah_diskon;
                    $jumlahDiskonWarna = session()->get('produkKonfigurasiFile')->harga_berwarna * session()->get('produkKonfigurasiFile')->jumlah_diskon;

                    if($jumlahDiskonGray > session()->get('produkKonfigurasiFile')->maksimal_diskon){
                        $hargaHitamPutih = session()->get('produkKonfigurasiFile')->harga_hitam_putih - session()->get('produkKonfigurasiFile')->maksimal_diskon;
                        $hargaBerwarna = session()->get('produkKonfigurasiFile')->harga_berwarna - session()->get('produkKonfigurasiFile')->maksimal_diskon;
                    }
                    else{
                        $hargaHitamPutih = session()->get('produkKonfigurasiFile')->harga_hitam_putih - $jumlahDiskonGray;
                        $hargaBerwarna = session()->get('produkKonfigurasiFile')->harga_berwarna - $jumlahDiskonWarna;
                    }
                }
            }
            else{
                if($produk->status_diskon != "Tersedia"){
                    $hargaHitamPutih = $produk->harga_hitam_putih;
                    $hargaBerwarna = $produk->harga_berwarna;
                }
                else{
                    $jumlahDiskonGray = $produk->harga_hitam_putih * $produk->jumlah_diskon;
                    $jumlahDiskonWarna = $produk->harga_berwarna * $produk->jumlah_diskon;

                    if($jumlahDiskonGray > $produk->maksimal_diskon){
                        $hargaHitamPutih = $produk->harga_hitam_putih - $produk->maksimal_diskon;
                        $hargaBerwarna = $produk->harga_berwarna - $produk->maksimal_diskon;
                    }
                    else{
                        $hargaHitamPutih = $produk->harga_hitam_putih - $jumlahDiskonGray;
                        $hargaBerwarna = $produk->harga_berwarna - $jumlahDiskonWarna;
                    }
                }
            }
        @endphp
        @if (session()->has('produkKonfigurasiFile'))
            <div id="produk" class="bg-light-purple p-4 mb-4" style="border-radius:5px; min-height:300px; position: relative;">
                <div class="row justify-content-between">
                    <div class="col-md-4">
                        @include('member.card_produk',["p"=>session()->get('produkKonfigurasiFile'),"fromKonfigurasi" => "true"])
                    </div>
                    <div class="col-md-8">
                        <div class="ml-2">
                            <div class="text-right">
                                <button class="btn btn-primary-yellow btn-rounded font-weight-bold py-1 px-4 mb-4"
                                    style="border-radius:35px;font-size: 16px;"
                                    @if(count($member->konfigurasi) > 1)
                                        onclick="window.location='{{route('pencarian',['id_konfigurasi' => $konfigurasi->id_konfigurasi,'fromKonfigurasi' => 'true'])}}'"
                                    @else
                                        onclick="window.location='{{route('pencarian')}}'"
                                    @endif>
                                    {{__('Ubah Produk') }}
                                </button>
                            </div>
                            <br>
                            <label class="font-weight-bold mb-2" style="font-size:18px;">{{__('Detail') }}
                            </label>
                            <br>
                            <div class="row justify-content-between ml-0 mr-0">
                                <label class="" style="font-size:16px;">{{__('Berwarna') }}</label>
                                <label class="" style="font-size:16px;">
                                    @if(session()->get('produkKonfigurasiFile')->status_diskon != 'Tersedia')
                                        {{rupiah(session()->get('produkKonfigurasiFile')->harga_berwarna) ?? rupiah(0) }} / Halaman
                                    @else
                                        {{rupiah($hargaBerwarna) ?? rupiah(0) }} / Halaman
                                    @endif
                                </label>
                            </div>
                            <div class="row justify-content-between ml-0 mr-0 mb-4">
                                <label class="" style="font-size:16px;">{{__('Hitam Putih') }}</label>
                                <label class="" style="font-size:16px;">
                                    @if(session()->get('produkKonfigurasiFile')->status_diskon != 'Tersedia')
                                        {{rupiah(session()->get('produkKonfigurasiFile')->harga_hitam_putih) ?? rupiah(0) }} / Halaman
                                    @else
                                        {{rupiah($hargaHitamPutih) ?? rupiah(0) }} / Halaman
                                    @endif
                                </label>
                            </div>
                            <div class="row justify-content-between ml-0 mr-0">
                                <label class="" style="font-size:16px;">{{__('Berwarna (Timbal Balik)') }}</label>
                                <label class="" style="font-size:16px;">{{rupiah(session()->get('produkKonfigurasiFile')->harga_timbal_balik_berwarna) ?? rupiah(0) }} / Halaman</label>
                            </div>
                            <div class="row justify-content-between ml-0 mr-0 mb-4">
                                <label class="" style="font-size:16px;">{{__('Hitam Putih (Timbal Balik)') }}</label>
                                <label class="" style="font-size:16px;">{{rupiah(session()->get('produkKonfigurasiFile')->harga_timbal_balik_hitam_putih) ?? rupiah(0) }} / Halaman</label>
                            </div>
                            <div class="row justify-content-between ml-0 mr-0 mb-5">
                                <label class="" style="font-size:16px;">{{__('Nilai Toleransi Kandungan Warna') }}</label>
                                <label class="" style="font-size:16px;">
                                    @if (empty(session()->get('produkKonfigurasiFile')->partner->ntkwh))
                                        {{__('0%')}}
                                    @else
                                        {{session()->get('produkKonfigurasiFile')->partner->ntkwh . "%" }}
                                    @endif
                                </label>
                            </div>
                            <label class="font-weight-bold mb-2" style="font-size:18px;">{{__('Fitur') }}</label>
                            @php
                                $fitur = json_decode(session()->get('produkKonfigurasiFile')->fitur,true);
                                $fiturTerpilih = json_decode($konfigurasi->fitur_terpilih,true);
                            @endphp
                            @if (count($fitur) != 0)
                                @foreach ($fitur as $f => $value)
                                    @if(count($fiturTerpilih) != 0)
                                        @foreach($fiturTerpilih as $ft => $valueFt)
                                            <div class="row justify-content-between ml-0 mr-0">
                                                <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                                                    @if($value['nama'] != $valueFt['namaFitur'])
                                                        <input type="checkbox" name="checkbox_fitur" class="custom-control-input" id="checkboxFitur{{$f}}" value="{{$value['nama']}}">
                                                        <label class="custom-control-label" for="checkboxFitur{{$f}}">
                                                            {{$value['nama']}}
                                                            <i id="helpFitur{{str_replace(' ','',$value['nama'])}}" class="material-icons help md-18 align-middle cursor-pointer" data-toggle="popover" data-trigger="hover" title="Deskripsi" data-html="true"
                                                                data-content=
                                                                    "<div class='media'>
                                                                        @if(!empty($value['foto_fitur']))
                                                                            <img src='{{ $value['foto_fitur'] }}' class='mr-3 mb-3' width='100%' height='156' alt=''>
                                                                        @endif
                                                                    </div>
                                                                    <div class='media-body'>
                                                                        <h5 class='media-heading'>
                                                                            {{$value['nama']}}
                                                                        </h5>
                                                                        <p>{{$value['nama']}} adalah {{$value['deskripsi']}}</p>
                                                                    </div>"
                                                                onmouseover="showPopUpHelpFitur('{{str_replace(' ','',$value['nama'])}}')" onmouseout="hidePopUpHelpFitur('{{str_replace(' ','',$value['nama'])}}')" style="color:#C4C4C4">
                                                                help
                                                            </i>
                                                        </label>
                                                        <input type="text" name="harga_fitur" id="hargaFitur{{$f}}" value="{{$value['harga']}}" hidden>
                                                        <label class="" style="font-size:16px;">{{rupiah((int) str_replace('.','',$value['harga'])) }}</label>
                                                    @else
                                                        <input type="checkbox" name="checkbox_fitur" class="custom-control-input" checked id="checkboxFitur{{$f}}" value="{{$valueFt['namaFitur']}}">
                                                        <label class="custom-control-label" for="checkboxFitur{{$f}}">
                                                            {{$valueFt['namaFitur']}}
                                                            <i id="helpFitur{{str_replace(' ','',$value['nama'])}}" class="material-icons help md-18 align-middle cursor-pointer" data-toggle="popover" data-trigger="hover" title="Deskripsi" data-html="true"
                                                                data-content=
                                                                    "<div class='media'>
                                                                        @if(!empty($value['foto_fitur']))
                                                                            <img src='{{ $value['foto_fitur'] }}' class='mr-3 mb-3' width='100%' height='156' alt=''>
                                                                        @endif
                                                                    </div>
                                                                    <div class='media-body'>
                                                                        <h5 class='media-heading'>
                                                                            {{$value['nama']}}
                                                                        </h5>
                                                                        <p>{{$value['nama']}} adalah {{$value['deskripsi']}}</p>
                                                                    </div>"
                                                                onmouseover="showPopUpHelpFitur('{{str_replace(' ','',$value['nama'])}}')" onmouseout="hidePopUpHelpFitur('{{str_replace(' ','',$value['nama'])}}')" style="color:#C4C4C4">
                                                                help
                                                            </i>
                                                        </label>
                                                        <input type="text" name="harga_fitur" id="hargaFitur{{$f}}" value="{{$valueFt['hargaFitur']}}" hidden>
                                                        <label class="" style="font-size:16px;">{{rupiah((int) str_replace('.','',$valueFt['hargaFitur'])) }}</label>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row justify-content-between ml-0 mr-0">
                                            <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                                                <input type="checkbox" name="checkbox_fitur" class="custom-control-input" id="checkboxFitur{{$f}}" value="{{$value['nama']}}">
                                                <label class="custom-control-label" for="checkboxFitur{{$f}}">
                                                    {{$value['nama']}}
                                                    <i id="helpFitur{{str_replace(' ','',$value['nama'])}}" class="material-icons help md-18 align-middle cursor-pointer" data-toggle="popover" data-trigger="hover" title="Deskripsi" data-html="true"
                                                        data-content=
                                                            "<div class='media'>
                                                                @if(!empty($value['foto_fitur']))
                                                                    <img src='{{ $value['foto_fitur'] }}' class='mr-3 mb-3' width='100%' height='156' alt=''>
                                                                @endif
                                                            </div>
                                                            <div class='media-body'>
                                                                <h5 class='media-heading'>
                                                                    {{$value['nama']}}
                                                                </h5>
                                                                <p>{{$value['nama']}} adalah {{$value['deskripsi']}}</p>
                                                            </div>"
                                                        onmouseover="showPopUpHelpFitur('{{str_replace(' ','',$value['nama'])}}')" onmouseout="hidePopUpHelpFitur('{{str_replace(' ','',$value['nama'])}}')" style="color:#C4C4C4">
                                                        help
                                                    </i>
                                                </label>
                                            </div>
                                            <input type="text" name="harga_fitur" id="hargaFitur{{$f}}" value="{{$value['harga']}}" hidden>
                                            <label class="" style="font-size:16px;">{{ rupiah((int) str_replace('.','',$value['harga'])) }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <br>
                                <label>-</label>
                            @endif
                        </div>
                    </div>
                </div>
                <form id="cekwarna-form" action="{{route("konfigurasi.cekwarna")}}" method="POST" hidden>
                    @csrf
                    @if (empty(session()->get('produkKonfigurasiFile')->partner->ntkwh))
                        <input type="text" name="percenMin" value="0" hidden>
                    @else
                        <input type="text" name="percenMin" value="{{session()->get('produkKonfigurasiFile')->partner->ntkwh}}" hidden>
                    @endif
                    <input type="text" name="path" hidden>
                </form>
            </div>
        @else
            <div id="produk" class="bg-light-purple p-4 mb-4" style="border-radius:5px; min-height:300px; position: relative;">
                <div class="row justify-content-between">
                    <div class="col-md-4">
                        @include('member.card_produk',["p"=>$produk,"fromKonfigurasi" => "true"])
                    </div>
                    <div class="col-md-8">
                        <div class="ml-2">
                            <div class="text-right">
                                <button class="btn btn-primary-yellow btn-rounded font-weight-bold py-1 px-4 mb-4"
                                    style="border-radius:35px;font-size: 16px;"
                                    onclick="window.location='{{route('pencarian',['id_konfigurasi' => $konfigurasi->id_konfigurasi,'fromKonfigurasi' => 'true'])}}'">
                                    {{__('Ubah Produk') }}
                                </button>
                            </div>
                            <br>
                            <label class="font-weight-bold mb-2" style="font-size:18px;">{{__('Detail') }}
                            </label>
                            <br>
                            <div class="row justify-content-between ml-0 mr-0">
                                <label class="" style="font-size:16px;">{{__('Berwarna') }}</label>
                                <label class="" style="font-size:16px;">
                                    @if($produk->status_diskon != 'Tersedia')
                                        {{rupiah($produk->harga_berwarna) ?? rupiah(0) }} / Halaman
                                    @else
                                        {{rupiah($hargaBerwarna) ?? rupiah(0) }} / Halaman
                                    @endif
                                </label>
                            </div>
                            <div class="row justify-content-between ml-0 mr-0 mb-4">
                                <label class="" style="font-size:16px;">{{__('Hitam Putih') }}</label>
                                <label class="" style="font-size:16px;">
                                    @if($produk->status_diskon != 'Tersedia')
                                        {{rupiah($produk->harga_hitam_putih) ?? rupiah(0) }} / Halaman
                                    @else
                                        {{rupiah($hargaHitamPutih) ?? rupiah(0) }} / Halaman
                                    @endif
                                </label>
                            </div>
                            <div class="row justify-content-between ml-0 mr-0">
                                <label class="" style="font-size:16px;">{{__('Berwarna (Timbal Balik)') }}</label>
                                <label class="" style="font-size:16px;">{{rupiah($produk->harga_timbal_balik_berwarna) ?? rupiah(0) }} / Halaman</label>
                            </div>
                            <div class="row justify-content-between ml-0 mr-0 mb-4">
                                <label class="" style="font-size:16px;">{{__('Hitam Putih (Timbal Balik)') }}</label>
                                <label class="" style="font-size:16px;">{{rupiah($produk->harga_timbal_balik_hitam_putih) ?? rupiah(0) }} / Halaman</label>
                            </div>
                            <div class="row justify-content-between ml-0 mr-0 mb-5">
                                <label class="" style="font-size:16px;">{{__('Nilai Toleransi Kandungan Warna') }}</label>
                                <label class="" style="font-size:16px;">
                                    @if (empty($produk->partner->ntkwh))
                                        {{__('0 %')}}
                                    @else
                                        {{$produk->partner->ntkwh . "%" }}
                                    @endif
                                </label>
                            </div>
                            <label class="font-weight-bold mb-2" style="font-size:18px;">{{__('Fitur') }}</label>
                            @php
                                $fitur = json_decode($produk->fitur,true);
                                $fiturTerpilih = json_decode($konfigurasi->fitur_terpilih,true);
                            @endphp
                            @if (!empty($fitur))
                                @foreach ($fitur as $f => $value)
                                    <div class="row justify-content-between ml-0 mr-0">
                                        <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                                            <input type="checkbox" name="checkbox_fitur" class="custom-control-input" id="checkboxFitur{{$f}}" value="{{$value['nama']}}"
                                                @foreach($fiturTerpilih as $ft => $valueFt)
                                                    @if($valueFt['namaFitur'] === $value['nama'])
                                                        checked
                                                    @endif
                                                @endforeach>
                                            <label class="custom-control-label" for="checkboxFitur{{$f}}">
                                                {{$value['nama']}}
                                                <i id="helpFitur{{str_replace(' ','',$value['nama'])}}" class="material-icons help md-18 align-middle cursor-pointer" data-toggle="popover" data-trigger="hover" title="Deskripsi" data-html="true"
                                                    data-content=
                                                        "<div class='media'>
                                                            @if(!empty($value['foto_fitur']))
                                                                <img src='{{ $value['foto_fitur'] }}' class='mr-3 mb-3' width='100%' height='156' alt=''>
                                                            @endif
                                                        </div>
                                                        <div class='media-body'>
                                                            <h5 class='media-heading'>
                                                                {{$value['nama']}}
                                                            </h5>
                                                            <p>{{$value['nama']}} adalah {{$value['deskripsi']}}</p>
                                                        </div>"
                                                    onmouseover="showPopUpHelpFitur('{{str_replace(' ','',$value['nama'])}}')" onmouseout="hidePopUpHelpFitur('{{str_replace(' ','',$value['nama'])}}')" style="color:#C4C4C4">
                                                    help
                                                </i>
                                            </label>
                                        </div>
                                        <input type="text" name="harga_fitur" id="hargaFitur{{$f}}" value="{{$value['harga']}}" hidden>
                                        <label class="" style="font-size:16px;">{{rupiah((int) str_replace('.','',$value['harga'])) }}</label>
                                    </div>
                                @endforeach
                            @else
                                <br>
                                <label>-</label>
                            @endif
                        </div>
                    </div>
                </div>
                <form id="cekwarna-form" action="{{route("konfigurasi.cekwarna")}}" method="POST" hidden>
                    @csrf
                    @if (empty($produk->partner->ntkwh))
                        <input type="text" name="percenMin" value="0" hidden>
                    @else
                        <input type="text" name="percenMin" value="{{$produk->partner->ntkwh}}" hidden>
                    @endif
                    <input type="text" name="path" hidden>
                </form>
            </div>
        @endif
        <div id="loading">
            <img src="{{asset('img/loading.gif')}}" alt="loading..." class="mx-auto d-block">
            <div id="progressText" class="mx-auto d-block"></div>
        </div>
        <script>
            $('#loading').hide();
        </script>
        @if (session()->has('fileUpload') || session()->has('produkKonfigurasiFile'))
            <form id="konfigurasiForm" action="{{route('konfigurasi.edit.store',$konfigurasi->id_konfigurasi)}}" method="POST">
                @csrf
                @if(session()->has('fileUpload') && session()->has('produkKonfigurasiFile'))
                    <input type='text' name="fileKonfigurasi" id="fileKonfigurasi" value="{{session()->get('fileUpload')->path}}" accept="application/pdf" hidden/>
                    <input type='number' name="percenMin" id="percenMin" value="{{session()->get('produkKonfigurasiFile')->partner->ntkwh}}" accept="application/pdf" hidden/>
                    <input type='text' name="idProduk" id="idProduk" value="{{session()->get('produkKonfigurasiFile')->id_produk}}" hidden />
                    <input type='text' name="namaFile" id="namaFile" value="{{(session()->get('fileUpload'))->name}}" hidden />
                    <input type='number' name="jumlahHalamanHitamPutih" id="jumlahHalamanHitamPutih" value="" hidden />
                    <input type='number' name="jumlahHalamanBerwarna" id="jumlahHalamanBerwarna" value="" hidden />
                    <input type='text' name="statusHalaman" id="statusHalaman" value="Semua" hidden />
                    <input type='text' name="halamanTerpilih" id="halamanTerpilih" value="" hidden />
                    <input type='number' name="jumlahSalinan" id="jumlahSalinan" value="1" hidden />
                    <input type='number' name="paksaHitamPutih" id="paksaHitamPutih" value="0" hidden />
                    <input type='number' name="timbalBalik" id="timbalBalik" value="0" hidden />
                    <input type='number' name="biaya" id="biaya" value="" hidden />
                    <input type='text' name="catatanTambahan" id="catatanTambahan" value="" hidden />
                    <input type='text' name="namaProduk" id="namaProduk" value="{{session()->get('produkKonfigurasiFile')->nama}}" hidden />
                    <input type='text' name="fiturTerpilih" id="fiturTerpilih" value="" hidden />
                @elseif(session()->has('fileUpload'))
                    <input type='text' name="fileKonfigurasi" id="fileKonfigurasi" value="{{session()->get('fileUpload')->path}}" accept="application/pdf" hidden/>
                    <input type='number' name="percenMin" id="percenMin" value="{{$produk->partner->ntkwh}}" accept="application/pdf" hidden/>
                    <input type='text' name="idProduk" id="idProduk" value="{{$produk->id_produk}}" hidden />
                    <input type='text' name="namaFile" id="namaFile" value="{{(session()->get('fileUpload'))->name}}" hidden />
                    <input type='number' name="jumlahHalamanHitamPutih" id="jumlahHalamanHitamPutih" value="0" hidden />
                    <input type='number' name="jumlahHalamanBerwarna" id="jumlahHalamanBerwarna" value="0" hidden />
                    <input type='text' name="statusHalaman" id="statusHalaman" value="Semua" hidden />
                    <input type='text' name="halamanTerpilih" id="halamanTerpilih" value="{{(session()->get('fileUpload'))->countPage}}" hidden />
                    <input type='number' name="jumlahSalinan" id="jumlahSalinan" value="1" hidden />
                    <input type='number' name="paksaHitamPutih" id="paksaHitamPutih" value="0" hidden />
                    <input type='number' name="timbalBalik" id="timbalBalik" value="0" hidden />
                    <input type='number' name="biaya" id="biaya" value="0" hidden />
                    <input type='text' name="catatanTambahan" id="catatanTambahan" value="{{$konfigurasi->catatan_tambahan}}" hidden />
                    <input type='text' name="namaProduk" id="namaProduk" value="{{$produk->nama}}" hidden />
                    <input type='text' name="fiturTerpilih" id="fiturTerpilih" value="{{$konfigurasi->fitur_terpilih}}" hidden />
                @elseif(session()->has('produkKonfigurasiFile'))
                    <input type='text' name="fileKonfigurasi" id="fileKonfigurasi" value="{{$konfigurasi->getFirstMediaPath('file_konfigurasi')}}" accept="application/pdf" hidden/>
                    <input type='number' name="percenMin" id="percenMin" value="{{session()->get('produkKonfigurasiFile')->partner->ntkwh}}" accept="application/pdf" hidden/>
                    <input type='text' name="idProduk" id="idProduk" value="{{session()->get('produkKonfigurasiFile')->id_produk}}" hidden />
                    <input type='text' name="namaFile" id="namaFile" value="{{$konfigurasi->getMedia('file_konfigurasi')->first()->file_name}}" hidden />
                    <input type='number' name="jumlahHalamanHitamPutih" id="jumlahHalamanHitamPutih" value="{{$konfigurasi->jumlah_halaman_hitamputih}}" hidden />
                    <input type='number' name="jumlahHalamanBerwarna" id="jumlahHalamanBerwarna" value="{{$konfigurasi->jumlah_halaman_berwarna}}" hidden />
                    <input type='text' name="statusHalaman" id="statusHalaman" value="{{$konfigurasi->status_halaman}}" hidden />
                    <input type='text' name="halamanTerpilih" id="halamanTerpilih" value="{{json_decode($konfigurasi->halaman_terpilih)}}" hidden />
                    <input type='number' name="jumlahSalinan" id="jumlahSalinan" value="{{$konfigurasi->jumlah_salinan}}" hidden />
                    <input type='number' name="paksaHitamPutih" id="paksaHitamPutih" value="{{$konfigurasi->paksa_hitamputih}}" hidden />
                    <input type='number' name="timbalBalik" id="timbalBalik" value="{{$konfigurasi->timbal_balik}}" hidden />
                    <input type='number' name="biaya" id="biaya" value="0" hidden />
                    <input type='text' name="catatanTambahan" id="catatanTambahan" value="{{$konfigurasi->catatan_tambahan}}" hidden />
                    <input type='text' name="namaProduk" id="namaProduk" value="{{session()->get('produkKonfigurasiFile')->nama}}" hidden />
                    <input type='number' name="hargaHitamPutih" id="hargaHitamPutih" value="{{session()->get('produkKonfigurasiFile')->harga_hitam_putih}}" hidden />
                    <input type='number' name="hargaBerwarna" id="hargaBerwarna" value="{{session()->get('produkKonfigurasiFile')->harga_berwarna}}" hidden />
                    <input type='number' name="hargaHitamPutihTimbalBalik" id="hargaHitamPutihTimbalBalik" value="{{session()->get('produkKonfigurasiFile')->harga_timbal_balik_hitam_putih}}" hidden />
                    <input type='number' name="hargaBerwarnaTimbalBalik" id="hargaBerwarnaTimbalBalik" value="{{session()->get('produkKonfigurasiFile')->harga_timbal_balik_berwarna}}" hidden />
                    <input type='text' name="fiturTerpilih" id="fiturTerpilih" value="" hidden />
                @endif
                <script>
                    $(function () {
                        function rupiah(val) {
                            return ("Rp. " + val.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1."));
                        }
                        $(document).ready(function () {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    type: 'GET',
                                    url: '{{route("konfigurasi.cekwarna")}}',
                                    data: {
                                        path:$('#fileKonfigurasi').val(),
                                        percenMin:$('#percenMin').val(),
                                        idProduk:$('#idProduk').val(),
                                        namaFile:$('#namaFile').val(),
                                        jumlahHalamanHitamPutih:$('#jumlahHalamanHitamPutih').val(),
                                        jumlahHalamanBerwarna:$('#jumlahHalamanBerwarna').val(),
                                        statusHalaman:$('#statusHalaman').val(),
                                        halamanTerpilih:[],
                                        jumlahSalinan:$('#jumlahSalin').val(),
                                        paksaHitamPutih:$('#paksaHitamPutih').val(),
                                        timbalBalik:$('#timbalBalik').val(),
                                        biaya:$('#biaya').val(),
                                        catatanTambahan:$('#catatanTambahan').val(),
                                        namaProduk:$('#namaProduk').val(),
                                        fiturTerpilih:eval($('#fiturTerpilih').val()),
                                    },
                                    dataType: 'json',
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        //TODO : Ubah pesan error menajadi tampilan
                                        alert('Maaf terjadi error '+thrownError+' Silahkan coba kembali');

                                    },
                                    beforeSend: function () {
                                        $('#loading').show();
                                        $('#hasil').hide();

                                    },
                                    complete: function () {
                                        $('#loading').hide();
                                        $('#hasil').show();
                                    },
                                    success: function (pdf) {
                                        console.log(pdf);

                                        pdf.namaFile = $('#namaFile').val();
                                        pdf.halamanTerpilih = [];

                                        var nilaiSemuaHalaman = $('#semuaHal').val();
                                        var nilaiKustomHal = $('#kustomHal').val();
                                        var jumlahKustomHal = 0;

                                        if('{{session()->has('fileUpload')}}'){
                                            if($('#rbSemuaHal').is(':checked')){
                                                for (let i = 1; i <= nilaiSemuaHalaman; i++) {
                                                    pdf.halamanTerpilih.push(i);
                                                }
                                            }

                                            else if($('#rbSampaiHal').is(':checked')){
                                                for (let i = $('#halamanAwal').val(); i <= $('#halamanAkhir').val(); i++) {
                                                    pdf.halamanTerpilih.push(i);
                                                }
                                            }

                                            else{
                                                pdf.halamanTerpilih.push(nilaiKustomHal);
                                            }
                                        }
                                        else{
                                            pdf.halamanTerpilih = $('#halamanTerpilih').val();
                                        }

                                        if('{{session()->has('fileUpload')}}'){
                                            pdf.jumlahHalamanHitamPutih = pdf['jumlahHalHitamPutih'];
                                            pdf.jumlahHalamanBerwarna = pdf['jumlahHalBerwarna'];
                                        }
                                        else{
                                            pdf.jumlahHalamanHitamPutih = $('#jumlahHalamanHitamPutih').val();
                                            pdf.jumlahHalamanBerwarna = $('#jumlahHalamanBerwarna').val();
                                        }

                                        pdf.statusHalaman = $('#statusHalaman').val();
                                        pdf.jumlahSalinan = parseInt($('#jumlahSalin').val());
                                        pdf.paksaHitamPutih = $('#paksaHitamPutih').val();
                                        pdf.timbalBalik = $('#timbalBalik').val();
                                        pdf.namaProduk = $('#namaProduk').val();
                                        pdf.fiturTerpilih = [];

                                        if(pdf.fiturTerpilih.length != 0 || pdf.fiturTerpilih != undefined){
                                            pdf.fiturTerpilih = eval($('#fiturTerpilih').val());
                                        }
                                        else{
                                            pdf.fiturTerpilih = [];
                                        }

                                        var halamanAwal = parseInt($('#halamanAwal').val());
                                        var halamanAkhir = parseInt($('#halamanAkhir').val());
                                        var jumlahSalinan = parseInt($('#jumlahSalin').val());

                                        if('{{!session()->has('produkKonfigurasiFile')}}'){
                                            var hargaHitamPutih = '{{$produk->harga_hitam_putih}}';
                                            var hargaBerwarna = '{{$produk->harga_berwarna}}';
                                            var hargaHitamPutihTimbalBalik = '{{$produk->harga_timbal_balik_hitam_putih}}';
                                            var hargaBerwarnaTimbalBalik = '{{$produk->harga_timbal_balik_berwarna}}';
                                            pdf.fiturTerpilih = eval($('#fiturTerpilih').val());
                                        }
                                        else{
                                            var hargaHitamPutih = $('#hargaHitamPutih').val();
                                            var hargaBerwarna = $('#hargaBerwarna').val();
                                            var hargaHitamPutihTimbalBalik = $('#hargaHitamPutihTimbalBalik').val();
                                            var hargaBerwarnaTimbalBalik = $('#hargaBerwarnaTimbalBalik').val();
                                            pdf.fiturTerpilih = [];
                                        }

                                        var nilaiPaksaHitamPutih = parseInt(pdf.jumlahHalamanHitamPutih + pdf.jumlahHalamanBerwarna);
                                        var nilaiPaksaBerwarna = 0;
                                        var fiturTerpilihEdited = pdf.fiturTerpilih;
                                        var fiturTerpilih = [];
                                        var hargaHitamPutihFinal = 0;
                                        var hargaBerwarnaFinal = 0;
                                        var hargaFiturTerpilih = [];

                                        if(pdf.timbalBalik != 0){
                                            hargaHitamPutih = hargaHitamPutihTimbalBalik;
                                            hargaBerwarna = hargaBerwarnaTimbalBalik;
                                        }
                                        else{
                                            hargaHitamPutih = '{{$hargaHitamPutih}}';
                                            hargaBerwarna = '{{$hargaBerwarna}}';
                                        }

                                        if(pdf.paksaHitamPutih != 0){
                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                            pdf.jumlahHalamanBerwarna = 0;
                                        }
                                        else{
                                            if('{{session()->has('fileUpload')}}'){
                                                pdf.jumlahHalamanHitamPutih = pdf['jumlahHalHitamPutih'];
                                                pdf.jumlahHalamanBerwarna = pdf['jumlahHalBerwarna'];
                                            }
                                            else{
                                                pdf.jumlahHalamanHitamPutih = $('#jumlahHalamanHitamPutih').val();
                                                pdf.jumlahHalamanBerwarna = $('#jumlahHalamanBerwarna').val();
                                            }
                                        }

                                        if(fiturTerpilihEdited.length != 0 || fiturTerpilihEdited.length != undefined){
                                            for(let i = 0; i < fiturTerpilihEdited.length; i++){
                                                fiturTerpilih.push(fiturTerpilihEdited[i].namaFitur);
                                                hargaFiturTerpilih.push(fiturTerpilihEdited[i].hargaFitur);
                                            }
                                        }

                                        var hargaTotalFiturTerpilih = 0;

                                        if(hargaFiturTerpilih.length != 0){
                                            hargaTotalFiturTerpilih = eval(hargaFiturTerpilih.join("+"));
                                        }
                                        else{
                                            hargaTotalFiturTerpilih = 0;
                                        }

                                        var totalHargaHitamPutih = hargaHitamPutih * pdf.jumlahHalamanHitamPutih * jumlahSalinan;
                                        var totalHargaBerwarna = hargaBerwarna * pdf.jumlahHalamanBerwarna * jumlahSalinan;
                                        var totalHarga = totalHargaHitamPutih + totalHargaBerwarna + hargaTotalFiturTerpilih;

                                        var hargaTotalKonfigurasi = totalHarga;
                                        var catatanTambahan = pdf.catatanTambahan;

                                        pdf.biaya = totalHarga;
                                        pdf.catatanTambahan = $('#catatanTambahan').val();

                                        var hasil = '' +
                                            ' <label class="font-weight-bold mt-5 mb-4" style="font-size:36px;">Detail Jenis Warna Setiap Halaman</label>' +
                                            '' +
                                            '    <div id="tableCekWarna" class="row justify-content-between ml-0 mr-0 ">' +
                                            '        <div class="col-md-6">' +
                                            '            <table class="table table-hover text-center" style="border-radius:25px 25px 15px 15px;">' +
                                            '                <thead class="bg-primary-purple text-white align-self-center">' +
                                            '                    <tr style="font-size: 18px;">' +
                                            '                        <th class="align-middle" scope="col-md-auto">Halaman</th>' +
                                            '                        <th class="align-middle" scope="col-md-auto">Persentase kandungan Berwarna</th>' +
                                            '                        <th class="align-middle" scope="col-md-auto">Jenis Warna Halaman</th>' +
                                            '                    </tr>' +
                                            '                </thead>' +
                                            '                <tbody style="font-size: 14px;">' ;

                                                                for (let i = 0; i < pdf['jumlahHalaman']; i++) {
                                                                    hasil+=
                                                '                   <tr>' +
                                                '                        <td scope="row">'+(i+1)+'</td>' +
                                                '                        <td>' +
                                                                            (pdf['halaman'][i]['piksel_berwarna']/pdf['halaman'][i]['total_piksel']*100).toFixed(2) + ' %' +
                                                '                        </td>' +
                                                '                        <td>' +
                                                                            (pdf['halaman'][i]['jenis_warna']) +
                                                '                       </td>' +
                                                '                    </tr>' ;
                                                                    }

                                            hasil+=
                                            '                </tbody>' +
                                            '            </table>' +
                                            '        </div>' +
                                            '        <div class="col-md-6 bg-primary-yellow p-2" style="border-radius: 5px; max-height:200px;">' +
                                            '            <div class="row justify-content-left ml-0 mr-0">' +
                                            '                <div class="col-md-auto">' +
                                            '                    <i class="material-icons md-18 align-middle mr-0" style="color:#C4C4C4">warning</i>' +
                                            '                </div>' +
                                            '                <div class="col-md-10">' +
                                            '                    <label style="font-size: 16px;">';

                                                                    if (pdf['jumlahHalBerwarna'] === 0) {
                                                                        hasil+=''+
                                            '                           File dokumen Anda dinyatakan memiliki halaman hitam-putih secara keseluruhannya dengan total ' +
                                            '                           <label class="font-weight-bold mb-0">' + pdf['jumlahHalHitamPutih'] + ' halaman hitam-putih </label> ' +
                                            '                           karena tidak melebihi nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.';
                                                                    }
                                                                    else if(pdf['jumlahHalHitamPutih'] === 0){
                                                                        hasil+=''+
                                            '                           File dokumen Anda dinyatakan memiliki halaman berwarna secara keseluruhannya dengan total ' + ' <label class="font-weight-bold mb-0">' + pdf['jumlahHalBerwarna'] + ' halaman berwarna </label>' + ' karena melebihi nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.';
                                                                    }
                                                                    else {
                                                                        hasil+=''+
                                                '                       File dokumen anda dinyatakan memiliki '+' <label class="font-weight-bold mb-0">'+ pdf['jumlahHalBerwarna'] +' halaman berwarna </label>'+ ' karena melebihi nilai toleransi' +
                                                '                       kandungan' +
                                                '                       warna yang ditetapkan oleh produk yang anda pilih dan '+'<label class="font-weight-bold mb-0">' + pdf['jumlahHalHitamPutih'] +' halaman hitam-putih </label>'+ ' karena tidak'+
                                                '                       melebihi' +
                                                '                       nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.';
                                                                    }
                                            hasil+=
                                            '                    </label>' +
                                            '                </div>' +
                                            '            </div>' +
                                            '        </div>' +
                                            '    </div>' +
                                            '' +
                                            '    <div class="row justify-content-between ml-0 mr-0 mt-5 mb-5">' +
                                            '        <div class="col-md-6 pl-2 pr-4 pb-4 pt-4 mb-4" style="border-radius:5px;">' +
                                            '            <label class="font-weight-bold mb-2 ml-0" style="font-size: 24px;">Catatan Tambahan' +
                                            '            </label>' +
                                            '            <div class="input-group mb-3" style="height:120px;">' +
                                            '                <textarea id="catatanTambahanArea" class="form-control" style="font-size: 18px;">'+$('#catatanTambahan').val()+'</textarea>' +
                                            '            </div>' +
                                            '        </div>' +
                                            '        <div class="col-md-6 bg-light-purple pl-4 pr-4 pt-2 pb-2 mt-4 mr-0" style="border-radius:10px;' +
                                            '                                font-size:18px;">' +
                                            '            <label class="SemiBold mb-4" style="font-size:24px;">Rincian Harga' +
                                            '            </label>' +
                                            '            <div class="row justify-content-between mb-2">' +
                                            '                <div class="col-md-auto text-left">' +
                                            '                    <label id="jumlahHitamPutih" class="mb-2">' +
                                                                    pdf.jumlahHalamanHitamPutih + ' Halaman Hitam Putih' +
                                            '                    </label>' +
                                            '                    <br>' +
                                            '                    <label id="jumlahBerwarna" class="mb-2">' +
                                                                    pdf.jumlahHalamanBerwarna + ' Halaman Berwarna' +
                                            '                    </label>' +
                                            '                </div>' +
                                            '                <div class="col-md-auto text-right">' +
                                            '                    <label id="hargaHitamPutih" class="SemiBold mb-2">' +
                                            '                       Rp. ' + totalHargaHitamPutih +
                                            '                    </label>' +
                                            '                    <br>' +
                                            '                    <label id="hargaBerwarna" class="SemiBold mb-2">' +
                                            '                       Rp. ' + totalHargaBerwarna +
                                            '                    </label>' +
                                            '                </div>' +
                                            '            </div>' +
                                            '            <label class="SemiBold mb-2">' +
                                            '                Fitur' +
                                            '            </label>' +
                                            '            <div id="fiturTambahanTerpilih">';
                                                            if(fiturTerpilihEdited.length != 0 && fiturTerpilihEdited != undefined){
                                                                for(i = 0; i < fiturTerpilihEdited.length; i++){
                                                                    hasil += '<div class="row justify-content-between">' +
                                                                    '   <div class="col-md-auto text-left">' +
                                                                    '       <label class="mb-2">' +
                                                                        fiturTerpilihEdited[i].namaFitur +
                                                                    '       </label>' +
                                                                    '   </div>' +
                                                                    '   <div class="col-md-auto text-right">' +
                                                                    '       <label class="SemiBold mb-2">' +
                                                                                'Rp. ' + (fiturTerpilihEdited[i].hargaFitur) +
                                                                    '       </label>' +
                                                                    '   </div>' +
                                                                    '</div>';
                                                                }
                                                            }
                                                            else{
                                                                hasil += '<div class="row justify-content-between">' +
                                                                    '   <div class="col-md-auto text-left">' +
                                                                        '       <label class="mb-2">' +
                                                                        '           -' +
                                                                        '       </label>' +
                                                                    '   </div>' +
                                                                    '   <div class="col-md-auto text-right">' +
                                                                        '       <label class="SemiBold mb-2">' +
                                                                        '           -' +
                                                                        '       </label>' +
                                                                    '   </div>' +
                                                                    '</div>';
                                                            }
                                            hasil += '  </div>'+
                                            '            <div class="row row-bordered"></div>' +
                                            '            <div class="row justify-content-between SemiBold mt-2">' +
                                            '                <div class="col-md-auto text-left">' +
                                            '                    <label>Total Harga Pesanan Kamu</label>' +
                                            '                </div>' +
                                            '                <div class="col-md-auto text-right">' +
                                            '                    <label id="totalHargaKonfigurasi">Rp. '+ totalHarga + '</label>' +
                                            '                </div>' +
                                            '            </div>' +
                                            '        </div>' +
                                            '    </div>' +
                                            '    <div class="row justify-content-end ml-0 mr-0 mt-2 mb-5">' +
                                            '        <div class="form-group mb-3">' +
                                            '            <button type="submit" id="simpanDanLanjutkan" class="btn btn-primary-wakprint font-weight-bold pl-4 pr-4" style="border-radius:30px;' +
                                            '                                font-size:24px;">' +
                                            '                Simpan dan Lanjutkan' +
                                            '            </button>' +
                                            '        </div>' +
                                            '    </div>' +
                                            '';

                                        $('#hasil').html(hasil);

                                            $('#btnPlus').click(function(){
                                                var val = parseInt($('#jumlahSalin').val(),10);

                                                $('#jumlahSalin').val((val+1));

                                                jumlahSalinan = val+1;

                                                pdf.jumlahSalinan = jumlahSalinan;

                                                if($('#rbSemuaHal').is(':checked')){
                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        pdf.timbalBalik = 1;

                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html('Rp. ' + hargaHitamPutihFinal);

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.timbalBalik = 0;
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        pdf.timbalBalik = 0;

                                                        $('#jumlahHitamPutih').html(
                                                            pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else if($('#rbSampaiHal').is(':checked')){
                                                    var batasBawah = 0;
                                                    var batasAtas = 0;
                                                    var jumlahHitamPutihFinal = 0;
                                                    var jumlahBerwarnaFinal = 0;

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        pdf.timbalBalik = 1;
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.timbalBalik = 0;
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        pdf.timbalBalik = 0;
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                        console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                    }
                                                }
                                                else if($('#rbKustomHal').is(':checked')){
                                                            nilaiKustomHal = $('#halamanKustom').val();
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'GET',
                                                                url: '{{route("halaman.kustom")}}',
                                                                data: {
                                                                    nilaiKustomHal:nilaiKustomHal,
                                                                },
                                                                error: function (xhr, ajaxOptions, thrownError) {
                                                                    alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                                },
                                                                complete: function(hasil){
                                                                },
                                                                success: function (hasil) {
                                                                    var jumlahHitamPutihFinal = 0;
                                                                    var jumlahBerwarnaFinal = 0;

                                                                    pdf.halamanTerpilih = hasil;

                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                            $('#jumlahHitamPutih').html(
                                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                            $('#jumlahHitamPutih').html(
                                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                                            pdf.timbalBalik = 1;
                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.timbalBalik = 0;
                                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else{
                                                                        pdf.timbalBalik = 0;
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                            });
                                                }

                                                pdf.biaya = hargaTotalKonfigurasi;

                                            });

                                            $('#btnMinus').click(function(){
                                                var val = parseInt($('#jumlahSalin').val(),10);

                                                if(val>1) {
                                                    $('#jumlahSalin').val((val-1));
                                                    jumlahSalinan = val-1;
                                                    if($('#rbSemuaHal').is(':checked')){
                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#rbSampaiHal').is(':checked')){
                                                        var batasBawah = 0;
                                                        var batasAtas = 0;
                                                        var jumlahHitamPutihFinal = 0;
                                                        var jumlahBerwarnaFinal = 0;

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                            console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                        }
                                                    }
                                                    else if($('#rbKustomHal').is(':checked')){
                                                            nilaiKustomHal = $('#halamanKustom').val();
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'GET',
                                                                url: '{{route("halaman.kustom")}}',
                                                                data: {
                                                                    nilaiKustomHal:nilaiKustomHal,
                                                                },
                                                                error: function (xhr, ajaxOptions, thrownError) {
                                                                    alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                                },
                                                                complete: function(hasil){
                                                                },
                                                                success: function (hasil) {
                                                                    var jumlahHitamPutihFinal = 0;
                                                                    var jumlahBerwarnaFinal = 0;

                                                                    pdf.halamanTerpilih = hasil;

                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                            $('#jumlahHitamPutih').html(
                                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                            $('#jumlahHitamPutih').html(
                                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                                            pdf.timbalBalik = 1;
                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.timbalBalik = 0;
                                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else{
                                                                        pdf.timbalBalik = 0;
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                            });
                                                    }
                                                }
                                                else if(val === 1){
                                                    $('#jumlahSalin').val((val));
                                                    jumlahSalinan = 1;
                                                    if($('#rbSemuaHal').is(':checked')){
                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan
                                                                );
                                                            }
                                                            else {
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan
                                                                );
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan
                                                                );
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan
                                                                );
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan
                                                            );

                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan
                                                            );
                                                        }
                                                    }
                                                    else if($('#rbSampaiHal').is(':checked')){
                                                        var batasBawah = 0;
                                                        var batasAtas = 0;
                                                        var jumlahHitamPutihFinal = 0;
                                                        var jumlahBerwarnaFinal = 0;

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                            console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                        }
                                                    }
                                                    else if($('#rbKustomHal').is(':checked')){
                                                            nilaiKustomHal = $('#halamanKustom').val();
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'GET',
                                                                url: '{{route("halaman.kustom")}}',
                                                                data: {
                                                                    nilaiKustomHal:nilaiKustomHal,
                                                                },
                                                                error: function (xhr, ajaxOptions, thrownError) {
                                                                    alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                                },
                                                                complete: function(hasil){
                                                                },
                                                                success: function (hasil) {
                                                                    var jumlahHitamPutihFinal = 0;
                                                                    var jumlahBerwarnaFinal = 0;

                                                                    pdf.halamanTerpilih = hasil;

                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                            $('#jumlahHitamPutih').html(
                                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                            $('#jumlahHitamPutih').html(
                                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                                            pdf.timbalBalik = 1;
                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.timbalBalik = 0;
                                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else{
                                                                        pdf.timbalBalik = 0;
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                            });
                                                    }
                                                }
                                                else {
                                                    if($('#rbSemuaHal').is(':checked')){
                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan
                                                                );
                                                            }
                                                            else {
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan
                                                                );
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan
                                                                );
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan
                                                                );
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan
                                                            );

                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan
                                                            );
                                                        }
                                                    }
                                                    else if($('#rbSampaiHal').is(':checked')){
                                                        var batasBawah = 0;
                                                        var batasAtas = 0;
                                                        var jumlahHitamPutihFinal = 0;
                                                        var jumlahBerwarnaFinal = 0;

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                            console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                        }
                                                    }
                                                    else if($('#rbKustomHal').is(':checked')){
                                                            nilaiKustomHal = $('#halamanKustom').val();
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'GET',
                                                                url: '{{route("halaman.kustom")}}',
                                                                data: {
                                                                    nilaiKustomHal:nilaiKustomHal,
                                                                },
                                                                error: function (xhr, ajaxOptions, thrownError) {
                                                                    alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                                },
                                                                complete: function(hasil){
                                                                },
                                                                success: function (hasil) {
                                                                    var jumlahHitamPutihFinal = 0;
                                                                    var jumlahBerwarnaFinal = 0;

                                                                    pdf.halamanTerpilih = hasil;

                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                            $('#jumlahHitamPutih').html(
                                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                            $('#jumlahHitamPutih').html(
                                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                                            pdf.timbalBalik = 1;
                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.timbalBalik = 0;
                                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else{
                                                                        pdf.timbalBalik = 0;
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                            });
                                                    }
                                                }

                                                pdf.jumlahSalinan = jumlahSalinan;
                                                pdf.biaya = hargaTotalKonfigurasi;
                                            });

                                            $('input[type=checkbox]').on('click change',(function(){
                                                if($('#rbSemuaHal').is(':checked')){
                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        pdf.timbalBalik = 1;
                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            pdf.paksaHitamPutih = 1;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {

                                                            pdf.paksaHitamPutih = 0;

                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        pdf.paksaHitamPutih = 1;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.timbalBalik = 0;
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        pdf.timbalBalik = 0;
                                                        pdf.paksaHitamPutih = 0;

                                                        $('#jumlahHitamPutih').html(
                                                            pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else if($('#rbSampaiHal').is(':checked')){
                                                    var batasBawah = 0;
                                                    var batasAtas = 0;
                                                    var jumlahHitamPutihFinal = 0;
                                                    var jumlahBerwarnaFinal = 0;

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        pdf.timbalBalik = 1;
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.timbalBalik = 0;
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        pdf.timbalBalik = 0;
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                        console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                    }
                                                }
                                                else{
                                                    nilaiKustomHal = $('#halamanKustom').val();
                                                        $.ajaxSetup({
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                        $.ajax({
                                                            type: 'GET',
                                                            url: '{{route("halaman.kustom")}}',
                                                            data: {
                                                                nilaiKustomHal:nilaiKustomHal,
                                                            },
                                                            error: function (xhr, ajaxOptions, thrownError) {
                                                                alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                            },
                                                            complete: function(hasil){
                                                            },
                                                            success: function (hasil) {
                                                                var jumlahHitamPutihFinal = 0;
                                                                var jumlahBerwarnaFinal = 0;

                                                                pdf.halamanTerpilih = hasil;

                                                                for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                                    pdf.timbalBalik = 1;
                                                                    if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                    else {
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                                else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                    pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                    pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                    $('#jumlahHitamPutih').html(
                                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                    );

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                    else {
                                                                        pdf.timbalBalik = 0;
                                                                        hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                                else{
                                                                    pdf.timbalBalik = 0;
                                                                    pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                    pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                    $('#jumlahHitamPutih').html(
                                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                        });
                                                }

                                                pdf.biaya = hargaTotalKonfigurasi;
                                            }));

                                            $('input[type=checkbox]').each(function(index, value){
                                                $('#checkboxFitur' + index).bind('change', function(){
                                                    var hasilFiturTambahan = '';

                                                    if(this.checked){
                                                        fiturTerpilih.push($(this).val());
                                                        hargaFiturTerpilih.push($('#hargaFitur' + index).val());

                                                        pdf.fiturTerpilih.push({
                                                            "namaFitur": $(this).val(),
                                                            "hargaFitur": $('#hargaFitur' + index).val()
                                                        });

                                                        hargaTotalFiturTerpilih = eval(hargaFiturTerpilih.join("+"));

                                                        for (var i = 0; i < fiturTerpilih.length; i++) {
                                                            var ft = fiturTerpilih[i];
                                                            var hargaFT = hargaFiturTerpilih[i];

                                                            hasilFiturTambahan +=
                                                                '            <div class="row justify-content-between">' +
                                                                '                <div class="col-md-auto text-left">' +
                                                                '                    <label class="mb-2">' +
                                                                                        ft +
                                                                '                    </label>' +
                                                                '                </div>' +
                                                                '                <div class="col-md-auto text-right">' +
                                                                '                    <label class="SemiBold mb-2">' +
                                                                '                       Rp. ' + hargaFT +
                                                                '                    </label>' +
                                                                '                </div>' +
                                                                '            </div>';
                                                        }

                                                        if($('#rbSemuaHal').is(':checked')){
                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                    $('#jumlahHitamPutih').html(
                                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                                else {
                                                                    $('#jumlahHitamPutih').html(
                                                                        pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                                    pdf.timbalBalik = 1;
                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                                else {
                                                                    pdf.timbalBalik = 0;
                                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                            else{
                                                                pdf.timbalBalik= 0;
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#rbSampaiHal').is(':checked')){
                                                            var batasBawah = 0;
                                                            var batasAtas = 0;
                                                            var jumlahHitamPutihFinal = 0;
                                                            var jumlahBerwarnaFinal = 0;

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                    pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                    pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                    $('#jumlahHitamPutih').html(
                                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                                else {
                                                                    pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                    pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                    $('#jumlahHitamPutih').html(
                                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                                    pdf.timbalBalik = 1;
                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                                else {
                                                                    pdf.timbalBalik = 0;
                                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                            else{
                                                                pdf.timbalBalik = 0;
                                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                                console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                            }
                                                        }
                                                        else if($('#rbKustomHal').is(':checked')){
                                                            nilaiKustomHal = $('#halamanKustom').val();
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'GET',
                                                                url: '{{route("halaman.kustom")}}',
                                                                data: {
                                                                    nilaiKustomHal:nilaiKustomHal,
                                                                },
                                                                error: function (xhr, ajaxOptions, thrownError) {
                                                                    alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                                },
                                                                complete: function(hasil){
                                                                },
                                                                success: function (hasil) {
                                                                    var jumlahHitamPutihFinal = 0;
                                                                    var jumlahBerwarnaFinal = 0;

                                                                    pdf.halamanTerpilih = hasil;

                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                            $('#jumlahHitamPutih').html(
                                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                            $('#jumlahHitamPutih').html(
                                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                                            pdf.timbalBalik = 1;
                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.timbalBalik = 0;
                                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else{
                                                                        pdf.timbalBalik = 0;
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                            });
                                                        }

                                                        $('#fiturTambahanTerpilih').html(hasilFiturTambahan);
                                                    }
                                                    else {
                                                        var pos = fiturTerpilih.indexOf($(this).val());

                                                        if(pos > -1){
                                                            fiturTerpilih.splice(pos, 1);
                                                            hargaFiturTerpilih.splice(pos,1);
                                                            pdf.fiturTerpilih.splice(pos,1);

                                                            console.log(pdf.fiturTerpilih);

                                                            if(fiturTerpilih.length === 0 && hargaFiturTerpilih.length === 0){
                                                                hargaTotalFiturTerpilih = 0;
                                                                hasilFiturTambahan +=
                                                                '            <div class="row justify-content-between">' +
                                                                '                <div class="col-md-auto text-left">' +
                                                                '                    <label class="mb-2">' +
                                                                '                       -' +
                                                                '                    </label>' +
                                                                '                </div>' +
                                                                '                <div class="col-md-auto text-right">' +
                                                                '                    <label class="SemiBold mb-2">' +
                                                                '                       -' +
                                                                '                    </label>' +
                                                                '                </div>' +
                                                                '            </div>';

                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                hargaTotalFiturTerpilih = eval(hargaFiturTerpilih.join("+"));

                                                                for (var i = 0; i < fiturTerpilih.length; i++) {
                                                                    var ft = fiturTerpilih[i];
                                                                    var hargaFT = hargaFiturTerpilih[i];

                                                                    hasilFiturTambahan +=
                                                                    '            <div class="row justify-content-between">' +
                                                                    '                <div class="col-md-auto text-left">' +
                                                                    '                    <label class="mb-2">' +
                                                                                            ft +
                                                                    '                    </label>' +
                                                                    '                </div>' +
                                                                    '                <div class="col-md-auto text-right">' +
                                                                    '                    <label class="SemiBold mb-2">' +
                                                                    '                       Rp. ' + hargaFT +
                                                                    '                    </label>' +
                                                                    '                </div>' +
                                                                    '            </div>';
                                                                }

                                                                // $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }

                                                        if($('#rbSemuaHal').is(':checked')){
                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                    $('#jumlahHitamPutih').html(
                                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                                else {
                                                                    $('#jumlahHitamPutih').html(
                                                                        pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                                    pdf.timbalBalik = 1;
                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                                else {
                                                                    pdf.timbalBalik = 0;
                                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                            else{
                                                                pdf.timbalBalik = 0;
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }

                                                        else if($('#rbSampaiHal').is(':checked')){
                                                            var batasBawah = 0;
                                                            var batasAtas = 0;
                                                            var jumlahHitamPutihFinal = 0;
                                                            var jumlahBerwarnaFinal = 0;

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                    pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                    pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                    $('#jumlahHitamPutih').html(
                                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                                else {
                                                                    pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                    pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                    $('#jumlahHitamPutih').html(
                                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                                    pdf.timbalBalik = 1;
                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                                else {
                                                                    pdf.timbalBalik = 0;
                                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                            else{
                                                                pdf.timbalBalik = 0;
                                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                                console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                            }
                                                        }

                                                        else if($('#rbKustomHal').is(':checked')){
                                                            nilaiKustomHal = $('#halamanKustom').val();
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'GET',
                                                                url: '{{route("halaman.kustom")}}',
                                                                data: {
                                                                    nilaiKustomHal:nilaiKustomHal,
                                                                },
                                                                error: function (xhr, ajaxOptions, thrownError) {
                                                                    alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                                },
                                                                complete: function(hasil){
                                                                },
                                                                success: function (hasil) {
                                                                    var jumlahHitamPutihFinal = 0;
                                                                    var jumlahBerwarnaFinal = 0;

                                                                    pdf.halamanTerpilih = hasil;

                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                            $('#jumlahHitamPutih').html(
                                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                            $('#jumlahHitamPutih').html(
                                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                                            pdf.timbalBalik = 1;
                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.timbalBalik = 0;
                                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else{
                                                                        pdf.timbalBalik = 0;
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                            });
                                                        }

                                                        $('#fiturTambahanTerpilih').html(hasilFiturTambahan);
                                                    }

                                                    pdf.biaya = hargaTotalKonfigurasi;
                                                });
                                            });

                                            $('input[type=radio]').bind('change',(function(){
                                                var related_class=$(this).val();
                                                $('.'+related_class).prop('disabled',false);

                                                if($('#rbSemuaHal').is(':checked')){
                                                    pdf.statusHalaman = $('#statusHalaman').val('Semua');
                                                    $('#halamanKustom').prop('disabled',true);
                                                    $('#halamanAwal').prop('disabled',true);
                                                    $('#halamanAkhir').prop('disabled',true);
                                                    $('#halamanKustom').val("");

                                                    $('#jumlahHalCetak').html(
                                                        '<label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">' +
                                                            '<i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>' +
                                                            '<label id="jumlahHal">' + nilaiSemuaHalaman + '</label>' +
                                                            ' Halaman yang Akan Dicetak' +
                                                        '</label>'
                                                    );

                                                    for (let i = 1; i <= nilaiSemuaHalaman; i++) {
                                                        pdf.halamanTerpilih.push(i);
                                                    }

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        pdf.timbalBalik = 1;
                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            pdf.paksaHitamPutih = 1;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.paksaHitamPutih = 0;

                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            data.jumlahHalamanHitamPutih = pdf['jumlahHalHitamPutih'];
                                                            data.jumlahHalamanBerwarna = pdf['jumlahHalBerwarna'];

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){
                                                        pdf.paksaHitamPutih = 1;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.timbalBalik = 0;
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        pdf.timbalBalik = 0;
                                                        pdf.paksaHitamPutih = 0;

                                                        $('#jumlahHitamPutih').html(
                                                            pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                        );

                                                        pdf.jumlahHalamanHitamPutih = pdf['jumlahHalHitamPutih'];
                                                        pdf.jumlahHalamanBerwarna = pdf['jumlahHalBerwarna'];

                                                        hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else if($('#rbSampaiHal').is(':checked')){
                                                    pdf.statusHalaman = $('#statusHalaman').val('Range');
                                                    $('#halamanKustom').prop('disabled',true);
                                                    $('#halamanAwal').prop('disabled',false);
                                                    $('#halamanAkhir').prop('disabled',false);
                                                    $('#halamanKustom').val("");

                                                    var batasBawah = 0;
                                                    var batasAtas = 0;
                                                    var jumlahHitamPutihFinal = 0;
                                                    var jumlahBerwarnaFinal = 0;
                                                    var nilaiSampaiHalaman = parseInt($('#halamanAkhir').val()) - parseInt($('#halamanAwal').val());

                                                    $('#halamanAwal').on('change input',function(){
                                                        parseInt($('#halamanAwal').val());
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        range(parseInt($('#halamanAwal').val()),parseInt($('#halamanAkhir').val()),1);

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    });

                                                    $('#halamanAkhir').on('change input',function(){
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAwal').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        range(parseInt($('#halamanAwal').val()),parseInt($('#halamanAkhir').val()),1);

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    });

                                                    if(nilaiSampaiHalaman === 0){
                                                        nilaiSampaiHalaman = 1;
                                                    }
                                                    else{
                                                        nilaiSampaiHalaman += 1;
                                                    }

                                                    $('#jumlahHalCetak').html(
                                                        '<label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">' +
                                                            '<i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>' +
                                                            '<label id="jumlahHal">' + nilaiSampaiHalaman + '</label>' +
                                                            ' Halaman yang Akan Dicetak' +
                                                        '</label>'
                                                    );

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        pdf.timbalBalik = 1;
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.timbalBalik = 0;
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        pdf.timbalBalik = 0;
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                        console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                    }
                                                }
                                                else if($('#rbKustomHal').is(':checked')){
                                                    pdf.statusHalaman = $('#statusHalaman').val('Kustom');
                                                    $('#halamanKustom').prop('disabled',false);
                                                    $('#halamanAwal').prop('disabled',true);
                                                    $('#halamanAkhir').prop('disabled',true);
                                                    $('#halamanKustom').val("");

                                                    $('#halamanKustom').on('change input',function(){
                                                        nilaiKustomHal = $('#halamanKustom').val();
                                                        $.ajaxSetup({
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                        $.ajax({
                                                            type: 'GET',
                                                            url: '{{route("halaman.kustom")}}',
                                                            data: {
                                                                nilaiKustomHal:nilaiKustomHal,
                                                            },
                                                            error: function (xhr, ajaxOptions, thrownError) {
                                                                alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                            },
                                                            complete: function(hasil){
                                                            },
                                                            success: function (hasil) {
                                                                var jumlahHitamPutihFinal = 0;
                                                                var jumlahBerwarnaFinal = 0;

                                                                pdf.halamanTerpilih = hasil;
                                                                jumlahKustomHal = hasil.length;

                                                                $('#jumlahHalCetak').html(
                                                                    '<label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">' +
                                                                    '<i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>' +
                                                                        '<label id="jumlahHal">' + jumlahKustomHal + '</label>' +
                                                                        ' Halaman yang Akan Dicetak' +
                                                                    '</label>'
                                                                );

                                                                for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                                    pdf.timbalBalik = 1;
                                                                    if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                    else {
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                                else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                    pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                    pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                    $('#jumlahHitamPutih').html(
                                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                    );

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                    else {
                                                                        pdf.timbalBalik = 0;
                                                                        hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                                else{
                                                                    pdf.timbalBalik = 0;
                                                                    pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                    pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                    $('#jumlahHitamPutih').html(
                                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            },
                                                        });
                                                    });
                                                }

                                                $('input[type=radio]').not(':checked').each(function(){
                                                    var other_class=$(this).val();
                                                    $('.'+other_class).prop('disabled',true);
                                                });

                                                pdf.biaya = hargaTotalKonfigurasi;
                                            }));

                                            $('#catatanTambahanArea').on('change input',(function(){
                                                pdf.catatanTambahan = $('#catatanTambahanArea').val();
                                            }));

                                            $('#simpanDanLanjutkan').on('click',(function(){
                                                if('{{session()->has('produkKonfigurasiFile')}}' && '{{!session()->has('fileUpload')}}'){
                                                    $('#fileKonfigurasi').val('{{$konfigurasi->getFirstMedia('file_konfigurasi')}}');
                                                    // $('#halamanTerpilih').val(JSON.parse(pdf.halamanTerpilih));
                                                }
                                                $('#jumlahHalamanHitamPutih').val(pdf.jumlahHalamanHitamPutih);
                                                $('#jumlahHalamanBerwarna').val(pdf.jumlahHalamanBerwarna);
                                                if($('#rbSemuaHal').is(':checked')){
                                                    pdf.statusHalaman = $('#rbSemuaHal').val();
                                                    $('#statusHalaman').val(pdf.statusHalaman);
                                                }
                                                else if($('#rbSampaiHal').is(':checked')){
                                                    pdf.statusHalaman = $('#rbSampaiHal').val();
                                                    $('#statusHalaman').val(pdf.statusHalaman);
                                                }
                                                else{
                                                    pdf.statusHalaman = $('#rbKustomHal').val();
                                                    $('#statusHalaman').val(pdf.statusHalaman);
                                                }
                                                $('#halamanTerpilih').val(pdf.halamanTerpilih);
                                                $('#jumlahSalinan').val(pdf.jumlahSalinan);
                                                $('#paksaHitamPutih').val(pdf.paksaHitamPutih);
                                                $('#timbalBalik').val(pdf.timbalBalik);
                                                $('#biaya').val(pdf.biaya);
                                                $('#catatanTambahan').val(pdf.catatanTambahan);
                                                $('#fiturTerpilih').val(JSON.stringify(pdf.fiturTerpilih));

                                                $('#konfigurasiForm').submit();
                                            }));

                                            function range(start, stop, step) {
                                                pdf.halamanTerpilih = [start], b = start;
                                                while (b < stop) {
                                                    pdf.halamanTerpilih.push(b += step || 1);
                                                }
                                                return pdf.halamanTerpilih;
                                            }
                                    }
                                });
                        });
                    });

                    function showPopUpHelpFitur(value) {
                        $('#helpFitur' + value).popover('show');
                    }

                    function hidePopUpHelpFitur(value) {
                        $('#helpFitur' + value).popover('hide');
                    }
                </script>
            </form>
        @else
            <form id="konfigurasiForm" action="{{route('konfigurasi.edit.store',$konfigurasi->id_konfigurasi)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type='text' name="fileKonfigurasi" id="fileKonfigurasi" value="{{$konfigurasi->getFirstMedia('file_konfigurasi')}}" accept="application/pdf" hidden/>
                <input type='text' name="idProduk" id="idProduk" value="{{$produk->id_produk}}" hidden />
                <input type='text' name="namaFile" id="namaFile" value="{{$konfigurasi->getMedia('file_konfigurasi')->first()->file_name}}" hidden />
                <input type='number' name="jumlahHalamanHitamPutih" id="jumlahHalamanHitamPutih" value="{{$konfigurasi->jumlah_halaman_hitamputih}}" hidden />
                <input type='number' name="jumlahHalamanBerwarna" id="jumlahHalamanBerwarna" value="{{$konfigurasi->jumlah_halaman_berwarna}}" hidden />
                <input type='text' name="statusHalaman" id="statusHalaman" value="" hidden />
                <input type='text' name="halamanTerpilih" id="halamanTerpilih" value="{{$konfigurasi->halaman_terpilih}}" hidden />
                <input type='number' name="jumlahSalinan" id="jumlahSalinan" value="{{$konfigurasi->jumlah_salinan}}" hidden />
                <input type='number' name="paksaHitamPutih" id="paksaHitamPutih" value="{{$konfigurasi->paksa_hitamputih}}" hidden />
                <input type='number' name="timbalBalik" id="timbalBalik" value="{{$konfigurasi->timbal_balik}}" hidden />
                <input type='number' name="biaya" id="biaya" value="{{$konfigurasi->biaya}}" hidden />
                <input type='text' name="catatanTambahan" id="catatanTambahan" value="{{$konfigurasi->catatan_tambahan}}" hidden />
                <input type='text' name="namaProduk" id="namaProduk" value="{{$produk->nama}}" hidden />
                <input type='text' name="fiturTerpilih" id="fiturTerpilih" value="{{$konfigurasi->fitur_terpilih}}" hidden />
                <script>
                    $(function () {
                        function rupiah(val) {
                            return ("Rp. " + val.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1."));
                        }
                        $(document).ready(function () {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    type: 'GET',
                                    url: '{{route("konfigurasi.cekwarna")}}',
                                    data: {
                                        path:"{{$konfigurasi->getFirstMediaPath('file_konfigurasi')}}",
                                        percenMin:"{{$konfigurasi->product->partner->ntkwh}}",
                                        idProduk:"{{$konfigurasi->product->id_produk}}",
                                        namaFile:"{{$konfigurasi->getMedia('file_konfigurasi')->first()->file_name}}",
                                        jumlahHalamanHitamPutih:$('#jumlahHalamanHitamPutih').val(),
                                        jumlahHalamanBerwarna:$('#jumlahHalamanBerwarna').val(),
                                        statusHalaman:'{{$konfigurasi->status_halaman}}',
                                        halamanTerpilih:$('#halamanTerpilih').val(),
                                        jumlahSalinan:$('#jumlahSalin').val(),
                                        paksaHitamPutih:$('#checkboxPaksaHitamPutih').val(),
                                        timbalBalik:$('#checkboxTimbalBalik').val(),
                                        biaya:$('#biaya').val(),
                                        catatanTambahan:$('#catatanTambahan').val(),
                                        namaProduk:"{{$produk->nama}}",
                                        fiturTerpilih:[],
                                    },
                                    dataType: 'json',
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        swal({title: "Maaf terjadi " + thrownError,
                                            text: 'Silahkan coba kembali',
                                            icon: "warning",
                                            buttons: "OK",
                                            dangerMode: true,
                                        });
                                    },
                                    beforeSend: function () {
                                        $('#loading').show();
                                        $('#hasil').hide();
                                    },
                                    complete: function () {
                                        $('#loading').hide();
                                        $('#hasil').show();
                                    },
                                    success: function (pdf) {
                                        console.log(pdf);

                                        pdf.namaFile = '{{$konfigurasi->getMedia('file_konfigurasi')->first()->file_name}}';
                                        pdf.jumlahHalamanHitamPutih = '{{$konfigurasi->jumlah_halaman_hitamputih}}';
                                        pdf.jumlahHalamanBerwarna = '{{$konfigurasi->jumlah_halaman_berwarna}}';
                                        pdf.statusHalaman = '{{$konfigurasi->status_halaman}}';
                                        pdf.halamanTerpilih = [];
                                        pdf.jumlahSalinan = parseInt($('#jumlahSalin').val());
                                        pdf.paksaHitamPutih = $('#checkboxPaksaHitamPutih').val();
                                        pdf.timbalBalik = $('#checkboxTimbalBalik').val();
                                        pdf.namaProduk = '{{$produk->nama}}';
                                        pdf.fiturTerpilih = [];

                                        var halamanAwal = parseInt($('#halamanAwal').val());
                                        var halamanAkhir = parseInt($('#halamanAkhir').val());
                                        var jumlahSalinan = $('#jumlahSalin').val();
                                        var nilaiSemuaHalaman = $('#semuaHal').val();
                                        var hargaHitamPutih = '{{$hargaHitamPutih}}';
                                        var hargaBerwarna = '{{$hargaBerwarna}}';
                                        var hargaHitamPutihTimbalBalik = '{{$konfigurasi->product->harga_timbal_balik_hitam_putih}}';
                                        var hargaBerwarnaTimbalBalik = '{{$konfigurasi->product->harga_timbal_balik_berwarna}}';
                                        var nilaiPaksaHitamPutih = parseInt(pdf['jumlahHalBerwarna'] + pdf['jumlahHalHitamPutih']);
                                        var nilaiPaksaBerwarna = 0;
                                        var fiturTerpilihEdited = eval($('#fiturTerpilih').val());
                                        var fiturTerpilih = [];
                                        // var nilaiSampaiHalaman = parseInt($('#halamanAkhir').val()) - parseInt($('#halamanAwal').val());
                                        var nilaiKustomHal = $('#kustomHal').val();
                                        var jumlahKustomHal = 0;

                                        var hargaHitamPutihFinal = 0;
                                        var hargaBerwarnaFinal = 0;
                                        var hargaFiturTerpilih = [];
                                        var catatanTambahan = $('#catatanTambahan').val();

                                        pdf.catatanTambahan = $('#catatanTambahan').val();

                                        if($('#rbSemuaHal').is(':checked')){
                                            for (let i = 1; i <= nilaiSemuaHalaman; i++) {
                                                pdf.halamanTerpilih.push(i);
                                            }
                                        }

                                        else if($('#rbSampaiHal').is(':checked')){
                                            for (let i = $('#halamanAwal').val(); i <= $('#halamanAkhir').val(); i++) {
                                                pdf.halamanTerpilih.push(i);
                                            }
                                        }

                                        else{
                                            pdf.halamanTerpilih.push(nilaiKustomHal);
                                        }

                                        if(pdf.timbalBalik != 0){
                                            hargaHitamPutih = hargaHitamPutihTimbalBalik;
                                            hargaBerwarna = hargaBerwarnaTimbalBalik;
                                        }
                                        else{
                                            hargaHitamPutih = '{{$hargaHitamPutih}}';
                                            hargaBerwarna = '{{$hargaBerwarna}}';
                                        }

                                        for(let i = 0; i < fiturTerpilihEdited.length; i++){
                                            fiturTerpilih.push(fiturTerpilihEdited[i].namaFitur);
                                            hargaFiturTerpilih.push(fiturTerpilihEdited[i].hargaFitur);
                                        }

                                        var hargaTotalFiturTerpilih = 0;

                                        if(hargaFiturTerpilih.length != 0){
                                            hargaTotalFiturTerpilih = eval(hargaFiturTerpilih.join("+"));
                                        }
                                        else{
                                            hargaTotalFiturTerpilih = 0;
                                        }

                                        var totalHargaHitamPutih = hargaHitamPutih * pdf.jumlahHalamanHitamPutih * jumlahSalinan;
                                        var totalHargaBerwarna = hargaBerwarna * pdf.jumlahHalamanBerwarna * jumlahSalinan;
                                        var totalHarga = totalHargaHitamPutih + totalHargaBerwarna + hargaTotalFiturTerpilih;

                                        var hargaTotalKonfigurasi = totalHarga;

                                        pdf.biaya = totalHarga;

                                        var hasil = '' +
                                            ' <label class="font-weight-bold mt-5 mb-4" style="font-size:36px;">Detail Jenis Warna Setiap Halaman</label>' +
                                            '' +
                                            '    <div id="tableCekWarna" class="row justify-content-between ml-0 mr-0 ">' +
                                            '        <div class="col-md-6">' +
                                            '            <table class="table table-hover text-center" style="border-radius:25px 25px 15px 15px;">' +
                                            '                <thead class="bg-primary-purple text-white align-self-center">' +
                                            '                    <tr style="font-size: 18px;">' +
                                            '                        <th class="align-middle" scope="col-md-auto">Halaman</th>' +
                                            '                        <th class="align-middle" scope="col-md-auto">Persentase kandungan Berwarna</th>' +
                                            '                        <th class="align-middle" scope="col-md-auto">Jenis Warna Halaman</th>' +
                                            '                    </tr>' +
                                            '                </thead>' +
                                            '                <tbody style="font-size: 14px;">' ;

                                                                for (let i = 0; i < pdf['jumlahHalaman']; i++) {
                                                                    hasil+=
                                                '                   <tr>' +
                                                '                        <td scope="row">'+(i+1)+'</td>' +
                                                '                        <td>' +
                                                                            (pdf['halaman'][i]['piksel_berwarna']/pdf['halaman'][i]['total_piksel']*100).toFixed(2) + ' %' +
                                                '                        </td>' +
                                                '                        <td>' +
                                                                            (pdf['halaman'][i]['jenis_warna']) +
                                                '                       </td>' +
                                                '                    </tr>' ;
                                                                    }

                                            hasil+=
                                            '                </tbody>' +
                                            '            </table>' +
                                            '        </div>' +
                                            '        <div class="col-md-6 bg-primary-yellow p-2" style="border-radius: 5px; max-height:200px;">' +
                                            '            <div class="row justify-content-left ml-0 mr-0">' +
                                            '                <div class="col-md-auto">' +
                                            '                    <i class="material-icons md-18 align-middle mr-0" style="color:#C4C4C4">warning</i>' +
                                            '                </div>' +
                                            '                <div class="col-md-10">' +
                                            '                    <label style="font-size: 16px;">';

                                                                    if (pdf['jumlahHalBerwarna'] === 0) {
                                                                        hasil+=''+
                                            '                           File dokumen Anda dinyatakan memiliki halaman hitam-putih secara keseluruhannya dengan total ' +
                                            '                           <label class="font-weight-bold mb-0">' + pdf['jumlahHalHitamPutih'] + ' halaman hitam-putih </label> ' +
                                            '                           karena tidak melebihi nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.';
                                                                    }
                                                                    else if(pdf['jumlahHalHitamPutih'] === 0){
                                                                        hasil+=''+
                                            '                           File dokumen Anda dinyatakan memiliki halaman berwarna secara keseluruhannya dengan total ' + ' <label class="font-weight-bold mb-0">' + pdf['jumlahHalBerwarna'] + ' halaman berwarna </label>' + ' karena melebihi nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.';
                                                                    }
                                                                    else {
                                                                        hasil+=''+
                                                '                       File dokumen anda dinyatakan memiliki '+' <label class="font-weight-bold mb-0">'+ pdf['jumlahHalBerwarna'] +' halaman berwarna </label>'+ ' karena melebihi nilai toleransi' +
                                                '                       kandungan' +
                                                '                       warna yang ditetapkan oleh produk yang anda pilih dan '+'<label class="font-weight-bold mb-0">' + pdf['jumlahHalHitamPutih'] +' halaman hitam-putih </label>'+ ' karena tidak'+
                                                '                       melebihi' +
                                                '                       nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.';
                                                                    }
                                            hasil+=
                                            '                    </label>' +
                                            '                </div>' +
                                            '            </div>' +
                                            '        </div>' +
                                            '    </div>' +
                                            '' +
                                            '    <div class="row justify-content-between ml-0 mr-0 mt-5 mb-5">' +
                                            '        <div class="col-md-6 pl-2 pr-4 pb-4 pt-4 mb-4" style="border-radius:5px;">' +
                                            '            <label class="font-weight-bold mb-2 ml-0" style="font-size: 24px;">Catatan Tambahan' +
                                            '            </label>' +
                                            '            <div class="input-group mb-3" style="height:120px;">' +
                                            '                <textarea id="catatanTambahanArea" name="catatanTambahanArea" class="form-control" style="font-size: 18px;">'+$('#catatanTambahan').val()+'</textarea>' +
                                            '            </div>' +
                                            '        </div>' +
                                            '        <div class="col-md-6 bg-light-purple pl-4 pr-4 pt-2 pb-2 mt-4 mr-0" style="border-radius:10px;' +
                                            '                                font-size:18px;">' +
                                            '            <label class="SemiBold mb-4" style="font-size:24px;">Rincian Harga' +
                                            '            </label>' +
                                            '            <div class="row justify-content-between mb-2">' +
                                            '                <div class="col-md-auto text-left">' +
                                            '                    <label id="jumlahHitamPutih" class="mb-2">' +
                                                                    pdf.jumlahHalamanHitamPutih + ' Halaman Hitam Putih' +
                                            '                    </label>' +
                                            '                    <br>' +
                                            '                    <label id="jumlahBerwarna" class="mb-2">' +
                                                                    pdf.jumlahHalamanBerwarna + ' Halaman Berwarna' +
                                            '                    </label>' +
                                            '                </div>' +
                                            '                <div class="col-md-auto text-right">' +
                                            '                    <label id="hargaHitamPutih" class="SemiBold mb-2">' +
                                                                    'Rp. ' + totalHargaHitamPutih +
                                            '                    </label>' +
                                            '                    <br>' +
                                            '                    <label id="hargaBerwarna" class="SemiBold mb-2">' +
                                                                    'Rp. ' + totalHargaBerwarna +
                                            '                    </label>' +
                                            '                </div>' +
                                            '            </div>' +
                                            '            <label class="SemiBold mb-2">' +
                                            '                Fitur' +
                                            '            </label>' +
                                            '            <div id="fiturTambahanTerpilih">';
                                                            if(fiturTerpilihEdited.length != 0){
                                                                for(i = 0; i < fiturTerpilihEdited.length; i++){
                                                                    hasil += '<div class="row justify-content-between">' +
                                                                    '   <div class="col-md-auto text-left">' +
                                                                    '       <label class="mb-2">' +
                                                                                fiturTerpilihEdited[i].namaFitur +
                                                                    '       </label>' +
                                                                    '   </div>' +
                                                                    '   <div class="col-md-auto text-right">' +
                                                                    '       <label class="SemiBold mb-2">' +
                                                                                rupiah(fiturTerpilihEdited[i].hargaFitur) +
                                                                    '       </label>' +
                                                                    '   </div>' +
                                                                    '</div>';
                                                                }
                                                            }
                                                            else{
                                                                hasil += '<div class="row justify-content-between">' +
                                                                '   <div class="col-md-auto text-left">' +
                                                                '       <label class="mb-2">' +
                                                                '           -' +
                                                                '       </label>' +
                                                                '   </div>' +
                                                                '   <div class="col-md-auto text-right">' +
                                                                '       <label class="SemiBold mb-2">' +
                                                                '           -' +
                                                                '       </label>' +
                                                                '   </div>' +
                                                                '</div>';
                                                            }
                                            hasil += '  </div>'+
                                            '            <div class="row row-bordered"></div>' +
                                            '            <div class="row justify-content-between SemiBold mt-2">' +
                                            '                <div class="col-md-auto text-left">' +
                                            '                    <label>Total Harga Pesanan Kamu</label>' +
                                            '                </div>' +
                                            '                <div class="col-md-auto text-right">' +
                                            '                    <label id="totalHargaKonfigurasi">'+ rupiah(totalHarga) + '</label>' +
                                            '                </div>' +
                                            '            </div>' +
                                            '        </div>' +
                                            '    </div>' +
                                            '    <div class="row justify-content-end ml-0 mr-0 mt-2 mb-5">' +
                                            '        <div class="form-group mb-3">' +
                                            '            <button type="submit" id="simpanDanLanjutkan" class="btn btn-primary-wakprint font-weight-bold pl-4 pr-4" style="border-radius:30px;' +
                                            '                                font-size:24px;">' +
                                            '                Simpan dan Lanjutkan' +
                                            '            </button>' +
                                            '        </div>' +
                                            '    </div>' +
                                            '';

                                        $('#hasil').html(hasil);

                                            $('#btnPlus').click(function(){
                                                var val = parseInt($('#jumlahSalin').val(),10);

                                                parseInt($('#jumlahSalin').val((val+1)));

                                                jumlahSalinan = val+1;

                                                pdf.jumlahSalinan = jumlahSalinan;

                                                if($('#rbSemuaHal').is(':checked')){
                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        pdf.timbalBalik = 1;
                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                        else {
                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(rupiah(hargaHitamPutihFinal));

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                        else {
                                                            pdf.timbalBalik = 0;
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                    }
                                                    else{
                                                        pdf.timbalBalik = 0;

                                                        if(pdf.paksaHitamPutih != 0){
                                                            $('#jumlahHitamPutih').html(
                                                                pdf.jumlahHalamanHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf.jumlahHalamanBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * pdf.jumlahHalamanHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * pdf.jumlahHalamanBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                        else{
                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                    }
                                                }
                                                else if($('#rbSampaiHal').is(':checked')){
                                                    var batasBawah = 0;
                                                    var batasAtas = 0;
                                                    var jumlahHitamPutihFinal = 0;
                                                    var jumlahBerwarnaFinal = 0;

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        pdf.timbalBalik = 1;
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.timbalBalik = 0;
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        pdf.timbalBalik = 0;
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                        console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                    }
                                                }
                                                else if($('#rbKustomHal').is(':checked')){
                                                            nilaiKustomHal = $('#halamanKustom').val();
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'GET',
                                                                url: '{{route("halaman.kustom")}}',
                                                                data: {
                                                                    nilaiKustomHal:nilaiKustomHal,
                                                                },
                                                                error: function (xhr, ajaxOptions, thrownError) {
                                                                    alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                                },
                                                                complete: function(hasil){
                                                                },
                                                                success: function (hasil) {
                                                                    var jumlahHitamPutihFinal = 0;
                                                                    var jumlahBerwarnaFinal = 0;

                                                                    pdf.halamanTerpilih = hasil;

                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                            $('#jumlahHitamPutih').html(
                                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                            $('#jumlahHitamPutih').html(
                                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                                            pdf.timbalBalik = 1;
                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.timbalBalik = 0;
                                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else{
                                                                        pdf.timbalBalik = 0;
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                            });
                                                }

                                                pdf.biaya = hargaTotalKonfigurasi;

                                            });

                                            $('#btnMinus').click(function(){
                                                var val = parseInt($('#jumlahSalin').val(),10);

                                                if(val>1) {
                                                    $('#jumlahSalin').val((val-1));
                                                    jumlahSalinan = val-1;
                                                    if($('#rbSemuaHal').is(':checked')){
                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;

                                                            if(pdf.paksaHitamPutih != 0){
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf.jumlahHalamanHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf.jumlahHalamanBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * pdf.jumlahHalamanHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    rupiah(hargaHitamPutihFinal)
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * pdf.jumlahHalamanBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    rupiah(hargaBerwarnaFinal)
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                            }
                                                            else{
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    rupiah(hargaHitamPutihFinal)
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    rupiah(hargaBerwarnaFinal)
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                            }
                                                        }
                                                    }
                                                    else if($('#rbSampaiHal').is(':checked')){
                                                        var batasBawah = 0;
                                                        var batasAtas = 0;
                                                        var jumlahHitamPutihFinal = 0;
                                                        var jumlahBerwarnaFinal = 0;

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                            console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                        }
                                                    }
                                                    else if($('#rbKustomHal').is(':checked')){
                                                            nilaiKustomHal = $('#halamanKustom').val();
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'GET',
                                                                url: '{{route("halaman.kustom")}}',
                                                                data: {
                                                                    nilaiKustomHal:nilaiKustomHal,
                                                                },
                                                                error: function (xhr, ajaxOptions, thrownError) {
                                                                    alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                                },
                                                                complete: function(hasil){
                                                                },
                                                                success: function (hasil) {
                                                                    var jumlahHitamPutihFinal = 0;
                                                                    var jumlahBerwarnaFinal = 0;

                                                                    pdf.halamanTerpilih = hasil;

                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                            $('#jumlahHitamPutih').html(
                                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                            $('#jumlahHitamPutih').html(
                                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                                            pdf.timbalBalik = 1;
                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.timbalBalik = 0;
                                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else{
                                                                        pdf.timbalBalik = 0;
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                            });
                                                    }
                                                }
                                                else if(val === 1){
                                                    $('#jumlahSalin').val((val));
                                                    jumlahSalinan = 1;
                                                    if($('#rbSemuaHal').is(':checked')){
                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan
                                                                );
                                                            }
                                                            else {
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan
                                                                );
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan
                                                                );
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan
                                                                );
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;

                                                            if(pdf.paksaHitamPutih != 0){
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf.jumlahHalamanHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf.jumlahHalamanBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * pdf.jumlahHalamanHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    rupiah(hargaHitamPutihFinal)
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * pdf.jumlahHalamanBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    rupiah(hargaBerwarnaFinal)
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                            }
                                                            else{
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    rupiah(hargaHitamPutihFinal)
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    rupiah(hargaBerwarnaFinal)
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                            }
                                                        }
                                                    }
                                                    else if($('#rbSampaiHal').is(':checked')){
                                                        var batasBawah = 0;
                                                        var batasAtas = 0;
                                                        var jumlahHitamPutihFinal = 0;
                                                        var jumlahBerwarnaFinal = 0;

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                            console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                        }
                                                    }
                                                    else if($('#rbKustomHal').is(':checked')){
                                                            nilaiKustomHal = $('#halamanKustom').val();
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'GET',
                                                                url: '{{route("halaman.kustom")}}',
                                                                data: {
                                                                    nilaiKustomHal:nilaiKustomHal,
                                                                },
                                                                error: function (xhr, ajaxOptions, thrownError) {
                                                                    alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                                },
                                                                complete: function(hasil){
                                                                },
                                                                success: function (hasil) {
                                                                    var jumlahHitamPutihFinal = 0;
                                                                    var jumlahBerwarnaFinal = 0;

                                                                    pdf.halamanTerpilih = hasil;

                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                            $('#jumlahHitamPutih').html(
                                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                            $('#jumlahHitamPutih').html(
                                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                                            pdf.timbalBalik = 1;
                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.timbalBalik = 0;
                                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else{
                                                                        pdf.timbalBalik = 0;
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                            });
                                                    }
                                                }
                                                else {
                                                    if($('#rbSemuaHal').is(':checked')){
                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan
                                                                );
                                                            }
                                                            else {
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan
                                                                );
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan
                                                                );
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan
                                                                );

                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan
                                                                );
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;

                                                            if(pdf.paksaHitamPutih != 0){
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf.jumlahHalamanHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf.jumlahHalamanBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * pdf.jumlahHalamanHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    rupiah(hargaHitamPutihFinal)
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * pdf.jumlahHalamanBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    rupiah(hargaBerwarnaFinal)
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                            }
                                                            else{
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    rupiah(hargaHitamPutihFinal)
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    rupiah(hargaBerwarnaFinal)
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                            }
                                                        }
                                                    }
                                                    else if($('#rbSampaiHal').is(':checked')){
                                                        var batasBawah = 0;
                                                        var batasAtas = 0;
                                                        var jumlahHitamPutihFinal = 0;
                                                        var jumlahBerwarnaFinal = 0;

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            batasBawah = parseInt($('#halamanAwal').val())-1;
                                                            batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                            for (i = batasBawah; i <= batasAtas; i++) {
                                                                if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                    jumlahBerwarnaFinal += 1;
                                                                }
                                                                else{
                                                                    jumlahHitamPutihFinal += 1;
                                                                }
                                                            }

                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                            console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                        }
                                                    }
                                                    else if($('#rbKustomHal').is(':checked')){
                                                            nilaiKustomHal = $('#halamanKustom').val();
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'GET',
                                                                url: '{{route("halaman.kustom")}}',
                                                                data: {
                                                                    nilaiKustomHal:nilaiKustomHal,
                                                                },
                                                                error: function (xhr, ajaxOptions, thrownError) {
                                                                    alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                                },
                                                                complete: function(hasil){
                                                                },
                                                                success: function (hasil) {
                                                                    var jumlahHitamPutihFinal = 0;
                                                                    var jumlahBerwarnaFinal = 0;

                                                                    pdf.halamanTerpilih = hasil;

                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                            $('#jumlahHitamPutih').html(
                                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                            $('#jumlahHitamPutih').html(
                                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                                            pdf.timbalBalik = 1;
                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.timbalBalik = 0;
                                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else{
                                                                        pdf.timbalBalik = 0;
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                            });
                                                    }
                                                }

                                                pdf.jumlahSalinan = jumlahSalinan;
                                                pdf.biaya = hargaTotalKonfigurasi;
                                            });

                                            $('input[type=checkbox]').bind('change',(function(){
                                                if($('#rbSemuaHal').is(':checked')){
                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        pdf.timbalBalik = 1;
                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            pdf.paksaHitamPutih = 1;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                        else {

                                                            pdf.paksaHitamPutih = 0;

                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        pdf.paksaHitamPutih = 1;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                        else {
                                                            pdf.timbalBalik = 0;
                                                            hargaHitamPutih = '{{$hargaHitamPutih}}';
                                                            hargaBerwarna = '{{$hargaBerwarna}}';

                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                    }
                                                    else{
                                                        pdf.timbalBalik = 0;
                                                        pdf.paksaHitamPutih = 0;
                                                        hargaHitamPutih = '{{$hargaHitamPutih}}';
                                                        hargaBerwarna = '{{$hargaBerwarna}}';

                                                        if(pdf.paksaHitamPutih != 0){
                                                            $('#jumlahHitamPutih').html(
                                                                pdf.jumlahHalamanHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf.jumlahHalamanBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * pdf.jumlahHalamanHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * pdf.jumlahHalamanBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                        else{
                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                    }
                                                }
                                                else if($('#rbSampaiHal').is(':checked')){
                                                    var batasBawah = 0;
                                                    var batasAtas = 0;
                                                    var jumlahHitamPutihFinal = 0;
                                                    var jumlahBerwarnaFinal = 0;

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        pdf.timbalBalik = 1;
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.timbalBalik = 0;
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        pdf.timbalBalik = 0;
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                        console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                    }
                                                }
                                                else{
                                                    nilaiKustomHal = $('#halamanKustom').val();
                                                        $.ajaxSetup({
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                        $.ajax({
                                                            type: 'GET',
                                                            url: '{{route("halaman.kustom")}}',
                                                            data: {
                                                                nilaiKustomHal:nilaiKustomHal,
                                                            },
                                                            error: function (xhr, ajaxOptions, thrownError) {
                                                                alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                            },
                                                            complete: function(hasil){
                                                            },
                                                            success: function (hasil) {
                                                                var jumlahHitamPutihFinal = 0;
                                                                var jumlahBerwarnaFinal = 0;

                                                                pdf.halamanTerpilih = hasil;

                                                                for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                                    pdf.timbalBalik = 1;
                                                                    if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                    else {
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                                else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                    pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                    pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                    $('#jumlahHitamPutih').html(
                                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                    );

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                    else {
                                                                        pdf.timbalBalik = 0;
                                                                        hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                                else{
                                                                    pdf.timbalBalik = 0;
                                                                    pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                    pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                    $('#jumlahHitamPutih').html(
                                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                        });
                                                }

                                                pdf.biaya = hargaTotalKonfigurasi;
                                            }));

                                            $('input[type=checkbox]').each(function(index, value){
                                                $('#checkboxFitur' + index).bind('change', function(){
                                                    var hasilFiturTambahan = '';

                                                    if(this.checked){
                                                        fiturTerpilih.push($(this).val());
                                                        hargaFiturTerpilih.push($('#hargaFitur' + index).val());

                                                        // pdf.fiturTerpilih.push('namaFitur : ' + $(this).val() + ' hargaFitur : ' + $('#hargaFitur' + index).val());

                                                        pdf.fiturTerpilih.push({
                                                            "namaFitur": $(this).val(),
                                                            "hargaFitur": $('#hargaFitur' + index).val()
                                                        });

                                                        hargaTotalFiturTerpilih = eval(hargaFiturTerpilih.join("+"));

                                                        for (var i = 0; i < fiturTerpilih.length; i++) {
                                                            var ft = fiturTerpilih[i];
                                                            var hargaFT = hargaFiturTerpilih[i];

                                                            hasilFiturTambahan +=
                                                                '            <div class="row justify-content-between">' +
                                                                '                <div class="col-md-auto text-left">' +
                                                                '                    <label class="mb-2">' +
                                                                                        ft +
                                                                '                    </label>' +
                                                                '                </div>' +
                                                                '                <div class="col-md-auto text-right">' +
                                                                '                    <label class="SemiBold mb-2">' +
                                                                                        'Rp. '+ hargaFT +
                                                                '                    </label>' +
                                                                '                </div>' +
                                                                '            </div>';
                                                        }

                                                        if($('#rbSemuaHal').is(':checked')){
                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                    $('#jumlahHitamPutih').html(
                                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        rupiah(hargaHitamPutihFinal)
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        rupiah(hargaBerwarnaFinal)
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                                }
                                                                else {
                                                                    $('#jumlahHitamPutih').html(
                                                                        pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        rupiah(hargaHitamPutihFinal)
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        rupiah(hargaBerwarnaFinal)
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                                }
                                                            }
                                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                                    pdf.timbalBalik = 1;
                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        rupiah(hargaHitamPutihFinal)
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        rupiah(hargaBerwarnaFinal)
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                                }
                                                                else {
                                                                    pdf.timbalBalik = 0;
                                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        rupiah(hargaHitamPutihFinal)
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        rupiah(hargaBerwarnaFinal)
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                                }
                                                            }
                                                            else{
                                                                pdf.timbalBalik= 0;
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    rupiah(hargaHitamPutihFinal)
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    rupiah(hargaBerwarnaFinal)
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                            }
                                                        }

                                                        else if($('#rbSampaiHal').is(':checked')){
                                                            var batasBawah = 0;
                                                            var batasAtas = 0;
                                                            var jumlahHitamPutihFinal = 0;
                                                            var jumlahBerwarnaFinal = 0;

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                    pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                    pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                    $('#jumlahHitamPutih').html(
                                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                                else {
                                                                    pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                    pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                    $('#jumlahHitamPutih').html(
                                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                                    pdf.timbalBalik = 1;
                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                                else {
                                                                    pdf.timbalBalik = 0;
                                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                            else{
                                                                pdf.timbalBalik = 0;
                                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                                console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                            }
                                                        }
                                                        else if($('#rbKustomHal').is(':checked')){
                                                            nilaiKustomHal = $('#halamanKustom').val();
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'GET',
                                                                url: '{{route("halaman.kustom")}}',
                                                                data: {
                                                                    nilaiKustomHal:nilaiKustomHal,
                                                                },
                                                                error: function (xhr, ajaxOptions, thrownError) {
                                                                    alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                                },
                                                                complete: function(hasil){
                                                                },
                                                                success: function (hasil) {
                                                                    var jumlahHitamPutihFinal = 0;
                                                                    var jumlahBerwarnaFinal = 0;

                                                                    pdf.halamanTerpilih = hasil;

                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                            $('#jumlahHitamPutih').html(
                                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                            $('#jumlahHitamPutih').html(
                                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                                            pdf.timbalBalik = 1;
                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.timbalBalik = 0;
                                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else{
                                                                        pdf.timbalBalik = 0;
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                            });
                                                        }

                                                        $('#fiturTambahanTerpilih').html(hasilFiturTambahan);
                                                    }
                                                    else {
                                                        var pos = fiturTerpilih.indexOf($(this).val());

                                                        if(pos > -1){
                                                            fiturTerpilih.splice(pos, 1);
                                                            hargaFiturTerpilih.splice(pos,1);
                                                            pdf.fiturTerpilih.splice(pos,1);

                                                            console.log(pdf.fiturTerpilih);

                                                            if(fiturTerpilih.length === 0 && hargaFiturTerpilih.length === 0){
                                                                hargaTotalFiturTerpilih = 0;
                                                                hasilFiturTambahan +=
                                                                '            <div class="row justify-content-between">' +
                                                                '                <div class="col-md-auto text-left">' +
                                                                '                    <label class="mb-2">' +
                                                                '                       -' +
                                                                '                    </label>' +
                                                                '                </div>' +
                                                                '                <div class="col-md-auto text-right">' +
                                                                '                    <label class="SemiBold mb-2">' +
                                                                '                       -' +
                                                                '                    </label>' +
                                                                '                </div>' +
                                                                '            </div>';

                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                hargaTotalFiturTerpilih = eval(hargaFiturTerpilih.join("+"));

                                                                for (var i = 0; i < fiturTerpilih.length; i++) {
                                                                    var ft = fiturTerpilih[i];
                                                                    var hargaFT = hargaFiturTerpilih[i];

                                                                    hasilFiturTambahan +=
                                                                    '            <div class="row justify-content-between">' +
                                                                    '                <div class="col-md-auto text-left">' +
                                                                    '                    <label class="mb-2">' +
                                                                                            ft +
                                                                    '                    </label>' +
                                                                    '                </div>' +
                                                                    '                <div class="col-md-auto text-right">' +
                                                                    '                    <label class="SemiBold mb-2">' +
                                                                                            + hargaFT +
                                                                    '                    </label>' +
                                                                    '                </div>' +
                                                                    '            </div>';
                                                                }

                                                                // $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }

                                                        if($('#rbSemuaHal').is(':checked')){
                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                    $('#jumlahHitamPutih').html(
                                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        rupiah(hargaHitamPutihFinal)
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        rupiah(hargaBerwarnaFinal)
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                                }
                                                                else {
                                                                    $('#jumlahHitamPutih').html(
                                                                        pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        rupiah(hargaHitamPutihFinal)
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        rupiah(hargaBerwarnaFinal)
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                                }
                                                            }
                                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                                    pdf.timbalBalik = 1;
                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        rupiah(hargaHitamPutihFinal)
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        rupiah(hargaBerwarnaFinal)
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                                }
                                                                else {
                                                                    pdf.timbalBalik = 0;
                                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        rupiah(hargaHitamPutihFinal)
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        rupiah(hargaBerwarnaFinal)
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                                }
                                                            }
                                                            else{
                                                                pdf.timbalBalik = 0;
                                                                $('#jumlahHitamPutih').html(
                                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    rupiah(hargaHitamPutihFinal)
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    rupiah(hargaBerwarnaFinal)
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                            }
                                                        }

                                                        else if($('#rbSampaiHal').is(':checked')){
                                                            var batasBawah = 0;
                                                            var batasAtas = 0;
                                                            var jumlahHitamPutihFinal = 0;
                                                            var jumlahBerwarnaFinal = 0;

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                    pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                    pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                    $('#jumlahHitamPutih').html(
                                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                                else {
                                                                    pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                    pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                    $('#jumlahHitamPutih').html(
                                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                                    pdf.timbalBalik = 1;
                                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                                else {
                                                                    pdf.timbalBalik = 0;
                                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            }
                                                            else{
                                                                pdf.timbalBalik = 0;
                                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                        jumlahBerwarnaFinal += 1;
                                                                    }
                                                                    else{
                                                                        jumlahHitamPutihFinal += 1;
                                                                    }
                                                                }

                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                                console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                            }
                                                        }

                                                        else if($('#rbKustomHal').is(':checked')){
                                                            nilaiKustomHal = $('#halamanKustom').val();
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                type: 'GET',
                                                                url: '{{route("halaman.kustom")}}',
                                                                data: {
                                                                    nilaiKustomHal:nilaiKustomHal,
                                                                },
                                                                error: function (xhr, ajaxOptions, thrownError) {
                                                                    alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                                },
                                                                complete: function(hasil){
                                                                },
                                                                success: function (hasil) {
                                                                    var jumlahHitamPutihFinal = 0;
                                                                    var jumlahBerwarnaFinal = 0;

                                                                    pdf.halamanTerpilih = hasil;

                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                            $('#jumlahHitamPutih').html(
                                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                            $('#jumlahHitamPutih').html(
                                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                            );

                                                                            $('#jumlahBerwarna').html(
                                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                            );

                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                                            pdf.timbalBalik = 1;
                                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                        else {
                                                                            pdf.timbalBalik = 0;
                                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                            $('#hargaHitamPutih').html(
                                                                                'Rp. ' + hargaHitamPutihFinal
                                                                            );

                                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                            $('#hargaBerwarna').html(
                                                                                'Rp. ' + hargaBerwarnaFinal
                                                                            );

                                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                        }
                                                                    }
                                                                    else{
                                                                        pdf.timbalBalik = 0;
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                            });
                                                        }

                                                        $('#fiturTambahanTerpilih').html(hasilFiturTambahan);
                                                    }

                                                    pdf.biaya = hargaTotalKonfigurasi;
                                                });
                                            });

                                            $('input[type=radio]').bind('change',(function(){
                                                var related_class=$(this).val();
                                                $('.'+related_class).prop('disabled',false);

                                                if($('#rbSemuaHal').is(':checked')){
                                                    $('#halamanKustom').prop('disabled',true);
                                                    $('#halamanAwal').prop('disabled',true);
                                                    $('#halamanAkhir').prop('disabled',true);
                                                    $('#halamanKustom').val("");

                                                    $('#jumlahHalCetak').html(
                                                        '<label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">' +
                                                            '<i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>' +
                                                            '<label id="jumlahHal">' + nilaiSemuaHalaman + '</label>' +
                                                            ' Halaman yang Akan Dicetak' +
                                                        '</label>'
                                                    );

                                                    for (let i = 1; i <= nilaiSemuaHalaman; i++) {
                                                        pdf.halamanTerpilih = [];
                                                        pdf.halamanTerpilih.push(i);
                                                    }

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        pdf.timbalBalik = 1;
                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            pdf.paksaHitamPutih = 1;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                        else {
                                                            pdf.paksaHitamPutih = 0;

                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            data.jumlahHalamanHitamPutih = pdf['jumlahHalHitamPutih'];
                                                            data.jumlahHalamanBerwarna = pdf['jumlahHalBerwarna'];

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){
                                                        pdf.paksaHitamPutih = 1;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                        else {
                                                            pdf.timbalBalik = 0;
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                rupiah(hargaHitamPutihFinal)
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                rupiah(hargaBerwarnaFinal)
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                        }
                                                    }
                                                    else{
                                                        pdf.timbalBalik = 0;
                                                        pdf.paksaHitamPutih = 0;

                                                        $('#jumlahHitamPutih').html(
                                                            pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                        );

                                                        pdf.jumlahHalamanHitamPutih = pdf['jumlahHalHitamPutih'];
                                                        pdf.jumlahHalamanBerwarna = pdf['jumlahHalBerwarna'];

                                                        hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            rupiah(hargaHitamPutihFinal)
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            rupiah(hargaBerwarnaFinal)
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html(rupiah(hargaTotalKonfigurasi));
                                                    }
                                                }
                                                else if($('#rbSampaiHal').is(':checked')){
                                                    $('#halamanKustom').prop('disabled',true);
                                                    $('#halamanAwal').prop('disabled',false);
                                                    $('#halamanAkhir').prop('disabled',false);
                                                    $('#halamanKustom').val("");

                                                    var batasBawah = 0;
                                                    var batasAtas = 0;
                                                    var jumlahHitamPutihFinal = 0;
                                                    var jumlahBerwarnaFinal = 0;
                                                    var nilaiSampaiHalaman = parseInt($('#halamanAkhir').val()) - parseInt($('#halamanAwal').val());

                                                    $('#halamanAwal').on('change input',function(){
                                                        parseInt($('#halamanAwal').val());
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        range(parseInt($('#halamanAwal').val()),parseInt($('#halamanAkhir').val()),1);

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    });

                                                    $('#halamanAkhir').on('change input',function(){
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAwal').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        range(parseInt($('#halamanAwal').val()),parseInt($('#halamanAkhir').val()),1);

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                $('#jumlahHitamPutih').html(
                                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                $('#jumlahHitamPutih').html(
                                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                );

                                                                $('#jumlahBerwarna').html(
                                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                );

                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                                pdf.timbalBalik = 1;
                                                                hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                            else {
                                                                pdf.timbalBalik = 0;
                                                                hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                $('#hargaHitamPutih').html(
                                                                    'Rp. ' + hargaHitamPutihFinal
                                                                );

                                                                hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                $('#hargaBerwarna').html(
                                                                    'Rp. ' + hargaBerwarnaFinal
                                                                );

                                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                            }
                                                        }
                                                        else{
                                                            pdf.timbalBalik = 0;
                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    });

                                                    if(nilaiSampaiHalaman === 0){
                                                        nilaiSampaiHalaman = 1;
                                                    }
                                                    else{
                                                        nilaiSampaiHalaman += 1;
                                                    }

                                                    $('#jumlahHalCetak').html(
                                                        '<label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">' +
                                                            '<i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>' +
                                                            '<label id="jumlahHal">' + nilaiSampaiHalaman + '</label>' +
                                                            ' Halaman yang Akan Dicetak' +
                                                        '</label>'
                                                    );

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        pdf.timbalBalik = 1;
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                            pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                            pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                            pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            pdf.timbalBalik = 1;
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            pdf.timbalBalik = 0;
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        pdf.timbalBalik = 0;
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                        console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                    }
                                                }
                                                else if($('#rbKustomHal').is(':checked')){

                                                    $('#halamanKustom').prop('disabled',false);
                                                    $('#halamanAwal').prop('disabled',true);
                                                    $('#halamanAkhir').prop('disabled',true);

                                                    pdf.halamanTerpilih = $('#halamanKustom').val();
                                                    // jumlahKustomHal = $('#halamanKustom').val().length;
                                                    jumlahKustomHal = 0;

                                                    $('#jumlahHalCetak').html(
                                                        '<label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">' +
                                                            '<i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>' +
                                                            '<label id="jumlahHal">' + jumlahKustomHal + '</label>' +
                                                            ' Halaman yang Akan Dicetak' +
                                                        '</label>'
                                                    );

                                                    // for (i = parseInt($('#halamanKustom').val()[0]); i <= jumlahKustomHal; i++) {
                                                    //     if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                    //         jumlahBerwarnaFinal += 1;
                                                    //     }
                                                    //     else{
                                                    //         jumlahHitamPutihFinal += 1;
                                                    //     }
                                                    // }

                                                    $('#halamanKustom').on('change input',function(){
                                                        nilaiKustomHal = $('#halamanKustom').val();
                                                        $.ajaxSetup({
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                        $.ajax({
                                                            type: 'GET',
                                                            url: '{{route("halaman.kustom")}}',
                                                            data: {
                                                                nilaiKustomHal:nilaiKustomHal,
                                                            },
                                                            error: function (xhr, ajaxOptions, thrownError) {
                                                                alert('Fungsi Error '+ thrownError +' Silahkan coba kembali');
                                                            },
                                                            complete: function(hasil){
                                                            },
                                                            success: function (hasil) {
                                                                var jumlahHitamPutihFinal = 0;
                                                                var jumlahBerwarnaFinal = 0;

                                                                pdf.halamanTerpilih = hasil;
                                                                jumlahKustomHal = hasil.length;

                                                                $('#jumlahHalCetak').html(
                                                                    '<label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">' +
                                                                    '<i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>' +
                                                                        '<label id="jumlahHal">' + jumlahKustomHal + '</label>' +
                                                                        ' Halaman yang Akan Dicetak' +
                                                                    '</label>'
                                                                );

                                                                if(parseInt(hasil[0]) != 0){
                                                                    for (i = parseInt(hasil[0]); i <= jumlahKustomHal; i++) {
                                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                            jumlahBerwarnaFinal += 1;
                                                                        }
                                                                        else{
                                                                            jumlahHitamPutihFinal += 1;
                                                                        }
                                                                    }
                                                                }

                                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                                    pdf.timbalBalik = 1;
                                                                    if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                        pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                        pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                        $('#jumlahHitamPutih').html(
                                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                    else {
                                                                        pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                        pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                        $('#jumlahHitamPutih').html(
                                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                        );

                                                                        $('#jumlahBerwarna').html(
                                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                        );

                                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                                else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;
                                                                    pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                                    pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                                    $('#jumlahHitamPutih').html(
                                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                                    );

                                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                                        pdf.timbalBalik = 1;
                                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                    else {
                                                                        pdf.timbalBalik = 0;
                                                                        hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                                        $('#hargaHitamPutih').html(
                                                                            'Rp. ' + hargaHitamPutihFinal
                                                                        );

                                                                        hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                                        $('#hargaBerwarna').html(
                                                                            'Rp. ' + hargaBerwarnaFinal
                                                                        );

                                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                    }
                                                                }
                                                                else{
                                                                    pdf.timbalBalik = 0;
                                                                    pdf.jumlahHalamanHitamPutih = jumlahHitamPutihFinal;
                                                                    pdf.jumlahHalamanBerwarna = jumlahBerwarnaFinal;

                                                                    $('#jumlahHitamPutih').html(
                                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                                    );

                                                                    $('#jumlahBerwarna').html(
                                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                                    );

                                                                    hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                                    $('#hargaHitamPutih').html(
                                                                        'Rp. ' + hargaHitamPutihFinal
                                                                    );

                                                                    hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                                    $('#hargaBerwarna').html(
                                                                        'Rp. ' + hargaBerwarnaFinal
                                                                    );

                                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                                }
                                                            },
                                                        });
                                                    });
                                                }

                                                $('input[type=radio]').not(':checked').each(function(){
                                                    var other_class=$(this).val();
                                                    $('.'+other_class).prop('disabled',true);
                                                });

                                                pdf.biaya = hargaTotalKonfigurasi;
                                            }));

                                            $('#catatanTambahanArea').on('change input',(function(){
                                                pdf.catatanTambahan = $('#catatanTambahanArea').val();
                                            }));

                                            $('#simpanDanLanjutkan').on('click',(function(){
                                                $('#jumlahHalamanHitamPutih').val(pdf.jumlahHalamanHitamPutih);
                                                $('#jumlahHalamanBerwarna').val(pdf.jumlahHalamanBerwarna);
                                                if($('#rbSemuaHal').is(':checked')){
                                                    pdf.statusHalaman = $('#rbSemuaHal').val();
                                                    $('#statusHalaman').val(pdf.statusHalaman);
                                                }
                                                else if($('#rbSampaiHal').is(':checked')){
                                                    pdf.statusHalaman = $('#rbSampaiHal').val();
                                                    $('#statusHalaman').val(pdf.statusHalaman);
                                                }
                                                else{
                                                    pdf.statusHalaman = $('#rbKustomHal').val();
                                                    $('#statusHalaman').val(pdf.statusHalaman);
                                                }
                                                $('#halamanTerpilih').val(pdf.halamanTerpilih);
                                                $('#jumlahSalinan').val(pdf.jumlahSalinan);
                                                $('#paksaHitamPutih').val(pdf.paksaHitamPutih);
                                                $('#timbalBalik').val(pdf.timbalBalik);
                                                $('#biaya').val(pdf.biaya);
                                                $('#catatanTambahan').val(pdf.catatanTambahan);
                                                $('#fiturTerpilih').val(JSON.stringify(pdf.fiturTerpilih));
                                                $('#konfigurasiForm').submit();
                                            }));

                                            function range(start, stop, step) {
                                                pdf.halamanTerpilih = [start], b = start;
                                                while (b < stop) {
                                                    pdf.halamanTerpilih.push(b += step || 1);
                                                }
                                                return pdf.halamanTerpilih;
                                            }

                                            // function kustomHal(val) {
                                            //     var hh = val;
                                            //     var hasil = [];
                                            //     hh.split("/[\s,,]+/",hh.length);

                                            //     for(i = 0; i < hh.length; i++){
                                            //         if(hh[i].indexOf("-") != false){
                                            //             var kk = "";
                                            //             kk.split("-",hh[i].length);
                                            //             for(j = kk[0]; j<= kk[1]; j++){
                                            //                 hasil.push(j);
                                            //             }
                                            //         }
                                            //         else{
                                            //             hasil.push(hh[i]);
                                            //         }
                                            //     }
                                            // }
                                    }
                                });
                        });
                    });

                    function showPopUpHelpFitur(value) {
                        $('#helpFitur' + value).popover('show');
                    }

                    function hidePopUpHelpFitur(value) {
                        $('#helpFitur' + value).popover('hide');
                    }
                </script>
            </form>
        @endif
        <div id="hasil">
        </div>
    </div>
</div>
@endsection
