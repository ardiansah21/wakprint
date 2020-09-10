@extends('layouts.admin')

@section('content')
<div class="tab-pane fade show active" role="tabpanel" style="font-size: 18px;">
    {{-- <div class="row jusify-content-between mb-3 mr-0">
        <div class="col-md-10">
            <div class="form-group search-input">
                <div class="main-search-input-item">
                    <input type="text"
                        role="search"
                        class="form-control"
                        placeholder="Cari data saldo disini..."
                        aria-label="Cari data saldo disini"
                        aria-describedby="basic-addon2"
                        style="border:0px solid white;
                            border-radius:30px;
                            font-size:16px;">
                        <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                            style="position: absolute;
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
                <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                    id="filterDataSaldo"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    style="font-size: 16px;">
                    {{__('Semua')}}
                </button>
                <div class="dropdown-menu"
                    aria-labelledby="filterDataSaldo"
                    style="font-size: 16px;">
                    <a class="dropdown-item"
                        href="#">
                        {{__('Terbaru')}}
                    </a>
                    <a class="dropdown-item"
                        href="#">
                        {{__('A-Z')}}
                    </a>
                    <a class="dropdown-item"
                        href="#">
                        {{__('Z-A')}}
                    </a>
                    <a class="dropdown-item"
                        href="#">
                        {{__('Jumlah Tertinggi')}}
                    </a>
                    <a class="dropdown-item"
                        href="#">
                        {{__('Jumlah Terendah')}}
                    </a>
                    <a class="dropdown-item"
                        href="#">
                        {{__('Pending')}}
                    </a>
                    <a class="dropdown-item"
                        href="#">
                        {{__('Berhasil')}}
                    </a>
                    <a class="dropdown-item"
                        href="#">
                        {{__('Gagal')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="ml-0 mr-0">
        <ul class="nav nav-pills mb-3"
            id="pills-tab"
            role="tablist"
            style="font-size: 16px;">
            <li class="nav-item mr-3">
                <a class="nav-link active"
                    id="pills-saldo-member-tab"
                    data-toggle="tab"
                    href="#pills-saldo-member"
                    role="tab"
                    aria-controls="pills-saldo-member"
                    aria-selected="true"
                    style="border-radius:10px 10px 0px 0px;">
                    <i class="material-icons align-middle mr-2">
                        account_circle
                    </i>
                    {{__('Member')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                    id="pills-saldo-pengelola-tab"
                    data-toggle="tab"
                    href="#pills-saldo-pengelola"
                    role="tab"
                    aria-controls="pills-saldo-pengelola"
                    aria-selected="false"
                    style="border-radius:10px 10px 0px 0px;">
                    <i class="material-icons align-middle mr-2">
                        print
                    </i>
                    {{__('Pengelola Percetakan')}}
                </a>
            </li>
        </ul>
        <div class="tab-content ml-0 mr-0"
            id="pills-tabContent">
            <div class="tab-pane fade show active"
                id="pills-saldo-member"
                role="tabpanel"
                aria-labelledby="pills-saldo-member-tab">
                <div class="my-custom-scrollbar">
                    <div class="table-scrollbar mb-5 pr-2">
                        <table class="table table-hover">
                            <thead class="bg-primary-purple text-white"
                                style="border-radius:25px 25px 15px 15px;
                                    font-size:16px;">
                                <tr>
                                    <th scope="col-md-auto">
                                        {{__('ID')}}
                                    </th>
                                    <th scope="col-md-auto">
                                        {{__('Nama')}}
                                    </th>
                                    <th scope="col-md-auto">
                                        {{__('Kode Pembayaran')}}
                                    </th>
                                    <th scope="col-md-auto">
                                        {{__('Jumlah Top Up')}}
                                    </th>
                                    <th scope="col-md-auto">
                                        {{__('Status')}}
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 12px;">
                                @foreach ($transaksi_saldo as $ts)
                                    @if($ts->jenis_transaksi === 'TopUp' || $ts->jenis_transaksi === 'Pembayaran')
                                        <tr>
                                            <td scope="row">
                                                {{$ts->id_transaksi ?? '-'}}
                                            </td>
                                            <td>
                                                {{$member[Auth::id()-1]->nama_lengkap}}
                                            </td>
                                            <td>
                                                {{$ts->kode_pembayaran ?? '-'}}
                                            </td>
                                            <td>
                                                Rp. {{$ts->jumlah_saldo ?? '-'}}
                                            </td>
                                            <td>
                                                {{$ts->status ?? '-'}}
                                            </td>
                                            <td>
                                                <a href="">
                                                    <i class="material-icons"
                                                        style="color: #7BD6AF;">
                                                        check_circle
                                                    </i>
                                                </a>
                                                <a href="{{ route('admin.saldo.tolak') }}">
                                                    <i class="material-icons"
                                                        style="color: #FF4949;">
                                                        cancel
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade"
                id="pills-saldo-pengelola"
                role="tabpanel"
                aria-labelledby="pills-saldo-pengelola-tab">
                <div class="table-scrollbar mb-5 pr-2">
                    <table class="table table-hover">
                        <thead class="bg-primary-purple text-white"
                            style="border-radius:25px 25px 15px 15px;
                                font-size:16px;">
                            <tr>
                                <th scope="col-md-auto">
                                    {{__('ID')}}
                                </th>
                                <th scope="col-md-auto">
                                    {{__('Nama')}}
                                </th>
                                <th scope="col-md-auto">
                                    {{__('Jumlah Penarikan')}}
                                </th>
                                <th scope="col-md-auto">
                                    {{__('Status')}}
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 12px;">

                            @foreach ($transaksi_saldo as $ts)
                                @if($ts->jenis_transaksi === 'Tarik')
                                    <tr>
                                        <td scope="row">
                                            {{$ts->id_transaksi}}
                                        </td>
                                        <td>
                                            {{$partner[Auth::id()-1]->nama_lengkap}}
                                        </td>
                                        <td>
                                            Rp. {{$ts->jumlah_saldo}}
                                        </td>
                                        <td>
                                            {{$ts->status}}
                                        </td>
                                        <td>
                                            <a href="">
                                                <i class="material-icons"
                                                    style="color: #7BD6AF;">
                                                    check_circle
                                                </i>
                                            </a>
                                            <a href="{{ route('admin.saldo.tolak') }}">
                                                <i class="material-icons"
                                                    style="color: #FF4949;">
                                                    cancel
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    <ul class="nav nav-pills mb-3"
            id="pills-tab"
            role="tablist"
            style="font-size: 16px;">
            <li class="nav-item mr-3">
                <a class="nav-link"
                    id="pills-saldo-member-tab"
                    data-toggle="tab"
                    href="#pills-saldo-member"
                    role="tab"
                    aria-controls="pills-saldo-member"
                    aria-selected="true"
                    style="border-radius:10px 10px 0px 0px;">
                    <i class="material-icons align-middle mr-2">
                        account_circle
                    </i>
                    {{__('Member')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                    id="pills-saldo-pengelola-tab"
                    data-toggle="tab"
                    href="#pills-saldo-pengelola"
                    role="tab"
                    aria-controls="pills-saldo-pengelola"
                    aria-selected="false"
                    style="border-radius:10px 10px 0px 0px;">
                    <i class="material-icons align-middle mr-2">
                        print
                    </i>
                    {{__('Pengelola Percetakan')}}
                </a>
            </li>
        </ul>
        <div class="tab-content ml-0 mr-0"
            id="pills-tabContent">
            <div class="tab-pane fade show active"
                id="pills-saldo-member"
                role="tabpanel"
                aria-labelledby="pills-saldo-member-tab">
                <table id="memberSaldoTable" class="table table-hover">
                    <thead class="bg-primary-purple text-white"
                            style="font-size:16px;">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Kode Pembayaran</th>
                            <th>Jumlah Top Up</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px;">
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade show"
                id="pills-saldo-pengelola"
                role="tabpanel"
                aria-labelledby="pills-saldo-pengelola-tab">
                <table id="partnerSaldoTable" class="table table-hover">
                    <thead class="bg-primary-purple text-white"
                            style="font-size:16px;">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Jumlah Penarikan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px;">
                    </tbody>
                </table>
            </div>
        </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#memberSaldoTable').DataTable({
                scrollY: 300,
                paging: false,
                info: false,
                processing: true,
                serverSide: true,
                orderable: true,
                searchable: true,
                autowidth: true,
                deferloading: 0,
                ajax: '{{ route('admin.saldo.json') }}',
                columns: [
                    { data: 'id_transaksi', name: 'id_transaksi' },
                    { data: 'jenis_transaksi', name: 'jenis_transaksi' },
                    { data: 'kode_pembayaran', name: 'kode_pembayaran' },
                    { data: 'jumlah_saldo', name: 'jumlah_saldo' },
                    { data: 'status', name: 'status' }
                ]
            });

            $('#partnerSaldoTable').DataTable({
                scrollY: 300,
                paging: false,
                info: false,
                processing: true,
                serverSide: true,
                orderable: true,
                searchable: true,
                autowidth: true,
                deferloading: 0,
                ajax: '{{ route('admin.saldo.json') }}',
                columns: [
                    { data: 'id_transaksi', name: 'id_transaksi' },
                    { data: 'jenis_transaksi', name: 'jenis_transaksi' },
                    { data: 'jumlah_saldo', name: 'jumlah_saldo' },
                    { data: 'status', name: 'status' }
                ]
            });

        // var table = $('#partnerTable').DataTable();
        // $('#partnerTable tbody').on( 'click', 'tr', function () {
        //     var id = table.row(this).data();
        //     document.location.href='partner/detail/' + id.id_pengelola;
        //     // if ($(this).hasClass('selected')) {
        //     //     $(this).removeClass('selected');
        //     // }
        //     // else {
        //     //     table.$('tr.selected').removeClass('selected');
        //     //     $(this).addClass('selected');
        //     //}
        // });

            $('li.a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                var currentTab = $(e.target).text(); // get current tab
                switch (currentTab)   {
                    case 'Member' :   //do nothing
                        //$('.nav-pills .nav-item a[href="pills-saldo-member"]').tab('show');
                        var table = $('#memberSaldoTable').DataTable({
                            scrollY: 300,
                            paging: false,
                            info: false,
                            processing: true,
                            serverSide: true,
                            orderable: true,
                            searchable: true,
                            autowidth: true,
                            deferloading: 0,
                            ajax: '{{ route('admin.saldo.json') }}',
                            columns: [
                                { data: 'id_transaksi', name: 'id_transaksi' },
                                { data: 'jenis_transaksi', name: 'jenis_transaksi' },
                                { data: 'kode_pembayaran', name: 'kode_pembayaran' },
                                { data: 'jumlah_saldo', name: 'jumlah_saldo' },
                                { data: 'status', name: 'status' }
                            ]
                        });
                        //$('#container').css( 'display', 'block' );
                        $('#memberSaldoTable tbody').on( 'click', 'tr', function () {
                            // var id = table.row(this).data();
                            document.location.href='saldo/tolak';
                        });
                        table.columns.adjust().draw();
                        
                        break;
                    case 'Pengelola Percetakan' :
                        var table = $('#partnerSaldoTable').DataTable({
                            scrollY: 300,
                            paging: false,
                            info: false,
                            processing: true,
                            serverSide: true,
                            orderable: true,
                            searchable: true,
                            autowidth: true,
                            deferloading: 0,
                            ajax: '{{ route('admin.saldo.json') }}',
                            columns: [
                                { data: 'id_transaksi', name: 'id_transaksi' },
                                { data: 'jenis_transaksi', name: 'jenis_transaksi' },
                                { data: 'jumlah_saldo', name: 'jumlah_saldo' },
                                { data: 'status', name: 'status' }
                            ]
                        });

                        //$('#container').css( 'display', 'block' );
                        table.columns.adjust().draw();
                        $('.li a[href="pills-saldo-pengelola' + tab + '"]').tab('show');
                        break ;
                    default:
                        $('ul li a').addClass('active');
                        $('ul li a').on('click', function () {
                            $(this).closest('nav ul').find('a.active').removeClass('active');
                            $(this).addClass('active');
                        });

                        var table = $('#memberSaldoTable').DataTable({
                            scrollY: 300,
                            paging: false,
                            info: false,
                            processing: true,
                            serverSide: true,
                            orderable: true,
                            searchable: true,
                            autowidth: true,
                            deferloading: 0,
                            ajax: '{{ route('admin.saldo.json') }}',
                            columns: [
                                { data: 'id_transaksi', name: 'id_transaksi' },
                                { data: 'jenis_transaksi', name: 'jenis_transaksi' },
                                { data: 'kode_pembayaran', name: 'kode_pembayaran' },
                                { data: 'jumlah_saldo', name: 'jumlah_saldo' },
                                { data: 'status', name: 'status' }
                            ]
                        });
                        table.columns.adjust().draw();
                        $('li a[href="pills-saldo-member"]').tab('show');
                };
            }) ;
        } );
    </script>
@endsection
