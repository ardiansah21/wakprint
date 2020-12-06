<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    @php
    $jumlahDiskonGray = $produk->harga_hitam_putih * $produk->jumlah_diskon;
    $jumlahDiskonWarna = $produk->harga_berwarna * $produk->jumlah_diskon;
    $arrJumlahUlasan = [];

    if($jumlahDiskonGray > $produk->maksimal_diskon){
        $hargaHitamPutih = $produk->harga_hitam_putih - $produk->maksimal_diskon;
        $hargaBerwarna = $produk->harga_berwarna - $produk->maksimal_diskon;
    }
    else{
        $hargaHitamPutih = $produk->harga_hitam_putih - $jumlahDiskonGray;
        $hargaBerwarna = $produk->harga_berwarna - $jumlahDiskonWarna;
    }

    if (!empty($ulasan)) {
        foreach ($ulasan as $u => $value) {
            if($value->id_produk === $produk->id_produk){
                array_push($arrJumlahUlasan,$value->id_ulasan);
            }
        }
    }

    @endphp

    <div class="container mt-5 mb-5">
        <div class="row justify-content-between mr-0">
            <div class="col-md-10">
                <label class="text-break font-weight-bold" style="font-size: 48px; max-width:90%;">
                    {{ $produk->partner->nama_toko }}
                </label>
            </div>
            <div class="col-md-auto">
                @if ($produk->partner->status_toko === 'Buka')
                    <img src="{{ url('img/buka.png') }}" class="img-responsive" alt="" width="130px" height="60px">
                @else
                    <img src="{{ url('img/tutup.png') }}" class="img-responsive" alt="" width="130px" height="60px">
                @endif
            </div>
        </div>
        <label class="text-break mb-4" style="font-size:24px;">
            <i class="material-icons md-32 align-middle mr-2">
                location_on
            </i>
            {{ $produk->partner->alamat_toko }}
        </label>
        <div class="row justify-content-left ml-0 mb-0">
            <label class="SemiBold mr-4" style="font-size: 24px;">
                <i class="material-icons md-32 align-middle mr-2" style="color:#FCFF82;">
                    star
                </i>
                {{ round($ratingPartner, 1) }} / 5
                {{-- {{ $produk->partner->rating_toko }} / 5 --}}
                {{-- @foreach ($produk as $p)
                    --}}
                    {{-- {{ collect([$produk->rating])->avg() }} / 5
                    --}}
                    {{-- @endforeach --}}
            </label>
            @if ($produk->partner->ambil_di_tempat === 0 && $produk->partner->antar_ke_tempat === 0)
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
            @elseif($produk->partner->ambil_di_tempat === 1 && $produk->partner->antar_ke_tempat === 1)
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
            @elseif($produk->partner->ambil_di_tempat === 0 && $produk->partner->antar_ke_tempat === 1)
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
            @elseif($produk->partner->ambil_di_tempat === 1 && $produk->partner->antar_ke_tempat === 0)
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
                @if ($a->id_pengelola === $produk->partner->id_pengelola && $a->status === 'Tersedia')
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
                        <label class="mb-4" style="font-size: 18px;">
                            {{ $produk->partner->ntkwh ?? 0 }} %
                        </label>
                    </div>
                    <div class="mx-auto mb-4" style="position:relative;">
                        @if (count($produk->partner->getMedia('foto_percetakan')) > 0)
                            <a data-fancybox="gallery" id="linkFotoPercetakan"
                                href="{{ $produk->partner->getFirstMediaUrl('foto_percetakan') }}">
                                <img id="fotoPercetakanUtama" class="img-responsive"
                                    src="{{ $produk->partner->getFirstMediaUrl('foto_percetakan') }}" alt="no picture"
                                    style="width:300px; height:200px; object-fit:cover;">
                            </a>
                        @else
                            <a data-fancybox="gallery" id="linkFotoPercetakan"
                                href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg">
                                <img class="img-responsive"
                                    src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg" alt=""
                                    style="width:300px; height:200px; object-fit:cover;">
                            </a>
                        @endif
                    </div>
                    @if (count($produk->partner->getMedia('foto_percetakan')) > 0)
                        <div class="row justify-content-left mb-5 mr-0 ml-0">
                            <div class="col-md-1 owl-nav align-self-center">
                                <a class="foto-percetakan-prev text-primary-purple cursor-pointer disabled"
                                    role="presentation">
                                    <i class="material-icons md-28 text-primary-purple">
                                        chevron_left
                                    </i>
                                    {{-- <span class="carousel-control-prev-icon"
                                        aria-hidden="true"></span> --}}
                                </a>
                            </div>
                            <div id="foto-percetakan-carousel"
                                class="col-md-9 owl-carousel owl-theme owl-loaded owl-drag owl-loading">
                                {{-- @if (count($produk->getMedia('foto_produk')) > 0)
                                    --}}
                                    @foreach ($produk->partner->getMedia('foto_percetakan') as $p => $value)
                                        <img id="klikFotoPercetakan{{ $p }}"
                                            class="img-responsive imgPercetakan cursor-pointer" src="{{ $value->getUrl() }}"
                                            alt="no picture" onclick="changeFotoPercetakan(this.src)"
                                            style="width:50px; height:50px; object-fit:cover;" />
                                    @endforeach
                                    {{--
                                @endif --}}
                            </div>
                            <div class="col-md-1 owl-nav align-self-center">
                                <a class="foto-percetakan-next cursor-pointer" role="presentation">
                                    <i class="material-icons md-28 text-primary-purple">
                                        chevron_right
                                    </i>
                                    {{-- <span class="carousel-control-next-icon"
                                        aria-hidden="true"></span> --}}
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="container">
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Pemilik Percetakan') }}
                        </label>
                        <label class="text-truncate mb-4" style="width: 100%; font-size: 18px;">
                            @if (!empty($produk->partner->getFirstMediaUrl()))
                                <img class="img-responsive align-self-center mr-2"
                                    src="{{ $produk->partner->getFirstMediaUrl() }}" width="40" height="40" alt="no logo"
                                    style="border-radius: 30px; border:solid 2px #BC41BE; object-fit:cover;">
                            @else
                                <img class="img-responsive align-self-center mr-2"
                                    src="https://ptetutorials.com/images/user-profile.png" width="40" height="40"
                                    alt="no logo"
                                    style="border-radius: 30px; border:solid 2px #BC41BE; object-fit:cover;">
                            @endif
                            {{ $produk->partner->nama_lengkap }}
                        </label>
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Deskripsi Percetakan') }}
                        </label>
                        <br>
                        <label class="mb-4" style="font-size: 14px;">
                            {{ $produk->partner->deskripsi_toko ?? '-' }}
                        </label>
                        <br>
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Jam Operasional Percetakan') }}
                        </label>
                        <br>
                        @if (!empty($produk->partner->jam_op_buka) && !empty($produk->partner->jam_op_tutup))
                            <label class="mb-4" style="font-size: 14px;">
                                <i class="material-icons md-12 align-middle mr-3">
                                    fiber_manual_record
                                </i>
                                Pukul {{ date_create($produk->partner->jam_op_buka)->format('H:i') }} -
                                {{ date_create($produk->partner->jam_op_tutup)->format('H:i') }} WIB
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
                        @if (!empty($produk->partner->syaratkententuan))
                            <div class="row justify-content-left mb-2" style="font-size: 14px;">
                                <i class="col-md-1 material-icons md-12 mr-1 mt-1">
                                    fiber_manual_record
                                </i>
                                <label class="col-md-10 mb-2" style="font-size: 14px;">
                                    {{ $produk->partner->syaratkententuan }}
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
                                @if ($a->id_pengelola === $produk->partner->id_pengelola)
                                    <div class="row justify-content-left" style="font-size: 14px;">
                                        <div class="col-md-3 text-left">
                                            <label class="mb-2">
                                                {{ $a->nama }}
                                            </label>
                                        </div>
                                        <div class="col-md-2">
                                            <i class="material-icons md-18 align-middle ml-2 mr-4" style="color:#C4C4C4">
                                                help
                                            </i>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <label class="mb-2">
                                                x {{ $a->jumlah }}
                                            </label>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <label class="mb-2">
                                                Rp. {{ $a->harga }}
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <label>-</label>
                                    @break
                                @endif
                            @endforeach
                        @else
                            <label>-</label>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-5 pl-4 pr-4">
                <div class="row justify-content-between card shadow-sm pl-4 pr-4 pt-4 pb-5 ml-4">
                    <div class="row justify-content-between mb-2" style="width:100%;">
                        <label class="col-md-10 SemiBold" style="font-size: 28px;">
                            {{ $produk->nama }}
                        </label>
                        <a class="col-md-auto text-right ml-0 mr-0"
                            href="{{ route('detail.partner', $produk->partner->id_pengelola) }}"
                            style="color: black; left:5%;">
                            <i class="material-icons md-32">
                                close
                            </i>
                        </a>
                    </div>
                    <div class="row justify-content-left mb-2">
                        <div class="col-md-10 ml-0">
                            <label class="" style="color:#FCFF82; font-size: 18px;">
                                @if ($ratingProduk != 0.0)
                                    @for ($i = 0; $i < $ratingProduk; $i++)
                                        <span class="material-icons md-36 align-middle">star</span>
                                    @endfor
                                @else
                                    @for ($i = 0; $i < $produk->rating; $i++)
                                        <span class="material-icons md-36 align-middle">star</span>
                                    @endfor
                                @endif

                                <span class="ml-4">
                                    <a class="text-primary-purple align-middle"
                                        href="{{ route('ulasan.partner', $produk->id_produk) }}">
                                        {{ count($arrJumlahUlasan) }} Ulasan
                                    </a>
                                </span>
                            </label>
                        </div>
                        <div class="col-md-auto">
                            <div class="row text-right">
                                <form id="favorit-form" action="{{ route('favorit.status', $produk->id_produk) }}"
                                    method="POST">
                                    @csrf
                                    <input id="id_produk" name="id_produk" value="{{ $produk->id_produk }}" hidden>
                                    @auth
                                        @if ($member->cekProdukFavorit($member->id_member, $produk->id_produk))
                                            <button type="submit"
                                                class="btn fa fa-heart fa-2x fa-responsive cursor-pointer text-danger mr-2"
                                                style="background:transparent;"></button>
                                        @else
                                            <button type="submit"
                                                class="btn fa fa-heart fa-2x fa-responsive cursor-pointer mr-2"
                                                style="background:transparent;"></button>
                                        @endif
                                    @endauth
                                    {{-- <button type="submit"
                                        class="btn fa fa-heart fa-2x fa-responsive cursor-pointer mr-4"
                                        style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>
                                    --}}
                                </form>
                                <a class="social-button"
                                    href="https://www.facebook.com/sharer/sharer.php?u=https://wakprint.com/produk/detail/{{ $produk->id_produk }}"
                                    style="color:black; text-decoration: none;">
                                    <i id="shareProduk" class="align-self-center material-icons md-36 cursor-pointer">
                                        share
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between ml-0 mr-0">
                        <div class="col-md-6">
                            <div class="mb-4" style="position:relative;">
                                @if (count($produk->getMedia('foto_produk')) > 0)
                                    <a data-fancybox="gallery" id="linkFotoProduk"
                                        href="{{ $produk->getFirstMediaUrl('foto_produk') }}">
                                        <img id="fotoProdukUtama" class="img-responsive"
                                            src="{{ $produk->getFirstMediaUrl('foto_produk') }}" alt="no picture"
                                            style="width:285px; height:200px; object-fit:cover;">
                                    </a>
                                @else
                                    <a data-fancybox="gallery" id="linkFotoProduk"
                                        href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg">
                                        <img class="img-responsive"
                                            src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                            alt="" style="width:285px; height:200px; object-fit:scale-down;">
                                    </a>
                                @endif
                            </div>
                            @if (count($produk->getMedia('foto_produk')) > 0)
                                <div class="row justify-content-between mb-4 mr-0">
                                    <div class="col-md-1 owl-nav align-self-center">
                                        <a class="foto-produk-prev text-primary-purple cursor-pointer disabled"
                                            role="presentation">
                                            <i class="material-icons md-28 text-primary-purple">
                                                chevron_left
                                            </i>
                                        </a>
                                    </div>
                                    <div id="foto-produk-carousel"
                                        class="col-md-9 owl-carousel owl-theme owl-loaded owl-drag owl-loading">
                                        @foreach ($produk->getMedia('foto_produk') as $p => $value)
                                            <img id="klikFotoProduk{{ $p }}" class="img-responsive cursor-pointer imgProduk"
                                                src="{{ $value->getUrl() }}" alt="no picture" onclick="change(this.src)"
                                                style="width:50px; height:50px; object-fit:cover;" />
                                        @endforeach
                                    </div>
                                    <div class="col-md-1 owl-nav align-self-center">
                                        <a class="foto-produk-next cursor-pointer" role="presentation">
                                            <i class="material-icons md-28 text-primary-purple">
                                                chevron_right
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="card-text text-break mb-2" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">
                                    description
                                </i>
                                {{ $produk->jenis_kertas }}
                            </label>
                            <br>
                            <label class="card-text text-break mb-3" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">
                                    print
                                </i>
                                {{ $produk->jenis_printer }}
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="mb-2">
                            <label class="card-text SemiBold mb-4" style="font-size: 24px;">
                                {{ __('Harga Produk') }}
                            </label>
                            <br>
                            @if (!empty($produk->jumlah_diskon))
                                <label class="text-break font-weight-bold mb-2" style="font-size: 20px;">
                                    Rp. <del>{{ $produk->harga_hitam_putih ?? '-' }}</del> {{ $hargaHitamPutih ?? '-' }} /
                                    Hal
                                    (Hitam-Putih)
                                </label>
                                <br>
                                @if (!empty($produk->harga_berwarna))
                                    <label class="text-break text-primary-purple font-weight-bold mb-2"
                                        style="font-size: 20px;">
                                        Rp. <del>{{ $produk->harga_berwarna ?? '-' }}</del> {{ $hargaBerwarna ?? '-' }} /
                                        Hal (Berwarna)
                                    </label>
                                @endif
                            @elseif(!empty($produk->harga_berwarna))
                                <label class="text-break font-weight-bold mb-2" style="font-size: 20px;">
                                    Rp. {{ $produk->harga_hitam_putih ?? '-' }} / Hal (Hitam-Putih)
                                </label>
                                <br>
                                <label class="text-break text-primary-purple font-weight-bold mb-4"
                                    style="font-size: 20px;">
                                    Rp. {{ $produk->harga_berwarna ?? '-' }} / Hal (Warna)
                                </label>
                            @else
                                <label class="text-break font-weight-bold mb-2" style="font-size: 20px;">
                                    Rp. {{ $produk->harga_hitam_putih ?? '-' }} / Hal (Hitam-Putih)
                                </label>
                            @endif
                        </div>
                        <div class="row justify-content-between">
                            @if (!empty($produk->harga_timbal_balik_hitam_putih))
                                <label class="col-md-6 text-break mb-2" style="font-size: 18px;">
                                    {{ __('Timbal Balik (Hitam-Putih)') }}
                                </label>
                                <i class="col-md-1 material-icons md-18 mt-1" style="color:#C4C4C4">
                                    help
                                </i>
                                <label class="col-md-4 text-break text-right SemiBold mb-2" style="font-size: 14px;">
                                    Rp. {{ $produk->harga_timbal_balik_hitam_putih }} / Hal
                                </label>
                            @endif
                        </div>
                        <div class="row justify-content-between mb-4">
                            @if (!empty($produk->harga_timbal_balik_berwarna))
                                <label class="col-md-6 text-break text-primary-purple mb-2" style="font-size: 18px;">
                                    {{ __('Timbal Balik (Warna)') }}
                                </label>
                                <i class="col-md-1 material-icons md-18 mt-1" style="color:#C4C4C4">
                                    help
                                </i>
                                <label class="col-md-4 text-break text-right text-primary-purple SemiBold mb-2"
                                    style="font-size: 14px;">
                                    Rp. {{ $produk->harga_timbal_balik_berwarna }} / Hal
                                </label>
                            @endif
                        </div>
                        <label class="card-text SemiBold mb-3" style="font-size: 24px;">
                            {{ __('Fitur') }}
                        </label>
                        <br>
                        @if (!empty($fitur))
                            <div class="row justify-content-between mb-4">
                                @foreach ($fitur as $key => $value)
                                    <label class="col-md-6 text-break mb-2" style="font-size: 18px;">
                                        {{ $value['nama'] }}
                                    </label>
                                    <i class="col-md-1 material-icons md-18 mt-1" style="color:#C4C4C4">
                                        help
                                    </i>
                                    <label class="col-md-5 text-break text-right font-weight-bold mb-2"
                                        style="font-size: 14px;">
                                        + Rp. {{ $value['harga'] }} / Hal
                                    </label>
                                @endforeach
                            </div>
                        @else
                            <label class="ml-0">-</label>
                            <br>
                        @endif()
                    </div>
                    <div class="bg-light-purple pl-4 pr-4 pb-4 pt-4 mb-5" style="border-radius:5px;">
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Deskripsi Produk') }}
                        </label>
                        <p class="mb-4" style="font-size: 14px;">
                            {{ $produk->deskripsi }}
                        </p>
                    </div>
                    <div class="row justify-content-end mr-0">
                        <button class="btn btn-default btn-lg text-primary-danger font-weight-bold pl-4 pr-4 mr-4"
                            onclick="window.location.href='{{ route('produk.lapor', $produk->id_produk) }}'"
                            style="border-radius:30px;font-size: 18px;">
                            {{ __('Laporkan') }}
                        </button>
                        <button class="btn btn-primary-wakprint btn-lg font-weight-bold pl-4 pr-4"
                            style="border-radius:30px; font-size: 18px;"
                            onclick="window.location.href='{{ route('konfigurasi.produk', $produk->id_produk) }}'">
                            {{ __('Gunakan Produk') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var msg = '{{ Session::get('
            alert ') }}';
            var exist = '{{ Session::has('
            alert ') }}';
            if (exist) {
                alert(msg);
            }

            var fotoProdukCarousel = $("#foto-produk-carousel");
            var fotoPercetakanCarousel = $("#foto-percetakan-carousel");

            // Produk Navigation Events
            $(".foto-produk-next").on('click', function() {
                fotoProdukCarousel.trigger('next.owl.carousel');
            });
            $(".foto-produk-prev").on('click', function() {
                fotoProdukCarousel.trigger('prev.owl.carousel');
            });

            // Percetakan Navigation Events
            $(".foto-percetakan-next").on('click', function() {
                fotoPercetakanCarousel.trigger('next.owl.carousel');
            });
            $(".foto-percetakan-prev").on('click', function() {
                fotoPercetakanCarousel.trigger('prev.owl.carousel');
            });

            fotoProdukCarousel.owlCarousel({
                loop: false,
                autoplay: false,
                autoplayTimeout: 5000,
                autoplayHoverPause: true
            });

            fotoPercetakanCarousel.owlCarousel({
                loop: false,
                autoplay: false,
                autoplayTimeout: 5000,
                autoplayHoverPause: true
            });
        });

        $('img').each(function(index, value) {
            $('#klikFotoProduk' + 0).css('border', "solid 2px #BC41BE");
            $('#klikFotoPercetakan' + 0).css('border', "solid 2px #BC41BE");

            $('#klikFotoProduk' + index).on('click', function(e) {
                $('.imgProduk').css('border', "solid 0px #BC41BE");
                $(this).css('border', "solid 2px #BC41BE");
            });
            $('#klikFotoPercetakan' + index).on('click', function(e) {
                $('.imgPercetakan').css('border', "solid 0px #BC41BE");
                $(this).css('border', "solid 2px #BC41BE");
            });
        });

        function change(src) {
            document.getElementById('fotoProdukUtama').src = src;
            document.getElementById('linkFotoProduk').href = src;
        }

        function changeFotoPercetakan(src) {
            document.getElementById('fotoPercetakanUtama').src = src;
            document.getElementById('linkFotoPercetakan').href = src;
        }

        // $('#shareProduk').on('click',function(){
        //     window.location = "http://www.url-to-real-shared-page";
        // });

    </script>
@endsection
