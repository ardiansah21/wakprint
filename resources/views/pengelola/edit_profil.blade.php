@extends('layouts.pengelola')

@section('content')
<div class="container mt-5 mb-5"
    style="font-size: 16px;">
    <label class="font-weight-bold mb-4"
        style="font-size: 36px;">
        {{__('Profil Tempat Percetakan') }}
    </label>
    <br>
    <form method="POST" action="{{ route('partner.profile.edit') }}">
        @csrf
        <label class="mb-2"
            style="font-size: 16px;">
            {{__('Foto Tempat Percetakan') }}
        </label>

        {{-- <div class="scrolling-wrapper mb-0"> --}}
            <div class="row justify-content-left"
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
                value="{{ $partner->jam_op_buka}}"
                class="form-input mr-2 ml-2"
                name="jambuka"
                style="width:48px;
                    font-size: 16px;"> 
                :
            <input type="datetime"
                name="menitbuka"
                maxlength="2"
                value="{{ $partner->jam_op_buka }}"
                class="form-input mr-2 ml-2"
                style="width:48px;
                    font-size: 16px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{__('Tutup') }}
            <input type="datetime"
                maxlength="2"
                name="jamtutup"
                class="form-input mr-2 ml-2"
                value="{{ $partner->jam_op_tutup }}"
                style="width:48px;
                    font-size: 16px;"> :
            <input type="datetime"
                maxlength="2"
                name="menittutup"
                class="form-input mr-2 ml-2"
                value="{{ $partner->jam_op_tutup }}"
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
                        <input type="checkbox"
                            name="ambiltempat"
                            class="custom-control-input"
                            value="Ambil di Tempat"
                            id="checkboxAmbil">
                        <label class="custom-control-label"
                            for="checkboxAmbil">
                            {{__('Ambil di Tempat') }}
                        </label>
                    </div>
                    <div class="form-group custom-control custom-checkbox mt-2 ml-4"
                        style="font-size: 16px;">
                        <input type="checkbox"
                            name="antartempat"
                            class="custom-control-input"
                            value="Diantar ke Tempat"
                            id="checkboxDiantar">
                        <label class="custom-control-label"
                            for="checkboxDiantar">
                            {{__('Diantar ke Tempat') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-auto text-right">
                <label class="mb-2">
                    {{__('Akurasi Tingkat Keakuratan Deteksi Warna Halaman') }}
                    <a class="text-primary-purple ml-2"
                        href=""
                        data-toggle="modal"
                        data-target="#infoAtkdwhModal">
                        {{__('Info') }}
                    </a>
                </label>
                <div class="form-group dropdown">
                    <button class="btn btn-default btn-block shadow-sm dropdown-toggle border border-gray" 
                        id="dropdownATKDH" 
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        style="font-size: 16px;
                            text-align:left;">
                        {{__('Akurasi Tingkat Keakuratan Deteksi Warna') }}
                    </button>
                    <ul class="dropdown-menu"
                        name="atkdwh"
                        aria-labelledby="dropdownATKDH"
                        style="font-size: 16px;
                        width:100%;">
                            <li class="dropdown-item" href="#" value="{{__('Penuh') }}">
                                {{__('Penuh') }}
                            </li>
                            <li class="dropdown-item" href="#" value="{{__('Tinggi') }}">
                                {{__('Tinggi') }}
                            </li>
                            <li class="dropdown-item" href="#" value="{{__('Sedang') }}">
                                {{__('Sedang') }}
                            </li>
                            <li class="dropdown-item" href="#" value="{{__('Rendah') }}">
                                {{__('Rendah') }}
                            </li>
                            <li class="dropdown-item" href="#" value="{{__('Sangat Rendah') }}">
                                {{__('Sangat Rendah') }}
                            </li>
                    </ul>
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
            <div class="form-group col-md-3">
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
            </div>
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
                                    "Maybank",
                                    "Mandiri"
                                );
                            @endphp
                            {{-- <select class="btn btn-default btn-block dropdown dropdown-toggle border border-gray" name="namabank" style="font-size: 18px;">
                                @foreach ($namaBank as $key => $value)
                                    <option value="{{ $key }}"
                                    @if ($key == old('namabank', $partner->nama_bank->option))
                                        selected="selected"
                                    @endif>
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select> --}}
                            <select class="btn btn-default btn-block dropdown dropdown-toggle border border-gray" name="namabank"
                                aria-valuetext="{{$partner->nama_bank}}" style="font-size: 18px;">
                                <option value="Maybank">{{__('Maybank')}}</option>
                                <option value="BCA">{{__('BCA')}}</option>
                                <option value="Mandiri">{{__('Mandiri')}}</option>
                                <option value="BRI">{{__('BRI')}}</option>
                            </select>
                            {{-- <button class="btn btn-default btn-block shadow-sm dropdown-toggle border border-gray"
                                id="dropdownNamaBank"
                                value="{{$partner->nama_bank}}"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                style="font-size:16px;
                                    text-align:left;">
                                {{$partner->nama_bank}}
                            </button>
                            <ul class="dropdown-menu"
                                name="namabank"
                                aria-labelledby="dropdownNamaBank"
                                style="font-size:16px;
                                    width:100%;">
                                <li class="dropdown-item"
                                    href="#"
                                    value="BCA">
                                    {{__('BCA') }}
                                </li>
                                <li class="dropdown-item"
                                    href="#"
                                    value="Mandiri">
                                    {{__('Mandiri') }}
                                </li>
                                <li class="dropdown-item"
                                    href="#"
                                    value="BNI">
                                    {{__('BNI') }}
                                </li>
                            </ul> --}}
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

