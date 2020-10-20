<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container">
    <div class="mt-5 mb-5">
        <label class="font-weight-bold" style="font-size:48px;">{{__('Konfigurasi File') }}
        </label>

        @if (!session()->has('fileUpload'))
        <div id="uploadFile" class="row justify-content-between bg-light-purple pl-4 pr-4 pt-4 pb-4 mt-5 mb-5 mr-0 ml-0"
            style="border-radius:5px; height:310px;">
            <div class="col-md-3 border-primary-purple d-flex h-100" style="width:265px;
                height:265px;">
                <label class="SemiBold text-center text-primary-purple align-self-center" style="font-size: 24px;">
                    {{__('Letak Dokumen Disini') }}
                </label>
            </div>
            <div class="col-md-9">
                <label class="text-justify mb-4 ml-2" style="font-size: 14px">
                    {{__('Letak dokumen yang ingin kamu cetak disamping kiri atau klik tombol dibawah') }}
                </label>
                <div class="text-center ml-2">
                    <button class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold" style="border-radius:30px
                            font-size: 18px" onclick="openDialogUpload()">
                        <i class="material-icons align-middle mr-2">cloud_upload</i>
                        {{__('Unggah') }}
                    </button>
                    <script>
                        function openDialogUpload() {
                                document.getElementById('fileidUpload').click();
                            }
                        function submitFormUpload() {
                            document.getElementById('change-form').submit();
                        }
                    </script>

                    <form id="change-form" action="{{ route('konfigurasi.upload') }}" method="POST"
                        enctype="multipart/form-data" style="display: none;">
                        @csrf
                        <input type='file' name="fileUpload" id="fileidUpload" onchange="submitFormUpload()"
                            accept="application/pdf" hidden />
                    </form>

                </div>
            </div>
        </div>
        @else
        <div id="konfigurasi" class="row justify-content-between mb-5">
            <div class="col-md-auto mt-5 mr-0">
                <div class="border-primary-purple" style="width:515px;
                        height:560px;
                        position:relative;
                        float: none;
                        display: table-cell;
                        vertical-align: bottom;">
                    <embed
                        src="{{url('tmp/upload/',(session()->get('fileUpload'))->name)."#pagemode=thumbs&statusbar=0&messages=0&navpanes=0&toolbar=0"}}"
                        type="application/pdf" height="567px" width="515px" frameborder="0" onload="" />
                </div>
            </div>
            <div class="col-md-6 mt-5">
                <div class="bg-light-purple p-2 mb-4" width="100%" style="border-radius:5px;">
                    <div class="col-md-12 row align-self-center">
                        <div class="col-md-1 d-flex justify-content-center">
                            <div class="align-self-center"><img src="https://img.icons8.com/nolan/96/pdf-2.png"
                                    width="48px" />
                            </div>
                        </div>
                        <div class="col-md-8 text-truncate align-self-center">
                            <a class="" href="{{url('tmp/upload',(session()->get('fileUpload'))->name)}}"
                                target="_blank" style="font-size: 18px;">
                                {{-- {{$pdf->namaFile ?? ''}} --}}
                                {{(session()->get('fileUpload'))->name}}
                            </a>
                            <br>
                            <label class="text-muted" style="font-size: 12px;">
                                {{-- {{$pdf ->jumlahHalaman ?? '' }} {{ __('Halaman') }} --}}
                                {{ (session()->get('fileUpload'))->countPage }} {{ __('Halaman') }}
                            </label>
                        </div>
                        <div class="col-md-3 align-self-center text-right p-0">
                            <button class="btn btn-primary-yellow btn-rounded font-weight-bold py-1 px-4"
                                style="border-radius:35px;font-size: 16px;" onclick="openDialogChange()">
                                {{__('Ubah') }}
                            </button>
                            <script>
                                function openDialogChange() {
                                        document.getElementById('fileid').click();
                                    }
                                function submitFormChange() {
                                        document.getElementById('change-form').submit();
                                    }
                            </script>
                            <form id="change-form" action="{{ route('konfigurasi.upload') }}" method="POST"
                                enctype="multipart/form-data" style="display: none;">
                                @csrf
                                <input type='file' name="fileUpload" id="fileid" onchange="submitFormChange()"
                                    accept="application/pdf" hidden />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mx-0">
                    <div class="col-md-7">
                        <label class="SemiBold mb-3 mt-2" style="font-size: 24px;">
                            {{__('Pilih Halaman') }}
                        </label>
                        <div class="form-group custom-control custom-radio mb-4" style="font-size: 18px;">
                            <input id="rbSemuaHal" name="radio" class="custom-control-input" type="radio"
                                onchange="document.getElementById('halamanAwal').disabled; document.getElementById('halamanAkhir').disabled; document.getElementById('halamanKustom').disabled;"
                                checked>
                            <label class="custom-control-label" for="rbSemuaHal">
                                {{__('Semua') }}
                            </label>
                        </div>
                        {{-- if(document.getElementById('halamanAwal').disabled){document.getElementById('rbSemuaHal').click();document.getElementById('rbSemuaHal').focus() }; --}}
                        <div class="form-group custom-control custom-radio mb-4" style="font-size: 18px;">
                            <input id="rbSampaiHal" name="radio" class="custom-control-input" type="radio"
                                value="sampai">
                            <label class="custom-control-label" for="rbSampaiHal"
                                onclick="document.getElementById('rbSampaiHal').click() ">
                                <input id="halamanAwal" type="number" min="1"
                                    max="{{ (session()->get('fileUpload'))->countPage}}" value="1" class="sampai"
                                    disabled class="form-input mr-2" for="rbSampaiHal" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                                    if(document.getElementById('halamanAkhir').value < this.value){
                                        document.getElementById('halamanAkhir').value = this.value
                                    }
                                    " style="width:48px;">
                                {{__('Sampai') }}
                                <input id="halamanAkhir" type="number" value="1" class="form-input ml-2 sampai" disabled
                                    for="rbSampaiHal"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    style="width:48px;" min="" max="{{ (session()->get('fileUpload'))->countPage}}">

                            </label>
                        </div>
                        <div class="form-group custom-control custom-radio mb-4" style="font-size: 18px;"
                            onclick="document.getElementById('rbKustomHal').click(); document.getElementById('halamanKustom').focus()">
                            <input id="rbKustomHal" name="radio" class="custom-control-input" type="radio"
                                value="kustom">
                            <label class="custom-control-label" for="rbKustomHal">
                                {{__('Kustom') }}
                            </label>
                            <br>
                            <input id="halamanKustom" type="text mr-4" class="form-input kustom" for="rbKustomHal"
                                disabled
                                oninput="this.value = this.value.replace(/[^0-9.-]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="card-title font-weight-bold mb-3" style="font-size: 24px;">
                            {{__('Jumlah Salinan') }}
                        </label>
                        <div class="form-group mb-4" style="font-size: 18px;">
                            <label id="btnMinus" class="pointer">
                                <i class="fa fa-minus ml-2 mr-2"></i>
                            </label>
                            <input id="jumlahSalin" type="number" class="form-input" min="1"
                                {{-- oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" --}}
                                value="1" style="width:48px;">
                            <label class="label pointer" id="btnPlus">
                                <i class="fa fa-plus ml-2 mr-2"></i>
                            </label>
                        </div>
                        <label class="SemiBold mb-2 mt-2" style="font-size: 24px;">
                            {{__('Cetak') }}
                        </label>
                        <div class="form-group custom-control custom-checkbox mt-2 ml-0" style="font-size: 18px;">
                            <input type="checkbox" class="custom-control-input" id="checkboxTimbalBalik">
                            <label class="custom-control-label" for="checkboxTimbalBalik">
                                {{__('Timbal Balik') }}
                            </label>
                        </div>
                        <div class="form-group custom-control custom-checkbox mt-2 ml-0" style="font-size: 18px;">
                            <input type="checkbox" class="custom-control-input" id="checkboxPaksaHitamPutih">
                            <label class="custom-control-label" for="checkboxPaksaHitamPutih">
                                {{__('Paksa Hitam Putih') }}
                            </label>
                        </div>
                    </div>
                    <div class="bg-primary-yellow mt-4 p-2" style="border-radius: 5px; width:100%">
                        <label class="my-auto" style="font-size: 16px;">
                            <i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>
                            <label id="jumlahHal">{{ (session()->get('fileUpload'))->countPage}}</label>
                            {{ __(' Halaman Akan Dicetak')}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <label id="lblproduk" class="font-weight-bold" style="font-size:36px;">{{__('Produk') }}
        </label>
        <div id="produk" class="bg-light-purple p-4 mb-4"
            style="border-radius:5px; min-height:300px; position: relative;">
            @if (!session()->has('produkKonfigurasiFile'))
            <div class="text-center"
                style="position: absolute; top: 50%; left:33%; -ms-transform: translateY(-50%); transform: translateY(-50%);">
                <button class="btn btn-primary-wakprint font-weight-bold pl-4 pr-4"
                    style="border-radius:30px; font-size:24px;" onclick="window.location='{{route('pencarian')}}'">
                    <i class="material-icons md-36 align-middle mr-2">print</i>{{__('Pilih Produk Percetakan')}}
                </button>
            </div>
            @else
            <div class="row justify-content-between">
                <div class="col-md-4">
                    @include('member.card_produk',["p"=>session()->get('produkKonfigurasiFile')])
                </div>
                <div class="col-md-8">
                    <div class="ml-2">
                        <div class="text-right">
                            <button class="btn btn-primary-yellow btn-rounded font-weight-bold py-1 px-4 mb-4"
                                style="border-radius:35px;font-size: 16px;"
                                onclick="window.location='{{route('pencarian')}}'">
                                {{__('Ubah Produk') }}
                            </button>
                        </div>
                        <br>
                        <label class="font-weight-bold mb-2" style="font-size:18px;">{{__('Detail') }}
                        </label>
                        <br>
                        <div class="row justify-content-between ml-0 mr-0">
                            <label class="" style="font-size:16px;">{{__('Berwarna') }}
                            </label>
                            <label class="" style="font-size:16px;">
                                {{-- {{__('Rp. 1.000 / Halaman') }} --}}
                                {{session()->get('produkKonfigurasiFile')->harga_hitam_putih . " / Halaman"}}
                            </label>
                        </div>
                        <div class="row justify-content-between ml-0 mr-0 mb-4">
                            <label class="" style="font-size:16px;">{{__('Hitam Putih') }}
                            </label>
                            <label class="" style="font-size:16px;">{{__('Rp. 500 / Halaman') }}
                            </label>
                        </div>
                        <div class="row justify-content-between ml-0 mr-0">
                            <label class="" style="font-size:16px;">{{__('Berwarna (Timbal Balik)') }}
                            </label>
                            <label class="" style="font-size:16px;">{{__('Rp. 1.000 / Halaman') }}
                            </label>
                        </div>
                        <div class="row justify-content-between ml-0 mr-0 mb-4">
                            <label class="" style="font-size:16px;">{{__('Hitam Putih (Timbal Balik)') }}
                            </label>
                            <label class="" style="font-size:16px;">{{__('Rp. 500 / Halaman') }}
                            </label>
                        </div>
                        <div class="row justify-content-between ml-0 mr-0 mb-5">
                            <label class="" style="font-size:16px;">{{__('Nilai Toleransi Kandungan Warna') }}
                            </label>
                            <label class="" style="font-size:16px;">{{__('10%') }}
                            </label>
                        </div>
                        <label class="font-weight-bold mb-2" style="font-size:18px;">{{__('Fitur Tambahan') }}
                        </label>
                        <div class="row justify-content-between ml-0 mr-0">
                            <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                                <input type="checkbox" name="checkbox_fitur" class="custom-control-input"
                                    id="checkboxFitur">
                                <label class="custom-control-label" for="checkboxFitur">
                                    {{__('Jilid Lakban Hitam')}}
                                    <i class="material-icons md-18 align-middle ml-2" style="color:#C4C4C4">
                                        help
                                    </i>
                                </label>
                            </div>
                            <label class="" style="font-size:16px;">{{__('Rp. 10.500') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <form id="cekwarna-form" action="{{route("konfigurasi.cekwarna")}}" method="POST" hidden>
                @csrf
                <input type="text" name="path" hidden>
                <input type="text" name="percenMin" hidden>
            </form>

            {{-- <script>
                function prosesCekWarna() {
                    document.getElementsByName("path").value = "{{session()->get('fileUpload')->path}}";
            document.getElementsByName("percenMin").value = "{{session()->get('fileUpload')->path}}";

            document.getElementById("cekwarna-form").submit;
            }
            </script> --}}

            @endif
        </div>
        @if (!session()->has('produkKonfigurasiFile'))
        <div class="bg-primary-yellow mt-4 mb-4 p-2" style="border-radius: 5px; width:100%">
            <label class="my-auto" style="font-size: 16px;">
                <i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4;">warning</i>
                {{__('Silahkan unggah file dokumen anda untuk melanjutkan proses konfigurasi file')}}
            </label>
        </div>
        @else
        @endif
        @endif

        <div id="loading">
            <img src="{{asset('img/loading.gif')}}" alt="loading..." class="mx-auto d-block">
            <div id="progressText" class="mx-auto d-block"></div>
        </div>
        @if (session()->has('fileUpload') &&session()->has('produkKonfigurasiFile'))
        <script>
            $(function () {
                    $(document).ready(function () {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'GET',
                            url: '{{route("konfigurasi.cekwarna")}}',
                            data: {
                                path:"{{(session()->get('fileUpload'))->path}}",
                                // percenMin:50
                            },
                            dataType: 'json',
                            error: function (xhr, ajaxOptions, thrownError) {
                                //TODO : Ubah pesan error menajadi tampilan
                                // alert(xhr.responseText);
                                alert('Maaf terjadi error '+thrownError+' Silahkan coba kembali');

                            },
                            beforeSend: function () {
                                $('#loading').show();
                                $('#hasil').hide();

                            },
                            complete: function () {
                                $('#loading').hide();
                                $('#hasil').show();
                            },
                            success: function (pdf) {
                                console.log(pdf);
                                var hasil = '' +
                                    ' <label class="font-weight-bold mt-5 mb-4" style="font-size:36px;">Detail Jenis Warna Setiap </label>' +
                                    '' +
                                    '    <div id="tableCekWarna" class="row justify-content-between ml-0 mr-0 ">' +
                                    '        <div class="col-md-6">' +
                                    '            <table class="table table-hover text-center" style="border-radius:25px 25px 15px 15px;">' +
                                    '                <thead class="bg-primary-purple text-white align-self-center">' +
                                    '                    <tr style="font-size: 18px;">' +
                                    '                        <th class="align-middle" scope="col-md-auto">Halaman</th>' +
                                    '                        <th class="align-middle" scope="col-md-auto">Persentase kandungan Berwarna</th>' +
                                    '                        <th class="align-middle" scope="col-md-auto">Jenis Warna Halaman</th>' +
                                    '                    </tr>' +
                                    '                </thead>' +
                                    '                <tbody style="font-size: 14px;">' ;

                                                        for (let i = 0; i < pdf['jumlahHalaman']; i++) {
                                                            hasil+=
                                        '                   <tr>' +
                                        '                        <td scope="row">'+(i+1)+'</td>' +
                                        '                        <td>' +
                                                                    (pdf['halaman'][i]['piksel_berwarna']/pdf['halaman'][i]['total_piksel']*100).toFixed(2) + ' %' +
                                        '                        </td>' +
                                        '                        <td>' +
                                                                    (pdf['halaman'][i]['jenis_warna']) +
                                        '                       </td>' +
                                        '                    </tr>' ;
                                                            }

                                    hasil+=
                                    '                </tbody>' +
                                    '            </table>' +
                                    '        </div>' +
                                    '        <div class="col-md-6 bg-primary-yellow p-2" style="border-radius: 5px;">' +
                                    '            <div class="row justify-content-left ml-0 mr-0">' +
                                    '                <div class="col-md-auto">' +
                                    '                    <i class="material-icons md-18 align-middle mr-0" style="color:#C4C4C4">warning</i>' +
                                    '                </div>' +
                                    '                <div class="col-md-10">' +
                                    '                    <label style="font-size: 16px;">' +
                                    '                        File dokumen anda dinyatakan memiliki 2 halaman berwarna karena melebihi nilai toleransi' +
                                    '                        kandungan' +
                                    '                        warna yang ditetapkan oleh produk yang anda pilih dan 2 halaman hitam-putih karena tidak' +
                                    '                        melebihi' +
                                    '                        nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.' +
                                    '                    </label>' +
                                    '                </div>' +
                                    '            </div>' +
                                    '        </div>' +
                                    '    </div>' +
                                    '' +
                                    '    <div class="row justify-content-between ml-0 mr-0 mt-5 mb-5">' +
                                    '        <div class="col-md-6 pl-2 pr-4 pb-4 pt-4 mb-4" style="border-radius:5px;">' +
                                    '            <label class="font-weight-bold mb-2 ml-0" style="font-size: 24px;">Catatan Tambahan' +
                                    '            </label>' +
                                    '            <div class="input-group mb-3" style="height:120px;">' +
                                    '                <textarea class="form-control" style="font-size: 18px;" aria-label="Deskripsi Ulasan"></textarea>' +
                                    '            </div>' +
                                    '        </div>' +
                                    '        <div class="col-md-6 bg-light-purple pl-4 pr-4 pt-2 pb-2 mt-4 mr-0" style="border-radius:10px;' +
                                    '                                font-size:18px;">' +
                                    '            <label class="SemiBold mb-4" style="font-size:24px;">Rincian Harga' +
                                    '            </label>' +
                                    '            <div class="row justify-content-between mb-2">' +
                                    '                <div class="col-md-auto text-left">' +
                                    '                    <label class="mb-2">' +
                                    '                        5 Halaman Hitam Putih' +
                                    '                    </label>' +
                                    '                    <br>' +
                                    '                    <label class="mb-2">' +
                                    '                        2 Halaman Berwarna' +
                                    '                    </label>' +
                                    '                </div>' +
                                    '                <div class="col-md-auto text-right">' +
                                    '                    <label class="SemiBold mb-2">' +
                                    '                        Rp. 1.000' +
                                    '                    </label>' +
                                    '                    <br>' +
                                    '                    <label class="SemiBold mb-2">' +
                                    '                        Rp. 2.000' +
                                    '                    </label>' +
                                    '                </div>' +
                                    '            </div>' +
                                    '            <label class="SemiBold mb-2">' +
                                    '                Fitur' +
                                    '            </label>' +
                                    '            <div class="row justify-content-between">' +
                                    '                <div class="col-md-auto text-left">' +
                                    '                    <label class="mb-2">' +
                                    '                        Jilid Lem' +
                                    '                    </label>upload' +
                                    '                </div>' +
                                    '                <div class="col-md-auto text-right">' +
                                    '                    <label class="SemiBold mb-2">' +
                                    '                        Rp. 2.000' +
                                    '                    </label>' +
                                    '                </div>' +
                                    '            </div>' +
                                    '            <div class="row row-bordered"></div>' +
                                    '            <div class="row justify-content-between SemiBold mt-2">' +
                                    '                <div class="col-md-auto text-left">' +
                                    '                    <label>Total Harga Pesanan Kamu</label>' +
                                    '                </div>' +
                                    '                <div class="col-md-auto text-right">' +
                                    '                    <label>Rp. 20.000</label>' +
                                    '                </div>' +
                                    '            </div>' +
                                    '        </div>' +
                                    '    </div>' +
                                    '    <div class="row justify-content-between ml-0 mr-0 mt-2 mb-5">' +
                                    '        <div class="form-group mb-3 mr-2">' +
                                    '            <button id="hapusConfigurasi" class="btn btn-outline-danger-primary font-weight-bold pl-4 pr-4" style="border-radius:30px;' +
                                    '                            font-size:24px;">' +
                                    '                Hapus Konfigurasi' +
                                    '            </button>' +
                                    '        </div>' +
                                    '        <div class="form-group mb-3 mr-2">' +
                                    '            <button id="simpanKonfigurasi" class="btn btn-outline-purple font-weight-bold pl-4 pr-4" style="border-radius:30px;' +
                                    '                            font-size:24px;">' +
                                    '                Simpan Konfigurasi' +
                                    '            </button>' +
                                    '        </div>' +
                                    '        <div class="form-group mb-3">' +
                                    '            <button class="btn btn-primary-wakprint font-weight-bold pl-4 pr-4" style="border-radius:30px;' +
                                    '                                font-size:24px;">' +
                                    '                Simpan dan Lanjutkan' +
                                    '            </button>' +
                                    '        </div>' +
                                    '    </div>' +
                                    '';


                                    $('#hasil').html(hasil)
                            }
                        });

                    });
                });

        </script>
        @endif

        <div id="hasil">

        </div>
    </div>
</div>

<script>
    $(function(){
        $('#loading').hide();

        // document.getElementById('halamanAwal').onchange(function(){
        //     alert("asdasdas");

        //     document.getElementById('jumlahHal').text = parseInt(document.getElementById('halamanAkhir').value) - parseInt(this.value)+1;

        // });
        $(document).ready(function(){
            $('input[type=radio]').on('click change',(function(){
                // alert('asdasda');
                var related_class=$(this).val();
                $('.'+related_class).prop('disabled',false);
                // alert(related_class);

                $('input[type=radio]').not(':checked').each(function(){
                    var other_class=$(this).val();
                    $('.'+other_class).prop('disabled',true);
                    // alert(other_class);
                });
            }));
        });



        $('#btnPlus').click(function(){
            var val = parseInt($('#jumlahSalin').val(),10);
            $('#jumlahSalin').val((val+1));
        });

        $('#btnMinus').click(function(){
            var val = parseInt($('#jumlahSalin').val(),10);
            if (val>1) {
                $('#jumlahSalin').val((val-1));
            }
        });

        // $('#btnPlus')

    });
</script>

@endsection

{{--
// $('#filterProdukList span').on('click', function () {
// $('#filterProdukButton').text($(this).text());
// $('#filterProduk').val($(this).text());
// });
// $('#jenisPrinterList span').on('click', function () {
// $('#jenisPrinterButton').text($(this).text());
// $('#jenisPrinter').val($(this).text());
// });
// $('#ukuranKertasList span').on('click', function () {
// $('#ukuranKertasButton').text($(this).text());
// $('#ukuranKertas').val($(this).text());
// });
</script> --}}
