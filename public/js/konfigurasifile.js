
// (function ($) {
//     $(document).ready(function () {

//         $('#hapusConfigurasi').on('click', function () {

//             $.ajax({
//                 url: '/notificationsSeen',
//                 type: 'POST',
//                 data: { _token: '{{ csrf_token() }}' },
//                 success: function () { alert('success!'); },
//                 error: function () { alert('error'); },
//             });

//         });

//     });
// }(jQuery));


$(function () {

    $('#loading').hide();

    $(document).ready(function () {
        $('#simpanKonfigurasi').on('click', function (e) {
            // alert('{{route("konfigurasi.cekwarna")}}');
            e.preventDefault;
            prosesCekwarna();
        });
    });

    function prosesCekwarna() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var data = JSON.stringify({
            path: "{{session()->get('fileUpload')->path}}",
            // percenMin : 0
        });


        var produkKonfigurasiFile = "{{session()->has('produkKonfigurasiFile')}}";
        var fileUpload = "{{session()->has('fileUpload')}}";

        if (produkKonfigurasiFile == true && fileUpload == true) {


            $.ajax({
                type: 'GET',
                url: '{{route("konfigurasi.cekwarna")}}',
                data: data,
                dataType: 'json',
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                    alert(thrownError);
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    alert(data);
                    console.log(data);
                },
                complete

            });
        }
    }
});

            //   xhr: function () {
            //         var http = new window.XMLHttpRequest();
            //         http.onerror = function () {
            //             alert("Gagal mengambil data");
            //         },
            //             http.setRequestHeader("Content-Type", "application/json;charset=UTF-8"),
            //             http.setRequestHeader("Accept", "application/json");
            //         return http
            //     },
