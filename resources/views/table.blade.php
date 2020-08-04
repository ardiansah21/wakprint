<!DOCTYPE html>
<html>

<head>
    <title>Laravel 5.8 Datatables Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <button class="btn btn-default" id="button">Add Row</button>
        <button class="btn btn-default" id="button2">Delete Row</button>
        <table id="memberTable" class="table table-hover">
            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 0px 0px;font-size:16px;">
                <tr>
                    <th>ID</th>
                    <th>Nama Member</th>
                    <th>Email Member</th>
                </tr>
            </thead>
            <tbody style="font-size: 12px;">
            </tbody>
        </table>
    </div>
</body>

<script>
    $(document).ready(function() {
        //var tm = $('#memberTable').DataTable();
        var selected = [];
        var counter = 1;



        // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        //     $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
        // } );

        $('#memberTable').DataTable({
            scrollY:'30vh',
            scrollCollapse: true,
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
                { data: 'id_member',name: 'id_member' },
                { data: 'nama_lengkap', name: 'nama_lengkap' },
                { data: 'email', name: 'email' }
            ],
            // rowCallback: function( row, data ) {
            //     if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
            //         $(row).addClass('selected');
            //     }
            // }

            // responsive: {
            //     details: {
            //         display: $.fn.dataTable.Responsive.display.modal( {
            //             header: function ( row ) {
            //                 var data = row.data();
            //                 return 'Details for '+data['id_member']+' '+data['nama_lengkap'];
            //             }
            //         } ),
            //         renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
            //             tableClass: 'table'
            //         } )
            //     }
            // }
        });

        // $('#button').on( 'click', function () {
        //     tm.row.add( [
        //         counter +'.1',
        //         counter +'.2',
        //         counter +'.3',
        //         counter +'.4',
        //         counter +'.5'
        //     ]).draw( false );

        //     counter++;
        // } );

        // $('#memberTable tbody').on( 'click', 'tr', function () {
        //     if($(this).hasClass('selected')) {
        //         $(this).removeClass('selected');
        //     }
        //     else {
        //         table.$('tr.selected').removeClass('selected');
        //         $(this).addClass('selected');
        //     }
        // } );

        // // Automatically add a first row of data
        // $('#button').click();

        // // Automatically delete a row of data
        // $('#button2').click( function () {
        //     table.row('.selected').remove().draw( false );
        // });

        // $('#memberTable tbody').on('click', 'tr', function () {
        //     var id = this.id;
        //     var index = $.inArray(id,selected);
        //     if ( index === -1 ) {
        //             selected.push(id);
        //         } else {
        //             selected.splice(index,1);
        //         }
        //     $(this).toggleClass('selected');
        // });

        // $('#myTable2').DataTable().search().draw();
    });
</script>

</html>
