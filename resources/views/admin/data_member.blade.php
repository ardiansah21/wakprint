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
@endsection

@section('script')
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<!-- Data Tables Import Online -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
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
        } );
    });
</script>
@endsection
