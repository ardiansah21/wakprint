@extends('layouts.admin')

@section('content')
    <div class="tab-pane fade show active mb-0" style="border-radius:10px;">
        <div class="card shadow-sm mb-0 p-4">
            <div class="row justify-content-between mb-2">
                <label class="col-md-10 text-break font-weight-bold" style="font-size:36px; width:100%;">
                    {{ __('Detail Pengelola') }}
                </label>
                <div class="col-md-2 text-right">
                    <a class="close material-icons md-32" href="{{ route('admin.partner') }}">
                        close
                    </a>
                </div>
            </div>
            <label class="text-break font-weight-bold" style="font-size:28px; width:100%;">
                ID : {{ $partner->id_pengelola ?? '-' }}
            </label>
            @if (!empty($partner->getFirstMediaUrl('foto_percetakan')))
                <img src="{{ $partner->getFirstMediaUrl('foto_percetakan') }}" class="img-responsive mb-4" alt="no picture"
                    style="width:100%; height:250px; border:solid 2px #BC41BE; object-fit:scale-down; border-radius:5px;">
            @else
                <div class="text-center text-white mb-4"
                    style="width:100%; height:250px; display: flex; justify-content: center; align-items: center; background: #BC41BE; border: solid 2px #BC41BE; border-radius:5px;">
                    <h1 class="font-weight-bold" style="width:100%;">Wakprint Partner</h1>
                </div>
                {{-- <img
                    src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                    class="img-responsive mb-4"> --}}
            @endif
            <div class="row justify-content-between mb-2">
                <label class="col-md-6 font-weight-bold mb-0">
                    {{ __('Nama Tempat Percetakan') }}
                </label>
                <label class="col-md-6 mb-0">
                    {{ $partner->nama_toko ?? '-' }}
                </label>
            </div>
            <div class="row justify-content-between mb-2">
                <label class="col-md-6 font-weight-bold mb-0">
                    {{ __('Nama Pemilik') }}
                </label>
                <label class="col-md-6 mb-0">
                    {{ $partner->nama_lengkap ?? '-' }}
                </label>
            </div>
            <div class="row justify-content-between mb-2">
                <label class="col-md-6 font-weight-bold mb-0">
                    {{ __('Nomor HP') }}
                </label>
                <label class="col-md-6 mb-0">
                    {{ $partner->nomor_hp ?? '-' }}
                </label>
            </div>
            <div class="row justify-content-between mb-2">
                <label class="col-md-6 font-weight-bold mb-0">
                    {{ __('Nama Bank') }}
                </label>
                <label class="col-md-6 mb-0">
                    {{ $partner->nama_bank ?? '-' }}
                </label>
            </div>
            <div class="row justify-content-between mb-2">
                <label class="col-md-6 font-weight-bold mb-0">
                    {{ __('Nomor Rekening') }}
                </label>
                <label class="col-md-6 mb-0">
                    {{ $partner->nomor_rekening ?? '-' }}
                </label>
            </div>
            <div class="row justify-content-between mb-2">
                <label class="col-md-6 font-weight-bold mb-0">
                    {{ __('Alamat') }}
                </label>
                <label class="col-md-6 mb-0">
                    {{ $partner->alamat_toko ?? '-' }}
                    <br>
                    <a href="{{ $partner->url_google_maps }}">
                        {{ $partner->url_google_maps ?? '-' }}
                    </a>
                </label>
            </div>
            <div class="row justify-content-between mb-2">
                <label class="col-md-6 font-weight-bold mb-0">
                    {{ __('Deskripsi Tempat Percetakan') }}
                </label>
                <label class="col-md-6 mb-0">
                    {{ $partner->deskripsi_toko ?? '-' }}
                </label>
            </div>
            <div class="row justify-content-between mb-4">
                <label class="col-md-6 font-weight-bold">
                    {{ __('Status Tempat Percetakan') }}
                </label>
                <label class="col-md-6">
                    {{ $partner->status_toko ?? '-' }}
                </label>
            </div>
            @if (!empty($partner->email_verified_at))
                <div class="text-right mr-0">
                    <label class="col-auto badge badge-pill bg-primary-purple text-white font-weight-bold pl-5 pr-5 mb-0" style="opacity: 0.7; border-radius:30px; border: 1px solid #BC41BE; padding-top:12px; padding-bottom:12px; font-size:18px;">
                        {{ __('Disetujui') }}
                    </label>
                </div>
            @else
                <div class="row justify-content-end">
                    <div class="mr-3">
                        <button
                            class="btn btn-danger btn-outline-danger-primary btn-lg text-primary-danger font-weight-bold pl-5 pr-5 "
                            onclick="window.location.href='{{ route('admin.partner.tolak', $partner->id_pengelola) }}'"
                            style="border-radius:30px; font-size:18px;">
                            {{ __('Tolak') }}
                        </button>
                    </div>
                    <form action="{{ route('admin.partner.terima', $partner->id_pengelola) }}" method="POST">
                        @csrf
                        <div class="mr-2">
                            <button type="submit"
                                class="col-auto btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5"
                                style="border-radius:30px; font-size:18px;">
                                {{ __('Setujui') }}
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection

