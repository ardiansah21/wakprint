<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <label class="font-weight-bold mt-5 mb-4" style="font-size:36px;">Detail Jenis Warna Setiap </label>

    <div id="tableCekWarna" class="row justify-content-between ml-0 mr-0 ">
        <div class="col-md-6">
            <table class="table table-hover text-center" style="border-radius:25px 25px 15px 15px;">
                <thead class="bg-primary-purple text-white align-self-center">
                    <tr style="font-size: 18px;">
                        <th class="align-middle" scope="col-md-auto">Halaman</th>
                        <th class="align-middle" scope="col-md-auto">Persentase kandungan Berwarna</th>
                        <th class="align-middle" scope="col-md-auto">Jenis Warna Halaman</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14px;">
                    {{-- for --}}
                    <tr>
                        <td scope="row">{{$i+1}}</td>
                        <td>
                            {{-- @php
                            $percen = $pdf->halaman[$i]['piksel_berwarna'] /
                            $pdf->halaman[$i]['total_piksel'] * 100;
                            echo $percen." %";
                            @endphp --}}
                        </td>
                        <td>JENIS WARNA</td>
                    </tr>
                    {{-- @endfor --}}
                </tbody>
            </table>
        </div>
        <div class="col-md-6 bg-primary-yellow p-2" style="border-radius: 5px;">
            <div class="row justify-content-left ml-0 mr-0">
                <div class="col-md-auto">
                    <i class="material-icons md-18 align-middle mr-0" style="color:#C4C4C4">warning</i>
                </div>
                <div class="col-md-10">
                    <label style="font-size: 16px;">
                        File dokumen anda dinyatakan memiliki 2 halaman berwarna karena melebihi nilai toleransi
                        kandungan
                        warna yang ditetapkan oleh produk yang anda pilih dan 2 halaman hitam-putih karena tidak
                        melebihi
                        nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-between ml-0 mr-0 mt-5 mb-5">
        <div class="col-md-6 pl-2 pr-4 pb-4 pt-4 mb-4" style="border-radius:5px;">
            <label class="font-weight-bold mb-2 ml-0" style="font-size: 24px;">Catatan Tambahan
            </label>
            <div class="input-group mb-3" style="height:120px;">
                <textarea class="form-control" style="font-size: 18px;" aria-label="Deskripsi Ulasan"></textarea>
            </div>
        </div>
        <div class="col-md-6 bg-light-purple pl-4 pr-4 pt-2 pb-2 mt-4 mr-0" style="border-radius:10px;
                                font-size:18px;">
            <label class="SemiBold mb-4" style="font-size:24px;">Rincian Harga
            </label>
            <div class="row justify-content-between mb-2">
                <div class="col-md-auto text-left">
                    <label class="mb-2">
                        5 Halaman Hitam Putih
                    </label>
                    <br>
                    <label class="mb-2">
                        2 Halaman Berwarna
                    </label>
                </div>
                <div class="col-md-auto text-right">
                    <label class="SemiBold mb-2">
                        Rp. 1.000
                    </label>
                    <br>
                    <label class="SemiBold mb-2">
                        Rp. 2.000
                    </label>
                </div>
            </div>
            <label class="SemiBold mb-2">
                Fitur
            </label>
            <div class="row justify-content-between">
                <div class="col-md-auto text-left">
                    <label class="mb-2">
                        Jilid Lem
                    </label>upload
                </div>
                <div class="col-md-auto text-right">
                    <label class="SemiBold mb-2">
                        Rp. 2.000
                    </label>
                </div>
            </div>
            <div class="row row-bordered"></div>
            <div class="row justify-content-between SemiBold mt-2">
                <div class="col-md-auto text-left">
                    <label>Total Harga Pesanan Kamu</label>
                </div>
                <div class="col-md-auto text-right">
                    <label>Rp. 20.000</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-between ml-0 mr-0 mt-2 mb-5">
        <div class="form-group mb-3 mr-2">
            <button id="hapusConfigurasi" class="btn btn-outline-danger-primary font-weight-bold pl-4 pr-4" style="border-radius:30px;
                            font-size:24px;">
                Hapus Konfigurasi
            </button>
        </div>
        <div class="form-group mb-3 mr-2">
            <button id="simpanKonfigurasi" class="btn btn-outline-purple font-weight-bold pl-4 pr-4" style="border-radius:30px;
                            font-size:24px;">
                Simpan Konfigurasi
            </button>
        </div>
        <div class="form-group mb-3">
            <button class="btn btn-primary-wakprint font-weight-bold pl-4 pr-4" style="border-radius:30px;
                                font-size:24px;">
                Simpan dan Lanjutkan
            </button>
        </div>
    </div>
</body>

</html>





@php
$pdf = session()->get('KonfigurasiCekwarna');
@endphp
<label class="font-weight-bold mt-5 mb-4" style="font-size:36px;">{{__('Detail Jenis Warna Setiap Halaman') }}
</label>

