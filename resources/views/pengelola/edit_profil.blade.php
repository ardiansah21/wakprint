@extends('layouts.pengelola')

@section('content')
<div class="container mt-5 mb-5"
    style="font-size: 16px;">
    <label class="font-weight-bold mb-4"
        style="font-size: 36px;">
        {{__('Profil Tempat Percetakan') }}
    </label>
    <br>
    <form method="POST" action="{{ route('partner.profile.edit') }}"  enctype="multipart/form-data">
        @csrf
        <label class="mb-2"
            style="font-size: 16px;">
            {{__('Foto Tempat Percetakan') }}
        </label>

        <div class="needsclick dropzone mb-3" id="document-dropzone"
            style=" border:1px solid #EBD1EC; border-radius:10px; color: #BC41BE; background-color:#EBD1EC;">
            <div class="dz-message" data-dz-message style="font-size: 18px;">
                <span>{{__('Klik atau Tarik Foto Percetakan Anda Disini') }}</span>
            </div>
        </div>

        {{-- <div class="scrolling-wrapper mb-0"> --}}

            <div class="row justify-content-left" hidden
                style="height:200px;">
                <div class="col-md-auto"
                    style="position: relative">
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                        class="img-responsive bg-light"
                        style="width:250px;
                            border-radius:10px;">
                    <div class="mb-3">
                        <button type="button"
                            class="btn btn-outline-yellow font-weight-bold pl-4 pr-4 mb-0"
                            style="position: relative;
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
                    <button class="btn btn-circle shadow-sm"
                        role="button">
                        <i class="material-icons md-36 align-middle"
                        style="color: white; margin-left:-7px;">
                            add
                        </i>
                    </button>
                </div>
            </div>
        {{-- </div> --}}

        <label class="mb-2">
            {{__('Nama Tempat Percetakan') }}
        </label>
        <div class="form-group mb-4">
            <input type="text"
                name="namapercetakan"
                class="form-control pt-2 pb-2"
                placeholder="Masukkan Nama Tempat Percetakan"
                aria-label="Masukkan Nama Tempat Percetakan"
                aria-describedby="inputGroup-sizing-sm"
                value="{{ $partner->nama_toko }}"
                style="font-size: 16px;">
        </div>
        <label class="mb-2">
            {{__('Deskripsi Tempat Percetakan') }}
        </label>
        <div class="form-group mb-4">
            <textarea class="form-control"
                name="deskripsi"
                placeholder="Masukkan Deskripsi Tempat Percetakan"
                aria-label="Deskripsi Percetakan"
                style="font-size: 16px;">{{ $partner->deskripsi_toko }}</textarea>
        </div>
        <label class="mb-2">
            {{__('Alamat Tempat Percetakan') }}
        </label>
        <div class="form-group mb-4">
            <textarea class="form-control"
                name="alamat"
                placeholder="Masukkan Alamat Tempat Percetakan Anda"
                aria-label="Alamat Tempat Percetakan"
                style="font-size: 16px;">{{ $partner->alamat_toko }}</textarea>
        </div>
        <label class="mb-2">
            {{__('URL Google Maps') }}
        </label>
        <div class="form-group mb-4">
            <input type="text"
                name="urlmaps"
                class="form-control pt-2 pb-2"
                value="{{ $partner->url_google_maps }}"
                placeholder="Masukkan URL Titik Lokasi Anda"
                aria-label="Masukkan URL Titik Lokasi Anda"
                aria-describedby="inputGroup-sizing-sm"
                style="font-size: 16px;">
        </div>
        <label class="mb-2">
            {{__('Jam Operasional') }}
        </label>
        <br>
        <label class="mb-4">
            {{__('Buka') }}
            <input type="datetime"
                maxlength="2"
                value="{{ date_create("$partner->jam_op_buka")->format('H')}}"
                class="form-input mr-2 ml-2"
                name="jambuka"
                style="width:48px;
                    font-size: 16px;">
                :
            <input type="datetime"
                name="menitbuka"
                maxlength="2"
                value="{{ date_create("$partner->jam_op_buka")->format('i')}}"
                class="form-input mr-2 ml-2"
                style="width:48px;
                    font-size: 16px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{__('Tutup') }}
            <input type="datetime"
                maxlength="2"
                name="jamtutup"
                class="form-input mr-2 ml-2"
                value="{{ date_create("$partner->jam_op_tutup")->format('H')}}"
                style="width:48px;
                    font-size: 16px;"> :
            <input type="datetime"
                maxlength="2"
                name="menittutup"
                class="form-input mr-2 ml-2"
                value="{{ date_create("$partner->jam_op_tutup")->format('i')}}"
                style="width:48px;
                    font-size: 16px;">
        </label>
        <br>
        <label class="mb-2">
            {{__('Syarat & Ketentuan') }}
        </label>
        <div class="form-group mb-4">
            <textarea class="form-control"
                name="skpercetakan"
                aria-label="Syarat & Ketentuan"
                placeholder="Masukkan Syarat & Ketentuan Percetakan Anda"
                style="font-size: 16px;">{{ $partner->syaratkententuan }}</textarea>
        </div>
        <div class="row justify-content-between mb-5">
            <div class="col-md-auto">
                <label class="mb-2">
                    {{__('Metode Pelayanan') }}
                </label>
                <div class="row justify-content-left mb-2">
                    <div class="form-group custom-control custom-checkbox mt-2 ml-3"
                        style="font-size: 16px;">
                        @if ($partner->ambil_di_tempat === 0)
                            <input type="checkbox"
                                name="ambiltempat"
                                class="custom-control-input"
                                value="Ambil di Tempat"
                                id="checkboxAmbil">
                        @else
                            <input type="checkbox"
                                name="ambiltempat"
                                class="custom-control-input"
                                value="Ambil di Tempat"
                                id="checkboxAmbil"
                                checked>
                        @endif
                        <label class="custom-control-label"
                            for="checkboxAmbil">
                            {{__('Ambil di Tempat') }}
                        </label>
                    </div>
                    <div class="form-group custom-control custom-checkbox mt-2 ml-4"
                        style="font-size: 16px;">
                        @if ($partner->antar_ke_tempat === 0)
                            <input type="checkbox"
                                name="antartempat"
                                class="custom-control-input"
                                value="Diantar ke Tempat"
                                id="checkboxDiantar">
                        @else
                            <input type="checkbox"
                                name="antartempat"
                                class="custom-control-input"
                                value="Diantar ke Tempat"
                                id="checkboxDiantar"
                                checked>
                        @endif
                        <label class="custom-control-label"
                            for="checkboxDiantar">
                            {{__('Diantar ke Tempat') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="mb-2" style="font-size:14px;">
                    {{__('Akurasi Tingkat Keakuratan Deteksi Warna Halaman') }}
                    <a class="text-primary-purple font-weight-bold ml-2"
                        href=""
                        data-toggle="modal"
                        data-target="#infoAtkdwhModal">
                        {{__('Info') }}
                    </a>
                </label>

                <div class="form-group">
                    <div class="dropdown" aria-required="true">
                        <input name="atkdwh" type="text" id="atkdwh" Class="form-control" value="{{ $partner->atkdwh ?? '' }}" hidden>
                        <button id="atkdwhButton"
                            class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                            id="dropdownAtkdwh" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;
                                text-align:left;">
                            {{$partner->atkdwh ?? 'Pilih Tingkat Akurasi Deteksi Warna Halaman'}}
                        </button>
                        @php
                        $atkdwh= array('Penuh', 'Tinggi', 'Sedang', 'Rendah', 'Sangat Rendah');
                        @endphp
                        <div id="atkdwhList" class="dropdown-menu" aria-labelledby="dropdownAtkdwh"
                            style="font-size: 16px; width:100%;">
                            @foreach ( $atkdwh as $a)
                            <span class="dropdown-item cursor-pointer ">
                                {{$a}}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group text-right mb-5">
            <button class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                type="submit"
                style="border-radius:30px;
                    font-size: 18px;">
                {{__('Simpan Perubahan') }}
            </button>
        </div>

        <label class="font-weight-bold mb-5 mt-2"
            style="font-size:36px;">
            {{__('Profil Pemilik Tempat Percetakan') }}
        </label>

        <div class="row justify-content-between mb-0">
            <div class="form-group col-md-3" style="width:250px;height:250px; border-radius:10px;">
                @if (!empty($partner->getFirstMediaUrl()))
                    <img id="gambarPartner" src="{{ $partner->getFirstMediaUrl() }}"
                    class="img-responsive" style="width:100%;height:250px; border-radius:10px;" alt="Foto Kosong">
                <button id="editPhotoButton" type="button" onclick="document.getElementById('imgupload').click();"
                    class="btn btn-outline-yellow font-weight-bold pl-4 pr-4 mb-0"
                    style="position: relative;
                        font-size:16px;
                        bottom: 50px;
                        left:110px;
                        right: 0px;
                        border-radius:30px;">
                        {{__('Pilih Foto') }}
                </button>
                <input id="imgupload" type="file" name="foto_partner" hidden accept="image/png, image/jpeg"
                    onchange="document.getElementById('gambarPartner').src=window.URL.createObjectURL(this.files[0]);" hidden>
                @else
                    <img id="gambarPartner" src="https://unsplash.it/600/400"
                        class="img-responsive" style="width:100%;height:250px; border-radius:10px;" alt="Foto Kosong">
                    <button id="editPhotoButton" type="button" onclick="document.getElementById('imgupload').click();"
                        class="btn btn-outline-yellow font-weight-bold pl-4 pr-4 mb-0"
                        style="position: relative;
                            font-size:16px;
                            bottom: 50px;
                            left:110px;
                            right: 0px;
                            border-radius:30px;">
                            {{__('Pilih Foto') }}
                    </button>
                    <input id="imgupload" type="file" name="foto_partner" hidden accept="image/png, image/jpeg"
                        onchange="document.getElementById('gambarPartner').src=window.URL.createObjectURL(this.files[0]);" hidden>
                @endif
            </div>
            {{-- <div class="form-group col-md-3">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                    class="img-responsive bg-light"
                    style="width:250px;
                        height:250px;
                        border-radius:10px;">
                <div class="form-group mb-3">
                    <button class="btn btn-outline-yellow font-weight-bold pl-4 pr-4 mb-0"
                        style="position: relative;
                        font-size:16px;
                        bottom: 50px;
                        left:110px;
                        right: 0px;
                        border-radius:30px;">
                        {{__('Pilih Foto') }}
                    </button>
                </div>
            </div> --}}
            <div class="col-md-9">
                <label class="mb-2">
                    {{__('Nama Pemilik Tempat Percetakan') }}
                </label>
                <div class="form-group ml-0 mr-0 mb-3">
                    <input type="text"
                        name="namapemilik"
                        class="form-control pt-2 pb-2"
                        value="{{ $partner->nama_lengkap }}"
                        placeholder="Masukkan Nama Pemilik Tempat Percetakan"
                        aria-label="Masukkan Nama Pemilik Tempat Percetakan"
                        aria-describedby="inputGroup-sizing-sm"
                        style="font-size:16px;">
                </div>
                <label class="mb-2">
                    {{__('Nomor HP Pemilik Tempat Percetakan') }}
                </label>
                <div class="form-group ml-0 mr-0 mb-3">
                    <input type="text"
                        name="nomorhp"
                        class="form-control pt-2 pb-2"
                        value="{{ $partner->nomor_hp }}"
                        placeholder="Masukkan Nomor HP Pemilik Tempat Percetakan"
                        aria-label="Masukkan Nomor HP Pemilik Tempat Percetakan"
                        aria-describedby="inputGroup-sizing-sm"
                        style="font-size:16px;">
                </div>
                <div class="row justify-content-between">
                    <div class="col-md-5">
                        <label class="mb-2">
                            {{__('Nama Bank Pemilik Tempat Percetakan') }}
                        </label>
                        <div class="form-group">
                            @php
                                $namaBank = array(
                                    "BRI",
                                    "BNI",
                                    "BCA",
                                    "Mandiri",
                                    "Maybank"
                                );
                            @endphp
                            <div class="form-group">
                                <div class="dropdown" aria-required="true">
                                    <input name="namabank" type="text" id="namabank" Class="form-control" value="{{ $partner->nama_bank }}" hidden>
                                    <button id="namaBankButton"
                                        class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                                        id="dropdownNamaBank" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{$partner->nama_bank}}
                                    </button>
                                    <div id="namaBankList" class="dropdown-menu" aria-labelledby="dropdownAtkdwh"
                                        style="font-size: 16px; width:100%;">
                                        @foreach ($namaBank as $nb)
                                        <span class="dropdown-item cursor-pointer ">
                                            {{$nb}}
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <label class="mb-2 ml-0">
                            {{__('Nomor Rekening Pemilik Tempat Percetakan') }}
                        </label>
                        <div class="form-group ml-0 mr-0 mb-0">
                            <input type="text"
                                name="nomorrekening"
                                class="form-control pt-2 pb-2"
                                value="{{ $partner->nomor_rekening }}"
                                placeholder="Masukkan Nomor Rekening Pemilik Tempat Percetakan"
                                aria-label="Masukkan Nomor Rekening Pemilik Tempat Percetakan"
                                aria-describedby="inputGroup-sizing-sm"
                                style="font-size:16px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb-5">
            <button class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                style="border-radius:30px;
                    font-size:18px;">
                {{__('Simpan Perubahan') }}
            </button>
        </div>
    </form>

    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
          alert(msg);
        }
      </script>

    {{-- pop up info --}}
    @include('pengelola.tingkat_akurasi')
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
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

            $('#atkdwhList span').on('click', function () {
                $('#atkdwhButton').text($(this).text());
                $('#atkdwh').val($(this).text());
            });
            $('#namaBankList span').on('click', function () {
                $('#namaBankButton').text($(this).text());
                $('#namabank').val($(this).text());
            });

            $("#editPhotoButton").on("click",function(){
                $('#imgupload').trigger('click'); return false;
            });

            $("#gambarPartner").on("change","#imgupload",function(){
                document.getElementById('gambarPartner').src=window.URL.createObjectURL(this.files[0]);
            });
        });

    </script>
@endsection

