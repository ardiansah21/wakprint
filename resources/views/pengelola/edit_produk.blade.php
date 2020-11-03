@php
// echo json_encode(($produk->getMedia('foto_produk'))[0]->getUrl());
// dd(
// // ($produk->getMedia('foto_produk'))[0]->getUrl()
// // ($produk->getMedia('foto_produk'))

// );
$fitur = json_decode($produk->fitur);
// dd($fitur);
$namaFiturArr = ((collect($fitur))->pluck('nama'))->toArray();

function getCF($produk, string $nama){
$fitur = json_decode($produk->fitur);
try { $hasil = collect((collect($fitur)->where('nama', $nama))[0]); return $hasil;
} catch (\Throwable $th) {return collect();}
}
@endphp

@extends('layouts.pengelola')

@section('content')
<script>
    $(".dropzone, .dz-preview, .dz-image-preview").css("background","#EBD1EC");
    $(".dz-remove").text("Hapus Gambar");
    $(".dz-remove").css({"margin-top" : "10px", "color" : "#000","font-weight": "bold"});
</script>
<div class="container mt-5 mb-5" style="font-size: 16px;">
    <form action="{{ route('partner.produk.update',['produk'=>$produk->id_produk]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}
        <div class="row justify-content-between ml-0 mr-0">
            <label class="font-weight-bold mb-4" style="font-size:36px;">
                {{__('Edit Produk') }}
            </label>
            <!-- Rounded switch -->
            <label class="switch mb-5">
                <input type="checkbox" name="status" value="Tersedia" checked>
                <span class="slider round"></span>
            </label>
        </div>
        <label class="mb-2 h4 font-weight-bold">
            {{__('Foto Produk') }}
        </label>
        <div class="needsclick dropzone mb-3" id="document-dropzone"
            style=" border:1px solid #EBD1EC; border-radius:10px; color: #BC41BE; background-color:#EBD1EC;">
            <div class="dz-message" data-dz-message style="font-size: 18px;">
                <span>{{__('Klik atau Tarik Foto Produk Anda Disini') }}</span>
            </div>
        </div>
        {{-- <div class="scrolling-wrapper mb-0"> --}}
        <div class="row justify-content-left" style="height:200px;" hidden>
            <div class="col-md-auto" style="position: relative">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                    class="img-responsive bg-light" style="width:250px;
                                border-radius:10px;">
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-yellow font-weight-bold pl-4 pr-4 mb-0"
                        style="position: relative; font-size:16px;bottom: 50px;left:110px;right: 0px;border-radius:30px;">
                        {{__('Pilih Foto') }}
                    </button>
                </div>
            </div>
            <div class="col-md-2 align-self-center mb-5">
                <button class="btn btn-circle shadow-sm" role="button">
                    <i class="material-icons md-36 align-middle" style="color: white; margin-left:-7px;">
                        add
                    </i>
                </button>
            </div>
        </div>
        {{-- </div> --}}

        <label class="mb-2 h4 font-weight-bold">
            {{__('Nama Produk') }}
        </label>
        <div class="form-group mb-4">
            <input name="nama" type="text" class="form-control form-control-lg mr-0" placeholder="Masukkan Nama Produk"
                value="{{$produk->nama}}" aria-label="Masukkan Nama Produk" aria-describedby="inputGroup-sizing-sm"
                style="font-size:16px;" required>
        </div>

        <label class="mb-2 h4 font-weight-bold">
            {{__('Harga Produk') }}
        </label>
        <div class="py-2 px-3 mb-4" style="border:1px solid #EBD1EC; border-radius:10px; background-color:white;">
            <div class="custom-control custom-checkbox col-md-3 mb-2">
                <input name="hitam_putih" type="checkbox" class="custom-control-input" id="checkboxHitamPutih"
                    onchange="document.getElementById('harga_hitam_putih').disabled=!this.checked; document.getElementById('harga_timbal_balik_hitam_putih').disabled=!this.checked;"
                    @if ($produk->hitam_putih) value="True" checked @endif
                >
                <label class="custom-control-label" for="checkboxHitamPutih">
                    {{__('Hitam-Putih') }}
                </label>
            </div>
            <div class="row justify-content-left mb-2">
                <label class="col-md-3 align-self-center ml-4 mt-2">
                    {{__('Harga Cetak') }}
                </label>
                <div class="row justify-content-left col-md-9"
                    onclick="if(document.getElementById('harga_hitam_putih').disabled){document.getElementById('checkboxHitamPutih').click();document.getElementById('harga_timbal_balik_hitam_putih').focus() };">
                    <label class="col-md-1 mt-2 mb-2"
                        style="display: inline-block; width: 10%; text-align: left; padding-right:8px">
                        {{__('Rp') }}
                    </label>
                    <input id="harga_hitam_putih" name="harga_hitam_putih" type="number" min="0"
                        value="{{$produk->harga_hitam_putih}}"
                        class="col-md-9 form-control pt-2 pb-2 optional-step-100 mr-0"
                        placeholder="Masukkan Harga Produk" aria-label="Masukkan Harga Produk"
                        aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; width:90%"
                        @if(!$produk->hitam_putih) disabled @endif required >
                    <label class="col-md-2 align-middle mt-2 mb-2"
                        style="display: inline-block; width: 10%; text-align: left; padding-right:8px">
                        {{__('/ Halaman') }}
                    </label>
                </div>
            </div>
            <div class="row justify-content-left mb-2">
                <label class="col-md-3 align-self-center ml-4 mt-2">
                    {{__('Harga Cetak Timbal Balik') }}
                </label>
                <div class="row justify-content-left col-md-9"
                    onclick="if(document.getElementById('harga_timbal_balik_hitam_putih').disabled){document.getElementById('checkboxHitamPutih').click();document.getElementById('harga_timbal_balik_hitam_putih').focus() };">
                    <label class="col-md-1 mt-2 mb-2"
                        style="display: inline-block; width: 10%; text-align: left; padding-right:8px">
                        {{__('Rp') }}
                    </label>
                    <input id="harga_timbal_balik_hitam_putih" name="harga_timbal_balik_hitam_putih" type="number"
                        value="{{$produk->harga_timbal_balik_hitam_putih}}" min="0"
                        class="col-md-9 form-control pt-2 pb-2 optional-step-100 mr-0"
                        placeholder="Masukkan Harga Produk" aria-label="Masukkan Harga Produk"
                        aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; width:90%"
                        @if(!$produk->hitam_putih) disabled @endif
                    >
                    <label class="col-md-2 align-middle mt-2 mb-2"
                        style="display: inline-block; width: 10%; text-align: left; padding-right:8px">
                        {{__('/ Halaman') }}
                    </label>
                </div>
            </div>
            <div class="custom-control custom-checkbox col-md-3 mb-2">
                <input name="berwarna" type="checkbox" class="custom-control-input" id="checkboxBerwarna"
                    onchange="document.getElementById('harga_berwarna').disabled=!this.checked; document.getElementById('harga_timbal_balik_berwarna').disabled=!this.checked;"
                    @if ($produk->berwarna) value="True" checked @endif
                >
                <label class="custom-control-label" for="checkboxBerwarna">
                    {{__('Berwarna') }}
                </label>
            </div>
            <div class="row justify-content-left mb-2">
                <label class="col-md-3 align-self-center ml-4 mt-2">
                    {{__('Harga Cetak') }}
                </label>
                <div class="row justify-content-left col-md-9"
                    onclick="if(document.getElementById('harga_berwarna').disabled){document.getElementById('checkboxBerwarna').click();document.getElementById('harga_berwarna').focus() };">
                    <label class="col-md-1 mt-2 mb-2"
                        style="display: inline-block; width: 10%; text-align: left; padding-right:8px">
                        {{__('Rp') }}
                    </label>
                    <input id="harga_berwarna" name="harga_berwarna" type="number" min="0"
                        value="{{$produk->harga_berwarna}}"
                        class="col-md-9 form-control pt-2 pb-2 optional-step-100 mr-0"
                        placeholder="Masukkan Harga Produk" aria-label="Masukkan Harga Produk"
                        @if(!$produk->berwarna)disabled @endif
                    aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; width:90%" required>
                    <label class="col-md-2 align-middle mt-2 mb-2"
                        style="display: inline-block; width: 10%; text-align: left; padding-right:8px">
                        {{__('/ Halaman') }}
                    </label>
                </div>
            </div>
            <div class="row justify-content-left mb-2">
                <label class="col-md-3 align-self-center ml-4 mt-2">
                    {{__('Harga Cetak Timbal Balik') }}
                </label>
                <div class="row justify-content-left col-md-9"
                    onclick="if(document.getElementById('harga_timbal_balik_berwarna').disabled){document.getElementById('checkboxBerwarna').click();document.getElementById('harga_timbal_balik_berwarna').focus() };">
                    <label class="col-md-1 mt-2 mb-2"
                        style="display: inline-block; width: 10%; text-align: left; padding-right:8px">
                        {{__('Rp') }}
                    </label>
                    <input id="harga_timbal_balik_berwarna" name="harga_timbal_balik_berwarna" type="number" min="0"
                        value="{{$produk->harga_timbal_balik_berwarna}}"
                        class="col-md-9 form-control pt-2 pb-2 optional-step-100 mr-0"
                        placeholder="Masukkan Harga Produk" aria-label="Masukkan Harga Produk" @if(!$produk->berwarna)
                    disabled @endif
                    aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; width:90%">
                    <label class="col-md-2 align-middle mt-2 mb-2"
                        style="display: inline-block; width: 10%; text-align: left; padding-right:8px">
                        {{__('/ Halaman') }}
                    </label>
                </div>
            </div>
        </div>
        <label class="mb-2 h4 font-weight-bold">
            {{__('Deskripsi Produk') }}
        </label>
        <div class="form-group mb-4">
            <textarea name="deskripsi" class="form-control" aria-label="Deskripsi Produk"
                placeholder="Masukkan Deskripsi Produk Anda">{{$produk->deskripsi}}</textarea>
        </div>
        <div class="row justify-content-between mb-4">
            <div class="form-group col-md-6">
                <label class="font-weight-bold h4 mb-2">
                    {{__('Kertas') }}
                </label>
                <div class="dropdown" aria-required="true">
                    <input name="jenis_kertas" type="text" id="ukuranKertas" Class="form-control"
                        value="{{$produk->jenis_kertas}}" hidden>
                    <button id="ukuranKertasButton"
                        class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                        id="dropdownKertas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;
                            text-align:left;">
                        {{$produk->jenis_kertas }}
                    </button>
                    @php
                    $ukuranKertas= array('A4HVS70gr', 'A4HVS80gr', 'A3HVS70gr', 'A3HVS80gr', 'F4HVS70gr', 'F4HVS80gr',
                    'LegalHVS70gr', 'LegalHVS80gr', 'LetterHVS70gr', 'LeterHVS80gr');
                    @endphp
                    <div id="ukuranKertasList" class="dropdown-menu" aria-labelledby="dropdownKertas"
                        style="font-size: 16px; width:100%;">
                        @foreach ( $ukuranKertas as $kertas)
                        <span class="dropdown-item cursor-pointer ">
                            {{$kertas}}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="font-weight-bold h4 mb-2">
                    {{__('Printer') }}
                </label>
                <div class="dropdown">
                    <input name="jenis_printer" type="text" id="jenisPrinter" Class="form-control"
                        value="{{$produk->jenis_printer}}" hidden>
                    <button id="jenisPrinterButton"
                        class="btn is-flex btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                        id="dropdownPrinter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;
                                text-align:left;">
                        {{$produk->jenis_printer}}
                    </button>
                    <div id="jenisPrinterList" class="dropdown-menu" aria-labelledby="dropdownPrinter" style="font-size: 16px;
                                width:100%">
                        <span class="dropdown-item ">
                            {{__('Ink Jet') }}
                        </span>
                        <span class="dropdown-item cursor-pointer">
                            {{__('Laser Jet') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <label class="mb-3 h4 font-weight-bold">
            {{__('Fitur Produk') }}
        </label>
        <div class="row justify-content-between mb-2 ml-0 mr-0">
            <div class="form-group custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkboxKliping"
                    @if(getCF($produk,'Kliping')->get('nama')=='Kliping')checked @endif
                onchange="document.getElementById('kliping').disabled=!this.checked;">
                <label class="custom-control-label" for="checkboxKliping">
                    {{__('Kliping') }}
                    <i class="material-icons md-18 align-middle" style="color:#C4C4C4">
                        help
                    </i>
                </label>
            </div>
            <div class="row col-md-5"
                onclick="if(document.getElementById('kliping').disabled){document.getElementById('checkboxKliping').click();document.getElementById('kliping').focus() };">
                <label class="align-self-center"
                    style=" display: inline-block; width: 10%; text-align: right; padding-right:8px">
                    {{__('Rp') }}
                </label>
                <input id="kliping" name="fitur[Kliping]" type="number" min="0"
                    value="{{getCF($produk,'Kliping')->get('harga')}}" class="form-control pt-2 pb-2 optional-step-100"
                    placeholder="Masukkan Harga Produk" aria-label="Masukkan Harga Produk"
                    aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; width:90%" required
                    @if(getCF($produk,'Kliping')->get('nama')==null)disabled @endif
                >
            </div>
        </div>
        <div class="row justify-content-left mb-2 ml-0">
            <label class="h5">
                {{__('Jilid') }}
            </label>
        </div>
        @php
        $paket = array('Lem','Baut','Kawat','Spiral');
        @endphp
        @foreach ($paket as $p)
        @php
        $key = array_search($p, array_column($fitur, 'nama'));
        if (false !== $key){$f[$p] = $fitur[$key];}
        @endphp
        <div class="form-group row justify-content-between mb-3 ml-2 mr-0">
            <div class="col-md-6 custom-control custom-checkbox ml-3">
                <input name="" type="checkbox" class="custom-control-input" id="checkbox{{ $p }}"
                    @if(in_array($p,$namaFiturArr)) checked @endif
                    onchange="document.getElementById('{{ $p }}').disabled=!this.checked; ">
                <label class="custom-control-label" for="checkbox{{$p}}">
                    {{$p}}
                    <i class="material-icons md-18 align-middle" style="color:#C4C4C4">
                        help
                    </i>
                </label>
            </div>
            <div class="row col-md-5"
                onclick="if(document.getElementById('{{ $p }}').disabled){document.getElementById('checkbox{{ $p }}').click();document.getElementById('{{ $p }}').focus() };">
                <label class="align-self-center"
                    style=" display: inline-block; width: 10%; text-align: right; padding-right:8px">
                    {{__('Rp') }}
                </label>
                <input id="{{ $p }}" name="fitur[{{ $p }}]" min="0" type="number" value="{{$f[$p]->harga ?? ''}}"
                    class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga Produk"
                    aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm"
                    style="font-size: 16px; width:90%" required @if(!in_array($p,$namaFiturArr))disabled @endif>
            </div>
        </div>

        @endforeach
        @php
        $nonPaket = array('Hekter','Tulang Kliping','Penjepit Kertas','Plastik Transparan','Kertas Jeruk');
        @endphp
        @foreach ($nonPaket as $np)
        @php
        $nkey = array_search($np, array_column($fitur, 'nama'));
        if (false !== $nkey){$nf[$np] = $fitur[$nkey];}
        @endphp
        <div class="row justify-content-between mb-3 ml-0 mr-0">
            <div class="col-md-6 custom-control custom-checkbox ml-0">
                <input name="" type="checkbox" class="custom-control-input" id="checkbox{{ $np }}"
                    @if(in_array($np,$namaFiturArr)) checked @endif
                    onchange="document.getElementById('{{ $np }}').disabled=!this.checked; ">
                <label class="custom-control-label" for="checkbox{{$np}}">
                    {{$np}}
                    <i class="material-icons md-18 align-middle" style="color:#C4C4C4">
                        help
                    </i>
                </label>
            </div>
            <div class="row col-md-5"
                onclick="if(document.getElementById('{{ $np }}').disabled){document.getElementById('checkbox{{ $np }}').click();document.getElementById('{{ $np }}').focus() };">
                <label class="align-self-center"
                    style=" display: inline-block; width: 10%; text-align: right; padding-right:8px">
                    {{__('Rp') }}
                </label>
                <input id="{{ $np }}" name="fitur[{{ $np }}]" type="number" min="0" value="{{$nf[$np]->harga ?? ''}}"
                    class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga Produk"
                    aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm"
                    style="font-size: 16px; width:90%" required @if(!in_array($np,$namaFiturArr))disabled @endif>
            </div>
        </div>
        @endforeach
        <hr class="mt-4">
        <label class="mb-4 ml-0 h4 mt-2 font-weight-bold ">
            {{__('Fitur Tambahan Anda') }}
        </label>
        {{-- @php
$FiturGabung = array_merge($paket,$nonPaket);
array_push($FiturGabung,'Kliping');

$arrFiturTambah = array();
foreach ($namaFiturArr as $key => $value) {
if (!in_array($value, $FiturGabung)) {
$tkey = array_search($value, array_column($fitur, 'nama'));
if (false !== $tkey){
$f[$p] = $fitur[$tkey];
}
}
}

@endphp --}}


        <ul id="areaTambah" class="mr-0" style="margin-left:-50px;list-style-type: none;">
            @php
            $FiturGabung = array_merge($paket,$nonPaket);
            array_push($FiturGabung,'Kliping');
            $arrFiturTambah = array();
            $i = 0;
            @endphp

            @foreach ($namaFiturArr as $key => $value)
            @if (!in_array($value, $FiturGabung))
            @php
            $i++;
            $tkey = array_search($value, array_column($fitur, 'nama'));
            if (false !== $tkey) {$f[$i] = $fitur[$tkey];}
            // echo $f[$i]->foto_fitur . " " .$i;
            @endphp
            <li class="ml-0 mr-0">
                <div class="row justify-content-between mb-2 ml-0" style="list-style-position: inside">
                    <div class="col-md-2">
                        <img id="blah{{$i}}"
                            src="{{$f[$i]->foto_fitur ?? 'https://via.placeholder.com/163/BC41BE/fff.png?text=Fitur'}}"
                            {{-- onerror="this.onerror=null; this.src='https:\/\/via.placeholder.com\/163/BC41BE\/fff.png?text=Fitur'" --}}
                            class="img-responsive bg-light" style="width:163px;height:163px;border-radius:10px; "
                            alt="foto produk">
                        <a id="editGambarProduk" class="pointer"
                            onclick="document.getElementById('imgupload{{$i}}').click();"
                            style="color: black; position: relative;bottom: 40px;left:130px;right: 0px;">
                            <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2"
                                style="border-radius: 5px;">
                                edit
                            </i>
                        </a>
                        <input type="text" value="{{$f[$i]->uniqid}}" hidden name="fitur[tambahan][{{$i}}][uniqid]">
                        <input id="imgupload{{$i}}" type="file" name="fitur[tambahan][{{$i}}][foto_fitur]" value="''"
                            hidden accept="image/png, image/jpeg" onchange="
                            document.getElementById('blah{{$i}}').src=window.URL.createObjectURL(this.files[0]);">
                    </div>
                    <div class="col-md-9">
                        <div class="row justify-content-between mr-1">
                            <div class="col-md-6 form-group mb-3"> <input name="fitur[tambahan][{{$i}}][nama]" id="nama"
                                    value="{{$f[$i]->nama}}" type="text" class="form-control form-control-lg pt-2 pb-2"
                                    placeholder="Masukkan Nama Paket" aria-label=""
                                    aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; " required="">
                            </div>
                            <div class="row col-md-6 form-group "> <label class="align-self-center"
                                    style=" display: inline-block; width: 10%; text-align: right; padding-right:8px"> Rp
                                </label>
                                <input id="harga" name="fitur[tambahan][{{$i}}][harga]" type="number" min="0"
                                    value="{{$f[$i]->harga}}" class="form-control pt-2 pb-2 optional-step-100"
                                    placeholder="Masukkan Harga Produk" aria-label="Masukkan Harga Produk"
                                    aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; width:90%"
                                    required="">
                            </div>
                        </div> <label class="mb-2 "> Deskripsi Fitur </label>
                        <div class="form-group mb-4 mr-0"> <textarea id="deskripsi"
                                name="fitur[tambahan][{{$i}}][deskripsi]" class="form-control d-flex"
                                aria-label="Deskripsi Fitur"
                                placeholder="Masukkan Deskripsi Paket Tambahan Anda">{{$f[$i]->deskripsi ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-auto align-self-center mr-0 mb-3"> <button id="hapus"
                            class="btn btn-circle-trash shadow-sm" type="button" role="button"> <i
                                class="fa fa-trash fa-2x" style="color: white" aria-hidden="true"></i>
                        </button> </div>
                </div>
            </li>
            @endif
            @endforeach

        </ul>
        <button id="tambahPaket" type="button" class="btn btn-primary-yellow btn-block center SemiBold mt-2 mb-5">
            Tambah Fitur
        </button>
        <div class="row justify-content-end mr-0 mb-5">
            <div class="mr-3">
                <button id="tes" type="reset"
                    class="btn btn-default btn-lg text-primary-danger font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px;
                            font-size:18px;">
                    {{__('Batalkan Perubahan') }}
                </button>
            </div>
            <div class="mr-0">
                <button type="submit" class="btn btn-lg btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px;
                            font-size:18px;">
                    {{__('Simpan Perubahan') }}
                </button>
            </div>
        </div>
    </form>
</div>


{{-- <li class="ml-0 mr-0">
    <div class="row justify-content-between mb-2 ml-0" style="list-style-position: inside">
        <div class="col-md-2">
            <img id="blah" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                class="img-responsive bg-light" style="width:163px;height:163px;border-radius:10px;" alt="foto produk">
            <a id="editGambarProduk" class="pointer" onclick="document.getElementById('imgupload').click();"
                style="color: black; position: relative;bottom: 40px;left:130px;right: 0px;">
                <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2" style="border-radius: 5px;"> edit
                </i>
            </a>
            <input id="imgupload" type="file" name="fotoProduk" hidden accept="image/png, image/jpeg"
                onchange="document.getElementById('blah').src=window.URL.createObjectURL(this.files[0]);" hidden>
        </div>
        <div class="col-md-9">
            <div class="row justify-content-between mr-1">
                <div class="col-md-6 form-group mb-3">
                    <input name="fitur[tambahan]['+i+'][nama]" id="nama" type="text"
                        class="form-control form-control-lg pt-2 pb-2" placeholder="Masukkan Nama Paket" aria-label=""
                        aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; " required>
                </div>
                <div class="row col-md-6 form-group "> <label class="align-self-center"
                        style=" display: inline-block; width: 10%; text-align: right; padding-right:8px"> Rp </label>
                    <input id="harga" name="fitur[tambahan]['+i+'][harga]" type="number" min="0"
                        class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga Produk"
                        aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm"
                        style="font-size: 16px; width:90%" required> </div>
            </div>
            <label class="mb-2 "> Deskripsi Fitur </label>
            <div class="form-group mb-4 mr-0">
                <textarea id="deskripsi" name="fitur[tambahan]['+i+'][deskripsi]" class="form-control d-flex"
                    aria-label="Deskripsi Fitur" placeholder="Masukkan Deskripsi Paket Tambahan Anda"> </textarea>
            </div>
        </div>
        <div class="col-md-auto align-self-center mr-0 mb-3">
            <button id="hapus" class="btn btn-circle-trash shadow-sm" type="button" role="button">
                <i class="fa fa-trash fa-2x" style="color: white" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</li> --}}



{{-- <script>
    $('#tes').on('click', function () {
    var APP_URL = {!! json_encode(url('/')) !!}
    alert(APP_URL);
});





</script> --}}
@endsection
@section('script')
<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
      url: '{{ route('partner.produk.storeMedia') }}',
      maxFilesize: 3, // MB
      addRemoveLinks: true,
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      success: function (file, response) {
        $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
        uploadedDocumentMap[file.name] = response.name
      },
      removedfile: function (file) {
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
          name = file.file_name
        } else {
          name = uploadedDocumentMap[file.name]
        }
        $('form').find('input[name="document[]"][value="' + name + '"]').remove()
      },
      init: function () {
      @if(isset($produk) && $produk->getMedia('foto_produk'))
        var files =
          {!! json_encode($produk->getMedia('foto_produk')) !!}
        for (var i in files) {
            var file = files[i]
            var fileUrl = "/storage"+"/"+file.id+"/"+file.file_name

          this.options.addedfile.call(this, file);
          this.options.thumbnail.call(this, file, fileUrl)
            {
            $('[data-dz-thumbnail]').css('height', '120');
            $('[data-dz-thumbnail]').css('width', '120');
            $('[data-dz-thumbnail]').css('object-fit', 'cover');

           };
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
        }
      @endif
    }

    }

    $('#jenisPrinterList span').on('click', function () {
    $('#jenisPrinterButton').text($(this).text());
    $('#jenisPrinter').val($(this).text());
});

$('#ukuranKertasList span').on('click', function () {
    $('#ukuranKertasButton').text($(this).text());
    $('#ukuranKertas').val($(this).text());
});

$(document).ready(function() {
 var i = "{{$i}}";
 $("#tambahPaket").click(function() {
     i++;
     alert(i);
     $("#areaTambah").append(
        '<li class="ml-0 mr-0">'+
        '    <div class="row justify-content-between mb-2 ml-0" style="list-style-position: inside">'+
        '        <div class="col-md-2">'+
        '            <img id="blah'+i+'" src="https://via.placeholder.com/163/BC41BE/fff.png?text=Fitur"'+
        '                class="img-responsive bg-light" style="width:163px;height:163px;border-radius:10px; " alt="foto produk">'+
        '            <a id="editGambarProduk" class="pointer" onclick="document.getElementById(\'imgupload'+i+'\').click();"'+
        '                style="color: black; position: relative;bottom: 40px;left:130px;right: 0px;">'+
        '                <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2" style="border-radius: 5px;"> edit'+
        '                </i>'+
        '            </a>'+
        '            <input id="imgupload'+i+'" type="file" name="fitur[tambahan]['+i+'][foto_fitur]" hidden accept="image/png, image/jpeg"'+
        '                onchange="document.getElementById(\'blah'+i+'\').src=window.URL.createObjectURL(this.files[0]);" hidden>'+
        '        </div>'+
        '        <div class="col-md-9">'+
        '            <div class="row justify-content-between mr-1">'+
        '                <div class="col-md-6 form-group mb-3">'+
        '                    <input name="fitur[tambahan]['+i+'][nama]" id="nama" type="text"'+
        '                        class="form-control form-control-lg pt-2 pb-2" placeholder="Masukkan Nama Paket" aria-label=""'+
        '                        aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; " required>'+
        '                </div>'+
        '                <div class="row col-md-6 form-group "> <label class="align-self-center"'+
        '                        style=" display: inline-block; width: 10%; text-align: right; padding-right:8px"> Rp </label>'+
        '                    <input id="harga" name="fitur[tambahan]['+i+'][harga]" type="number" min="0"'+
        '                        class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga Produk"'+
        '                        aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm"'+
        '                        style="font-size: 16px; width:90%" required> </div>'+
        '            </div>'+
        '            <label class="mb-2 "> Deskripsi Fitur </label>'+
        '            <div class="form-group mb-4 mr-0">'+
        '                <textarea id="deskripsi" name="fitur[tambahan]['+i+'][deskripsi]" class="form-control d-flex"'+
        '                    aria-label="Deskripsi Fitur" placeholder="Masukkan Deskripsi Paket Tambahan Anda"></textarea>'+
        '            </div>'+
        '        </div>'+
        '        <div class="col-md-auto align-self-center mr-0 mb-3">'+
        '            <button id="hapus" class="btn btn-circle-trash shadow-sm" type="button" role="button">'+
        '                <i class="fa fa-trash fa-2x" style="color: white" aria-hidden="true"></i>'+
        '            </button>'+
        '        </div>'+
        '    </div>'+
        '</li>'
        );
        i++;
    });

    $("#areaTambah").on("click","#hapus",function(){
        $($(this).parents('li').get(0)).remove();
    });

    $("#areaTambah").on("click","#editGambarProduk",function(){
        $('#imgupload').trigger('click'); return false;
    });

    $("#areaTambah").on("change","#imgupload",function(){
        document.getElementById('blah').src=window.URL.createObjectURL(this.files[0]);
    });

});

</script>
@endsection