<div id="tableCekWarna" class="row justify-content-between ml-0 mr-0 ">
    <div class="col-md-6">
        <table class="table table-hover text-center" style="border-radius:25px 25px 15px 15px;">
            <thead class="bg-primary-purple text-white align-self-center">
                <tr style="font-size: 18px;">
                    <th class="align-middle" scope="col-md-auto">{{__('Halaman') }}</th>
                    <th class="align-middle" scope="col-md-auto">
                        {{__('Persentase kandungan Berwarna') }}
                    </th>
                    <th class="align-middle" scope="col-md-auto">{{__('Jenis Warna Halaman') }}</th>
                </tr>
            </thead>
            <tbody style="font-size: 14px;">
                {{-- @if ($pdf != null) --}}

                @for ($i = 0; $i < $pdf->jumlahHalaman; $i++) <tr>
                        <td scope="row">{{$i+1}}</td>
                        <td>
                            @php
                            $percen = $pdf->halaman[$i]['piksel_berwarna'] /
                            $pdf->halaman[$i]['total_piksel'] * 100;
                            echo $percen." %";
                            @endphp
                        </td>
                        <td>{{$pdf->halaman[$i]['jenis_warna']}}</td>
                    </tr>
                    @endfor

                    {{-- @endif --}}
            </tbody>
        </table>
    </div>
    <div class="col-md-6 bg-primary-yellow p-2" style="border-radius: 5px;">
        <div class="row justify-content-left ml-0 mr-0">
            <div class="col-md-auto">
                <i class="material-icons md-18 align-middle mr-0" style="color:#C4C4C4">warning</i>
            </div>
            <div class="col-md-10">
                <label style="font-size: 16px;">
                    {{__('File dokumen anda dinyatakan memiliki 2 halaman berwarna karena melebihi nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih dan 2 halaman hitam-putih karena tidak melebihi nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.')}}
                </label>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-between ml-0 mr-0 mt-5 mb-5">
    <div class="col-md-6 pl-2 pr-4 pb-4 pt-4 mb-4" style="border-radius:5px;">
        <label class="font-weight-bold mb-2 ml-0" style="font-size: 24px;">
            {{__('Catatan Tambahan') }}
        </label>
        <div class="input-group mb-3" style="height:120px;">
            <textarea class="form-control" style="font-size: 18px;" aria-label="Deskripsi Ulasan"></textarea>
        </div>
    </div>
    <div class="col-md-6 bg-light-purple pl-4 pr-4 pt-2 pb-2 mt-4 mr-0" style="border-radius:10px;
                    font-size:18px;">
        <label class="SemiBold mb-4" style="font-size:24px;">
            {{__('Rincian Harga') }}
        </label>
        <div class="row justify-content-between mb-2">
            <div class="col-md-auto text-left">
                <label class="mb-2">
                    {{__('5 Halaman Hitam Putih') }}
                </label>
                <br>
                <label class="mb-2">
                    {{__('2 Halaman Berwarna') }}
                </label>
            </div>
            <div class="col-md-auto text-right">
                <label class="SemiBold mb-2">
                    {{__('Rp. 1.000') }}
                </label>
                <br>
                <label class="SemiBold mb-2">
                    {{__('Rp. 2.000') }}
                </label>
            </div>
        </div>
        <label class="SemiBold mb-2">
            {{__('Fitur') }}
        </label>
        <div class="row justify-content-between">
            <div class="col-md-auto text-left">
                <label class="mb-2">
                    {{__('Jilid Lem') }}
                </label>upload
            </div>
            <div class="col-md-auto text-right">
                <label class="SemiBold mb-2">
                    {{__('Rp. 2.000') }}
                </label>
            </div>
        </div>
        <div class="row row-bordered"></div>
        <div class="row justify-content-between SemiBold mt-2">
            <div class="col-md-auto text-left">
                <label>Total Harga Pesanan Kamu</label>
            </div>
            <div class="col-md-auto text-right">
                <label>Rp. 20.000</label>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-between ml-0 mr-0 mt-2 mb-5">
    <div class="form-group mb-3 mr-2">
        <button id="hapusConfigurasi" class="btn btn-outline-danger-primary font-weight-bold pl-4 pr-4" style="border-radius:30px;
                font-size:24px;">
            {{__('Hapus Konfigurasi')}}
        </button>
    </div>
    <div class="form-group mb-3 mr-2">
        <button id="simpanKonfigurasi" class="btn btn-outline-purple font-weight-bold pl-4 pr-4" style="border-radius:30px;
                font-size:24px;">
            {{__('Simpan Konfigurasi')}}
        </button>
    </div>
    <div class="form-group mb-3">
        <button class="btn btn-primary-wakprint font-weight-bold pl-4 pr-4" style="border-radius:30px;
                    font-size:24px;">
            {{__('Simpan dan Lanjutkan')}}
        </button>
    </div>
</div>



