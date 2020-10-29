<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container">
    <div class="mt-5 mb-5">
        <label class="font-weight-bold" style="font-size:48px;">{{__('Konfigurasi File') }}</label>
    {{-- <form id="konfigurasiForm" method="POST" action="{{route("konfigurasi.tambah")}}">
    @csrf --}}
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
                                <input id="rbSemuaHal" name="radio" class="custom-control-input" type="radio" value="{{session()->get('fileUpload')->countPage}}"
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
                                    <input id="halamanAkhir" type="number" value="{{ (session()->get('fileUpload'))->countPage}}" class="form-input ml-2 sampai" disabled
                                        for="rbSampaiHal" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                                        if(document.getElementById('halamanAwal').value > this.value){
                                            document.getElementById('halamanAwal').value = this.value
                                        }
                                        " style="width:48px;" min="1" max="{{ (session()->get('fileUpload'))->countPage}}">
                                </label>
                            </div>
                            <div class="form-group custom-control custom-radio mb-4" style="font-size: 18px;"
                                onclick="document.getElementById('rbKustomHal').click(); document.getElementById('halamanKustom').focus()">
                                <input id="rbKustomHal" name="radio" class="custom-control-input" type="radio" value="kustom">
                                <label class="custom-control-label" for="rbKustomHal">
                                    {{__('Kustom') }}
                                </label>
                                <br>
                                <input id="halamanKustom" type="text mr-4" class="form-input kustom" for="rbKustomHal" value="" disabled oninput="this.value = this.value.replace(/[^0-9,-]/g, '').replace(/(\,.*)\./g, '$1');">
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
                                <input type="checkbox" class="custom-control-input" id="checkboxTimbalBalik" value="Timbal Balik">
                                <label class="custom-control-label" for="checkboxTimbalBalik">
                                    {{__('Timbal Balik') }}
                                </label>
                            </div>
                            <div class="form-group custom-control custom-checkbox mt-2 ml-0" style="font-size: 18px;">
                                <input type="checkbox" class="custom-control-input" id="checkboxPaksaHitamPutih" value="Hitam Putih">
                                <label class="custom-control-label" for="checkboxPaksaHitamPutih">
                                    {{__('Paksa Hitam Putih') }}
                                </label>
                            </div>
                        </div>
                        <div class="bg-primary-yellow mt-4 p-2" style="border-radius: 5px; width:100%">
                            <label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">
                                <i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>
                                <label id="jumlahHal">{{ (session()->get('fileUpload'))->countPage}}</label>
                                {{ __(' Halaman Akan Dicetak')}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <label id="lblproduk" class="font-weight-bold" style="font-size:36px;">{{__('Produk') }}</label>
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
                                <label class="" style="font-size:16px;">{{__('Berwarna') }}</label>
                                <label class="" style="font-size:16px;">{{"Rp. ". session()->get('produkKonfigurasiFile')->harga_berwarna . " / Halaman" ?? "-" }}</label>
                            </div>
                            <div class="row justify-content-between ml-0 mr-0 mb-4">
                                <label class="" style="font-size:16px;">{{__('Hitam Putih') }}</label>
                                <label class="" style="font-size:16px;">{{"Rp. ". session()->get('produkKonfigurasiFile')->harga_hitam_putih . " / Halaman" ?? "-" }}</label>
                            </div>
                            <div class="row justify-content-between ml-0 mr-0">
                                <label class="" style="font-size:16px;">{{__('Berwarna (Timbal Balik)') }}</label>
                                <label class="" style="font-size:16px;">{{"Rp. ". session()->get('produkKonfigurasiFile')->harga_timbal_balik_berwarna . " / Halaman" ?? "-" }}</label>
                            </div>
                            <div class="row justify-content-between ml-0 mr-0 mb-4">
                                <label class="" style="font-size:16px;">{{__('Hitam Putih (Timbal Balik)') }}</label>
                                <label class="" style="font-size:16px;">{{"Rp. ". session()->get('produkKonfigurasiFile')->harga_timbal_balik_hitam_putih . " / Halaman" ?? "-" }}</label>
                            </div>
                            <div class="row justify-content-between ml-0 mr-0 mb-5">
                                <label class="" style="font-size:16px;">{{__('Nilai Toleransi Kandungan Warna') }}</label>
                                <label class="" style="font-size:16px;">
                                    @if (empty(session()->get('produkKonfigurasiFile')->partner->ntkwh))
                                        {{__('0%')}}
                                    @else
                                        {{session()->get('produkKonfigurasiFile')->partner->ntkwh . "%" }}
                                    @endif
                                </label>
                            </div>
                            <label class="font-weight-bold mb-2" style="font-size:18px;">{{__('Fitur Tambahan') }}</label>
                            @php
                                $fitur = json_decode(session()->get('produkKonfigurasiFile')->fitur);
                            @endphp
                            @if (!empty($fitur))
                                @foreach ($fitur->tambahan as $f => $value)
                                    <div class="row justify-content-between ml-0 mr-0">
                                        <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                                        <input type="checkbox" name="checkbox_fitur" class="custom-control-input" id="checkboxFitur{{$f}}" value="{{$value->nama}}">
                                            <label class="custom-control-label" for="checkboxFitur{{$f}}">
                                                {{$value->nama}}
                                                <i class="material-icons md-18 align-middle ml-2" style="color:#C4C4C4">
                                                    help
                                                </i>
                                            </label>
                                        </div>
                                        <input type="text" name="harga_fitur" id="hargaFitur{{$f}}" value="{{$value->harga}}" hidden>
                                        <label class="" style="font-size:16px;">{{__('Rp. ' .$value->harga) }}</label>
                                    </div>
                                @endforeach
                            @else
                                <br>
                                <label>-</label>
                            @endif

                        </div>
                    </div>
                </div>

                <form id="cekwarna-form" action="{{route("konfigurasi.cekwarna")}}" method="POST" hidden>
                    @csrf
                    @if (empty(session()->get('produkKonfigurasiFile')->partner->ntkwh))
                        <input type="text" name="percenMin" value="0" hidden>
                    @else
                        <input type="text" name="percenMin" value="{{session()->get('produkKonfigurasiFile')->partner->ntkwh}}" hidden>
                    @endif
                    <input type="text" name="path" hidden>
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
        <div id="loading" style="position: absolute; top:70%; left:47%; background-color: rgb ( 255,  255,  255 ) ;">
            <img src="{{asset('img/loading.gif')}}" alt="loading..." class="mx-auto d-block">
            <div id="progressText" class="mx-auto d-block"></div>
        </div>
        @if (session()->has('fileUpload') && session()->has('produkKonfigurasiFile'))
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
                                percenMin:"{{session()->get('produkKonfigurasiFile')->partner->ntkwh}}",
                                idProduk:"{{session()->get('produkKonfigurasiFile')->id_produk}}",
                                namaFile:"{{(session()->get('fileUpload'))->name}}",
                                jumlahHalamanHitamPutih:0,
                                jumlahHalamanBerwarna:0,
                                halamanTerpilih:[],
                                jumlahSalinan:$('#jumlahSalin').val(),
                                paksaHitamPutih:0,
                                biaya:0,
                                catatanTambahan:$('#catatanTambahan').val(),
                                namaProduk:"{{session()->get('produkKonfigurasiFile')->nama}}",
                                fiturTerpilih:[],
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

                                pdf.namaFile = '{{(session()->get('fileUpload'))->name}}';
                                pdf.jumlahHalamanHitamPutih = pdf['jumlahHalHitamPutih'];
                                pdf.jumlahHalamanBerwarna = pdf['jumlahHalBerwarna'];
                                pdf.halamanTerpilih = [];
                                pdf.jumlahSalinan = parseInt($('#jumlahSalin').val());
                                pdf.paksaHitamPutih = 0;
                                pdf.namaProduk = '{{session()->get('produkKonfigurasiFile')->nama}}';
                                pdf.fiturTerpilih = [];

                                var halamanAwal = parseInt($('#halamanAwal').val());
                                var halamanAkhir = parseInt($('#halamanAkhir').val());
                                var jumlahSalinan = parseInt($('#jumlahSalin').val());
                                var nilaiSemuaHalaman = $('#rbSemuaHal').val();
                                var hargaHitamPutih = '{{(session()->get('produkKonfigurasiFile'))->harga_hitam_putih}}';
                                var hargaBerwarna = '{{(session()->get('produkKonfigurasiFile'))->harga_berwarna}}';
                                var hargaHitamPutihTimbalBalik = '{{(session()->get('produkKonfigurasiFile'))->harga_timbal_balik_hitam_putih}}';
                                var hargaBerwarnaTimbalBalik = '{{(session()->get('produkKonfigurasiFile'))->harga_timbal_balik_berwarna}}';
                                var nilaiPaksaHitamPutih = parseInt(pdf['jumlahHalBerwarna'] + pdf['jumlahHalHitamPutih']);
                                var nilaiPaksaBerwarna = 0;
                                var fiturTerpilih = [];

                                var hargaHitamPutihFinal = 0;
                                var hargaBerwarnaFinal = 0;
                                var hargaFiturTerpilih = [];
                                var hargaTotalFiturTerpilih = 0;
                                var hargaTotalKonfigurasi = 0;
                                var totalHarga = (hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan) + (hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan);
                                var catatanTambahan = "";

                                pdf.biaya = totalHarga;
                                pdf.catatanTambahan = "";

                                for (let i = 1; i <= nilaiSemuaHalaman; i++) {
                                    pdf.halamanTerpilih.push(i);
                                }

                                var hasil = '' +
                                    ' <label class="font-weight-bold mt-5 mb-4" style="font-size:36px;">Detail Jenis Warna Setiap Halaman</label>' +
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
                                    '        <div class="col-md-6 bg-primary-yellow p-2" style="border-radius: 5px; max-height:200px;">' +
                                    '            <div class="row justify-content-left ml-0 mr-0">' +
                                    '                <div class="col-md-auto">' +
                                    '                    <i class="material-icons md-18 align-middle mr-0" style="color:#C4C4C4">warning</i>' +
                                    '                </div>' +
                                    '                <div class="col-md-10">' +
                                    '                    <label style="font-size: 16px;">';

                                                            if (pdf['jumlahHalBerwarna'] === 0) {
                                                                hasil+=''+
                                    '                           File dokumen Anda dinyatakan memiliki halaman hitam-putih secara keseluruhannya dengan total ' +
                                    '                           <label class="font-weight-bold mb-0">' + pdf['jumlahHalHitamPutih'] + ' halaman hitam-putih </label> ' +
                                    '                           karena tidak melebihi nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.';
                                                            }
                                                            else if(pdf['jumlahHalHitamPutih'] === 0){
                                                                hasil+=''+
                                    '                           File dokumen Anda dinyatakan memiliki halaman berwarna secara keseluruhannya dengan total ' + ' <label class="font-weight-bold mb-0">' + pdf['jumlahHalBerwarna'] + ' halaman berwarna </label>' + ' karena melebihi nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.';
                                                            }
                                                            else {
                                                                hasil+=''+
                                        '                       File dokumen anda dinyatakan memiliki '+' <label class="font-weight-bold mb-0">'+ pdf['jumlahHalBerwarna'] +' halaman berwarna </label>'+ ' karena melebihi nilai toleransi' +
                                        '                       kandungan' +
                                        '                       warna yang ditetapkan oleh produk yang anda pilih dan '+'<label class="font-weight-bold mb-0">' + pdf['jumlahHalHitamPutih'] +' halaman hitam-putih </label>'+ ' karena tidak'+
                                        '                       melebihi' +
                                        '                       nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.';
                                                            }
                                    hasil+=
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
                                    '                <textarea id="catatanTambahan" class="form-control" style="font-size: 18px;"></textarea>' +
                                    '            </div>' +
                                    '        </div>' +
                                    '        <div class="col-md-6 bg-light-purple pl-4 pr-4 pt-2 pb-2 mt-4 mr-0" style="border-radius:10px;' +
                                    '                                font-size:18px;">' +
                                    '            <label class="SemiBold mb-4" style="font-size:24px;">Rincian Harga' +
                                    '            </label>' +
                                    '            <div class="row justify-content-between mb-2">' +
                                    '                <div class="col-md-auto text-left">' +
                                    '                    <label id="jumlahHitamPutih" class="mb-2">' +
                                                            pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih' +
                                    '                    </label>' +
                                    '                    <br>' +
                                    '                    <label id="jumlahBerwarna" class="mb-2">' +
                                                            pdf['jumlahHalBerwarna'] + ' Halaman Berwarna' +
                                    '                    </label>' +
                                    '                </div>' +
                                    '                <div class="col-md-auto text-right">' +
                                    '                    <label id="hargaHitamPutih" class="SemiBold mb-2">' +
                                    '                       Rp. ' + hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan +
                                    '                    </label>' +
                                    '                    <br>' +
                                    '                    <label id="hargaBerwarna" class="SemiBold mb-2">' +
                                    '                       Rp. ' + hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan +
                                    '                    </label>' +
                                    '                </div>' +
                                    '            </div>' +
                                    '            <label class="SemiBold mb-2">' +
                                    '                Fitur' +
                                    '            </label>' +
                                    '            <div id="fiturTambahanTerpilih">'+
                                        '            <div class="row justify-content-between">' +
                                        '                <div class="col-md-auto text-left">' +
                                        '                    <label class="mb-2">' +
                                        '                        -' +
                                        '                    </label>' +
                                        '                </div>' +
                                        '                <div class="col-md-auto text-right">' +
                                        '                    <label class="SemiBold mb-2">' +
                                        '                        -' +
                                        '                    </label>' +
                                        '                </div>' +
                                        '            </div>' +
                                    '            </div>'+
                                    '            <div class="row row-bordered"></div>' +
                                    '            <div class="row justify-content-between SemiBold mt-2">' +
                                    '                <div class="col-md-auto text-left">' +
                                    '                    <label>Total Harga Pesanan Kamu</label>' +
                                    '                </div>' +
                                    '                <div class="col-md-auto text-right">' +
                                    '                    <label id="totalHargaKonfigurasi">Rp. '+ totalHarga + '</label>' +
                                    '                </div>' +
                                    '            </div>' +
                                    '        </div>' +
                                    '    </div>' +
                                    '    <form id="konfigurasiForm" method="POST">' +
                                    '    @csrf' +
                                    '    <div class="row justify-content-between ml-0 mr-0 mt-2 mb-5">' +
                                    '        <div class="form-group mb-3 mr-2">' +
                                    '            <button type="submit" id="hapusKonfigurasi" class="btn btn-outline-danger-primary font-weight-bold pl-4 pr-4" style="border-radius:30px;' +
                                    '                            font-size:24px;">' +
                                    '                Hapus Konfigurasi' +
                                    '            </button>' +
                                    '        </div>' +
                                    '        <div class="form-group mb-3 mr-2">' +
                                    '            <button type="submit" id="simpanKonfigurasi" class="btn btn-outline-purple font-weight-bold pl-4 pr-4" style="border-radius:30px;' +
                                    '                            font-size:24px;">' +
                                    '                Simpan Konfigurasi' +
                                    '            </button>' +
                                    '        </div>' +
                                    '        <div class="form-group mb-3">' +
                                    '            <button type="submit" id="simpanDanLanjutkan" class="btn btn-primary-wakprint font-weight-bold pl-4 pr-4" style="border-radius:30px;' +
                                    '                                font-size:24px;">' +
                                    '                Simpan dan Lanjutkan' +
                                    '            </button>' +
                                    '        </div>' +
                                    '    </div>' +
                                    '    </form>' +
                                '';

                                $('#hasil').html(hasil);

                                    $('#btnPlus').click(function(){
                                        var val = parseInt($('#jumlahSalin').val(),10);

                                        $('#jumlahSalin').val((val+1));

                                        jumlahSalinan = val+1;

                                        pdf.jumlahSalinan = jumlahSalinan;

                                        if($('#rbSemuaHal').is(':checked')){
                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                                else {
                                                    $('#jumlahHitamPutih').html(
                                                        pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                $('#jumlahHitamPutih').html(
                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                );

                                                $('#jumlahBerwarna').html(
                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                );

                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                                else {
                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else{
                                                $('#jumlahHitamPutih').html(
                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                );

                                                $('#jumlahBerwarna').html(
                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                );

                                                hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                $('#hargaHitamPutih').html(
                                                    'Rp. ' + hargaHitamPutihFinal
                                                );

                                                hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                $('#hargaBerwarna').html(
                                                    'Rp. ' + hargaBerwarnaFinal
                                                );

                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;

                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                            }
                                        }
                                        else if($('#rbSampaiHal').is(':checked')){
                                            var batasBawah = 0;
                                            var batasAtas = 0;
                                            var jumlahHitamPutihFinal = 0;
                                            var jumlahBerwarnaFinal = 0;

                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                        jumlahBerwarnaFinal += 1;
                                                    }
                                                    else{
                                                        jumlahHitamPutihFinal += 1;
                                                    }
                                                }

                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                                else {
                                                    $('#jumlahHitamPutih').html(
                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                        jumlahBerwarnaFinal += 1;
                                                    }
                                                    else{
                                                        jumlahHitamPutihFinal += 1;
                                                    }
                                                }

                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                $('#jumlahHitamPutih').html(
                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                );

                                                $('#jumlahBerwarna').html(
                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                );

                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                                else {
                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else{
                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                        jumlahBerwarnaFinal += 1;
                                                    }
                                                    else{
                                                        jumlahHitamPutihFinal += 1;
                                                    }
                                                }

                                                $('#jumlahHitamPutih').html(
                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                );

                                                $('#jumlahBerwarna').html(
                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                );

                                                hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                $('#hargaHitamPutih').html(
                                                    'Rp. ' + hargaHitamPutihFinal
                                                );

                                                hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                $('#hargaBerwarna').html(
                                                    'Rp. ' + hargaBerwarnaFinal
                                                );

                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                            }
                                        }

                                        pdf.biaya = hargaTotalKonfigurasi;

                                    });

                                    $('#btnMinus').click(function(){
                                        var val = parseInt($('#jumlahSalin').val(),10);

                                        if(val>1) {
                                            $('#jumlahSalin').val((val-1));
                                            jumlahSalinan = val-1;
                                            if($('#rbSemuaHal').is(':checked')){
                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        $('#jumlahHitamPutih').html(
                                                            pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else{
                                                    $('#jumlahHitamPutih').html(
                                                        pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else if($('#rbSampaiHal').is(':checked')){
                                                var batasBawah = 0;
                                                var batasAtas = 0;
                                                var jumlahHitamPutihFinal = 0;
                                                var jumlahBerwarnaFinal = 0;

                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    batasBawah = parseInt($('#halamanAwal').val())-1;
                                                    batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                    for (i = batasBawah; i <= batasAtas; i++) {
                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                            jumlahBerwarnaFinal += 1;
                                                        }
                                                        else{
                                                            jumlahHitamPutihFinal += 1;
                                                        }
                                                    }

                                                    if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    batasBawah = parseInt($('#halamanAwal').val())-1;
                                                    batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                    for (i = batasBawah; i <= batasAtas; i++) {
                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                            jumlahBerwarnaFinal += 1;
                                                        }
                                                        else{
                                                            jumlahHitamPutihFinal += 1;
                                                        }
                                                    }

                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else{
                                                    batasBawah = parseInt($('#halamanAwal').val())-1;
                                                    batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                    for (i = batasBawah; i <= batasAtas; i++) {
                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                            jumlahBerwarnaFinal += 1;
                                                        }
                                                        else{
                                                            jumlahHitamPutihFinal += 1;
                                                        }
                                                    }

                                                    $('#jumlahHitamPutih').html(
                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                    console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                }
                                            }
                                        }
                                        else if(val === 1){
                                            $('#jumlahSalin').val((val));
                                            jumlahSalinan = 1;
                                            if($('#rbSemuaHal').is(':checked')){
                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan
                                                        );

                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan
                                                        );
                                                    }
                                                    else {
                                                        $('#jumlahHitamPutih').html(
                                                            pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                        );

                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan
                                                        );

                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan
                                                        );
                                                    }
                                                }
                                                else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan
                                                        );

                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan
                                                        );
                                                    }
                                                    else {
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan
                                                        );

                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan
                                                        );
                                                    }
                                                }
                                                else{
                                                    $('#jumlahHitamPutih').html(
                                                        pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                    );

                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan
                                                    );

                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan
                                                    );
                                                }
                                            }
                                            else if($('#rbSampaiHal').is(':checked')){
                                                var batasBawah = 0;
                                                var batasAtas = 0;
                                                var jumlahHitamPutihFinal = 0;
                                                var jumlahBerwarnaFinal = 0;

                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    batasBawah = parseInt($('#halamanAwal').val())-1;
                                                    batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                    for (i = batasBawah; i <= batasAtas; i++) {
                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                            jumlahBerwarnaFinal += 1;
                                                        }
                                                        else{
                                                            jumlahHitamPutihFinal += 1;
                                                        }
                                                    }

                                                    if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    batasBawah = parseInt($('#halamanAwal').val())-1;
                                                    batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                    for (i = batasBawah; i <= batasAtas; i++) {
                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                            jumlahBerwarnaFinal += 1;
                                                        }
                                                        else{
                                                            jumlahHitamPutihFinal += 1;
                                                        }
                                                    }

                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else{
                                                    batasBawah = parseInt($('#halamanAwal').val())-1;
                                                    batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                    for (i = batasBawah; i <= batasAtas; i++) {
                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                            jumlahBerwarnaFinal += 1;
                                                        }
                                                        else{
                                                            jumlahHitamPutihFinal += 1;
                                                        }
                                                    }

                                                    $('#jumlahHitamPutih').html(
                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                    console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                }
                                            }
                                        }
                                        else {
                                            if($('#rbSemuaHal').is(':checked')){
                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan
                                                        );

                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan
                                                        );
                                                    }
                                                    else {
                                                        $('#jumlahHitamPutih').html(
                                                            pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                        );

                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan
                                                        );

                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan
                                                        );
                                                    }
                                                }
                                                else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan
                                                        );

                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan
                                                        );
                                                    }
                                                    else {
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan
                                                        );

                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan
                                                        );
                                                    }
                                                }
                                                else{
                                                    $('#jumlahHitamPutih').html(
                                                        pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                    );

                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan
                                                    );

                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan
                                                    );
                                                }
                                            }
                                            else if($('#rbSampaiHal').is(':checked')){
                                                var batasBawah = 0;
                                                var batasAtas = 0;
                                                var jumlahHitamPutihFinal = 0;
                                                var jumlahBerwarnaFinal = 0;

                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    batasBawah = parseInt($('#halamanAwal').val())-1;
                                                    batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                    for (i = batasBawah; i <= batasAtas; i++) {
                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                            jumlahBerwarnaFinal += 1;
                                                        }
                                                        else{
                                                            jumlahHitamPutihFinal += 1;
                                                        }
                                                    }

                                                    if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    batasBawah = parseInt($('#halamanAwal').val())-1;
                                                    batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                    for (i = batasBawah; i <= batasAtas; i++) {
                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                            jumlahBerwarnaFinal += 1;
                                                        }
                                                        else{
                                                            jumlahHitamPutihFinal += 1;
                                                        }
                                                    }

                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else{
                                                    batasBawah = parseInt($('#halamanAwal').val())-1;
                                                    batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                    for (i = batasBawah; i <= batasAtas; i++) {
                                                        if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                            jumlahBerwarnaFinal += 1;
                                                        }
                                                        else{
                                                            jumlahHitamPutihFinal += 1;
                                                        }
                                                    }

                                                    $('#jumlahHitamPutih').html(
                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                    console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                }
                                            }
                                        }

                                        pdf.jumlahSalinan = jumlahSalinan;
                                        pdf.biaya = hargaTotalKonfigurasi;
                                    });

                                    $('input[type=checkbox]').on('click change',(function(){
                                        if($('#rbSemuaHal').is(':checked')){
                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    pdf.paksaHitamPutih = 1;

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                                else {

                                                    pdf.paksaHitamPutih = 0;

                                                    $('#jumlahHitamPutih').html(
                                                        pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                pdf.paksaHitamPutih = 1;

                                                $('#jumlahHitamPutih').html(
                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                );

                                                $('#jumlahBerwarna').html(
                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                );

                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                                else {
                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else{

                                                pdf.paksaHitamPutih = 0;

                                                $('#jumlahHitamPutih').html(
                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                );

                                                $('#jumlahBerwarna').html(
                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                );

                                                hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                $('#hargaHitamPutih').html(
                                                    'Rp. ' + hargaHitamPutihFinal
                                                );

                                                hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                $('#hargaBerwarna').html(
                                                    'Rp. ' + hargaBerwarnaFinal
                                                );

                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                            }
                                        }
                                        else if($('#rbSampaiHal').is(':checked')){
                                            var batasBawah = 0;
                                            var batasAtas = 0;
                                            var jumlahHitamPutihFinal = 0;
                                            var jumlahBerwarnaFinal = 0;

                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                        jumlahBerwarnaFinal += 1;
                                                    }
                                                    else{
                                                        jumlahHitamPutihFinal += 1;
                                                    }
                                                }

                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                                else {
                                                    $('#jumlahHitamPutih').html(
                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                        jumlahBerwarnaFinal += 1;
                                                    }
                                                    else{
                                                        jumlahHitamPutihFinal += 1;
                                                    }
                                                }

                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                $('#jumlahHitamPutih').html(
                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                );

                                                $('#jumlahBerwarna').html(
                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                );

                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                                else {
                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else{
                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                        jumlahBerwarnaFinal += 1;
                                                    }
                                                    else{
                                                        jumlahHitamPutihFinal += 1;
                                                    }
                                                }

                                                $('#jumlahHitamPutih').html(
                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                );

                                                $('#jumlahBerwarna').html(
                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                );

                                                hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                $('#hargaHitamPutih').html(
                                                    'Rp. ' + hargaHitamPutihFinal
                                                );

                                                hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                $('#hargaBerwarna').html(
                                                    'Rp. ' + hargaBerwarnaFinal
                                                );

                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                            }
                                        }

                                        pdf.biaya = hargaTotalKonfigurasi;
                                    }));

                                    $('input[type=checkbox]').each(function(index, value){
                                        $('#checkboxFitur' + index).bind('change', function(){
                                            var hasilFiturTambahan = '';

                                            if(this.checked){
                                                fiturTerpilih.push($(this).val());
                                                hargaFiturTerpilih.push($('#hargaFitur' + index).val());

                                                pdf.fiturTerpilih.push('namaFitur : ' + $(this).val() + ' hargaFitur : ' + $('#hargaFitur' + index).val());

                                                hargaTotalFiturTerpilih = eval(hargaFiturTerpilih.join("+"));

                                                for (var i = 0; i < fiturTerpilih.length; i++) {
                                                    var ft = fiturTerpilih[i];
                                                    var hargaFT = hargaFiturTerpilih[i];

                                                    hasilFiturTambahan +=
                                                        '            <div class="row justify-content-between">' +
                                                        '                <div class="col-md-auto text-left">' +
                                                        '                    <label class="mb-2">' +
                                                                                ft +
                                                        '                    </label>' +
                                                        '                </div>' +
                                                        '                <div class="col-md-auto text-right">' +
                                                        '                    <label class="SemiBold mb-2">' +
                                                        '                       Rp. ' + hargaFT +
                                                        '                    </label>' +
                                                        '                </div>' +
                                                        '            </div>';
                                                }

                                                if($('#rbSemuaHal').is(':checked')){
                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        $('#jumlahHitamPutih').html(
                                                            pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }

                                                else if($('#rbSampaiHal').is(':checked')){
                                                    var batasBawah = 0;
                                                    var batasAtas = 0;
                                                    var jumlahHitamPutihFinal = 0;
                                                    var jumlahBerwarnaFinal = 0;

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                        console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                    }
                                                }

                                                $('#fiturTambahanTerpilih').html(hasilFiturTambahan);
                                            }
                                            else {
                                                var pos = fiturTerpilih.indexOf($(this).val());

                                                if(pos > -1){
                                                    fiturTerpilih.splice(pos, 1);
                                                    hargaFiturTerpilih.splice(pos,1);
                                                    pdf.fiturTerpilih.splice(pos,1);

                                                    if(fiturTerpilih.length === 0 && hargaFiturTerpilih.length === 0){
                                                        hargaTotalFiturTerpilih = 0;
                                                        hasilFiturTambahan +=
                                                        '            <div class="row justify-content-between">' +
                                                        '                <div class="col-md-auto text-left">' +
                                                        '                    <label class="mb-2">' +
                                                        '                       -' +
                                                        '                    </label>' +
                                                        '                </div>' +
                                                        '                <div class="col-md-auto text-right">' +
                                                        '                    <label class="SemiBold mb-2">' +
                                                        '                       -' +
                                                        '                    </label>' +
                                                        '                </div>' +
                                                        '            </div>';

                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        hargaTotalFiturTerpilih = eval(hargaFiturTerpilih.join("+"));

                                                        for (var i = 0; i < fiturTerpilih.length; i++) {
                                                            var ft = fiturTerpilih[i];
                                                            var hargaFT = hargaFiturTerpilih[i];

                                                            hasilFiturTambahan +=
                                                            '            <div class="row justify-content-between">' +
                                                            '                <div class="col-md-auto text-left">' +
                                                            '                    <label class="mb-2">' +
                                                                                    ft +
                                                            '                    </label>' +
                                                            '                </div>' +
                                                            '                <div class="col-md-auto text-right">' +
                                                            '                    <label class="SemiBold mb-2">' +
                                                            '                       Rp. ' + hargaFT +
                                                            '                    </label>' +
                                                            '                </div>' +
                                                            '            </div>';
                                                        }

                                                        // $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }

                                                if($('#rbSemuaHal').is(':checked')){
                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            $('#jumlahHitamPutih').html(
                                                                pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        $('#jumlahHitamPutih').html(
                                                            pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }

                                                else if($('#rbSampaiHal').is(':checked')){
                                                    var batasBawah = 0;
                                                    var batasAtas = 0;
                                                    var jumlahHitamPutihFinal = 0;
                                                    var jumlahBerwarnaFinal = 0;

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                            nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                            $('#jumlahHitamPutih').html(
                                                                nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            $('#jumlahHitamPutih').html(
                                                                jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                            );

                                                            $('#jumlahBerwarna').html(
                                                                jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                            );

                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        if($('#checkboxTimbalBalik').is(':checked')){
                                                            hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                        else {
                                                            hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                            $('#hargaHitamPutih').html(
                                                                'Rp. ' + hargaHitamPutihFinal
                                                            );

                                                            hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                            $('#hargaBerwarna').html(
                                                                'Rp. ' + hargaBerwarnaFinal
                                                            );

                                                            hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                            $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                        }
                                                    }
                                                    else{
                                                        batasBawah = parseInt($('#halamanAwal').val())-1;
                                                        batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                        for (i = batasBawah; i <= batasAtas; i++) {
                                                            if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                                jumlahBerwarnaFinal += 1;
                                                            }
                                                            else{
                                                                jumlahHitamPutihFinal += 1;
                                                            }
                                                        }

                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                        console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                                    }
                                                }

                                                $('#fiturTambahanTerpilih').html(hasilFiturTambahan);
                                            }

                                            pdf.biaya = hargaTotalKonfigurasi;
                                        });
                                    });

                                    $('input[type=radio]').on('click change',(function(){
                                        var related_class=$(this).val();
                                        $('.'+related_class).prop('disabled',false);

                                        if($('#rbSemuaHal').is(':checked')){

                                            $('#jumlahHalCetak').html(
                                                '<label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">' +
                                                    '<i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>' +
                                                    '<label id="jumlahHal">' + nilaiSemuaHalaman + '</label>' +
                                                    ' Halaman yang Akan Dicetak' +
                                                '</label>'
                                            );

                                            for (let i = 1; i <= nilaiSemuaHalaman; i++) {
                                                pdf.halamanTerpilih.push(i);
                                            }

                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    pdf.paksaHitamPutih = 1;

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                    pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                                else {
                                                    pdf.paksaHitamPutih = 0;

                                                    $('#jumlahHitamPutih').html(
                                                        pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                    );

                                                    data.jumlahHalamanHitamPutih = pdf['jumlahHalHitamPutih'];
                                                    data.jumlahHalamanBerwarna = pdf['jumlahHalBerwarna'];

                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){
                                                pdf.paksaHitamPutih = 1;

                                                $('#jumlahHitamPutih').html(
                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                );

                                                $('#jumlahBerwarna').html(
                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                );

                                                pdf.jumlahHalamanHitamPutih = nilaiPaksaHitamPutih;
                                                pdf.jumlahHalamanBerwarna = nilaiPaksaBerwarna;

                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                                else {
                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else{
                                                pdf.paksaHitamPutih = 0;

                                                $('#jumlahHitamPutih').html(
                                                    pdf['jumlahHalHitamPutih'] + ' Halaman Hitam Putih'
                                                );

                                                $('#jumlahBerwarna').html(
                                                    pdf['jumlahHalBerwarna'] + ' Halaman Berwarna'
                                                );

                                                pdf.jumlahHalamanHitamPutih = pdf['jumlahHalHitamPutih'];
                                                pdf.jumlahHalamanBerwarna = pdf['jumlahHalBerwarna'];

                                                hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                $('#hargaHitamPutih').html(
                                                    'Rp. ' + hargaHitamPutihFinal
                                                );

                                                hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                $('#hargaBerwarna').html(
                                                    'Rp. ' + hargaBerwarnaFinal
                                                );

                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                            }
                                        }
                                        else if($('#rbSampaiHal').is(':checked')){
                                            var batasBawah = 0;
                                            var batasAtas = 0;
                                            var jumlahHitamPutihFinal = 0;
                                            var jumlahBerwarnaFinal = 0;
                                            var nilaiSampaiHalaman = parseInt($('#halamanAkhir').val()) - parseInt($('#halamanAwal').val());

                                            $('#halamanAwal').on('change input',function(){
                                                parseInt($('#halamanAwal').val());
                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                        jumlahBerwarnaFinal += 1;
                                                    }
                                                    else{
                                                        jumlahHitamPutihFinal += 1;
                                                    }
                                                }

                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else{
                                                    $('#jumlahHitamPutih').html(
                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            });

                                            $('#halamanAkhir').on('change input',function(){
                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                batasAtas = parseInt($('#halamanAwal').val())-1;

                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                        jumlahBerwarnaFinal += 1;
                                                    }
                                                    else{
                                                        jumlahHitamPutihFinal += 1;
                                                    }
                                                }

                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                        nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                        $('#jumlahHitamPutih').html(
                                                            nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        $('#jumlahHitamPutih').html(
                                                            jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                        );

                                                        $('#jumlahBerwarna').html(
                                                            jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                        );

                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * jumlahHitamPutihFinal * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * jumlahBerwarnaFinal * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    if($('#checkboxTimbalBalik').is(':checked')){
                                                        hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                    else {
                                                        hargaHitamPutihFinal = hargaHitamPutih * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                        $('#hargaHitamPutih').html(
                                                            'Rp. ' + hargaHitamPutihFinal
                                                        );

                                                        hargaBerwarnaFinal = hargaBerwarna * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                        $('#hargaBerwarna').html(
                                                            'Rp. ' + hargaBerwarnaFinal
                                                        );

                                                        hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                        $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                    }
                                                }
                                                else{
                                                    $('#jumlahHitamPutih').html(
                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            });

                                            if(nilaiSampaiHalaman === 0){
                                                nilaiSampaiHalaman = 1;
                                            }
                                            else{
                                                nilaiSampaiHalaman += 1;
                                            }

                                            $('#jumlahHalCetak').html(
                                                '<label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">' +
                                                    '<i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>' +
                                                    '<label id="jumlahHal">' + nilaiSampaiHalaman + '</label>' +
                                                    ' Halaman yang Akan Dicetak' +
                                                '</label>'
                                            );

                                            if($('#checkboxTimbalBalik').is(':checked')){
                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                        jumlahBerwarnaFinal += 1;
                                                    }
                                                    else{
                                                        jumlahHitamPutihFinal += 1;
                                                    }
                                                }

                                                if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                    nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                    $('#jumlahHitamPutih').html(
                                                        nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                                else {
                                                    $('#jumlahHitamPutih').html(
                                                        jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                    );

                                                    $('#jumlahBerwarna').html(
                                                        jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                    );

                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * pdf['jumlahHalHitamPutih'] * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * pdf['jumlahHalBerwarna'] * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else if($('#checkboxPaksaHitamPutih').is(':checked')){

                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                        jumlahBerwarnaFinal += 1;
                                                    }
                                                    else{
                                                        jumlahHitamPutihFinal += 1;
                                                    }
                                                }

                                                nilaiPaksaHitamPutih = jumlahHitamPutihFinal + jumlahBerwarnaFinal;

                                                $('#jumlahHitamPutih').html(
                                                    nilaiPaksaHitamPutih + ' Halaman Hitam Putih'
                                                );

                                                $('#jumlahBerwarna').html(
                                                    nilaiPaksaBerwarna + ' Halaman Berwarna'
                                                );

                                                if($('#checkboxTimbalBalik').is(':checked')){
                                                    hargaHitamPutihFinal = hargaHitamPutihTimbalBalik * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarnaTimbalBalik * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                                else {
                                                    hargaHitamPutihFinal = hargaHitamPutih * nilaiPaksaHitamPutih * jumlahSalinan;
                                                    $('#hargaHitamPutih').html(
                                                        'Rp. ' + hargaHitamPutihFinal
                                                    );

                                                    hargaBerwarnaFinal = hargaBerwarna * nilaiPaksaBerwarna * jumlahSalinan;
                                                    $('#hargaBerwarna').html(
                                                        'Rp. ' + hargaBerwarnaFinal
                                                    );

                                                    hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                    $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);
                                                }
                                            }
                                            else{
                                                batasBawah = parseInt($('#halamanAwal').val())-1;
                                                batasAtas = parseInt($('#halamanAkhir').val())-1;

                                                for (i = batasBawah; i <= batasAtas; i++) {
                                                    if(pdf['halaman'][i]['jenis_warna'] === 'Berwarna'){
                                                        jumlahBerwarnaFinal += 1;
                                                    }
                                                    else{
                                                        jumlahHitamPutihFinal += 1;
                                                    }
                                                }

                                                $('#jumlahHitamPutih').html(
                                                    jumlahHitamPutihFinal + ' Halaman Hitam Putih'
                                                );

                                                $('#jumlahBerwarna').html(
                                                    jumlahBerwarnaFinal + ' Halaman Berwarna'
                                                );

                                                hargaHitamPutihFinal = hargaHitamPutih * jumlahHitamPutihFinal * jumlahSalinan;
                                                $('#hargaHitamPutih').html(
                                                    'Rp. ' + hargaHitamPutihFinal
                                                );

                                                hargaBerwarnaFinal = hargaBerwarna * jumlahBerwarnaFinal * jumlahSalinan;
                                                $('#hargaBerwarna').html(
                                                    'Rp. ' + hargaBerwarnaFinal
                                                );

                                                hargaTotalKonfigurasi = hargaHitamPutihFinal + hargaBerwarnaFinal + hargaTotalFiturTerpilih;
                                                $('#totalHargaKonfigurasi').html('Rp. ' + hargaTotalKonfigurasi);

                                                console.log('Jumlah Hitam Putih : ' + jumlahHitamPutihFinal + '\nJumlah Berwarna : ' + jumlahBerwarnaFinal);
                                            }
                                        }
                                        else if($('#rbKustomHal').is(':checked')){
                                            var a = kustomHal($('#halamanKustom').val())
                                            $('#halamanKustom').on('change input',function(){
                                                console.log(a);
                                            });
                                        }

                                        $('input[type=radio]').not(':checked').each(function(){
                                            var other_class=$(this).val();
                                            $('.'+other_class).prop('disabled',true);
                                            // alert(other_class);
                                        });

                                        pdf.biaya = hargaTotalKonfigurasi;
                                    }));

                                    $('#catatanTambahan').on('change input',(function(){
                                        catatanTambahan = $('#catatanTambahan').val();
                                        pdf.catatanTambahan = catatanTambahan;
                                        // console.log(catatanTambahan);
                                    }));

                                    $('#hapusKonfigurasi').on('click',(function(){

                                    }));

                                    $('#simpanKonfigurasi').on('click',(function(){
                                        if($('#rbSemuaHal').is(':checked')){
                                            console.log('Nama File : ' + pdf.namaFile);
                                            console.log('Jumlah Halaman Hitam Putih : ' + pdf.jumlahHalamanHitamPutih);
                                            console.log('Jumlah Halaman Berwarna : ' + pdf.jumlahHalamanBerwarna);
                                            console.log('Halaman Terpilih : ' + pdf.halamanTerpilih);
                                            console.log('Jumlah Salinan : ' + pdf.jumlahSalinan);
                                            console.log('Nilai Paksa Hitam Putih : ' + pdf.paksaHitamPutih);
                                            console.log('Biaya : ' + pdf.biaya);
                                            console.log('Catatan Tambahan : ' + pdf.catatanTambahan);
                                            console.log('Nama Produk : ' + pdf.namaProduk);
                                            console.log('Fitur Terpilih : ' + pdf.fiturTerpilih);
                                        }

                                        $('#konfigurasiForm').submit(function(e){

                                            e.preventDefault();

                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $.ajax({
                                                type: 'POST',
                                                url: '{{route("konfigurasi.tambah")}}',
                                                data:{
                                                    idProduk:"{{session()->get('produkKonfigurasiFile')->id_produk}}",
                                                    namaFile:"{{(session()->get('fileUpload'))->name}}",
                                                    jumlahHalamanHitamPutih:0,
                                                    jumlahHalamanBerwarna:0,
                                                    halamanTerpilih:[],
                                                    jumlahSalinan:$('#jumlahSalin').val(),
                                                    paksaHitamPutih:pdf.paksaHitamPutih,
                                                    biaya:0,
                                                    catatanTambahan:$('#catatanTambahan').val(),
                                                    namaProduk:"{{session()->get('produkKonfigurasiFile')->nama}}",
                                                    fiturTerpilih:[],
                                                },
                                                // data: form.serialize(),
                                                error: function (xhr, ajaxOptions, thrownError) {
                                                    alert('Tambah Konfigurasi Bermasalah '+ thrownError +' Silahkan coba kembali');
                                                },
                                                beforeSend: function () {
                                                    $('#loading').show();
                                                },
                                                complete: function () {
                                                    $('#loading').hide();
                                                },
                                                success: function (pdf) {
                                                    // data.namaFile = pdf.namaFile,
                                                    // data.jumlahHalamanHitamPutih = pdf.jumlahHalamanHitamPutih,
                                                    // data.jumlahHalamanBerwarna = pdf.jumlahHalamanBerwarna,
                                                    // data.halamanTerpilih = pdf.halamanTerpilih,
                                                    // data.jumlahSalinan = pdf.jumlahSalinan,
                                                    // data.paksaHitamPutih = pdf.paksaHitamPutih,
                                                    // data.biaya = pdf.biaya,
                                                    // data.catatanTambahan = pdf.catatanTambahan,
                                                    // data.namaProduk = pdf.namaProduk,
                                                    // data.fiturTerpilih = pdf.fiturTerpilih,
                                                    alert('Konfigurasi Anda Telah Berhasil Ditambahkan');
                                                },
                                            });
                                        });

                                        // $('#konfigurasiForm').trigger('submit');

                                    }));

                                    $('#simpanDanLanjutkan').on('click',(function(){

                                    }));
                            }
                        });

                        function kustomHal(halaman) {
                            var hh = new Array(halaman.split("/[\s,,]+/"));
                            var hasil = new Array();

                            // console.log(hh);

                            hh.forEach(h => {
                                if(hh.indexOf(h + '-') !== false) {
                                    // var kk = hh.split("-");
                                    for (let i = h[0]; i <= h[1]; i++) {
                                        hasil.push(i);
                                    }
                                } else {
                                    hasil.push(h);
                                }
                            });
                            hasil.sort();
                            return hasil;
                        }
                });


            });

        </script>
        @endif

        <div id="hasil">
            {{-- <script>
                $(function(pdf){
                    $('#loading').hide();

                    // alert(pdf.jumlahHalBerwarna);

                    // document.getElementById('halamanAwal').onchange(function(){
                    //     alert("asdasdas");

                    //     document.getElementById('jumlahHal').text = parseInt(document.getElementById('halamanAkhir').value) - parseInt(this.value)+1;

                    // });
                    $(document).ready(function(){
                        $('input[type=radio]').on('click change',(function(){

                            var related_class=$(this).val();
                            $('.'+related_class).prop('disabled',false);
                            if($('#rbSemuaHal').is(':checked')){
                                var nilaiSemuaHalaman = $('#rbSemuaHal').val();
                                $('#jumlahHalCetak').html(
                                    '<label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">' +
                                        '<i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>' +
                                        '<label id="jumlahHal">' + nilaiSemuaHalaman + '</label>' +
                                        ' Halaman yang Akan Dicetak' +
                                    '</label>'
                                );

                                $('#jumlahHitamPutih').html(
                                    '<label id="jumlahHitamPutih" class="mb-2">' +
                                        '   ' + pdf['jumlahHalHitamPutih'] + ' Halaman Berwarna' +
                                    '</label>' +
                                    '<br>'
                                );

                                $('#jumlahBerwarna').html(
                                    '<label id="jumlahBerwarna" class="mb-2">' +
                                    '   ' + pdf['jumlahHalBerwarna'] + ' Halaman Berwarna' +
                                    '</label>' +
                                    '<br>'
                                );

                            }
                            else if($('#rbSampaiHal').is(':checked')){
                                var nilaiSampaiHalaman = document.getElementById('halamanAkhir').value - document.getElementById('halamanAwal').value;
                                    if(nilaiSampaiHalaman === 0){
                                        nilaiSampaiHalaman = 1;
                                    }
                                    else{
                                        nilaiSampaiHalaman += 1;
                                    }
                                $('#jumlahHalCetak').html(
                                    '<label id="jumlahHalCetak" class="my-auto" style="font-size: 16px;">' +
                                        '<i class="material-icons md-18 align-middle mr-2" style="color:#C4C4C4">warning</i>' +
                                        '<label id="jumlahHal">' + nilaiSampaiHalaman + '</label>' +
                                        ' Halaman yang Akan Dicetak' +
                                    '</label>'
                                );
                            }
                            // $('#rbSemuaHal').bind('change',function(){
                            //     if(this.checked){
                            //         var nilai1 = $('#rbSemuaHal').val(pdf['jumlahHalaman']);
                            //         alert(nilai1);
                            //     }
                            // });

                            // alert(related_class);

                            $('input[type=radio]').not(':checked').each(function(){
                                var other_class=$(this).val();
                                $('.'+other_class).prop('disabled',true);
                                // alert(other_class);
                            });
                        }));
                    });

                    var jumlahSalinan = 1;

                    $('#btnPlus').click(function(){
                        var val = parseInt($('#jumlahSalin').val(),10);
                        $('#jumlahSalin').val((val+1));
                        jumlahSalinan = val+1;
                        // alert(jumlahSalinan);
                    });

                    $('#btnMinus').click(function(){
                        var val = parseInt($('#jumlahSalin').val(),10);
                        if (val>1) {
                            $('#jumlahSalin').val((val-1));
                            jumlahSalinan = val-1;
                        }
                        // alert(jumlahSalinan);
                    });


                    // $('#btnPlus')

                });
            </script> --}}
        </div>
    {{-- </form> --}}
    </div>
</div>



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
