$(function() {
    $('.table').hide();
    $('#hasil').hide();


    $(document).ready(function() {
        $('#loading').hide();
        var bar = $('.bar');
        var percent = $('.percent');

        $('#frmUpload').ajaxForm({
            beforeSend: function() {
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
                $('.table').hide();
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);

            },
            complete: function(xhr) {
                // alert('File Uploaded Successfully');

                bar.width('0%')
                percent.html('0%');

                var data = xhr.responseText;
                var pdf = JSON.parse(data);

                document.getElementById('a').setAttribute('src', 'temp_pdf_pengujian/' + pdf['name'] + '#zoom=30');

                $('#path').val(pdf['path']);



                // $('#aa').html(pdf['namaFile']);
                // xhr.addEventListener("load", () => {
                //     console.log("transfer selesai");
                //   });





                // $('#placeTable').ready(function () {

                //     $('.table').show();
                //     $('#loading').hide();

                //     $('#namaFile').text(pdf['namaFile']);
                //     $('#jumlahHalaman').text(pdf['jumlahHalaman']);
                //     $('#jumlahHalamanBerwarna').text(pdf['jumlahHalBerwarna']);
                //     $('#jumlahHalamanHitamPutih').text(pdf['jumlahHalHitamPutih']);
                //     $('#waktuEksekusi').text(pdf['waktuEksekusi']);
                //     $('#pixelPercenMin').text(pdf['pixelPercenMin']);
                //     // $('embed').src = '{{url(\'pengujian/pdf/\',)."#pagemode=thumbs&statusbar=0&messages=0&navpanes=0&toolbar=0"}}';
                //     // $('#a').src = "<?php {{url('/pengujian/pdf/" + pdf['namaFile'] + "')}}?>";
                //     // document.getElementById('a').setAttribute('src', 'temp_pdf_pengujian/' + pdf["namaFile"])
                //     var k = '<tbody>'
                //     for (i = 0; i < pdf['halaman'].length; i++) {
                //         if (pdf['halaman'][i].jenis_warna == "Berwarna")
                //             k += '<tr class= "bg-success">';
                //         else
                //             k += '<tr class="bg-secondary">';
                //         k += '<td scope="row">' + (i + 1) + '</td>';
                //         k += '<td>' + pdf['halaman'][i].total_piksel + '</td>';
                //         k += '<td>' + pdf['halaman'][i].piksel_berwarna + '</td>';
                //         k += '<td>' + pdf['halaman'][i].piksel_hitam_putih + '</td>';
                //         k += '<td>' + pdf['halaman'][i].jenis_warna + '</td>';
                //         k += '</tr>';
                //     }
                //     k += '</tbody>';
                //     document.getElementById('tableData').innerHTML = k;


                // });
            }

        });



        $('#frmProses').ajaxForm({
            beforeSend: function() {
                $('.table').hide();
                $('#hasil').show();
                $('#loading').show();
                window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' })

            },
            complete: function(xhr) {
                var data = xhr.responseText;
                var pdf = JSON.parse(data);

                $('#placeTable').ready(function() {

                    $('.table').show();
                    $('#loading').hide();

                    $('#namaFile').text(pdf['namaFile']);
                    $('#jumlahHalaman').text(pdf['jumlahHalaman']);
                    $('#jumlahHalamanBerwarna').text(pdf['jumlahHalBerwarna']);
                    $('#jumlahHalamanHitamPutih').text(pdf['jumlahHalHitamPutih']);
                    $('#waktuEksekusi').text(pdf['waktuEksekusi']);
                    $('#pixelPercenMin').text(pdf['pixelPercenMin']);
                    // $('embed').src = '{{url(\'pengujian/pdf/\',)."#pagemode=thumbs&statusbar=0&messages=0&navpanes=0&toolbar=0"}}';
                    // $('#a').src = "<?php {{url('/pengujian/pdf/" + pdf['namaFile'] + "')}}?>";
                    // document.getElementById('a').setAttribute('src', 'temp_pdf_pengujian/' + pdf["namaFile"])
                    var k = '<tbody>'
                    for (i = 0; i < pdf['halaman'].length; i++) {
                        if (pdf['halaman'][i].jenis_warna == "Berwarna")
                            k += '<tr class= "bg-success">';
                        else
                            k += '<tr class="bg-secondary">';
                        k += '<td scope="row">' + (i + 1) + '</td>';
                        k += '<td>' + pdf['halaman'][i].total_piksel + '</td>';
                        k += '<td>' + pdf['halaman'][i].piksel_berwarna + '</td>';
                        k += '<td>' + pdf['halaman'][i].piksel_hitam_putih + '</td>';
                        k += '<td>' + pdf['halaman'][i].piksel_berwarna / pdf['halaman'][i].total_piksel * 100 + '%</td>';
                        k += '<td>' + pdf['halaman'][i].jenis_warna + '</td>';
                        k += '</tr>';
                    }
                    k += '</tbody>';
                    document.getElementById('tableData').innerHTML = k;

                    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' })
                });


            }
        });

    });




});



// $('#labelPreview').hide();

// $('#jenisDokumenList span').on('click', function () {
//     $('#labelPreview').show();
//     $('#jenisDokumenButton').text($(this).text());
//     $('#jenisDokumen').val($(this).text());
//     // document.getElementById('a').setAttribute('src', 'pengujian/pdf/' + $(this).text().trim() + '.pdf');

//     // switch ($(this).text) {
//     //     case "Teks":

//     //         break;

//     //     case "Gambar":

//     //         break;

//     //     case "Text Dan Gambar":

//     //         break;

//     //     case "Kosong":

//     //         break;

//     //     default:
//     //         break;
//     // }

// });



// function showLoading() {
//     document.querySelector('#loading').classList.add('loading');
//     document.querySelector('#loading-content').classList.add('loading-content');
// }

// function hideLoading() {
//     document.querySelector('#loading').classList.remove('loading');
//     document.querySelector('#loading-content').classList.remove('loading-content');
// }

//////////