@php
    $member = DB::table('member')->get();
@endphp

{{-- @extends('table') --}}

@extends('layouts.admin')

@section('content')
<table id="memberTable" class="table table-hover">
    <thead class="bg-primary-purple text-white"
            style="border-radius:25px 25px 15px 15px; font-size:16px;">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody style="font-size: 12px;">
    </tbody>
</table>
<script>
    $(document).ready( function () {
        $('#memberTable').DataTable({
            scrollY: 300,
            paging: false,
            info: false,
            processing: true,
            serverSide: true,
            orderable: true,
            searchable: true,
            autowidth: true,
            deferloading: 0,
            ajax: '{{ route('admin.member.json') }}',
            columns: [
                { data: 'id_member', name: 'id_member' },
                { data: 'nama_lengkap', name: 'nama_lengkap' },
                { data: 'email', name: 'email' }
            ]
        });

        var table = $('#memberTable').DataTable();
        $('#memberTable tbody').on( 'click', 'tr', function () {
            var id = table.row(this).data();
            document.location.href='member/detail/' + id.id_member;
            // if ($(this).hasClass('selected')) {
            //     $(this).removeClass('selected');
            // }
            // else {
            //     table.$('tr.selected').removeClass('selected');
            //     $(this).addClass('selected');
            // }
        } );
    });
</script>
{{-- <div class="tab-pane fade show active" id="v-pills-beranda" role="tabpanel" style="font-size: 18px;">
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
                        <tr onclick="window.location.href='member/detail/{{ $member[$i]->id_member }}'">
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
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    </div>
    @else
    <label>Data Member Kosong</label>
    @endif
</div> --}}

@endsection


