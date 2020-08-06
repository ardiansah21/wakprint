function submit() {
    showLoading();
    document.getElementById('form').submit();
}
$(function () {
    $('.table').hide();
    $(document).ready(function () {
        $('#loading').hide();
        var bar = $('.bar');
        var percent = $('.percent');

        $('form').ajaxForm({
            beforeSend: function () {
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
                $('.table').hide();
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
                $('#loading').show();
            },
            complete: function (xhr) {
                // alert('File Uploaded Successfully');
                // window.location.href = "/pdf";
                // $('form').submit;
                // alert(xhr['path']);
                // document.getElementsByClassName('aa').html(xhr.path)

                var data = xhr.responseText;
                var pdf = JSON.parse(data);

                // $('#aa').html(pdf['namaFile']);

                $('.table').ready(function () {
                    $('.table').show();
                    $('#loading').hide();
                    var k = '<tbody>'
                    for (i = 0; i < pdf['halaman'].length; i++) {
                        if(pdf['halaman'][i].jenis_warna=="Berwarna")
                            k += '<tr class= "bg-success">';
                        else
                            k += '<tr class="bg-secondary">';
                        k += '<td scope="row">' + (i+1) + '</td>';
                        k += '<td>' + pdf['halaman'][i].total_piksel + '</td>';
                        k += '<td>' + pdf['halaman'][i].piksel_berwarna + '</td>';
                        k += '<td>' + pdf['halaman'][i].piksel_hitam_putih + '</td>';
                        k += '<td>' + pdf['halaman'][i].jenis_warna + '</td>';
                        k += '</tr>';
                    }
                    k += '</tbody>';
                    document.getElementById('tableData').innerHTML = k;
                });
            }

        });
    });
});









// function showLoading() {
//     document.querySelector('#loading').classList.add('loading');
//     document.querySelector('#loading-content').classList.add('loading-content');
// }

// function hideLoading() {
//     document.querySelector('#loading').classList.remove('loading');
//     document.querySelector('#loading-content').classList.remove('loading-content');
// }

//////////
