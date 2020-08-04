@php
$pengelola = DB::table('pengelola_percetakan')->get();
@endphp

@extends('layouts.admin')

@section('content')
{{-- <div class="tab-pane fade show active" id="v-pills-beranda" role="tabpanel" style="font-size: 18px;">
    <div class="row jusify-content-between mb-3 mr-0">
        <div class="col-md-10">
            <div class="form-group search-input">
                <div class="main-search-input-item">
                    <input type="text" role="search" class="form-control"
                        placeholder="Cari data pengelola percetakan disini..."
                        aria-label="Cari data pengelola percetakan disini" aria-describedby="basic-addon2" style="border:0px solid white;
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
                <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" id="filterDataPengelola"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;">
                    {{__('Semua')}}
                </button>
                <div class="dropdown-menu" aria-labelledby="filterDataPengelola" style="font-size: 16px;">
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
    @if(!empty($partner))
    <div class="table-scrollbar mb-5 pr-2">
        <table class="table table-hover">
            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;
                        font-size:16px;">
                <tr>
                    <th scope="col-md-auto">
                        {{__('ID')}}
                    </th>
                    <th scope="col-md-auto">
                        {{__('Nama Tempat Percetakan')}}
                    </th>
                    <th scope="col-md-auto">
                        {{__('Email Pemilik Percetakan')}}
                    </th>
                    <th scope="col-md-auto"></th>
                </tr>
            </thead>
            <tbody style="font-size: 12px;">
                @for ($i = 0; $i < count($partner); $i++)
                <tr onclick="window.location.href='partner/detail/{{ $partner[$i]->id_pengelola }}'">
                    <td scope="row">
                        {{$partner[$i]->id_pengelola}}
                    </td>
                    <td>
                        {{$partner[$i]->nama_lengkap}}
                    </td>
                    <td>
                        {{$partner[$i]->email}}
                    </td>
                    <td>
                        <i class="material-icons" style="color: red;" style="margin-left: -200px;">
                            delete
                        </i>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
    @else
    <label>Data Pengelola Kosong</label>
    @endif
</div> --}}

<table id="partnerTable" class="table table-hover">
    <thead class="bg-primary-purple text-white"
            style="font-size:16px;">
        <tr>
            <th>ID</th>
            <th>Nama Tempat Percetakan</th>
            <th>Email Pemilik Percetakan</th>
        </tr>
    </thead>
    <tbody style="font-size: 12px;">
    </tbody>
</table>
<script>
    $(document).ready( function () {
        $('#partnerTable').DataTable({
            scrollY: 300,
            paging: false,
            info: false,
            processing: true,
            serverSide: true,
            orderable: true,
            searchable: true,
            autowidth: true,
            deferloading: 0,
            ajax: '{{ route('admin.partner.json') }}',
            columns: [
                { data: 'id_pengelola', name: 'id_pengelola' },
                { data: 'nama_toko', name: 'nama_toko' },
                { data: 'email', name: 'email' }
            ]
        });

        var table = $('#partnerTable').DataTable();
        $('#partnerTable tbody').on( 'click', 'tr', function () {
            var id = table.row(this).data();
            document.location.href='partner/detail/' + id.id_pengelola;
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
@endsection



