<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
@php
$jumlahDiskonGray = $produk->harga_hitam_putih * $produk->jumlah_diskon;
$jumlahDiskonWarna = $produk->harga_berwarna * $produk->jumlah_diskon;
if($jumlahDiskonGray > $produk->maksimal_diskon){
$hargaHitamPutih = $produk->harga_hitam_putih - $produk->maksimal_diskon;
$hargaBerwarna = $produk->harga_berwarna - $produk->maksimal_diskon;
}
else{
$hargaHitamPutih = $produk->harga_hitam_putih - $jumlahDiskonGray;
$hargaBerwarna = $produk->harga_berwarna - $jumlahDiskonWarna;
}
@endphp
<div class="container mt-5 mb-5">
    <div class="row justify-content-between">
        <div class="col-md-10">
            <label class="text-break font-weight-bold" style="font-size: 48px; max-width:90%;">
                {{$produk->partner->nama_toko}}
            </label>
        </div>
        <div class="col-md-auto">
            @if ($produk->partner->status_toko === 'Buka')
            <img src="{{url('img/buka.png')}}" class="img-responsive mr-0" alt="" width="130px" height="60px">
            @else
            <img src="{{url('img/tutup.png')}}" class="img-responsive mr-0" alt="" width="130px" height="60px">
            @endif
        </div>
    </div>
    <label class="text-break mb-4" style="font-size:24px;">
        <i class="material-icons md-32 align-middle mr-2">
            location_on
        </i>
        {{$produk->partner->alamat_toko}}
    </label>
    <div class="row justify-content-left ml-0 mb-0">
        <label class="SemiBold mr-4" style="font-size: 24px;">
            <i class="material-icons md-32 align-middle mr-2" style="color:#FCFF82;">
                star
            </i>
            {{round($ratingPartner,1)}} / 5
            {{-- {{$produk->partner->rating_toko}} / 5 --}}
            {{-- @foreach($produk as $p) --}}
            {{-- {{collect([$produk->rating])->avg()}} / 5 --}}
            {{-- @endforeach --}}

        </label>
        </label>
        @if ($produk->partner->ambil_di_tempat === 0 && $produk->partner->antar_ke_tempat === 0)
        <label class="mr-4" style="font-size: 18px;" hidden>
            <i class="align-middle material-icons md-32 mr-1">
                directions_run
            </i>
            {{__('Ambil di Tempat')}}
        </label>
        <label class="mr-4" style="font-size: 18px;" hidden>
            <i class="align-middle material-icons md-32 mr-2">
                local_shipping
            </i>
            {{__('Antar ke Rumah')}}
        </label>
        @elseif($produk->partner->ambil_di_tempat === 1 && $produk->partner->antar_ke_tempat === 1)
        <label class="mr-4" style="font-size: 18px;">
            <i class="align-middle material-icons md-32 mr-1">
                directions_run
            </i>
            {{__('Ambil di Tempat')}}
        </label>
        <label class="mr-4" style="font-size: 18px;">
            <i class="align-middle material-icons md-32 mr-2">
                local_shipping
            </i>
            {{__('Antar ke Rumah')}}
        </label>
        @elseif($produk->partner->ambil_di_tempat === 0 && $produk->partner->antar_ke_tempat === 1)
        <label class="mr-4" style="font-size: 18px;" hidden>
            <i class="align-middle material-icons md-32 mr-1">
                directions_run
            </i>
            {{__('Ambil di Tempat')}}
        </label>
        <label class="mr-4" style="font-size: 18px;">
            <i class="align-middle material-icons md-32 mr-2">
                local_shipping
            </i>
            {{__('Antar ke Rumah')}}
        </label>
        @elseif($produk->partner->ambil_di_tempat === 1 && $produk->partner->antar_ke_tempat === 0)
        <label class="mr-4" style="font-size: 18px;">
            <i class="align-middle material-icons md-32 mr-1">
                directions_run
            </i>
            {{__('Ambil di Tempat')}}
        </label>
        <label class="mr-4" style="font-size: 18px;" hidden>
            <i class="align-middle material-icons md-32 mr-2">
                local_shipping
            </i>
            {{__('Antar ke Rumah')}}
        </label>
        @else
        <label class="mr-4" style="font-size: 18px;" hidden>
            <i class="align-middle material-icons md-32 mr-1">
                directions_run
            </i>
            {{__('Ambil di Tempat')}}
        </label>
        <label class="mr-4" style="font-size: 18px;" hidden>
            <i class="align-middle material-icons md-32 mr-2">
                local_shipping
            </i>
            {{__('Antar ke Rumah')}}
        </label>
        @endif
        @foreach ($atk as $a)
        @if($a->id_pengelola === $produk->partner->id_pengelola && $a->status === 'Tersedia')
        <label class="mr-4" style="font-size: 18px;">
            <i class="align-middle material-icons md-32 mr-2">
                architecture
            </i>
            {{__('Alat Tulis Kantor')}}
        </label>
        @break
        @else
        <label class="mr-4" style="font-size: 18px;" hidden>
            <i class="align-middle material-icons md-32 mr-2">
                architecture
            </i>
            {{__('Alat Tulis Kantor')}}
        </label>
        @endif
        @endforeach
        </div>
        <div class="row justify-content-between ml-0 mr-0">
            <div class="bg-light-purple col-md-4 p-3 mt-5"
                style="border-radius:10px;">
                <div class="mb-4" style="border-bottom: 1px solid #BC41BE">
                    <label class="SemiBold mb-2"
                        style="font-size: 18px;">
                        {{__('Nilai Persentase Minimum Toleransi Halaman Berwarna')}}
                    </label>
                    <label class="mb-4"
                        style="font-size: 18px;">
                        {{__('10%')}}
                    </label>
                </div>
                <div class="text-center mb-4"
                style="position:relative;">
                    <img class="img-responsive"
                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                        alt=""
                        style="width:300px;
                            height:200px;">
                </div>
                <div class="row justify-content-left mb-5">
                    <span class="align-self-center col-md-1 mr-0">
                        <a class="text-primary-purple"
                            href="#multi-item-foto-percetakan"
                            role="button"
                            data-slide="prev">
                            <i class="material-icons md-32">
                                chevron_left
                            </i>
                        </a>
                    </span>
                    <div id="multi-item-foto-percetakan" class="carousel slide carousel-multi-item col-md-9" data-ride="carousel">

                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">

                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">

                        {{-- @foreach ($collection as $item) --}}
                        <div class="carousel-item active">

                            <div class="row">

                                {{-- @foreach ($collection as $item) --}}
                                <div class="col-md-auto mr-0">
                                    <img class="img-responsive"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                        alt="" style="width:60px; height:60px;">
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
                    <a class="text-primary-purple" href="#multi-item-foto-percetakan" role="button" data-slide="next">
                        <i class="material-icons md-32">
                            chevron_right
                        </i>
                    </a>
                </span>
            </div>
            <div class="container">
                <label class="SemiBold mb-2" style="font-size: 18px;">
                    {{__('Pemilik Percetakan')}}
                </label>
                <label class="text-truncate mb-4" style="width: 100%;
                            font-size: 18px;">
                    <img class="img-responsive align-self-center mr-2"
                        src="https://ptetutorials.com/images/user-profile.png" width="40" height="40" alt="no logo">
                    {{$produk->partner->nama_lengkap}}
                </label>
                <label class="SemiBold mb-2" style="font-size: 18px;">
                    {{__('Deskripsi Percetakan')}}
                </label>
                <br>
                <label class="mb-4" style="font-size: 14px;">
                    {{$produk->partner->deskripsi_toko ?? '-'}}
                </label>
                <br>
                <label class="SemiBold mb-2" style="font-size: 18px;">
                    {{__('Jam Operasional Percetakan')}}
                </label>
                <br>
                @if (!empty($produk->partner->jam_op_buka) && !empty($produk->partner->jam_op_tutup))
                <label class="mb-4" style="font-size: 14px;">
                    <i class="material-icons md-12 align-middle mr-3">
                        fiber_manual_record
                    </i>
                    Pukul {{ date_create($produk->partner->jam_op_buka)->format('H:i')}} -
                    {{ date_create($produk->partner->jam_op_tutup)->format('H:i')}} WIB
                </label>
                <br>
                @else
                <label class="mb-2" style="font-size: 14px;">
                    {{__('-')}}
                </label>
                <br>
                @endif
                <label class="SemiBold mb-2" style="font-size: 18px;">
                    {{__('Syarat & Ketentuan Percetakan')}}
                </label>
                <br>
                @if (!empty($produk->partner->syaratkententuan))
                <div class="row justify-content-left mb-2" style="font-size: 14px;">
                    <i class="col-md-1 material-icons md-12 mr-1 mt-1">
                        fiber_manual_record
                    </i>
                    <label class="col-md-10 mb-2" style="font-size: 14px;">
                        {{$produk->partner->syaratkententuan}}
                    </label>
                </div>
                <br>
                @else
                <label class="mb-2" style="font-size: 14px;">
                    {{__('-')}}
                </label>
                <br>
                @endif
                <label class="SemiBold mb-2" style="font-size: 18px;">
                    {{__('ATK')}}
                </label>
                <br>
                @if (!empty($atk))
                @foreach ($atk as $a)
                @if ($a->id_pengelola === $produk->partner->id_pengelola)
                <div class="row justify-content-left" style="font-size: 14px;">
                    <div class="col-md-3 text-left">
                        <label class="mb-2">
                            {{$a->nama}}

                            {{-- x {{$a->jumlah}} --}}
                        </label>
                    </div>
                    <div class="col-md-2">
                        <i class="material-icons md-18 align-middle ml-2 mr-4" style="color:#C4C4C4">
                            help
                        </i>
                    </div>
                    <div class="col-md-3 text-right">
                        <label class="mb-2">
                            x {{$a->jumlah}}
                        </label>
                    </div>
                    <div class="col-md-4 text-right">
                        <label class="mb-2">
                            Rp. {{$a->harga}}
                        </label>
                    </div>
                </div>
                {{-- @else
                                <label>-</label>
                                @break --}}
                @endif
                @endforeach
                @else
                <label>-</label>
                @endif
            </div>
        </div>
        <div class="col-8 mt-5 ml-0 pl-4 pr-4">
            <div class="card shadow-sm pl-4 pr-4 pt-4 pb-5">
                <div class="row justify-content-between mb-2">
                    <label class="col-md-10 text-justify text-break SemiBold" style="font-size: 28px;">
                        {{$produk->nama}}
                    </label>
                    <a class="col-md-auto ml-0" href="{{ route('detail.partner',$produk->partner->id_pengelola) }}"
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
                            @for ($i = 0; $i < $produk->rating; $i++)
                                <span class="material-icons md-36 align-middle">star</span>
                                @endfor
                                <span class="ml-4">
                                    <a class="text-primary-purple align-middle"
                                        href="{{ route('ulasan.partner', $produk->partner->id_pengelola) }}">
                                        {{__('10 Ulasan')}}
                                    </a>
                                </span>
                        </label>
                    </div>
                    <div class="col-md-auto text-right">
                        <i class="material-icons md-36 mr-4" style="color:#FF4949;">
                            favorite
                        </i>
                        <i class="material-icons md-36 ml-0">
                            forward
                        </i>
                    </div>
                </div>
                <div class="row justify-content-between ml-0">
                    <div class="col-md-6">
                        <div class="mb-4" style="position:relative;">
                            <img class="img-responsive"
                                src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg" alt=""
                                style="width:285px; height:200px;">
                        </div>
                        <div class="row justify-content-left mb-5">
                            <span class="align-self-center col-md-1 mr-0">
                                <a class="text-primary-purple" href="#multi-item-foto-produk" role="button"
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
                                <a class="text-primary-purple" href="#multi-item-foto-produk" role="button"
                                    data-slide="next">
                                    <i class="material-icons md-32">
                                        chevron_right
                                    </i>
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- @foreach ($collection as $item) --}}
                        <label class="card-text text-break mb-2" style="font-size: 24px;">
                            <i class="material-icons md-32 align-middle mr-2">
                                description
                            </i>
                            {{$produk->jenis_kertas}}
                        </label>
                        <br>
                        {{-- <label class="card-text text-break mb-2"
                                style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">
                                    palette
                                </i>
                                @if ($produk->berwarna === 0 && $produk->hitam_putih === 1)
                                {{__('Hitam-Putih')}}
                        @elseif ($produk->berwarna === 1 && $produk->hitam_putih === 0)
                        {{__('Berwarna')}}
                        @elseif ($produk->hitam_putih === 1 && $produk->berwarna === 1)
                        {{__('Berwarna')}}
                        @else
                        {{__('-')}}
                        @endif
                        </label>
                        <br> --}}
                        <label class="card-text text-break mb-3" style="font-size: 24px;">
                            <i class="material-icons md-32 align-middle mr-2">
                                print
                            </i>
                            {{$produk->jenis_printer}}
                        </label>
                        {{-- @endforeach --}}

                        @if (!empty($produk->jumlah_diskon))
                        <label class="text-break font-weight-bold mb-2" style="font-size: 24px;">
                            Rp. <del>{{$produk->harga_hitam_putih ?? '-'}}</del> {{$hargaHitamPutih ?? '-'}} / hal
                            (Hitam-Putih)
                        </label>
                        @if (!empty($produk->harga_berwarna))
                        <label class="text-break text-primary-purple font-weight-bold mb-2" style="font-size: 24px;">
                            Rp. <del>{{$produk->harga_berwarna ?? '-'}}</del> {{$hargaBerwarna ?? '-'}} / hal (Berwarna)
                        </label>
                        {{-- @else
                                    <label class="text-break text-primary-purple font-weight-bold mb-4"
                                        style="font-size: 24px;" hidden>
                                        Rp. <del>{{$produk->harga_berwarna ?? '-'}}</del> {{$hargaBerwarna ?? '-'}} /
                        hal (Berwarna)
                        </label> --}}
                        @endif
                        @elseif(!empty($produk->harga_berwarna))
                        <label class="text-break font-weight-bold mb-2" style="font-size: 24px;">
                            Rp. {{$produk->harga_hitam_putih ?? '-'}} / hal (Hitam-Putih)
                        </label>
                        <label class="text-break text-primary-purple font-weight-bold mb-4" style="font-size: 24px;">
                            Rp. {{$produk->harga_berwarna ?? '-'}} / hal (Warna)
                        </label>
                        @else
                        <label class="text-break font-weight-bold mb-2" style="font-size: 24px;">
                            Rp. {{$produk->harga_hitam_putih ?? '-'}} / hal (Hitam-Putih)
                        </label>
                        {{-- <label class="text-break text-primary-purple font-weight-bold mb-4"
                                    style="font-size: 24px;">
                                    Rp. {{$produk->harga_berwarna ?? '-'}} / hal (Warna)
                        </label> --}}
                        @endif
                        <div class="row justify-content-between mb-2">
                            @if (!empty($produk->harga_timbal_balik_hitam_putih))
                            <label class="col-md-6 text-break mb-2" style="font-size: 18px;">
                                {{__('Timbal Balik (Hitam-Putih)')}}
                            </label>
                            <i class="col-md-1 material-icons md-18 mt-1" style="color:#C4C4C4">
                                help
                            </i>
                            <label class="col-md-4 text-break SemiBold mb-2" style="font-size: 14px;">
                                + Rp. {{$produk->harga_timbal_balik_hitam_putih}} / hal
                            </label>
                            @endif
                        </div>
                        <div class="row justify-content-between mb-4">
                            @if (!empty($produk->harga_timbal_balik_berwarna))
                            <label class="col-md-6 text-break text-primary-purple mb-2" style="font-size: 18px;">
                                {{__('Timbal Balik (Warna)')}}
                            </label>
                            <i class="col-md-1 material-icons md-18 mt-1" style="color:#C4C4C4">
                                help
                            </i>
                            <label class="col-md-4 text-break text-primary-purple SemiBold mb-2"
                                style="font-size: 14px;">
                                + Rp. {{$produk->harga_timbal_balik_berwarna}} / hal
                            </label>
                            @endif
                        </div>
                        {{-- <label class="card-text SemiBold mb-2"
                                style="font-size: 18px;">
                                {{__('Paket')}}
                        </label>
                        @if(!empty($fitur['paket']))
                        <div class="row justify-content-between mb-4">
                            @foreach ($fitur['paket'] as $key => $value)
                            <label class="col-md-6 text-break mb-2" style="font-size: 18px;">
                                {{$key}}
                            </label>
                            <i class="col-md-1 material-icons md-18 mt-1" style="color:#C4C4C4">
                                help
                            </i>
                            <label class="col-md-4 text-break font-weight-bold mb-2" style="font-size: 14px;">
                                + Rp. {{$value}} / Hal
                            </label>
                            @endforeach
                        </div>
                        @else
                        <label class="ml-0">-</label>
                        <br>
                        @endif()
                        <label class="card-text SemiBold mb-2" style="font-size: 18px;">
                            {{__('Non-Paket')}}
                        </label>
                        <br>
                        @if(!empty($fitur['nonPaket']))
                        <div class="row justify-content-between mb-4">
                            @foreach ($fitur['nonPaket'] as $key => $value)
                            <label class="col-md-6 text-break mb-2" style="font-size: 18px;">
                                {{$key}}
                            </label>
                            <i class="col-md-1 material-icons md-18 mt-1" style="color:#C4C4C4">
                                help
                            </i>
                            <label class="col-md-4 text-break font-weight-bold mb-2" style="font-size: 14px;">
                                + Rp. {{$value}} / Hal
                            </label>
                            @endforeach
                        </div>
                        @else
                        <label class="ml-0">-</label>
                        <br>
                        @endif()
                        <label class="card-text SemiBold mb-2" style="font-size: 18px;">
                            {{__('Paket Tambahan')}}
                        </label>
                        @if(!empty($fitur['paket']))
                        <div class="row justify-content-between mb-4">
                            @foreach ($fitur['tambahan'] as $key)
                            <label class="col-md-6 text-break mb-2" style="font-size: 18px;">
                                {{$key['nama']}}
                            </label>
                            <i class="col-md-1 material-icons md-18 mt-1" style="color:#C4C4C4">
                                help
                            </i>
                            <label class="col-md-4 text-break font-weight-bold mb-2" style="font-size: 14px;">
                                + Rp. {{$key['harga']}} / Hal
                            </label>
                            @endforeach
                        </div>
                        @else
                        <label class="ml-0">-</label>
                        <br>
                        @endif() --}}
                    </div>
                </div>
                <div>
                    <label class="card-text SemiBold mb-2" style="font-size: 18px;">
                        {{__('Paket')}}
                    </label>
                    <br>
                    @if(!empty($fitur['paket']))
                    <div class="row justify-content-between mb-4">
                        @foreach ($fitur['paket'] as $key => $value)
                        <label class="col-md-6 text-break mb-2" style="font-size: 18px;">
                            {{$key}}
                        </label>
                        <i class="col-md-1 material-icons md-18 mt-1" style="color:#C4C4C4">
                            help
                        </i>
                        <label class="col-md-5 text-break text-right font-weight-bold mb-2" style="font-size: 14px;">
                            + Rp. {{$value}} / Hal
                        </label>
                        @endforeach
                    </div>
                    @else
                    <label class="ml-0">-</label>
                    <br>
                    @endif()
                    <label class="card-text SemiBold mb-2" style="font-size: 18px;">
                        {{__('Non-Paket')}}
                    </label>
                    <br>
                    @if(!empty($fitur['nonPaket']))
                    <div class="row justify-content-between mb-4">
                        @foreach ($fitur['nonPaket'] as $key => $value)
                        <label class="col-md-6 text-break mb-2" style="font-size: 18px;">
                            {{$key}}
                        </label>
                        <i class="col-md-1 material-icons md-18 mt-1" style="color:#C4C4C4">
                            help
                        </i>
                        <label class="col-md-5 text-break text-right font-weight-bold mb-2" style="font-size: 14px;">
                            + Rp. {{$value}} / Hal
                        </label>
                        @endforeach
                    </div>
                    @else
                    <label class="ml-0">-</label>
                    <br>
                    @endif()
                    <label class="card-text SemiBold mb-2" style="font-size: 18px;">
                        {{__('Paket Tambahan')}}
                    </label>
                    <br>
                    @if(!empty($fitur['paket']))
                    <div class="row justify-content-between mb-4">
                        @foreach ($fitur['tambahan'] as $key)
                        <label class="col-md-6 text-break mb-2" style="font-size: 18px;">
                            {{$key['nama']}}
                        </label>
                        <i class="col-md-1 material-icons md-18 mt-1" style="color:#C4C4C4">
                            help
                        </i>
                        <label class="col-md-5 text-break text-right font-weight-bold mb-2" style="font-size: 14px;">
                            + Rp. {{$key['harga']}} / Hal
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
                        {{__('Deskripsi Produk')}}
                    </label>
                    <p class="mb-4" style="font-size: 14px;">
                        {{$produk->deskripsi}}
                    </p>
                </div>
                <div class="row justify-content-end mr-0">
                    <button class="btn btn-default btn-lg text-primary-danger font-weight-bold pl-4 pr-4 mr-4"
                        onclick="window.location.href='{{ route('produk.lapor',$produk->id_produk) }}'"
                        style="border-radius:30px;font-size: 18px;">
                        {{__('Laporkan')}}
                    </button>
                    <button class="btn btn-primary-wakprint btn-lg font-weight-bold pl-4 pr-4"
                        style="border-radius:30px; font-size: 18px;"
                        onclick="window.location.href='{{ route('konfigurasi.produk',$produk->id_produk) }}'">
                        {{__('Gunakan Produk')}}
                    </button>
                </div>
            </div>
            {{-- @include('member.card_detail_produk') --}}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
</script>
@endsection
