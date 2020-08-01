//halaman tambah produk
$('#jenisPrinterList span').on('click', function () {
    $('#jenisPrinterButton').text($(this).text());
    $('#jenisPrinter').val($(this).text());
});

$('#ukuranKertasList span').on('click', function () {
    $('#ukuranKertasButton').text($(this).text());
    $('#ukuranKertas').val($(this).text());
});

$(document).ready(function() {
 var i = 0;
    $("#tambahPaket").click(function() {
      $("#areaTambah").append(
        "<li class='ml-0 mr-0'><div class='row justify-content-between mb-2 ml-0' style='list-style-position: inside'>    <div class='col-md-2' >        <img src='https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg'            class='img-responsive bg-light' style='width:163px;                    height:163px;                    border-radius:10px;'>        <a href='' style='color: black;                    position: relative;                    bottom: 40px;                    left:130px;                    right: 0px;'>            <i class='material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2' style='border-radius: 5px;'>                edit            </i>        </a>    </div>    <div class='col-md-9'>        <div class='row justify-content-between mr-1'>            <div class='col-md-6 form-group mb-3'>                <input name='fitur[tambahan]["+i+"][nama]' id='nama' type='text' class='form-control form-control-lg pt-2 pb-2' placeholder='Masukkan Nama Paket'                    aria-label='' aria-describedby='inputGroup-sizing-sm'                    style='font-size: 16px; ' required>            </div>            <div class='row col-md-6 form-group '>                <label class='align-self-center' style=' display: inline-block; width: 10%; text-align: right; padding-right:8px'>                    Rp                </label>                <input id='harga' name='fitur[tambahan]["+i+"][harga]' type='number' min='0' class='form-control pt-2 pb-2 optional-step-100' placeholder='Masukkan Harga Produk' aria-label='Masukkan Harga Produk'                    aria-describedby='inputGroup-sizing-sm' style='font-size: 16px; width:90%' required>            </div>        </div>        <label class='mb-2 '>            Deskripsi Fitur        </label>        <div class='form-group mb-4 mr-0'>            <textarea id='deskripsi' name='fitur[tambahan]["+i+"][deskripsi]' class='form-control d-flex' aria-label='Deskripsi Fitur'                placeholder='Masukkan Deskripsi Paket Tambahan Anda'></textarea>        </div>    </div>    <div class='col-md-auto align-self-center mr-0 mb-3'>        <button id='hapus' class='btn btn-circle-trash shadow-sm' type='button'            role='button'>            <i class='fa fa-trash fa-2x' style='color: white' aria-hidden='true'></i>        </button>    </div></div></li>"
        );
        i++;
    });

    $("#areaTambah").on("click","#hapus",function(){
        $($(this).parents('li').get(0)).remove();
	});
});


   





/*
  jQuery Optional Number Step

Version: 1.0.0
 Author: Arthur Shlain
   Repo: https://github.com/ArthurShlain/JQuery-Optional-Step
 Issues: https://github.com/ArthurShlain/JQuery-Optional-Step/issues
*/
(function ($) {

    $.fn.optionalNumberStep = function (step) {
        var $base = $(this);

        var $body = $('body');

        $body.on("mouseenter mousemove", '[data-optional-step]', function () {
            $(this).attr("step", $(this).attr('data-optional-step'));
        });

        $body.on("mouseleave blur", '[data-optional-step]', function () {
            $(this).removeAttr("step");
        });

        $body.on("keydown", '[data-optional-step]', function () {
            var key = event.which;
            switch (key) {
                case 38: // Key up.
                    $(this).attr("step", step);
                    break;

                case 40: // Key down.
                    $(this).attr("step", step);
                    break;
                default:
                    $(this).removeAttr("step");
                    break;
            }
        });

        if (step === 'unset') {
            $base.removeAttr('data-optional-step');
        }

        if ($.isNumeric(step)) {
            $base.attr('data-optional-step', step);
        }

    }

}(jQuery));

jQuery(function () {
    $('.optional-step-100').optionalNumberStep(100);
});