{{-- <div class="modal fade" id="pengelolaModal" tabindex="-1" role="dialog"
    aria-labelledby="pengelolaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="border-radius: 10px;
            font-size:18px;">
            <div class="modal-body" style="border-radius: 10px;">
                <div class="mb-0 ml-2 mr-2">
                    <button class="close material-icons md-32" data-dismiss="modal">
                        close
                    </button>
                    <label class="text-break font-weight-bold" style="font-size:36px;
                            width:100%;">
                        {{ __('000000736123') }}
                    </label>
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                        class="img-responsive mb-4" style="width:100%;
                            height:250px;
                            border-radius:5px;">
                    <div class="row justify-content-between mb-2">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{ __('Nama Tempat Percetakan') }}
                        </label>
                        <label class="col-md-6 mb-0">
                            {{ __('Toko Uwak') }}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{ __('Nama Pemilik') }}
                        </label>
                        <label class="col-md-6 mb-0">
                            {{ __('Agus') }}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{ __('Nomor HP') }}
                        </label>
                        <label class="col-md-6 mb-0">
                            {{ __('+6281263547763') }}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{ __('Nama Bank') }}
                        </label>
                        <label class="col-md-6 mb-0">
                            {{ __('BRI') }}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{ __('Nomor Rekening') }}
                        </label>
                        <label class="col-md-6 mb-0">
                            {{ __('0538549202057') }}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{ __('Alamat') }}
                        </label>
                        <label class="col-md-6 mb-0">
                            {{ __('Jln. Seksama Medan Denai, Medan, Sumatera Utara (20228)') }}
                            <br>
                            <a href="">
                                {{ __('https:/goo.gle/AhfjeuaDHfkean') }}
                            </a>
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{ __('Deskripsi Tempat Percetakan') }}
                        </label>
                        <label class="col-md-6 mb-0">
                            {{ __('Tempat percetakan yang sangat bersahabat untuk kalangan pelajar') }}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-4">
                        <label class="col-md-6 font-weight-bold">
                            {{ __('Status Tempat Percetakan') }}
                        </label>
                        <label class="col-md-6">
                            {{ __('BUKA') }}
                        </label>
                    </div>
                    <div class="row justify-content-end mb-2">
                        <div class="mr-3">
                            <button
                                class="btn btn-danger btn-outline-danger-primary btn-lg text-primary-danger font-weight-bold mb-4 pl-5 pr-5 "
                                style="border-radius:30px
                                    font-size:18px;">
                                {{ __('Tolak') }}
                            </button>
                        </div>
                        <div class="mr-2">
                            <button class="col-auto btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-4"
                                style="border-radius:30px;
                                    font-size:18px;">
                                {{ __('Setujui') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
