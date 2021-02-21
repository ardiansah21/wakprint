<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengujian</title>

    <style>
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

        .table-hover th,
        .table-hover td {

            text-align: center;

        }

        .table {
            border-radius: 5px;
            /* width: 50%; */
            margin: auto;
            float: none;

        }

        .table-borderless>tbody>tr>td,
        .table-borderless>tbody>tr>th,
        .table-borderless>tfoot>tr>td,
        .table-borderless>tfoot>tr>th,
        .table-borderless>thead>tr>td,
        .table-borderless>thead>tr>th {
            border: none;
        }

        body {
            overflow-y: scroll;
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body>
    <div class="container">
        <h2 class="my-4">Sistem Deteksi Warna Halaman</h2>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Upload Dokumen</div>
                    <div class="card-body">
                        <form id="frmUpload" action="{{route('pengujian.store')}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <label class="btn btn-primary " for="my-file-selector">
                                <input id="my-file-selector" name="file" type="file" accept="application/pdf"
                                    style="display:none" onchange="
                                        $('#upload-file-info').html(this.files[0].name);
                                        $('#frmUpload').submit();">
                                Upload PDF
                            </label><span class='label label-info ml-2' id="upload-file-info"></span>

                            <div class="progress mt-2">
                                <div class="bar"></div>
                                <div class="percent">0%</div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">Eksekusi</div>
                    <div class="card-body">
                        <form id="frmProses" action="{{route('pengujian.proses')}}" method="POST">
                            @csrf
                            <input id="path" name="path" type="text" hidden>
                            <div class="row mt-2">
                                <label for="percenMin" class="mr-3 ml-3">Persentase Minimum Piksel Berwarna:</label>
                                <input type="number" name="percenMin" step="any" id="percenMin" min="0" max="100"
                                    placeholder="masukkan persentase minimum piksel berwarna" value="0">
                                <label for="percenMin" class="ml-1">%</label>
                            </div>
                            <button type="submit" class="btn btn-danger mt-4">Proses</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Preview</div>
                    <div class="card-body p-0">
                        <embed id="a" style="width: 100%; height: 317px" type="application/pdf"
                            background-color="#00ff00" frameborder="0" />
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5" id="hasil">
            <div class="card-header">Hasil</div>
            <div class="card-body">
                <div id="loading">
                    <img src="{{asset('img/loading.gif')}}" alt="loading..." class="mx-auto d-block">
                    <div id="progressText" class="mx-auto d-block"></div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-md-4">
                        <table class="table borderless w-auto">
                            <tr>
                                <td>Total Persentase Minimum Piksel Berwarna</td>
                                <td class="align-middle" id="pixelPercenMin"></td>
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
                                <td>Waktu Eksekusi (detik)</td>
                                <td id="waktuEksekusi"></td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-md-8">
                        <div id="placeTable">
                            <div class="table-responsive">
                                <table class="table table-hover table-inverse  w-auto">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>Halaman</th>
                                            <th>Total Piksel</th>
                                            <th>Total Piksel Berwarna</th>
                                            <th>Total Piksel Hitam Putih</th>
                                            <th>Persentase Piksel Berwarna</th>
                                            <th>Jenis Warna</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableData"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="{{asset('js/pengujian.js')}}"></script>
</body>
</html>
