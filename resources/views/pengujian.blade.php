@extends('layouts.pengelola')
@section('content')

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
</style>
<div class="container">
    <form action="{{route('pdf.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <label class="btn btn-primary mt-4" for="my-file-selector">
            <input id="my-file-selector" name="file" type="file" accept="application/pdf" style="display:none"
                onchange="$('#upload-file-info').html(this.files[0].name);">
            Cari PDF
        </label><span class='label label-info' id="upload-file-info"></span>
        <div class="progress">
            <div class="bar"></div>
            <div class="percent">0%</div>
        </div>
        <div class="row">
            <input type="number" name="percenMin" id="percenMin">
            <label for="percenMin">%</label>
        </div>
        <button type="submit" class="btn btn-danger mt-4">Proses</button>
    </form>
    <div id="loading">
        <img src="{{asset('img/loading.gif')}}" alt="loading..." class="mx-auto d-block">
        <div id="progressText" class="mx-auto d-block"></div>
    </div>
    <div>
        <table class="table table-hover table-inverse table-responsive mx-auto d-blok" >
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




@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script src="{{asset('js/pengujian.js')}}"></script>
@endsection




{{-- <style>
    .loading {
        z-index: 20;
        position: absolute;
        top: 0;
        left: -5px;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .loading-content {
        position: absolute;
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        top: 50%;
        left: 50%%;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div class="container">
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <form id="form" action={{route('pdf.store')}} method="post" enctype="multipart/form-data">
@csrf
<input oninput="submit()" type="file" name="file" id="file" accept="application/pdf">
</form>
<div onload="hideLoading()">
    @if (session()->has('pdf'))
    @inject('tt', 'App\Http\Controllers\PdfController')
    {{$tt::cekWarna(session('pdf'))->namaFile}}
    @endif
</div>
</div> --}}










{{-- <!DOCTYPE html>
<html>

<head>
    <script data-require="jquery@*" data-semver="3.2.1"
        src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
    <script src="http://joaopereirawd.github.io/fakeLoader.js/js/fakeLoader.js"></script>
    <link rel="stylesheet" href="http://joaopereirawd.github.io/fakeLoader.js/demo/css/fakeLoader.css" />

    <script>
        window.onload = () => {
      document.body.addEventListener('keydown', function (e) {
       if (e.keyCode == 13) {
       $("#fakeLoader").fadeIn();
         $("#fakeLoader").fakeLoader({
           timeToHide:1200, //Time in milliseconds for fakeLoader disappear
           spinner:"spinner1",//Options: 'spinner1', 'spinner2', 'spinner3','spinner4', 'spinner5', 'spinner6', 'spinner7'
          });
        }
     });
    }
    </script>
</head>

<body>
    <h1>Hello Plunker!</h1>
    <div id="fakeLoader"></div>

    <script type="text/javascript">
        $("#fakeLoader").fakeLoader({
timeToHide:1200, //Time in milliseconds for fakeLoader disappear
spinner:"spinner1",//Options: 'spinner1', 'spinner2', 'spinner3','spinner4', 'spinner5', 'spinner6', 'spinner7'
});
    </script>
</body>

</html> --}}
