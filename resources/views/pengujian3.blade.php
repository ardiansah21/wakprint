<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengujian</title>

    <style>
        html {
            background-color: white;
        }

        .progress {
            position: relative;
            width: 100%;
        }

        .bar {
            background-color: #42b942;
            width: 0%;
            height: 30px;
        }

        .percent {
            position: absolute;
            display: inline-block;
            left: 50%;
            color: #4e5b95;
            margin-top: 8px;
        }

        .table th {

            text-align: center;

        }

        .table {
            border-radius: 5px;
            width: 50%;
            margin: auto;
            float: none;
        }
    </style>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">


</head>

<body>
    <div class="container mt-3">
        <form action="{{route('store2')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <label class="SemiBold mr-5" style="font-size:20px;">Jenis Dokumen</label>
                        <div class="dropdown">
                            <input name="jenis_dokumen" type="text" id="jenisDokumen" Class="form-control" hidden>
                            <button id="jenisDokumenButton"
                                class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                                id="dropdownjenisDokumen" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" style="font-size: 12px;text-align:left;">
                                Opsi
                            </button>
                            @php
                            $jenisDokumen= array('Teks', 'Gambar', 'Teks Dan Gambar', 'Kosong');
                            @endphp
                            <div id="jenisDokumenList" class="dropdown-menu" aria-labelledby="dropdownjenisDokumen"
                                style="font-size: 12px; width:100%;">
                                @foreach ( $jenisDokumen as $printer)
                                <span class="dropdown-item cursor-pointer ">
                                    {{$printer}}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <label class="SemiBold mr-3" style="font-size:20px;">Persentase Minimum</label>
                        <input type="number" name="percenMin" step="any" id="percenMin" min="0" max="100"
                            placeholder="masukkan persentase minimum" value="0">
                        <label for="percenMin" class="ml-1">%</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 ml-0 w-25" data-toggle="button"
                        aria-pressed="false" autocomplete="off">
                        Proses
                    </button>

                    <div id="content">
                        <div id="loading">
                            <img src="{{asset('img/loading.gif')}}" alt="loading..." class="mx-auto d-block">
                            <div id="progressText" class="mx-auto d-block"></div>
                        </div>
                        <table class="table borderless my-3">
                            <tr>
                                <td>Nama File</td>
                                <td id="namaFile"></td>
                            </tr>
                            <tr>
                                <td>Jumlah Halaman</td>
                                <td id="jumlahHalaman"></td>
                            </tr>
                            <tr>
                                <td>Jumlah Halaman Berwarna</td>
                                <td id="jumlahHalamanBerwarna"></td>
                            </tr>
                            <tr>
                                <td>Jumlah Halaman Hitam Putih</td>
                                <td id="jumlahHalamanHitamPutih"></td>
                            </tr>
                            <tr>
                                <td>Waktu Eksekusi</td>
                                <td id="waktuEksekusi"></td>
                            </tr>
                            <tr>
                                <td>Total Piksel Persentase Minimum</td>
                                <td id="pixelPercenMin"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-7">
                    <label id="labelPreview" class="SemiBold mr-3" style="font-size:20px;">Preview</label>
                    <div class="float-right col" style="height: 500px">
                        <embed id="a" style="width: 100%; height: 100%" type="application/pdf" frameborder="0"
                            src="about:blank" />
                    </div>
                </div>
            </div>

            <div id="placeTable" style="margin-top: 30px">
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-hover table-inverse mx-auto w-auto">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Halaman</th>
                                    <th>Total Piksel</th>
                                    <th>Total Piksel Berwarna</th>
                                    <th>Total Piksel Hitam Putih</th>
                                    <th>Jenis Warna</th>
                                </tr>
                            </thead>
                            <tbody id="tableData"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="{{asset('js/pengujian2.js')}}"></script>

</body>

</html>
