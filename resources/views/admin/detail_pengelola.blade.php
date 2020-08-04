@extends('layouts.admin')

@section('content')
<div class="tab-pane fade show active mb-0" style="border-radius:10px;">
    <div class="card shadow-sm mb-0 p-4">
        <span>
            <a class="close material-icons md-32" href="{{ route('admin.partner') }}">
                close
            </a>
            <label class="text-break font-weight-bold" style="font-size:36px; width:100%;">
                {{$partner->id_pengelola ?? '-'}}
            </label>
        </span>
        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive mb-4"
            style="width:100%;
                                height:250px;
                                border-radius:5px;">
        <div class="row justify-content-between mb-2">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Nama Tempat Percetakan')}}
            </label>
            <label class="col-md-6 mb-0">
                {{$partner->nama_toko ?? '-'}}
            </label>
        </div>
        <div class="row justify-content-between mb-2">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Nama Pemilik')}}
            </label>
            <label class="col-md-6 mb-0">
                {{$partner->nama_lengkap ?? '-'}}
            </label>
        </div>
        <div class="row justify-content-between mb-2">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Nomor HP')}}
            </label>
            <label class="col-md-6 mb-0">
                {{$partner->nomor_hp ?? '-'}}
            </label>
        </div>
        <div class="row justify-content-between mb-2">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Nama Bank')}}
            </label>
            <label class="col-md-6 mb-0">
                {{$partner->nama_bank ?? '-'}}
            </label>
        </div>
        <div class="row justify-content-between mb-2">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Nomor Rekening')}}
            </label>
            <label class="col-md-6 mb-0">
                {{$partner->nomor_rekening ?? '-'}}
            </label>
        </div>
        <div class="row justify-content-between mb-2">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Alamat')}}
            </label>
            <label class="col-md-6 mb-0">
                {{$partner->alamat_toko ?? '-'}}
                <br>
                <a href="">
                    {{$partner->url_google_maps ?? '-'}}
                </a>
            </label>
        </div>
        <div class="row justify-content-between mb-2">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Deskripsi Tempat Percetakan')}}
            </label>
            <label class="col-md-6 mb-0">
                {{$partner->deskripsi_toko ?? '-'}}
            </label>
        </div>
        <div class="row justify-content-between mb-4">
            <label class="col-md-6 font-weight-bold">
                {{__('Status Tempat Percetakan')}}
            </label>
            <label class="col-md-6">
                {{$partner->status_toko ?? '-'}}
            </label>
        </div>
        <div class="row justify-content-end">
            <div class="mr-3">
                <button
                    class="btn btn-danger btn-outline-danger-primary btn-lg text-primary-danger font-weight-bold pl-5 pr-5 "
                    style="border-radius:30px
                                        font-size:18px;">
                    {{__('Tolak')}}
                </button>
            </div>
            <div class="mr-2">
                <button class="col-auto btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5" style="border-radius:30px; font-size:18px;">
                    {{__('Setujui')}}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- <div class="modal fade"
    id="pengelolaModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="pengelolaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md"
        role="document">
        <div class="modal-content"
            style="border-radius: 10px;
            font-size:18px;">
            <div class="modal-body"
                style="border-radius: 10px;">
                <div class="mb-0 ml-2 mr-2">
                    <button class="close material-icons md-32"
                        data-dismiss="modal">
                        close
                    </button>
                    <label class="text-break font-weight-bold"
                        style="font-size:36px;
                            width:100%;">
                        {{__('000000736123')}}
</label>
<img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive mb-4" style="width:100%;
                            height:250px;
                            border-radius:5px;">
<div class="row justify-content-between mb-2">
    <label class="col-md-6 font-weight-bold mb-0">
        {{__('Nama Tempat Percetakan')}}
    </label>
    <label class="col-md-6 mb-0">
        {{__('Toko Uwak')}}
    </label>
</div>
<div class="row justify-content-between mb-2">
    <label class="col-md-6 font-weight-bold mb-0">
        {{__('Nama Pemilik')}}
    </label>
    <label class="col-md-6 mb-0">
        {{__('Agus')}}
    </label>
</div>
<div class="row justify-content-between mb-2">
    <label class="col-md-6 font-weight-bold mb-0">
        {{__('Nomor HP')}}
    </label>
    <label class="col-md-6 mb-0">
        {{__('+6281263547763')}}
    </label>
</div>
<div class="row justify-content-between mb-2">
    <label class="col-md-6 font-weight-bold mb-0">
        {{__('Nama Bank')}}
    </label>
    <label class="col-md-6 mb-0">
        {{__('BRI')}}
    </label>
</div>
<div class="row justify-content-between mb-2">
    <label class="col-md-6 font-weight-bold mb-0">
        {{__('Nomor Rekening')}}
    </label>
    <label class="col-md-6 mb-0">
        {{__('0538549202057')}}
    </label>
</div>
<div class="row justify-content-between mb-2">
    <label class="col-md-6 font-weight-bold mb-0">
        {{__('Alamat')}}
    </label>
    <label class="col-md-6 mb-0">
        {{__('Jln. Seksama Medan Denai, Medan, Sumatera Utara (20228)')}}
        <br>
        <a href="">
            {{__('https:/goo.gle/AhfjeuaDHfkean')}}
        </a>
    </label>
</div>
<div class="row justify-content-between mb-2">
    <label class="col-md-6 font-weight-bold mb-0">
        {{__('Deskripsi Tempat Percetakan')}}
    </label>
    <label class="col-md-6 mb-0">
        {{__('Tempat percetakan yang sangat bersahabat untuk kalangan pelajar')}}
    </label>
</div>
<div class="row justify-content-between mb-4">
    <label class="col-md-6 font-weight-bold">
        {{__('Status Tempat Percetakan')}}
    </label>
    <label class="col-md-6">
        {{__('BUKA')}}
    </label>
</div>
<div class="row justify-content-end mb-2">
    <div class="mr-3">
        <button
            class="btn btn-danger btn-outline-danger-primary btn-lg text-primary-danger font-weight-bold mb-4 pl-5 pr-5 "
            style="border-radius:30px
                                    font-size:18px;">
            {{__('Tolak')}}
        </button>
    </div>
    <div class="mr-2">
        <button class="col-auto btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-4" style="border-radius:30px;
                                    font-size:18px;">
            {{__('Setujui')}}
        </button>
    </div>
</div>
</div>
</div>
</div>
</div>
</div> --}}
