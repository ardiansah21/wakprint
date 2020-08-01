<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container mt-4 mb-5">
    <label class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Alamat Pengiriman')}}</label>
    <div class="mb-4">
        <button class="btn btn-primary-yellow shadow-sm font-weight-bold pl-4 pr-4" data-toggle="modal"
            data-target="#tambahAlamatModal" data-title="Tambah Alamat Pengiriman"
            style="border-radius:30px; font-size: 18px;">
            <i class="material-icons align-middle mr-2">location_on</i>
            {{__('Tambah Alamat Baru')}}
        </button>
    </div>
    @if(!empty($member->alamat))
        <div class="table-scrollbar pr-4">
            <table id="table-wrapper" class="table table-hover mt-4" style="border-radius:25px 25px 15px 15px;">
                <thead class="bg-primary-purple text-white">
                    <tr style="font-size: 18px;">
                        <th class="align-middle" scope="col-md-auto">{{__('Nama Pengguna')}}</th>
                        <th class="align-middle" scope="col-md-auto">{{__('Alamat')}}</th>
                        <th class="align-middle" scope="col-md-auto">{{__('No. HP')}}</th>
                        <th scope="col-md-auto"></th>
                        <th scope="col-md-auto"></th>
                    </tr>
                </thead>
                <tbody style="font-size: 14px;">
                    @for($i=0 ; $i < count($member->alamat['alamat']);$i++)
                        {{-- @if($member->alamat['alamat'][$i] != null){ --}}
                            <tr>
                                {{-- <input type="number" id="id" name="id" hidden> --}}
                                <td class="align-middle" name="namapenerima" scope="row">
                                    {{ $member->alamat['alamat'][$i]['Nama Penerima'] }}
                                </td>
                                <td class="align-middle" name="alamat">
                                    {{ $member->alamat['alamat'][$i]['Alamat Jalan'] }},
                                    {{ $member->alamat['alamat'][$i]['Kelurahan'] }},
                                    {{ $member->alamat['alamat'][$i]['Kecamatan'] }},
                                    {{ $member->alamat['alamat'][$i]['KabupatenKota'] }},
                                    {{ $member->alamat['alamat'][$i]['Provinsi'] }},
                                    {{ $member->alamat['alamat'][$i]['Kode Pos'] }}
                                </td>
                                <td class="align-middle" name="nomorhp">{{ $member->alamat['alamat'][$i]['Nomor HP'] }}</td>
                                <td>
                                    <span>
                                        <a href="" class="material-icons text-decoration-none mr-2" data-toggle="modal"
                                            data-target="#editAlamatModal" data-title="Ubah Alamat Pengiriman"
                                            data-id="{{ $member->alamat['alamat'][$i]['id'] }}"
                                            data-nama-penerima="{{ $member->alamat['alamat'][$i]['Nama Penerima'] }}"
                                            data-nomor-hp="{{ $member->alamat['alamat'][$i]['Nomor HP'] }}"
                                            data-provinsi="{{ $member->alamat['alamat'][$i]['Provinsi'] }}"
                                            data-kabupaten-kota="{{ $member->alamat['alamat'][$i]['KabupatenKota'] }}"
                                            data-kecamatan="{{ $member->alamat['alamat'][$i]['Kecamatan'] }}"
                                            data-kelurahan="{{ $member->alamat['alamat'][$i]['Kelurahan'] }}"
                                            data-kode-pos="{{ $member->alamat['alamat'][$i]['Kode Pos'] }}"
                                            data-alamat-jalan="{{ $member->alamat['alamat'][$i]['Alamat Jalan'] }}">
                                            edit
                                        </a>
                                        <a href="alamat/hapus/{{$member->alamat['alamat'][$i]['id'] }}" text-decoration="none" class="material-icons text-decoration-none mr-2"
                                            style="color: #FF4949;">
                                            delete
                                        </a>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-purple">
                                            <input type="radio" name="alamatutama" id="alamatutama" autocomplete="off" checked>
                                            Utama
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        {{-- @endif --}}
                        @endfor
                </tbody>
            </table>
        </div>
    @else
        <label style="font-size: 16px;">{{__('Silahkan tambahkan alamat pengiriman Anda')}}</label>
    @endif

    {{-- popup modal tambah alamat --}}
    <div class="modal fade" id="tambahAlamatModal" tabindex="-1" role="dialog" aria-labelledby="alamatModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <form id="formModal" action="{{ route('alamat.tambah') }}" class="mb-3" method="POST">
                        @csrf
                        <button class="close material-icons md-32" data-dismiss="modal">
                            close
                        </button>
                        <input type="number" id="id" name="id" hidden>
                        <label id="alamatModalLabel" class="modal-title font-weight-bold ml-0 mb-5"
                            style="font-size: 48px;">
                            {{ __('Tambah Alamat Pengiriman') }}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Nama Penerima') }}</label>
                                    <div class="input-group">
                                        <input id="namaPenerima" type="text" name="namapenerima" placeholder="Masukkan Nama Penerima"
                                            class="form-control pt-2 pb-2 r" style="font-size: 18px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Nomor HP') }}</label>
                                    <div class="input-group">
                                        <input id="nomorHP" type="text" name="nomorhp" class="form-control pt-2 pb-2"
                                            value="" placeholder="Masukkan Nomor HP Penerima"
                                            aria-label="Masukkan Nomor HP Penerima"
                                            aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Provinsi') }}</label>
                                    <div class="input-group mb-3">
                                        <input id="provinsi" type="text" name="provinsi" class="form-control pt-2 pb-2"
                                            value="" placeholder="Masukkan Provinsi" aria-label="Masukkan Provinsi"
                                            aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Kabupaten / Kota') }}</label>
                                    <div class="input-group mb-3">
                                        <input id="kabupatenKota" type="text" name="kota" class="form-control pt-2 pb-2"
                                            value="" placeholder="Masukkan Nama Kabupaten / Kota"
                                            aria-label="Masukkan Nama Kabupaten / Kota"
                                            aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Kecamatan') }}</label>
                                    <div class="input-group">
                                        <input id="kecamatan" type="text" name="kecamatan"
                                            class="form-control pt-2 pb-2" value=""
                                            placeholder="Masukkan Nama Kecamatan" aria-label="Masukkan Nama Kecamatan"
                                            aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Kelurahan') }}</label>
                                    <div class="input-group">
                                        <input id="kelurahan" type="text" name="kelurahan"
                                            class="form-control pt-2 pb-2" value=""
                                            placeholder="Masukkan Nama Kelurahan" aria-label="Masukkan Nama Kelurahan"
                                            aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Kode Pos') }}</label>
                                    <div class="input-group">
                                        <input id="kodePos" type="text" name="kodepos" class="form-control pt-2 pb-2"
                                            value="" placeholder="Masukkan Kode Pos" aria-label="Masukkan Kode Pos"
                                            aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Alamat') }}</label>
                                    <div class="input-group mb-3">
                                        <textarea id="alamatJalan" class="form-control" type="text" name="alamatjalan"
                                            aria-label="Alamat" style="font-size: 18px;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row float-right mr-0">
                            <div class="form-group mb-3 mr-3">
                                <button class="btn btn-default text-primary-purple font-weight-bold pl-4 pr-4"
                                    data-dismiss="modal" style="border-radius:30px; font-size:18px;">
                                    {{ __('Batal') }}
                                </button>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit"
                                    class="btn btn-primary-wakprint text-right font-weight-bold pl-4 pr-4"
                                    style="border-radius:30px; font-size:18px;">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- popup modal edit alamat --}}
    <div class="modal fade" id="editAlamatModal" tabindex="-1" role="dialog" aria-labelledby="editAlamatModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <form id="formModal" action="{{ route('alamat.edit') }}" class="mb-3" method="POST">
                        @csrf
                        <button class="close material-icons md-32" data-dismiss="modal">
                            close
                        </button>
                        <input type="number" id="id" name="id" hidden>
                        <label id="editAlamatModalLabel" class="modal-title font-weight-bold ml-0 mb-5"
                            style="font-size: 48px;">
                            {{ __('Ubah Alamat Pengiriman') }}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Nama Penerima') }}</label>
                                    <div class="input-group">
                                        <input id="namaPenerima" type="text" name="namapenerima" placeholder="Masukkan Nama Penerima"
                                            class="form-control pt-2 pb-2 r" style="font-size: 18px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Nomor HP') }}</label>
                                    <div class="input-group">
                                        <input id="nomorHP" type="text" name="nomorhp" class="form-control pt-2 pb-2"
                                            placeholder="Masukkan Nomor HP Penerima"
                                            aria-label="Masukkan Nomor HP Penerima"
                                            aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Provinsi') }}</label>
                                    <div class="input-group mb-3">
                                        <input id="provinsi" type="text" name="provinsi" class="form-control pt-2 pb-2"
                                            placeholder="Masukkan Provinsi" aria-label="Masukkan Provinsi"
                                            aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Kabupaten / Kota') }}</label>
                                    <div class="input-group mb-3">
                                        <input id="kabupatenKota" type="text" name="kota" class="form-control pt-2 pb-2"
                                            placeholder="Masukkan Nama Kabupaten / Kota"
                                            aria-label="Masukkan Nama Kabupaten / Kota"
                                            aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Kecamatan') }}</label>
                                    <div class="input-group">
                                        <input id="kecamatan" type="text" name="kecamatan"
                                            class="form-control pt-2 pb-2"
                                            placeholder="Masukkan Nama Kecamatan" aria-label="Masukkan Nama Kecamatan"
                                            aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Kelurahan') }}</label>
                                    <div class="input-group">
                                        <input id="kelurahan" type="text" name="kelurahan"
                                            class="form-control pt-2 pb-2"
                                            placeholder="Masukkan Nama Kelurahan" aria-label="Masukkan Nama Kelurahan"
                                            aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Kode Pos') }}</label>
                                    <div class="input-group">
                                        <input id="kodePos" type="text" name="kodepos" class="form-control pt-2 pb-2"
                                            placeholder="Masukkan Kode Pos" aria-label="Masukkan Kode Pos"
                                            aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2"
                                        style="font-size: 18px;">{{ __('Alamat') }}</label>
                                    <div class="input-group mb-3">
                                        <textarea id="alamatJalan" class="form-control" type="text" name="alamatjalan"
                                            aria-label="Alamat" style="font-size: 18px;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row float-right mr-0">
                            <div class="form-group mb-3 mr-3">
                                <button class="btn btn-default text-primary-purple font-weight-bold pl-4 pr-4"
                                    data-dismiss="modal" style="border-radius:30px; font-size:18px;">
                                    {{ __('Batal') }}
                                </button>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit"
                                    class="btn btn-primary-wakprint text-right font-weight-bold pl-4 pr-4"
                                    style="border-radius:30px; font-size:18px;">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //ubah
    $('#editAlamatModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        $(this).find('.modal-title').text(button.data('title'))
        $(this).find('#id').val(button.data('id'))
        $(this).find('#namaPenerima').val(button.data('nama-penerima'))
        $(this).find('#nomorHP').val(button.data('nomor-hp'))
        $(this).find('#provinsi').val(button.data('provinsi'))
        $(this).find('#kabupatenKota').val(button.data('kabupaten-kota'))
        $(this).find('#kecamatan').val(button.data('kecamatan'))
        $(this).find('#kelurahan').val(button.data('kelurahan'))
        $(this).find('#kodePos').val(button.data('kode-pos'))
        $(this).find('#alamatJalan').val(button.data('alamat-jalan'))
    })

    //tambah
    $('#tambahAlamatModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            $(this).find('.modal-title').text(button.data('title'))
            $(this).find('#id').val(button.data('id'))
            $(this).find('#namaPenerima').val(button.data('nama-penerima'))
            $(this).find('#nomorHP').val(button.data('nomor-hp'))
            $(this).find('#provinsi').val(button.data('provinsi'))
            $(this).find('#kabupatenKota').val(button.data('kabupaten-kota'))
            $(this).find('#kecamatan').val(button.data('kecamatan'))
            $(this).find('#kelurahan').val(button.data('kelurahan'))
            $(this).find('#kodePos').val(button.data('kode-pos'))
            $(this).find('#alamatJalan').val(button.data('alamat-jalan'))
            
    })
</script>


@endsection