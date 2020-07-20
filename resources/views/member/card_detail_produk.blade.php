<div class="card shadow-sm pl-4 pr-4 pt-4 pb-5">
    <div class="row justify-content-between mb-2">
        <label class="col-md-10 text-justify text-break SemiBold"
            style="font-size: 28px;">
            {{__('Cetak Hitam Putih Dokumen by Percetakan IMAHA Productions asdsadadssadsaas')}}
        </label>
        <a class="col-md-auto ml-0"
            href=""
            style="color: black;">
            <i class="material-icons md-32">
                close
            </i>
        </a>
    </div>
    <div class="row justify-content-between mb-5">
        <div class="col-md-auto ml-0">
            <label class="" style="color:#FCFF82;
                font-size: 18px;">
                <span class="material-icons md-36 align-middle">star</span>
                <span class="material-icons md-36 align-middle">star</span>
                <span class="material-icons md-36 align-middle">star</span>
                <span class="material-icons md-36 align-middle">star</span>
                <span class="material-icons md-36 align-middle">star</span>
                <span class="ml-4">
                    <a class="text-primary-purple align-middle"
                        href="">
                        {{__('10 Ulasan')}}
                    </a>
                </span>
            </label>
        </div>
        <div class="col-md-auto text-right">
            <i class="material-icons md-36 mr-4"
            style="color:#FF4949;">
                favorite
            </i>
            <i class="material-icons md-36 ml-0">
                forward
            </i>
        </div>
    </div>
    <div class="row justify-content-between ml-0">
        <div class="col-md-6">
            <div class="mb-4"
                style="position:relative;">
                <img class="img-responsive"
                    src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                    alt="" style="width:285px; height:200px;">
            </div>
            <div class="row justify-content-left mb-5">
                <span class="align-self-center col-md-1 mr-0">
                    <a class="text-primary-purple"
                        href="#multi-item-foto-produk"
                        role="button"
                        data-slide="prev">
                        <i class="material-icons md-32">
                            chevron_left
                        </i>
                    </a>
                </span>

                <!--Carousel Wrapper-->
                <div id="multi-item-foto-produk" class="carousel slide carousel-multi-item col-md-9"
                    data-ride="carousel">

                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">

                        {{-- @foreach ($collection as $item) --}}
                        <div class="carousel-item active">
                            <div class="row">

                                {{-- @foreach ($collection as $item) --}}
                                <div class="col-md-auto mr-0">
                                    <img class="img-responsive"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                        alt="" style="width:50px; height:50px;">
                                </div>
                                {{-- @endforeach --}}

                            </div>
                        </div>
                        {{-- @endforeach --}}

                    </div>
                    <!--/.Slides-->

                </div>
                <!--/.Carousel Wrapper-->

                <span class="align-self-center">
                    <a class="text-primary-purple"
                        href="#multi-item-foto-produk"
                        role="button"
                        data-slide="next">
                        <i class="material-icons md-32">
                            chevron_right
                        </i>
                    </a>
                </span>
            </div>
        </div>
        <div class="col-md-6">
            <label class="text-break font-weight-bold mb-4"
                style="font-size: 24px;">
                {{__('Rp. 2.000 / hal')}}
            </label>

            {{-- @foreach ($collection as $item) --}}
            <label class="card-text text-break mb-2"
                style="font-size: 18px;">
                <i class="material-icons md-18 align-middle mr-2">
                    palette
                </i>
                {{__('Hitam Putih')}}
            </label>
            <br>
            <label class="card-text text-break mb-2"
                style="font-size: 18px;">
                <i class="material-icons md-18 align-middle mr-2">
                    print
                </i>
                 {{__('Ink Jet')}}
            </label>
            {{-- @endforeach --}}

            <div class="row justify-content-between mb-4">
                <label class="col-md-5 text-break mb-2"
                        style="font-size: 18px;">
                        {{__('Timbal Balik')}}
                </label>
                <i class="col-md-auto material-icons md-18 mt-1"
                style="color:#C4C4C4">
                help
                </i>
                <label class="col-md-auto text-break SemiBold mb-2"
                    style="font-size: 14px;">
                    {{__('+ Rp. 2k / Hal')}}
                </label>
            </div>
            <label class="card-text SemiBold mb-2"
                style="font-size: 18px;">
                {{__('Paket')}}
            </label>

            {{-- @foreach ($collection as $item) --}}
            <div class="row justify-content-between mb-4">
                <label class="col-md-5 text-break mb-2"
                        style="font-size: 18px;">
                        {{__('Jilid')}}
                </label>
                <i class="col-md-auto material-icons md-18 mt-1"
                style="color:#C4C4C4">
                help
                </i>
                <label class="col-md-auto text-break font-weight-bold mb-2"
                    style="font-size: 14px;">
                    {{__('+ Rp. 2k / Hal')}}
                </label>
            </div>
            {{-- @endforeach --}}


            <label class="card-text SemiBold mb-2"
                style="font-size: 18px;">
                {{__('Non-Paket')}}
            </label>

            {{-- @foreach ($collection as $item) --}}
            <div class="row justify-content-between mb-4">
                <label class="col-md-5 text-break mb-2"
                        style="font-size: 18px;">
                        {{__('Kertas Jeruk')}}
                </label>
                <i class="col-md-auto material-icons md-18 mt-1"
                style="color:#C4C4C4">
                help
                </i>
                <label class="col-md-auto text-break font-weight-bold mb-2"
                    style="font-size: 14px;">
                    {{__('+ Rp. 2k / Hal')}}
                </label>
            </div>
            {{-- @endforeach --}}

        </div>
    </div>
    <div class="bg-light-purple pl-4 pr-4 pb-4 pt-4 mb-5"
        style="border-radius:5px;">
        <label class="SemiBold mb-2"
            style="font-size: 18px;">
            {{__('Deskripsi Produk')}}
        </label>
        <p class="mb-4"
            style="font-size: 14px;">
            {{__('Produk ini sudah dibuat 1 paket dengan keterangan yang ada diatas, apabila kamu ingin
            membuat permintaan khusus silahkan tulis di kolom catatan tambahan yang sudah disediakan
            pada konfigurasi file kamu sebelum melakukan pemesanan atau apabila produk ini kurang
            sesuai dengan keinginan tambahan kamu maka silahkan kamu memilih produk lain yang sesuai
            dengan tambahan yang anda inginkan. Terimakasih:):)')}}
        </p>
    </div>

    <div class="row justify-content-end mr-0">
        <button class="btn btn-default btn-lg text-primary-danger font-weight-bold pl-4 pr-4 mr-4"
            style="border-radius:30px;font-size: 18px;">
            {{__('Laporkan')}}   
        </button>
        <button class="btn btn-primary-wakprint btn-lg font-weight-bold pl-4 pr-4"
            style="border-radius:30px; font-size: 18px;">
            {{__('Gunakan Produk')}}
        </button>
    </div>
</div>