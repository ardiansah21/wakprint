@extends('layouts.admin')

@section('content')
    <table id="keluhanTable" class="table table-hover">
        <thead class="bg-primary-purple text-white"
            style="border-radius:25px 25px 15px 15px; font-size:16px;">
            <tr>
                <th scope="col-md-auto">
                    {{ __('ID') }}
                </th>
                <th scope="col-md-auto">
                    {{ __('Nama') }}
                </th>
                <th scope="col-md-auto">
                    {{ __('Keluhan') }}
                </th>
                <th scope="col-md-auto">
                    {{ __('Status') }}
                </th>
            </tr>
        </thead>
        <tbody style="font-size: 12px;">
        </tbody>
    </table>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Data Tables Import Online -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        // $(document).ready(function() {
        var table = $('#keluhanTable').DataTable({
            scrollY: 300,
            paging: false,
            info: false,
            processing: true,
            serverSide: true,
            orderable: true,
            searchable: true,
            autowidth: true,
            deferloading: 0,
            ajax: "{{ route('admin.keluhan.json') }}",
            columns: [{
                    data: 'id_lapor',
                    name: 'id_lapor'
                },
                {
                    data: 'id_member',
                    name: 'id_member'
                },
                {
                    data: 'pesan',
                    name: 'pesan'
                },
                {
                    data: 'status',
                    name: 'status'
                }
            ]
        });


        $('#keluhanTable tbody').on('click', 'tr', function() {
            var id = table.row(this).data();
            if (id.status === 'Pending') {
                document.location.href = 'keluhan/detail/' + id.id_lapor;
            }
        });
        // if (data.status === 'Pending') {
        //     alert('Pending');
        //     $('#keluhanTable tbody').on('click', 'tr', function() {
        //         var id = table.row(this).data();
        //         document.location.href = 'keluhan/detail/' + id.id_lapor;
        //     });
        // } else {
        //     alert('No');
        // }
        // });

    </script>
@endsection


{{-- @include('admin.tanggapi_keluhan') --}}
