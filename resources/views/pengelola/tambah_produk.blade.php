@extends('layouts.pengelola')

@section('content')
<div class="container mt-5 mb-5" style="font-size: 16px;">
    <form action="{{ route('partner.produk.store') }}" method="POST">
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

        <label class="mb-2 h4 font-weight-bold" style="font-size: 16px;" >
            {{__('Foto Produk') }}
        </label>
        <div class="needsclick dropzone mb-3" id="document-dropzone">
            <div class="dz-message" data-dz-message>
                <span>klik atau tarik sini NJING</span><br> 
            </div>
        </div>

        {{-- <div class="scrolling-wrapper mb-0"> --}}
        <div class="row justify-content-left" style="height:200px;" hidden>
            <div class="col-md-auto" style="position: relative">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                    class="img-responsive bg-light" style="width:250px;
                                border-radius:10px;">
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-yellow font-weight-bold pl-4 pr-4 mb-0" style="position: relative;
                                    font-size:16px;
                                    bottom: 50px;
                                    left:110px;
                                    right: 0px;
                                    border-radius:30px;">
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
                aria-label="Masukkan Nama Produk" aria-describedby="inputGroup-sizing-sm" style="font-size:16px;">
        </div>
        <div class="row justify-content-between">
            <div class="col-md-6">
                <label class="mb-2 h4 font-weight-bold">
                    {{__('Harga Produk') }}
                </label>
                <div class="row justify-content-left mb-2">
                    <label class="col-md-1 mt-2 mb-2">
                        {{__('Rp') }}
                    </label>
                    <div class="col-md-9 form-group mb-4">
                        <input name="harga" type="text" class="form-control form-control-lg"
                            placeholder="Masukkan Harga Produk" aria-label="Masukkan Harga Produk"
                            aria-describedby="inputGroup-sizing-sm" style="font-size: 16px;">
                    </div>
                    <label class="col-md-1 mt-0 mb-2">
                        {{__('/ Lembar') }}
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <label class="mb-2 h4 font-weight-bold">
                    {{__('Harga Produk (Timbal Balik)') }}
                </label>
                <div class="row justify-content-left mb-2">
                    <label class="col-md-1 mt-2 mb-2">
                        {{__('Rp') }}
                    </label>
                    <div class="col-md-9 form-group mb-4">
                        <input name="harga_timbal_balik" type="text" class="form-control form-control-lg pt-2 pb-2"
                            placeholder="Masukkan Harga Produk (Timbal Balik)"
                            aria-label="Masukkan Harga Produk (Timbal Balik)" aria-describedby="inputGroup-sizing-sm"
                            style="font-size: 16px;">
                    </div>
                    <label class="col-md-1 mt-0 mb-2">
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
        <div class="row justify-content-between mb-2 ml-0">
            <div class="form-group custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkboxKliping" onchange="document.getElementById('kliping').disabled=!this.checked;">
                <label class="custom-control-label" for="checkboxKliping">
                    {{__('Kliping') }}
                    <i class="material-icons md-18 align-middle" style="color:#C4C4C4">
                        help
                    </i>
                </label>
            </div>
            <div class="row col-md-5" onclick="if(document.getElementById('kliping').disabled){document.getElementById('checkboxKliping').click();document.getElementById('kliping').focus() };">
                <label class="align-self-center" style=" display: inline-block; width: 10%; text-align: right; padding-right:8px">
                    {{__('Rp') }}
                </label>
                <input id="kliping" name="fitur[paket][Kliping]" type="number" step="50" min="0" class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga Produk" aria-label="Masukkan Harga Produk"
                    aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; width:90%" disabled required>
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
            <div class="form-group row justify-content-between mb-3 ml-2">
                <div class="col-md-6 custom-control custom-checkbox ml-3">
                    <input name="" type="checkbox" class="custom-control-input" id="checkbox{{ $p }}" onchange="document.getElementById('{{ $p }}').disabled=!this.checked; ">
                    <label class="custom-control-label" for="checkbox{{$p}}">
                        {{$p}}
                        <i class="material-icons md-18 align-middle" style="color:#C4C4C4">
                            help
                        </i>
                    </label>
                </div>
                <div class="row col-md-5" onclick="if(document.getElementById('{{ $p }}').disabled){document.getElementById('checkbox{{ $p }}').click();document.getElementById('{{ $p }}').focus() };">
                    <label class="align-self-center" style=" display: inline-block; width: 10%; text-align: right; padding-right:8px">
                        {{__('Rp') }}
                    </label>
                    <input id="{{ $p }}" name="fitur[paket][{{ $p }}]" min="0" type="number" class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga Produk" aria-label="Masukkan Harga Produk"
                        aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; width:90%" disabled required>
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
            <div class="row justify-content-between mb-3 ml-0">
                <div class="col-md-6 custom-control custom-checkbox ml-0">
                    <input name="" type="checkbox" class="custom-control-input" id="checkbox{{ $np }}" onchange="document.getElementById('{{ $np }}').disabled=!this.checked; ">
                    <label class="custom-control-label" for="checkbox{{$np}}">
                        {{$np}}
                        <i class="material-icons md-18 align-middle" style="color:#C4C4C4">
                            help
                        </i>
                    </label>
                </div>
                <div class="row col-md-5" onclick="if(document.getElementById('{{ $np }}').disabled){document.getElementById('checkbox{{ $np }}').click();document.getElementById('{{ $np }}').focus() };">
                    <label class="align-self-center" style=" display: inline-block; width: 10%; text-align: right; padding-right:8px">
                        {{__('Rp') }}
                    </label>
                    <input id="{{ $np }}" name="fitur[nonPaket][{{ $np }}]" type="number" min="0" class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga Produk" aria-label="Masukkan Harga Produk"
                        aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; width:90%" disabled required>
                </div>
            </div>
        @endforeach
        <hr class="mt-4"> 
        <label class="mb-4 ml-0 h4 mt-2 font-weight-bold ">
            {{__('Paket Tambahan Anda') }}
        </label>
        <ul id="areaTambah" class="ml-0 mr-0" style="text-decoration: none;">
        </ul>
        <button id="tambahPaket" type="button" class="btn btn-warning center mt-2 mb-2">
            Tambah Paket
        </button>
        <div class="row justify-content-end mr-0 mb-5">
            <div class="mr-3">
                <button id="tes" type="reset" class="btn btn-default btn-lg text-primary-danger font-weight-bold pl-5 pr-5 mb-0"
                    style="border-radius:30px;
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

<script>
    $('#tes').on('click', function () {
    var APP_URL = {!! json_encode(url('/')) !!}
    alert(APP_URL);
});


</script>
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
        $('form').find('input[name="document[]"][value="' + name + '"]').remove()
      },
      init: function () {
        @if(isset($project) && $project->document)
          var files ={!! json_encode($project->document) !!}
          for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
          }
        @endif
      }
    }
  </script>
@stop