<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="container mb-5 mt-5">
        <div class="row justify-content-between">
            <div class="col-md-10">
                <label class="text-break font-weight-bold" style="font-size: 48px; max-width:90%;">
                    {{ $partner->nama_toko }}
                </label>
            </div>
            <div class="col-md-auto">
                <img src="{{ url('img/buka.png') }}" class="img-responsive mr-0" alt="" width="130px" height="60px">
            </div>
        </div>
        <label class="text-break mb-4"
            @if(!empty($partner->url_google_maps))
                onclick="window.location.href='{{$partner->url_google_maps}}'"
            @endif
                style="font-size:24px;">
            <i class="material-icons md-32">
                location_on
            </i>
            {{ $partner->alamat_toko }}
        </label>
        <div class="row justify-content-left ml-0 mb-0">
            <label class="SemiBold mr-4" style="font-size: 24px;">
                <i class="material-icons md-32 align-middle mr-2" style="color:#FCFF82;">
                    star
                </i>
                @foreach ($produk as $p)
                    @if (!empty($p) && $p->id_pengelola === $p->partner->id_pengelola)
                        {{ round($ratingPartner, 1) }} / 5
                    @else
                        {{ $p->partner->rating_toko }} / 5
                    @endif
                    @break
                @endforeach
            </label>
            @if ($partner->ambil_di_tempat === 0 && $partner->antar_ke_tempat === 0)
                <label class="mr-4" style="font-size: 18px;" hidden>
                    <i class="align-middle material-icons md-32 mr-1">
                        directions_run
                    </i>
                    {{ __('Ambil di Tempat') }}
                </label>
                <label class="mr-4" style="font-size: 18px;" hidden>
                    <i class="align-middle material-icons md-32 mr-2">
                        local_shipping
                    </i>
                    {{ __('Antar ke Rumah') }}
                </label>
            @elseif($partner->ambil_di_tempat === 1 && $partner->antar_ke_tempat === 1)
                <label class="mr-4" style="font-size: 18px;">
                    <i class="align-middle material-icons md-32 mr-1">
                        directions_run
                    </i>
                    {{ __('Ambil di Tempat') }}
                </label>
                <label class="mr-4" style="font-size: 18px;">
                    <i class="align-middle material-icons md-32 mr-2">
                        local_shipping
                    </i>
                    {{ __('Antar ke Rumah') }}
                </label>
            @elseif($partner->ambil_di_tempat === 0 && $partner->antar_ke_tempat === 1)
                <label class="mr-4" style="font-size: 18px;" hidden>
                    <i class="align-middle material-icons md-32 mr-1">
                        directions_run
                    </i>
                    {{ __('Ambil di Tempat') }}
                </label>
                <label class="mr-4" style="font-size: 18px;">
                    <i class="align-middle material-icons md-32 mr-2">
                        local_shipping
                    </i>
                    {{ __('Antar ke Rumah') }}
                </label>
            @elseif($partner->ambil_di_tempat === 1 && $partner->antar_ke_tempat === 0)
                <label class="mr-4" style="font-size: 18px;">
                    <i class="align-middle material-icons md-32 mr-1">
                        directions_run
                    </i>
                    {{ __('Ambil di Tempat') }}
                </label>
                <label class="mr-4" style="font-size: 18px;" hidden>
                    <i class="align-middle material-icons md-32 mr-2">
                        local_shipping
                    </i>
                    {{ __('Antar ke Rumah') }}
                </label>
            @else
                <label class="mr-4" style="font-size: 18px;" hidden>
                    <i class="align-middle material-icons md-32 mr-1">
                        directions_run
                    </i>
                    {{ __('Ambil di Tempat') }}
                </label>
                <label class="mr-4" style="font-size: 18px;" hidden>
                    <i class="align-middle material-icons md-32 mr-2">
                        local_shipping
                    </i>
                    {{ __('Antar ke Rumah') }}
                </label>
            @endif
            @foreach ($atk as $a)
                @if ($a->id_pengelola === $partner->id_pengelola && $a->status === 'Tersedia')
                    <label class="mr-4" style="font-size: 18px;">
                        <i class="align-middle material-icons md-32 mr-2">
                            architecture
                        </i>
                        {{ __('Alat Tulis Kantor') }}
                    </label>
                    @break
                @else
                    <label class="mr-4" style="font-size: 18px;" hidden>
                        <i class="align-middle material-icons md-32 mr-2">
                            architecture
                        </i>
                        {{ __('Alat Tulis Kantor') }}
                    </label>
                @endif
            @endforeach
        </div>
        <div class="row justify-content-between ml-0 mr-0">
            <div class="col-md-4 mt-5">
                <div class="row justify-content-between bg-light-purple p-3" style="border-radius:10px;">
                    <div class="mb-4" style="border-bottom: 1px solid #BC41BE">
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Nilai Persentase Minimum Toleransi Halaman Berwarna') }}
                        </label>
                        <label class="mb-4 mr-2" style="font-size: 18px;">
                            {{ $partner->ntkwh ?? 0 }} %
                        </label>
                        <i id="helpNtkwh" class="material-icons md-18 cursor-pointer mt-1" data-toggle="popover" data-trigger="hover" title="Deskripsi" data-html="true" data-content="<div><p>Nilai Toleransi Kandungan Halaman Berwarna merupakan nilai toleransi minimum yang ditetapkan oleh tempat percetakan dalam mendeteksi warna per halaman pada dokumen yang diunggah</p></div>" onmouseover="showPopUpHelpNtkwh()" onmouseout="hidePopUpHelpNtkwh()" style="color:#C4C4C4">
                            help
                        </i>
                    </div>
                    <div class="mx-auto mb-4" style="position:relative;">
                        @if (count($partner->getMedia('foto_percetakan')) > 0)
                            <a data-fancybox="gallery" id="linkFotoPercetakan"
                                href="{{ $partner->getFirstMediaUrl('foto_percetakan') }}">
                                <img id="fotoPercetakanUtama" class="img-responsive"
                                    src="{{ $partner->getFirstMediaUrl('foto_percetakan') }}" alt="no picture"
                                    style="width:300px; height:200px; object-fit:cover;">
                            </a>
                        @else
                            <a data-fancybox="gallery" id="linkFotoPercetakan"
                                href="{{$partner->foto_percetakan[0]}}">
                                <img id="fotoPercetakanUtama" class="img-responsive"
                                    src="{{$partner->foto_percetakan[0]}}" alt=""
                                    style="width:300px; height:200px; object-fit:cover;">
                            </a>
                        @endif
                    </div>
                    @if (count($partner->getMedia('foto_percetakan')) > 0)
                        <div class="row justify-content-left mb-5 mr-0">
                            <div class="col-md-1 owl-nav align-self-center">
                                <a class="foto-percetakan-prev text-primary-purple cursor-pointer disabled"
                                    role="presentation">
                                    <i class="material-icons md-28 text-primary-purple">
                                        chevron_left
                                    </i>
                                </a>
                            </div>
                            <div id="foto-percetakan-carousel"
                                class="col-md-9 owl-carousel owl-theme owl-loaded owl-drag owl-loading">
                                @if (count($partner->getMedia('foto_percetakan')) > 0)
                                    @foreach ($partner->getMedia('foto_percetakan') as $p => $value)
                                        <img id="klikFotoPercetakan{{ $p }}" class="img-responsive imgPercetakan"
                                            src="{{ $value->getUrl() }}" alt="no picture"
                                            onclick="changeFotoPercetakan(this.src)"
                                            style="width:50px; height:50px; object-fit:cover;" />
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-1 owl-nav align-self-center">
                                <a class="foto-percetakan-next cursor-pointer" role="presentation">
                                    <i class="material-icons md-28 text-primary-purple">
                                        chevron_right
                                    </i>
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="container">
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Pemilik Percetakan') }}
                        </label>
                        <label class="text-truncate mb-4" style="width: 100%; font-size: 18px;">
                            <img class="img-responsive align-self-center mr-2" src="{{$partner->avatar}}" width="40" height="40" alt="no logo" style="border-radius: 30px; border:solid 2px #BC41BE; object-fit:cover;">
                            {{ $partner->nama_lengkap }}
                        </label>
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Deskripsi Percetakan') }}
                        </label>
                        <br>
                        <label class="mb-4" style="font-size: 14px;">
                            {{ $partner->deskripsi_toko ?? '-' }}
                        </label>
                        <br>
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Jam Operasional Percetakan') }}
                        </label>
                        <br>
                        @if (!empty($partner->jam_op_buka) && !empty($partner->jam_op_tutup))
                            <label class="mb-4" style="font-size: 14px;">
                                <i class="material-icons md-12 align-middle mr-3">
                                    fiber_manual_record
                                </i>
                                Pukul {{ date_create($partner->jam_op_buka)->format('H:i') }} -
                                {{ date_create($partner->jam_op_tutup)->format('H:i') }} WIB
                            </label>
                            <br>
                        @else
                            <label class="mb-2" style="font-size: 14px;">
                                {{ __('-') }}
                            </label>
                            <br>
                        @endif
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Syarat & Ketentuan Percetakan') }}
                        </label>
                        <br>
                        @if (!empty($partner->syaratkententuan))
                            <div class="row justify-content-left mb-2" style="font-size: 14px;">
                                <i class="col-md-1 material-icons md-12 mr-1 mt-1">
                                    fiber_manual_record
                                </i>
                                <label class="col-md-10 mb-2" style="font-size: 14px;">
                                    {{ $partner->syaratkententuan }}
                                </label>
                            </div>
                            <br>
                        @else
                            <label class="mb-2" style="font-size: 14px;">
                                {{ __('-') }}
                            </label>
                            <br>
                        @endif
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('ATK') }}
                        </label>
                        <br>
                        @if (!empty($atk))
                            @foreach ($atk as $a)
                                @if ($a->id_pengelola === $partner->id_pengelola)
                                    <div class="row justify-content-left" style="font-size: 14px;">
                                        <div class="col-md-5 text-left">
                                            <label class="mb-2">
                                                {{ $a->nama }}
                                            </label>
                                        </div>
                                        {{-- <div class="col-md-2">
                                            <i class="material-icons md-18 align-middle ml-2 mr-4" style="color:#C4C4C4">
                                                help
                                            </i>
                                        </div> --}}
                                        <div class="col-md-3 text-left">
                                            <label class="mb-2">
                                                x {{ $a->jumlah }}
                                            </label>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <label class="mb-2">
                                                {{ rupiah($a->harga) }}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <label>-</label>
                        @endif
                    </div>
                </div>
            </div>
            <div id="pencarianDetailPartnerVue" class="col-md-8 mt-5">
                <pencarian-produk-parner-component :produks="{{ $produk }}">
                </pencarian-produk-parner-component>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        var fotoPercetakan = $('#fotoPercetakan').val();
        var fotoPercetakanCarousel = $("#foto-percetakan-carousel");

        // Percetakan Navigation Events
        $(".foto-percetakan-next").on('click', function() {
            fotoPercetakanCarousel.trigger('next.owl.carousel');
        });
        $(".foto-percetakan-prev").on('click', function() {
            fotoPercetakanCarousel.trigger('prev.owl.carousel');
        });

        fotoPercetakanCarousel.owlCarousel({
            loop: false,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });

        $('img').each(function(index, value) {
            $('#klikFotoPercetakan' + 0).css('border', "solid 2px #BC41BE");
            $('#klikFotoPercetakan' + index).on('click', function(e) {
                $('.imgPercetakan').css('border', "solid 0px #BC41BE");
                $(this).css('border', "solid 2px #BC41BE");
            });
        });

        function changeFotoPercetakan(src) {
            document.getElementById('fotoPercetakanUtama').src = src;
            document.getElementById('linkFotoPercetakan').href = src;
        }

        function showPopUpHelpNtkwh() {
            $('#helpNtkwh').popover('show');
        }

        function hidePopUpHelpTbNtkwh() {
            $('#helpNtkwh').popover('hide');
        }

    </script>
@endsection
