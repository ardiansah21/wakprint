@extends('layouts.pengelola')

@php
    use Carbon\Carbon;
    $month=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
@endphp

@section('content')
    <div class="container mt-5 mb-5" style="font-size: 16px;">
        <label class="font-weight-bold mb-4"
            style="font-size: 36px;">
            {{__('Ubah Promo') }}
        </label>
            <form id="submit-form" action="{{ route('partner.promo.store.update',$produk->id_produk) }}" method="POST">
                @csrf
                <div class="card shadow-sm mb-5" style="min-height: 200px; width:30%;">
                    <div class="card-body">
                        <div class="row justify-content-between" style="min-height:50px;">
                            <label class="card-title col-md-10 text-truncate-multiline font-weight-bold mb-2" style="font-size: 14px;">
                                {{$produk->nama ?? '-'}}
                            </label>
                        </div>
                        <label class="card-title font-weight-bold mb-0" style="font-size: 14px;">
                            {{__('Deskripsi Produk')}}
                        </label>
                        <label class="card-text text-truncate-multiline" style="font-size: 12px;">
                            {{$produk->deskripsi ?? '-'}}
                        </label>
                    </div>
                    <div class="card-footer bg-primary-purple">
                        <div class="row justify-content-between ml-0 mb-0">
                            <div>
                                @if ($produk->status_diskon != 'Tersedia')
                                    <i class="material-icons md-24 text-white align-middle mr-2">
                                        color_lens
                                    </i>
                                    <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                        Rp. {{$produk->harga_hitam_putih ?? '-'}}
                                    </label>
                                    <br>
                                    @if (!empty($produk->harga_berwarna))
                                        <i class="material-icons md-24 text-primary-yellow align-middle mr-2">
                                            color_lens
                                        </i>
                                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2"
                                            style="font-size: 16px;">
                                            Rp. {{$produk->harga_berwarna}}
                                        </label>
                                        @else
                                        <i class="material-icons md-24 text-primary-yellow align-middle mr-2">
                                            color_lens
                                        </i>
                                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2"
                                            style="font-size: 16px;">
                                            {{__('Tidak Tersedia')}}
                                        </label>
                                    @endif
                                @else
                                    @php
                                        $hargaDiskonHitamPutih = $produk->jumlah_diskon * $produk->harga_hitam_putih;
                                        $hargaDiskonBerwarna = $produk->jumlah_diskon * $produk->harga_berwarna;

                                        if($hargaDiskonHitamPutih > $produk->maksimal_diskon){
                                            $hargaFinalHitamPutih = $produk->harga_hitam_putih - $produk->maksimal_diskon;
                                        }
                                        else{
                                            $hargaFinalHitamPutih = $produk->harga_hitam_putih - $hargaDiskonHitamPutih;
                                        }

                                        if($hargaDiskonBerwarna > $produk->maksimal_diskon){
                                            $hargaFinalBerwarna = $produk->harga_berwarna - $produk->maksimal_diskon;
                                        }
                                        else{
                                            $hargaFinalBerwarna = $produk->harga_berwarna - $hargaDiskonBerwarna;
                                        }
                                    @endphp
                                    <i class="material-icons md-24 text-white align-middle mr-2">
                                        color_lens
                                    </i>
                                    <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 12px;">
                                        <del>{{rupiah($produk->harga_hitam_putih)}}</del>
                                    </label>
                                    <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                        {{rupiah($hargaFinalHitamPutih)}}
                                    </label>
                                    <br>
                                    @if (!empty($produk->harga_berwarna))
                                        <i class="material-icons md-24 text-primary-yellow align-middle mr-2">
                                            color_lens
                                        </i>
                                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 12px;">
                                            <del>{{rupiah($produk->harga_berwarna)}}</del>
                                        </label>
                                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                            {{rupiah($hargaFinalBerwarna)}}
                                        </label>
                                    @else
                                        <i class="material-icons md-24 text-primary-yellow align-middle mr-2">
                                            color_lens
                                        </i>
                                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                            {{__('Tidak Tersedia')}}
                                        </label>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4" style="">
                    <div class="col-md-6">
                        <label class="mb-2">
                            {{__('Maksimal Diskon') }}
                        </label>
                        <div class="row justify-content-between mb-2">
                            <label class="col-md-1 text-center mb-0 mr-0 mt-2">
                                {{__('Rp.') }}
                            </label>
                            <div class="col-md-11 form-group mb-4">
                                <input type="text" name="maksimal_diskon" class="form-control form-control-lg pt-2 pb-2" placeholder="300.000" aria-label="300.000" value="{{ $produk->maksimal_diskon }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" aria-describedby="inputGroup-sizing-sm" style="font-size: 16px;">
                            </div>
                        </div>
                        <label class="mb-2">
                            {{__('Tanggal Promo Mulai') }}
                        </label>
                        <div class="row justify-content-left mb-3">
                            <div class="form-group col-md-4">
                                <div class="dropdown" aria-required="true">
                                    <input name="tanggal_mulai_promo" type="text" id="tanggal_mulai_promo" Class="form-control" hidden>
                                    <button id="tanggalMulaiPromoButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownTanggalMulaiPromo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{Carbon::parse($produk->mulai_waktu_diskon)->translatedFormat('d')}}
                                    </button>
                                    <div id="tanggalMulaiPromoList" class="dropdown-menu" aria-labelledby="dropdownTanggalMulaiPromo" style="font-size: 16px; width:100%;">
                                        @for($i=1;$i<32;$i++)
                                            <span class="dropdown-item cursor-pointer ">
                                                {{$i}}
                                            </span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="dropdown" aria-required="true">
                                    <input name="bulan_mulai_promo" type="text" id="bulan_mulai_promo" Class="form-control" hidden>
                                    <button id="bulanMulaiPromoButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownBulanMulaiPromo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{Carbon::parse($produk->mulai_waktu_diskon)->translatedFormat('F')}}
                                    </button>
                                    <div id="bulanMulaiPromoList" class="dropdown-menu" aria-labelledby="dropdownBulanMulaiPromo" style="font-size: 16px; width:100%;">
                                        @foreach ($month as $m)
                                            <span class="dropdown-item cursor-pointer ">
                                                {{$m}}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="dropdown" aria-required="true">
                                    <input name="tahun_mulai_promo" type="text" id="tahun_mulai_promo" Class="form-control" hidden>
                                    <button id="tahunMulaiPromoButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownTahunMulaiPromo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{Carbon::parse($produk->mulai_waktu_diskon)->translatedFormat('Y')}}
                                    </button>
                                    <div id="tahunMulaiPromoList" class="dropdown-menu" aria-labelledby="dropdownTahunMulaiPromo" style="font-size: 16px; width:100%;">
                                        @for($i=2020;$i<2030;$i++)
                                            <span class="dropdown-item cursor-pointer ">
                                                {{$i}}
                                            </span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="mb-2">
                            {{__('Jumlah Diskon') }}
                        </label>
                        <div class="form-group row justify-content-left mb-2">
                            <div class="col-md-3 input-group mb-4">
                                <input type="number" name="jumlah_diskon" class="form-control form-control-lg pt-2 pb-2" placeholder="10" aria-label="10" value="{{ $produk->jumlah_diskon * 100 }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" aria-describedby="inputGroup-sizing-sm" style="width:100%; font-size:16px;">
                            </div>
                            <label class="col-md-auto text-left mb-0 mr-0 ml-0 mt-2">
                                {{__('%') }}
                            </label>
                        </div>
                        <label class="mb-2">
                            {{__('Tanggal Promo Selesai') }}
                        </label>
                        <div class="row justify-content-left mb-3">
                            <div class="form-group col-md-4">
                                <div class="dropdown" aria-required="true">
                                    <input name="tanggal_selesai_promo" type="text" id="tanggal_selesai_promo" Class="form-control" hidden>
                                    <button id="tanggalSelesaiPromoButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownTanggalSelesaiPromo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{Carbon::parse($produk->selesai_waktu_diskon)->translatedFormat('d')}}
                                    </button>
                                    <div id="tanggalSelesaiPromoList" class="dropdown-menu" aria-labelledby="dropdownTanggalSelesaiPromo" style="font-size: 16px; width:100%;">
                                        @for($i=1;$i<32;$i++)
                                            <span class="dropdown-item cursor-pointer ">
                                                {{$i}}
                                            </span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="dropdown" aria-required="true">
                                    <input name="bulan_selesai_promo" type="text" id="bulan_selesai_promo" Class="form-control" hidden>
                                    <button id="bulanSelesaiPromoButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownBulanSelesaiPromo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{Carbon::parse($produk->selesai_waktu_diskon)->translatedFormat('F')}}
                                    </button>
                                    <div id="bulanSelesaiPromoList" class="dropdown-menu" aria-labelledby="dropdownBulanSelesaiPromo" style="font-size: 16px; width:100%;">
                                        @foreach ($month as $m)
                                            <span class="dropdown-item cursor-pointer ">
                                                {{$m}}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="dropdown" aria-required="true">
                                    <input name="tahun_selesai_promo" type="text" id="tahun_selesai_promo" Class="form-control" value="" hidden>
                                    <button id="tahunSelesaiPromoButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownTahunSelesaiPromo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{Carbon::parse($produk->selesai_waktu_diskon)->translatedFormat('Y')}}
                                    </button>
                                    <div id="tahunSelesaiPromoList" class="dropdown-menu" aria-labelledby="dropdownTahunSelesaiPromo" style="font-size: 16px; width:100%;">
                                        @for($i=2020;$i<2030;$i++)
                                            <span class="dropdown-item cursor-pointer ">
                                                {{$i}}
                                            </span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mr-0">
                    <div class="mr-3">
                        <button class="btn btn-default btn-lg text-primary-purple font-weight-bold pl-5 pr-5 mb-0" onclick="window.location.href='{{ route('partner.promo.index') }}'" style="border-radius:30px; font-size:18px;">
                            {{__('Batal') }}
                        </button>
                    </div>
                    <div class="mr-0">
                        <button type="submit" class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px;">
                            {{__('Simpan') }}
                        </button>
                    </div>
                </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $('#tanggalMulaiPromoList span').on('click', function () {
            $('#tanggalMulaiPromoButton').text($(this).text());
            $('#tanggal_mulai_promo').val($(this).text());
        });
        $('#bulanMulaiPromoList span').on('click', function () {
            $('#bulanMulaiPromoButton').text($(this).text());
            $('#bulan_mulai_promo').val($(this).text());
        });
        $('#tahunMulaiPromoList span').on('click', function () {
            $('#tahunMulaiPromoButton').text($(this).text());
            $('#tahun_mulai_promo').val($(this).text());
        });
        $('#tanggalSelesaiPromoList span').on('click', function () {
            $('#tanggalSelesaiPromoButton').text($(this).text());
            $('#tanggal_selesai_promo').val($(this).text());
        });
        $('#bulanSelesaiPromoList span').on('click', function () {
            $('#bulanSelesaiPromoButton').text($(this).text());
            $('#bulan_selesai_promo').val($(this).text());
        });
        $('#tahunSelesaiPromoList span').on('click', function () {
            $('#tahunSelesaiPromoButton').text($(this).text());
            $('#tahun_selesai_promo').val($(this).text());
        });
    </script>

@endsection

