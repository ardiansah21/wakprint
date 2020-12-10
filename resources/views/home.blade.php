<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')

<div class="pt-5 pb-5 img-responsive d-flex justify-content-center pl-0 pr-0" style="background-image: url(img/bg-unggah.png);background-size: cover;">
    <div ondragover="" id="areaUnggah" class="row border border-white text-white align-self-center ml-5 mr-5" style="width:250px;height:250px; background-color:transparent !important;">
        <form action="{{ route('upload.pdf') }}" class="dropzone" method="POST" enctype="multipart/form-data" style="width:100% ;background-color:transparent !important;">
            @csrf
            <div class="dz-message" data-dz-message>
                <label class="SemiBold my-auto" style="text-align:center; font-size: 24px">{{__('Letak Dokumen Disini') }}</label>
            </div>
        </form>
    </div>
    <div id="kamuMauPrintApa">
        <h1 class="display-4 font-weight-bold mb-0" style="font-size: 64px">{{__('Kamu mau print apa ?') }}</h1>
        <label class="SemiBold mb-4 ml-1" style="font-size: 24px">{{__('Letak dokumen kamu disamping atau pilih unggah ?') }}</label>
        <br>
        <button id="a" type="button" class="btn btn-primary-yellow btn-rounded shadow ml-1 pt-1 pb-1 pl-5 pr-5 font-weight-bold text-center" style="border-radius:30px; font-size: 24px;" onclick="openDialog()">
            <i class="material-icons md-32 align-middle mb-1 mr-1">cloud_upload</i>
            {{__('Unggah') }}
        </button>
        <form id="upload-form" action="{{ route('upload.file.home') }}" method="POST" enctype="multipart/form-data" style="display: none;">
            @csrf
            <input type='file' name="file" id="fileid" onchange="submitForm()" accept="application/pdf" hidden />
        </form>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="pt-5 pb-5">
        <h1 class="font-weight-bold text-center mb-5" style="font-size: 48px">{{__('Cara Pemesanan') }}</h1>
        <div class="row">
            <div class="col-md-4">
                <img src="img/uploaddata.png" class="img-responsive d-flex justify-content-center center mb-4" alt="" width="100px" height="100px">
                <h4 class="SemiBold text-primary-purple text-center" style="font-size: 24px">{{__('Unggah Data') }}</h4>
                <p class="text-center" style="font-size: 18px">{{__('Unggah data dan masukan detail pesanan') }}</p>
            </div>
            <div class="col-md-4">
                <img src="img/caripercetakan.png" class="img-responsive center mb-4" alt="" width="100px" height="100px">
                <h4 class="SemiBold text-primary-purple text-center" style="font-size: 24px">
                    {{__('Cari Tempat Percetakan') }}
                </h4>
                <p class="text-center" style="font-size: 18px">
                    {{__('Cari lokasi tempat percetakan sesuai kebutuhan') }}
                </p>
            </div>
            <div class="col-md-4">
                <img src="img/ambildokumen.png" class="img-responsive center mb-4" alt="" width="100px" height="100px">
                <h4 class="SemiBold text-primary-purple text-center" style="font-size: 24px">
                    {{__('Ambil Dokumen') }}
                </h4>
                <p class="text-center" style="font-size: 18px">
                    {{__('Lakukan pembayaran dan ambil dokumen langsung di tempat percetakan') }}
                </p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center bg-light-purple p-5 mb-5" style="border-radius:5px;">
        <h1 class="font-weight-bold text-center mb-4" style="font-size: 48px">{{__('Tentang Wakprint') }}</h1>
        <p class="text-center" style="font-size: 24px">
            {{__('Wakprint adalah platform yang menghubungkan semua printer di seluruh Indonesia secara online untuk menjawab
                kebutuhan pencetakan dokumen Anda. Ribuan printer yang telah menjadi rekanan Wakprint, dapat diakses oleh
                Anda dengan mudah. Kirimkan dokumen dan ambil serta bayar dokumen anda langsung ke rekanan kami. Sekarang,
                mencetak dokumen dapat dilakukan di mana pun dengan
                mudah pada jaringan printer di Wakprint.com') }}
        </p>
    </div>
    <div class="row">
        <div class="main-search-input mb-5 ml-0">
            <div class="main-search-input-item">
                <input type="text" role="search" class="form-control p-4" id="keywordPencarian" name="keywordPencarian" placeholder="Cari percetakan atau produk disini" aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2" style="border:0px solid white; border-radius:30px; font-size:24px;">
                <button class="btn btn-primary-yellow btn-rounded shadow-sm ml-1 pt-1 pb-1 pl-5 pr-5 SemiBold text-center" onclick="window.location.href='{{route('pencarian',request()->input('keywordPencarian'))}}'" style="position: absolute; font-size:24px; top: 50%; left: 92%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                    {{__('Cari') }}
                </button>
            </div>
        </div>
    </div>
    <div class="row justify-content-between mb-5">
        <label class="font-weight-bold" style="font-size: 48px">{{__('Produk Pilihan') }}</label>
        <a class="SemiBold text-primary-purple align-self-center" href="{{ route('pencarian') }}"
            style="font-size: 14px">{{__('Lihat Semua') }}</a>
    </div>
    <div class="row justify-content-between mb-5">
        <div class="col-md-1 owl-nav align-self-center">
            <a class="produk-prev disabled" role="presentation">
                <span class="carousel-control-prev-icon btn-floating btn-circle-navigation-right rounded-circle cursor-pointer" aria-hidden="true"></span>
            </a>
        </div>
        <div id="produk-carousel" class="col-md-10 owl-carousel owl-theme owl-loaded owl-drag owl-loading">
            @foreach ($produk as $p)
                <div class="mr-4">
                    @include('member.card_produk')
                </div>
            @endforeach
        </div>
        <div class="col-md-1 owl-nav align-self-center">
            <a class="produk-next" role="presentation">
                <span class="carousel-control-next-icon btn-floating btn-circle-navigation-left rounded-circle cursor-pointer" aria-hidden="true"></span>
            </a>
        </div>
    </div>
    <div class="row justify-content-between mb-5">
        <label class="font-weight-bold" style="font-size: 48px">{{__('Percetakan Pilihan') }}</label>
        <a class="SemiBold text-primary-purple align-self-center" href="{{ route('pencarian') }}"
            style="font-size: 14px">{{__('Lihat Semua') }}</a>
    </div>
    <div class="row justify-content-between mb-5">
        <div class="col-md-1 owl-nav align-self-center">
            <a class="percetakan-prev disabled" role="presentation">
                <span class="carousel-control-prev-icon btn-floating btn-circle-navigation-right rounded-circle cursor-pointer" aria-hidden="true"></span>
            </a>
        </div>
        <div id="percetakan-carousel" class="col-md-10 owl-carousel owl-theme owl-loaded owl-drag owl-loading">
            @foreach ($partner as $p)
                <div class="mr-4">
                    @include('member.card_percetakan')
                </div>
            @endforeach
        </div>
        <div class="col-md-1 owl-nav align-self-center">
            <a class="percetakan-next" role="presentation">
                <span class="carousel-control-next-icon btn-floating btn-circle-navigation-left rounded-circle cursor-pointer" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>
<div id="areaDaftarPercetakan" class="img-responsive pt-5 pb-5 pr-0 pl-0 mb-0 mr-0"
    style="background-image: url(img/bg-daftarpercetakan.png); background-size: cover;">
    <div class="container">
        <label class="font-weight-bold" style="font-size: 64px;">{{__('Daftarkan Percetakan Kamu') }}</label>
        <br>
        <label class="text-dark font-weight-bold mb-4"
            style="font-size: 24px;">{{__('Jadilah percetakan terbaik di Indonesia melalui kami') }}</label>
        <br>
        <button onclick="window.location.href='{{ route('partner.register') }}'"
            class="btn btn-primary-wakprint btn-rounded shadow pt-2 pb-2 pl-4 pr-4 font-weight-bold"
            style="font-size: 24px">
            <i class="material-icons md-32 align-middle mr-1">exit_to_app</i>
            {{__('Daftar') }}
        </button>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('dropzone/dist/min/dropzone.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    function openDialog() {
        document.getElementById('fileid').click();
    }
    function submitForm() {
        document.getElementById('upload-form').submit();
    }
    Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone(".dropzone",{
            maxFilesize: 10,  // 3 mb
            maxFiles:1,
            acceptedFiles: ".pdf",
            clickable: true,
            timeout:180000,
        });
        // myDropzone.on("success", function(pdf){

        //     // window.location.href = "{{route('konfigurasi.file',['pdf'=>"v"])}}";
        //     // if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {
        //         alert('sukses'));
        //     // }
        //     // document.body.innerHTML += <form id="Form"action="{{ route('upload.test') }}" method="POST" enctype="multipart/form-data"><input type="hidden" name="file" value="+pdf}}"></form>';
        //     // document.getElementById("Form").submit();
        // });
        myDropzone.on("success", function(file, xhr, formData){
                document.body.innerHTML += '<form id="Form"action="{{ route('upload.test') }}" method="POST" enctype="multipart/form-data"> @csrf <input type="text" name="namaFile" value="'+xhr.pdf.namaFile+'"> <input type="text" name="jumlahHalaman" value="'+xhr.pdf.jumlahHalaman+'"> <input type="text" name="jumlahHalBerwarna" value="'+xhr.pdf.jumlahHalBerwarna+'"> <input type="text" name="jumlahHalHitamPutih" value="'+xhr.pdf.jumlahHalHitamPutih+'"> <input type="text" name="path" value="'+xhr.pdf.path+'"></form>';
                document.getElementById("Form").submit();
        });
    //     myDropzone.on("sending", function(file, xhr, formData) {
    //         formData.append("filesize", file.size);
    //    });
</script>
<script>
    $(document).ready(function(){
        var produkCarousel = $("#produk-carousel");
        var percetakanCarousel = $("#percetakan-carousel");

        // Produk Navigation Events
        $(".produk-next").on('click',function(){
            produkCarousel.trigger('next.owl.carousel');
        });
        $(".produk-prev").on('click',function(){
            produkCarousel.trigger('prev.owl.carousel');
        });

        // Percetakan Navigation Events
        $(".percetakan-next").on('click',function(){
            percetakanCarousel.trigger('next.owl.carousel');
        });
        $(".percetakan-prev").on('click',function(){
            percetakanCarousel.trigger('prev.owl.carousel');
        });

        produkCarousel.owlCarousel({
            loop:true,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true
        });

        percetakanCarousel.owlCarousel({
            loop:true,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true
        });
    });
</script>
@endsection
