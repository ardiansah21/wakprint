@extends('layouts.admin')

@section('content')
    <div class="tab-pane fade show active" role="tabpanel" style="font-size: 18px;">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="font-size: 16px;">
            <li class="nav-item mr-3">
                <a class="nav-link" id="pills-saldo-member-tab" data-toggle="tab" href="#pills-saldo-member" role="tab"
                    aria-controls="pills-saldo-member" aria-selected="true" style="border-radius:10px 10px 0px 0px;">
                    <i class="material-icons align-middle mr-2">
                        account_circle
                    </i>
                    {{ __('Member') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-saldo-pengelola-tab" data-toggle="tab" href="#pills-saldo-pengelola"
                    role="tab" aria-controls="pills-saldo-pengelola" aria-selected="false"
                    style="border-radius:10px 10px 0px 0px;">
                    <i class="material-icons align-middle mr-2">
                        print
                    </i>
                    {{ __('Pengelola Percetakan') }}
                </a>
            </li>
        </ul>
        <div class="tab-content ml-0 mr-0" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-saldo-member" role="tabpanel"
                aria-labelledby="pills-saldo-member-tab">
                <table id="memberSaldoTable" class="table table-hover">
                    <thead class="bg-primary-purple text-white" style="font-size:16px;">
                        <tr>
                            <th class="align-middle">ID</th>
                            <th class="align-middle">Nama</th>
                            <th class="align-middle">Kode Pembayaran</th>
                            <th class="align-middle">Jumlah Top Up</th>
                            <th class="align-middle">Tanggal</th>
                            <th class="align-middle">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px;"></tbody>
                </table>
            </div>
            <div class="tab-pane fade show" id="pills-saldo-pengelola" role="tabpanel"
                aria-labelledby="pills-saldo-pengelola-tab">
                <table id="partnerSaldoTable" class="table table-hover">
                    <thead class="bg-primary-purple text-white" style="font-size:16px;">
                        <tr>
                            <th class="align-middle">ID</th>
                            <th class="align-middle">Nama</th>
                            <th class="align-middle">Jenis Transaksi</th>
                            <th class="align-middle">Jumlah Penarikan</th>
                            <th class="align-middle">Tanggal</th>
                            <th class="align-middle">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px;"></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Data Tables Import Online -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        var saldoMemberTable = $('#memberSaldoTable').DataTable({
            scrollY: 300,
            paging: false,
            info: false,
            processing: true,
            serverSide: true,
            orderable: true,
            searchable: true,
            autowidth: true,
            deferloading: 0,
            ajax: "{{ route('admin.saldo.member.json') }}",
            columns: [{
                    data: 'id_transaksi',
                    name: 'id_transaksi'
                },
                {
                    data: 'jenis_transaksi',
                    name: 'jenis_transaksi'
                },
                {
                    data: 'kode_pembayaran',
                    name: 'kode_pembayaran'
                },
                {
                    data: 'jumlah_saldo',
                    name: 'jumlah_saldo'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: null,
                    name: null,
                    render: function(data, type, row, meta) {
                        if (data.status != 'Pending') {
                            return '';
                        } else {
                            return '<a href="saldo/terima/saldo-member/store/' + data.id_transaksi +
                                '"><i class="material-icons" style="color: #7BD6AF;">check_circle</i></a><a href="saldo/tolak/' +
                                data.id_transaksi +
                                '"><i class="material-icons" style="color: #FF4949;">cancel</i></a>';
                        }
                    }
                }
            ]
        });

        var saldoPartnerTable = $('#partnerSaldoTable').DataTable({
            scrollY: 300,
            paging: false,
            info: false,
            processing: true,
            serverSide: true,
            orderable: true,
            searchable: true,
            autowidth: true,
            deferloading: 0,
            ajax: "{{ route('admin.saldo.partner.json') }}",
            columns: [{
                    data: 'id_transaksi',
                    name: 'id_transaksi'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'jenis_transaksi',
                    name: 'jenis_transaksi'
                },
                {
                    data: 'jumlah_saldo',
                    name: 'jumlah_saldo'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: null,
                    name: null,
                    render: function(data, type, row, meta) {
                        if (data.status != 'Pending') {
                            return '';
                        } else {
                            return '<a href="saldo/terima/saldo-partner/store/' + data.id_transaksi +
                                '"><i class="material-icons" style="color: #7BD6AF;">check_circle</i></a><a href="saldo/tolak/' +
                                data.id_transaksi +
                                '"><i class="material-icons" style="color: #FF4949;">cancel</i></a>';
                        }
                    }
                }
            ]
        });

        $('li.a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var currentTab = $(e.target).text(); // get current tab
            switch (currentTab) {
                case 'Member':
                    $('#memberSaldoTable tbody tr').on('click', 'tr', function() {
                        // var id = table.row(this).data();
                        document.location.href = 'saldo/tolak';
                    });
                    saldoMemberTable.columns.adjust().draw();
                    $('#pills-saldo-member-tab').addClass('active');
                    $('#pills-saldo-pengelola-tab').removeClass('active');
                    break;
                case 'Pengelola Percetakan':
                    // $('#container').css( 'display', 'block' );
                    saldoPartnerTable.columns.adjust().draw();
                    $('.li a[href="pills-saldo-pengelola' + tab + '"]').tab('show');
                    $('#pills-saldo-member-tab').removeClass('active');
                    $('#pills-saldo-pengelola-tab').addClass('active');
                    break;
                default:
                    // $('ul li a').on('click', function () {
                    //     $(this).closest('nav ul').find('a.active').removeClass('active');
                    //     $(this).addClass('active');
                    // });

                    saldoMemberTable.columns.adjust().draw();
                    $('li a[href="pills-saldo-member"]').tab('show');
            }
        });

    </script>
@endsection
