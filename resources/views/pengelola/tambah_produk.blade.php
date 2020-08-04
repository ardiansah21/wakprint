@extends('layouts.pengelola')

@section('content')
<div class="container mt-5 mb-5" style="font-size: 16px;">
    <form action="{{ route('partner.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-between ml-0 mr-0">
            <label class="font-weight-bold mb-4" style="font-size:36px;">
                {{__('Tambah Produk') }}
            </label>
            <!-- Rounded switch -->
            <label class="switch mb-5">
                <input type="checkbox" name="status" value="Tersedia" checked>
                <span class="slider round"></span>
            </label>
        </div>

        <label class="mb-2 h4 font-weight-bold" style="font-size: 16px;">
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
                aria-label="Masukkan Nama Produk" aria-describedby="inputGroup-sizing-sm" style="font-size:16px;"
                required>
        </div>
        <div class="row justify-content-between mb-4">
            <div class="col-md-6">
                <label class="mb-2 h4 font-weight-bold">
                    {{__('Harga Produk') }}
                </label>
                <div class="row justify-content-left mb-2">
                    <label class="col-md-1 mt-2 mb-2"
                        style="display: inline-block; width: 10%; text-align: left; padding-right:8px">
                        {{__('Rp') }}
                    </label>
                    <input name="harga" type="number" step="50" min="0"
                        class="col-md-9 form-control pt-2 pb-2 optional-step-100 mr-0"
                        placeholder="Masukkan Harga Produk" aria-label="Masukkan Harga Produk"
                        aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; width:90%" required>
                    <label class="col-md-2 align-middle mt-2 mb-2"
                        style="display: inline-block; width: 10%; text-align: left; padding-right:8px">
                        {{__('/ Lbr') }}
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <label class="mb-2 h4 font-weight-bold">
                    {{__('Harga Produk (Timbal Balik)') }}
                </label>
                <div class="row justify-content-left mb-2">
                    <label class="col-md-1 mt-2 mb-2"
                        style="display: inline-block; width: 10%; text-align: left; padding-right:8px">
                        {{__('Rp') }}
                    </label>
                    <input name="harga_timbal_balik" type="number" step="50" min="0"
                        class="col-md-9 form-control pt-2 pb-2 optional-step-100 mr-0"
                        placeholder="Masukkan Harga Produk (Timbal Balik)" aria-label="Masukkan Harga Produk"
                        aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; width:90%" required>
                    <label class="col-md-2 align-middle mt-2 mb-2"
                        style="display: inline-block; width: 10%; text-align: left; padding-right:8px">
                        {{__('/ Lbr') }}
                    </label>
                </div>
            </div>
        </div>
        <label class="mb-2 h4 font-weight-bold">
            {{__('Deskripsi Produk') }}
        </label>
        <div class="form-group mb-4">
            <textarea name="deskripsi" class="form-control" aria-label="Deskripsi Produk"
                placeholder="Masukkan Deskripsi Produk Anda"></textarea>
        </div>
        <label class="mb-3 h4 font-weight-bold">
            {{__('Fitur Utama') }}
        </label>
        <div class="row justify-content-between mb-4">
            <div class="form-group col-md-4">
                <label class="font-weight-bold mb-2" style="font-size:14px;">
                    {{__('Kertas') }}
                </label>
                <div class="dropdown">
                    <input name="jenis_kertas" type="text" id="ukuranKertas" Class="form-control" hidden>
                    <button id="ukuranKertasButton"
                        class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                        id="dropdownKertas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;
                            text-align:left;">
                        {{__('Jenis Pilih Kertas') }}
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
            <div class="form-group col-md-4">
                <label class="font-weight-bold mb-2" style="font-size: 14px;">
                    {{__('Printer') }}
                </label>
                <div class="dropdown">
                    <input name="jenis_printer" type="text" id="jenisPrinter" Class="form-control" hidden>
                    <button id="jenisPrinterButton"
                        class="btn is-flex btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                        id="dropdownPrinter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;
                                text-align:left;">
                        {{__('Jenis Pilih Printer') }}
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
            <div class="form-group col-md-4">
                <label class="font-weight-bold mb-2" style="font-size: 14px;">
                    {{__('Warna Cetak') }}
                </label>
                <div class="row justify-content-left mb-2">
                    <div class="custom-control custom-checkbox mt-2 ml-3">
                        <input name="hitam_putih" type="checkbox" class="custom-control-input" id="checkboxHitamPutih"
                            value="True" checked>
                        <label class="custom-control-label" for="checkboxHitamPutih">
                            {{__('Hitam-Putih') }}
                        </label>
                    </div>
                    <div class="custom-control custom-checkbox mt-2 ml-4">
                        <input name="berwarna" type="checkbox" class="custom-control-input" id="checkboxWarna"
                            value="True" checked>
                        <label class="custom-control-label" for="checkboxWarna">
                            {{__('Berwarna') }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <label class="mb-3 h4 font-weight-bold">
            {{__('Paket Produk') }}
        </label>
        <div class="row justify-content-between mb-2 ml-0 mr-0">
            <div class="form-group custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkboxKliping"
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
                <input id="kliping" name="fitur[paket][Kliping]" type="number" step="50" min="0"
                    class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga Produk"
                    aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm"
                    style="font-size: 16px; width:90%" disabled required>
            </div>
        </div>
        <div class="row justify-content-left mb-2 ml-0">
            <label class="h5">
                {{__('Jilid') }}
                <i class="material-icons md-18 align-middle" style="color:#C4C4C4">
                    help
                </i>
            </label>
        </div>

        @php
        $paket = array('Lem','Baut','Kawat','spiral');
        @endphp
        @foreach ($paket as $p)
        <div class="form-group row justify-content-between mb-3 ml-2 mr-0">
            <div class="col-md-6 custom-control custom-checkbox ml-3">
                <input name="" type="checkbox" class="custom-control-input" id="checkbox{{ $p }}"
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
                <input id="{{ $p }}" name="fitur[paket][{{ $p }}]" min="0" type="number"
                    class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga Produk"
                    aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm"
                    style="font-size: 16px; width:90%" disabled required>
            </div>
        </div>
        @endforeach
        <label class="mb-3 h4 font-weight-bold">
            {{__('Paket Non-Produk') }}
        </label>

        @php
        $nonPaket = array('Hekter','Tulang Kliping','Penjepit Kertas','Plastik Transparan','Kertas Jeruk');
        @endphp
        @foreach ($nonPaket as $np)
        <div class="row justify-content-between mb-3 ml-0 mr-0">
            <div class="col-md-6 custom-control custom-checkbox ml-0">
                <input name="" type="checkbox" class="custom-control-input" id="checkbox{{ $np }}"
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
                <input id="{{ $np }}" name="fitur[nonPaket][{{ $np }}]" type="number" min="0"
                    class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga Produk"
                    aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm"
                    style="font-size: 16px; width:90%" disabled required>
            </div>
        </div>
        @endforeach
        <hr class="mt-4">
        <label class="mb-4 ml-0 h4 mt-2 font-weight-bold ">
            {{__('Paket Tambahan Anda') }}
        </label>
        <ul id="areaTambah" class="mr-0" style="margin-left:-50px;list-style-type: none;">
        </ul>
        <button id="tambahPaket" type="button" class="btn btn-primary-yellow btn-block center SemiBold mt-2 mb-5">
            Tambah Paket
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
      maxFilesize: 2, // MB
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
 var i = 0;
    $("#tambahPaket").click(function() {
      $("#areaTambah").append(
        '<li class="ml-0 mr-0">'+
        '    <div class="row justify-content-between mb-2 ml-0" style="list-style-position: inside">'+
        '        <div class="col-md-2">'+
        '            <img id="blah'+i+'" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"'+
        '                class="img-responsive bg-light" style="width:163px;height:163px;border-radius:10px;" alt="foto produk">'+
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
