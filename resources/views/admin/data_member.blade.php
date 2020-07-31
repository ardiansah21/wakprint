@php
    $member = DB::table('member')->get();
@endphp

<div class="row jusify-content-between mb-3 mr-0">
    <div class="col-md-10">
        <div class="form-group search-input">
            <div class="main-search-input-item">
                <input id="cariMember" type="text" role="search" name="carimember" class="form-control"
                    placeholder="Cari data member disini..." aria-label="Cari data member disini"
                    aria-describedby="basic-addon2" style="border:0px solid white;
                        border-radius:30px;
                        font-size:16px;">
                <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3" style="position: absolute;
                            top: 50%; left: 95%;
                            transform: translate(-50%, -50%);
                            -ms-transform: translate(-50%, -50%);">
                    search
                </i>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="dropdown">
            <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" id="filterDataMember"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;">
                {{__('Semua')}}
            </button>
            <div class="dropdown-menu" aria-labelledby="filterDataMember" style="font-size: 16px;">
                <a class="dropdown-item" href="#">
                    {{__('Terbaru')}}
                </a>
                <a class="dropdown-item" href="#">
                    {{__('A-Z')}}
                </a>
                <a class="dropdown-item" href="#">
                    {{__('Z-A')}}
                </a>
            </div>
        </div>
    </div>
</div>
@if(!empty($member))
<div>
    {{-- <table id="memberTable" class="table table-hover">
        <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;
                        font-size:16px;">
            <tr>
                <th>ID</th>
                <th>Nama Member</th>
                <th>Email Member</th>
            </tr>
        </thead>
        <tbody style="font-size: 12px;">
        </tbody>
    </table> --}}
    <div class="table-scrollbar mb-5 pr-2">
        <table id="dataMember" name="dataMember" class="display table table-hover">
            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;
                        font-size:16px;">
                <tr>
                    <th scope="col-md-auto">
                        {{__('ID')}}
                    </th>
                    <th scope="col-md-auto">
                        {{__('Nama')}}
                    </th>
                    <th scope="col-md-auto">
                        {{__('Email')}}
                    </th>
                    <th scope="col-md-auto"></th>
                </tr>
            </thead>
            <tbody style="font-size: 12px;">
                @for ($i = 0; $i < count($member); $i++)
                    <tr onclick="window.location.href='{{ route('admin.detail.member') }}'">
                    {{-- <tr onclick="window.location.href='admin/member/{{ $member[$i]->id_member }}'">  --}}
                            <td id="idMember" name="id_member" scope="row">
                                {{ $member[$i]->id_member }}
                            </td>
                            <td>
                                {{ $member[$i]->nama_lengkap }}
                            </td>
                            <td>
                                {{ $member[$i]->email }}
                            </td>
                            <td>
                                <i class="material-icons" style="color: red;" style="margin-left: -200px;">
                                    delete
                                </i>
                            </td>
                        </a>
                    {{-- <tr data-toggle="modal" data-target="#memberModal" data-id="{{ $member[$i]->id_member }}"> --}}
                        
                    </tr>
                    @endfor
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="border-radius: 10px;
                font-size:18px;">
            <div class="modal-body" style="border-radius: 10px;">
                <div class="mb-0" style="border-radius:10px;">
                    <button class="close material-icons md-32" data-dismiss="modal">
                        close
                    </button>
                    <label id="idMember" name="idmember" aria-valuetext="idmember"
                        class="text-break font-weight-bold mb-4" style="font-size:36px;
                                width:100%;">
                        {{-- {{ $member[$i-1]->id_member }} --}}
                    </label>
                    <div class="row justify-content-between mb-2 ml-0">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{__('Nama Lengkap')}}
                        </label>
                        <label id="namaMember" name="namamember" class="col-md-6 mb-0">
                            {{-- {{ $m->nama_lengkap }} --}}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2 ml-0">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{__('Tanggal Lahir')}}
                        </label>
                        <label id="tlMember" name="tlmember" class="col-md-6 mb-0">
                            {{-- {{ $m->tanggal_lahir }} --}}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2 ml-0">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{__('Jenis Kelamin')}}
                        </label>
                        <label id="jkMember" name="jkmember" class="col-md-6 mb-0">
                            {{-- @if ($m->jenis_kelamin === 'L')
                                    {{__('Laki-Laki') }}
                            @elseif ($m->jenis_kelamin === 'P')
                            {{__('Perempuan') }}
                            @else{
                            {{__('-') }}
                            }
                            @endif --}}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2 ml-0">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{__('Email')}}
                        </label>
                        <label id="emailMember" name="emailmember" class="col-md-6 mb-0">
                            {{-- {{ $m->email }} --}}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2 ml-0">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{__('Nomor HP')}}
                        </label>
                        <label id="nomorHPMember" name="nomorhpmember" class="col-md-6 mb-0">
                            {{-- {{ $m->nomor_hp }} --}}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-4 ml-0">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{__('Alamat')}}
                        </label>
                        <label id="alamatMember" name="alamatmember" class="col-md-6 mb-0">
                            {{-- {{ $m->alamat }} --}}
                            {{-- @for($i=0 ; $i < count($member->alamat['alamat']);$i++)
                                    {{ $member->alamat['alamat'][$i]['AlamatJalan'] }},
                            {{ $member->alamat['alamat'][$i]['Kelurahan'] }},
                            {{ $member->alamat['alamat'][$i]['Kecamatan'] }},
                            {{ $member->alamat['alamat'][$i]['KabupatenKota'] }},
                            {{ $member->alamat['alamat'][$i]['Provinsi'] }},
                            {{ $member->alamat['alamat'][$i]['KodePos'] }}
                            @endfor --}}
                        </label>
                    </div>
                    <div class="container mb-2" style="font-size:18px;">
                        <button class="btn btn-danger btn-outline-danger-primary btn-block font-weight-bold mb-4"
                            style="border-radius:30px">
                            {{__('Hapus')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else
<label>Data Member Kosong</label>
@endif

@section('script')
<script>
    $(function() {
        $('#memberTable').DataTable({
            processing: true,
                    serverSide: true,
                    orderable: true,
                    searchable: true,
                    ajax: 'member/json',
                    columns: [
                        { data: 'id_member', name: 'id_member' },
                        { data: 'nama_lengkap', name: 'nama_lengkap' },
                        { data: 'email', name: 'email' }
                    ]
        });
    });

    //dataMemberModal
    $('#memberModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        $(this).find('#idMember').text(button.data('id'))
    })
    //dataPengelolaModal
    $('#pengelolaModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        $(this).find('#idMember').val(button.data('id-member'))
        $(this).find('#namaMember').val(button.data('nama-member'))
        $(this).find('#tlMember').val(button.data('tl-member'))
        $(this).find('#jkMember').val(button.data('jk-member'))
        $(this).find('#emailMember').val(button.data('email-member'))
        $(this).find('#nomorHPMember').val(button.data('nomor-hp-member'))
        $(this).find('#alamatMember').val(button.data('alamat-member'))
    })
</script>
@endsection