<div id="bawahdetail">
    @if (session()->has('KonfigurasiCekwarna'))
    <div id="detail">
        @php
        $pdf = session()->get('KonfigurasiCekwarna');
        @endphp
        <label class="font-weight-bold mt-5 mb-4" style="font-size:36px;">{{__('Detail Jenis Warna Setiap Halaman') }}
        </label>

        <div id="tableCekWarna" class="row justify-content-between ml-0 mr-0 ">
            <div class="col-md-6">
                <table class="table table-hover text-center" style="border-radius:25px 25px 15px 15px;">
                    <thead class="bg-primary-purple text-white align-self-center">
                        <tr style="font-size: 18px;">
                            <th class="align-middle" scope="col-md-auto">{{__('Halaman') }}</th>
                            <th class="align-middle" scope="col-md-auto">
                                {{__('Persentase kandungan Berwarna') }}
                            </th>
                            <th class="align-middle" scope="col-md-auto">{{__('Jenis Warna Halaman') }}</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        {{-- @if ($pdf != null) --}}

                        @for ($i = 0; $i < $pdf->jumlahHalaman; $i++) <tr>
                                <td scope="row">{{$i+1}}</td>
                                <td>
                                    @php
                                    $percen = $pdf->halaman[$i]['piksel_berwarna'] /
                                    $pdf->halaman[$i]['total_piksel'] * 100;
                                    echo $percen." %";
                                    @endphp
                                </td>
                                <td>{{$pdf->halaman[$i]['jenis_warna']}}</td>
                            </tr>
                            @endfor

                            {{-- @endif --}}
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 bg-primary-yellow p-2" style="border-radius: 5px;">
                <div class="row justify-content-left ml-0 mr-0">
                    <div class="col-md-auto">
                        <i class="material-icons md-18 align-middle mr-0" style="color:#C4C4C4">warning</i>
                    </div>
                    <div class="col-md-10">
                        <label style="font-size: 16px;">
                            {{__('File dokumen anda dinyatakan memiliki 2 halaman berwarna karena melebihi nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih dan 2 halaman hitam-putih karena tidak melebihi nilai toleransi kandungan warna yang ditetapkan oleh produk yang anda pilih.')}}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-between ml-0 mr-0 mt-5 mb-5">
            <div class="col-md-6 pl-2 pr-4 pb-4 pt-4 mb-4" style="border-radius:5px;">
                <label class="font-weight-bold mb-2 ml-0" style="font-size: 24px;">
                    {{__('Catatan Tambahan') }}
                </label>
                <div class="input-group mb-3" style="height:120px;">
                    <textarea class="form-control" style="font-size: 18px;" aria-label="Deskripsi Ulasan"></textarea>
                </div>
            </div>
            <div class="col-md-6 bg-light-purple pl-4 pr-4 pt-2 pb-2 mt-4 mr-0" style="border-radius:10px;
                            font-size:18px;">
                <label class="SemiBold mb-4" style="font-size:24px;">
                    {{__('Rincian Harga') }}
                </label>
                <div class="row justify-content-between mb-2">
                    <div class="col-md-auto text-left">
                        <label class="mb-2">
                            {{__('5 Halaman Hitam Putih') }}
                        </label>
                        <br>
                        <label class="mb-2">
                            {{__('2 Halaman Berwarna') }}
                        </label>
                    </div>
                    <div class="col-md-auto text-right">
                        <label class="SemiBold mb-2">
                            {{__('Rp. 1.000') }}
                        </label>
                        <br>
                        <label class="SemiBold mb-2">
                            {{__('Rp. 2.000') }}
                        </label>
                    </div>
                </div>
                <label class="SemiBold mb-2">
                    {{__('Fitur') }}
                </label>
                <div class="row justify-content-between">
                    <div class="col-md-auto text-left">
                        <label class="mb-2">
                            {{__('Jilid Lem') }}
                        </label>upload
                    </div>
                    <div class="col-md-auto text-right">
                        <label class="SemiBold mb-2">
                            {{__('Rp. 2.000') }}
                        </label>
                    </div>
                </div>
                <div class="row row-bordered"></div>
                <div class="row justify-content-between SemiBold mt-2">
                    <div class="col-md-auto text-left">
                        <label>Total Harga Pesanan Kamu</label>
                    </div>
                    <div class="col-md-auto text-right">
                        <label>Rp. 20.000</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-between ml-0 mr-0 mt-2 mb-5">
            <div class="form-group mb-3 mr-2">
                <button id="hapusConfigurasi" class="btn btn-outline-danger-primary font-weight-bold pl-4 pr-4" style="border-radius:30px;
                        font-size:24px;">
                    {{__('Hapus Konfigurasi')}}
                </button>
            </div>
            <div class="form-group mb-3 mr-2">
                <button id="simpanKonfigurasi" class="btn btn-outline-purple font-weight-bold pl-4 pr-4" style="border-radius:30px;
                        font-size:24px;">
                    {{__('Simpan Konfigurasi')}}
                </button>
            </div>
            <div class="form-group mb-3">
                <button class="btn btn-primary-wakprint font-weight-bold pl-4 pr-4" style="border-radius:30px;
                            font-size:24px;">
                    {{__('Simpan dan Lanjutkan')}}
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
