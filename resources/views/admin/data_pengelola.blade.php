@php
$pengelola = DB::table('pengelola_percetakan')->get();
@endphp

@extends('layouts.admin')

@section('content')
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
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
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
        } );
    });
</script>
@endsection


