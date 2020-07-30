@inject('mbr', 'App\Member')

@extends('layouts.admin')

@section('content')
<div class="container mt-4 mb-5">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active mb-2" id="v-pills-beranda-tab" data-toggle="pill" href="#v-pills-beranda"
                    role="tab" aria-controls="v-pills-beranda" aria-selected="true" style="font-size:18px;">
                    <i class="material-icons md-36 align-middle mr-2">
                        home
                    </i>
                    {{__('Beranda')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-data-member-tab" data-toggle="pill" href="#v-pills-data-member"
                    role="tab" aria-controls="v-pills-data-member" aria-selected="true" style="font-size:18px;">
                    <i class="material-icons md-36 align-middle mr-2">
                        history_edu
                    </i>
                    {{__('Data Member')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-data-pengelola-tab" data-toggle="pill"
                    href="#v-pills-data-pengelola" role="tab" aria-controls="v-pills-data-pengelola"
                    aria-selected="true" style="font-size:18px;">
                    <i class="material-icons md-36 align-middle mr-2">
                        print
                    </i>
                    {{__('Data Pengelola')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-saldo-tab" data-toggle="pill" href="#v-pills-saldo" role="tab"
                    aria-controls="v-pills-saldo" aria-selected="true" style="font-size:18px;">
                    <i class="material-icons md-36 align-middle mr-2">
                        account_balance_wallet
                    </i>
                    {{__('Saldo')}}
                </a>
                <a class="nav-link mb-4" id="v-pills-keluhan-tab" data-toggle="pill" href="#v-pills-keluhan" role="tab"
                    aria-controls="v-pills-keluhan" aria-selected="true" style="font-size:18px;">
                    <i class="material-icons md-36 align-middle mr-2">
                        chat
                    </i>
                    {{__('Keluhan Pelanggan')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-keluar-tab" data-toggle="pill" href="#v-pills-keluar" role="tab"
                    aria-controls="v-pills-keluar" aria-selected="true" style="font-size:18px;"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                    <i class="material-icons text-primary-danger md-36 align-middle mr-2">
                        exit_to_app
                    </i>
                    {{__('Keluar')}}
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        <div class="tab-content col-md-8">
            <div class="tab-pane fade show active" id="v-pills-beranda" role="tabpanel" style="font-size: 18px;">
                <div class="row justify-content-between mb-4 ml-0">
                    <div class="col-md-6">
                        <label class="font-weight-bold">
                            {{__('Total Member')}}
                        </label>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light-purple p-4 col-md-12 text-center mr-4" style="border-radius:10px;
                                font-size:48px;">
                            <label class="font-weight-bold text-break" style="width: 100%;">
                                {{__('43')}}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mb-4 ml-0">
                    <div class="col-md-6">
                        <label class="font-weight-bold">
                            {{__('Total Pengelola Percetakan')}}
                        </label>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light-purple p-4 col-md-12 text-center mr-4" style="border-radius:10px;
                                font-size:48px;">
                            <label class="font-weight-bold text-break" style="width: 100%;">
                                {{__('43')}}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mb-4 ml-0">
                    <div class="col-md-6">
                        <label class="font-weight-bold">
                            {{__('Jumlah Transaksi')}}
                        </label>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light-purple p-4 col-md-12 text-center mr-4" style="border-radius:10px;
                                font-size:48px;">
                            <label class="font-weight-bold text-break" style="width: 100%;">
                                {{__('43')}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-data-member" role="tabpanel">
                <div class="row jusify-content-between mb-3 mr-0">
                    <div class="col-md-10">
                        {{-- <form action="{{ route('cari_member') }}" method="GET"> --}}
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
                        {{-- </form> --}}

                    </div>
                    <div class="col-md-2">
                        <div class="dropdown">
                            <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                                id="filterDataMember" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="font-size: 16px;">
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
                        <table id="tableMember" class="table table-hover">
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
                                @for($i=0 ; $i < count($member);$i++) <tr data-toggle="modal" data-target="#memberModal"
                                    data-id-member="{{ $member[$i]->id_member }}"
                                    data-nama-member="{{ $member[$i]->nama_lengkap }}"
                                    data-tl-member="{{ $member[$i]->tanggal_lahir }}"
                                    data-jk-member="{{ $member[$i]->jenis_kelamin }}"
                                    data-email-member="{{ $member[$i]->email }}"
                                    data-nomor-hp-member="{{ $member[$i]->nomor_hp }}"
                                    data-alamat-member="{{ $member[$i]->alamat }}">

                                    <td scope="row">
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
                                    </tr>
                                    @endfor
                                    {{-- @foreach($member as $m)
                                <tr data-toggle="modal"
                                    data-target="#memberModal"
                                    data-id="{{ $m->id_member }}"
                                    data-nama-member="{{ $m->nama_lengkap }}"
                                    data-tl-member="{{ $m->tanggal_lahir }}"
                                    data-jk-member="{{ $m->jenis_kelamin }}"
                                    data-email-member="{{ $m->email }}"
                                    data-nomor-hp-member="{{ $m->nomor_hp }}"
                                    data-alamat-member="{{ $m->alamat }}"
                                    >
                                    <td scope="row">
                                        {{ $m->id_member }}
                                    </td>
                                    <td>
                                        {{ $m->nama_lengkap }}
                                    </td>
                                    <td>
                                        {{ $m->email }}
                                    </td>
                                    <td>
                                        <i class="material-icons" style="color: red;" style="margin-left: -200px;">
                                            delete
                                        </i>
                                    </td>
                                    </tr>
                                    @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content" style="border-radius: 10px;
                            font-size:18px;">

                        </div>
                    </div>
                </div>
                @else
                <label>Data Member Kosong</label>
                @endif
                {{-- <script type="text/javascript">
                    $('#cariMember').on('keyup',function(){
                        $value=$(this).val();
                        $.ajax({
                            type : 'get',
                            url : '{{URL::to('search')}}',
                            data:{'carimember':$value},
                            success:function(data){
                            $('tbody').html(data);
                            }
                        });
                    })
                </script>

                <script type="text/javascript">
                    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                </script> --}}
                {{-- @include('admin.data_member') --}}
                {{-- @include('admin.detail_member') --}}
            </div>
            <div class="tab-pane fade" id="v-pills-data-pengelola" role="tabpanel">
                @include('admin.data_pengelola')
            </div>
            <div class="tab-pane fade" id="v-pills-saldo" role="tabpanel">
                @include('admin.konfirmasi_saldo')
            </div>
            <div class="tab-pane fade" id="v-pills-keluhan" role="tabpanel">
                @include('admin.kelola_keluhan')
            </div>
        </div>
    </div>
</div>

<script>
    function cariMember() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("cariMember");
      filter = input.value.toUpperCase();
      table = document.getElementById("tableMember");
      tr = table.getElementsByTagName("tr");
    
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
    //dataMemberModal
    $('#memberModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        $(this).find('#idMember').text(button.data('id'))
        // $(this).find('#namaMember').text(button.data('nama-member'))
        // $(this).find('#tlMember').text(button.data('tl-member'))
        // $(this).find('#jkMember').text(button.data('jk-member'))
        // $(this).find('#emailMember').text(button.data('email-member'))
        // $(this).find('#nomorHPMember').text(button.data('nomor-hp-member'))
        // $(this).find('#alamatMember').text(button.data('alamat-member'))
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