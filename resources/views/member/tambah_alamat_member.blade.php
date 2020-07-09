<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tambah Alamat Member Wakprint</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- bootstrap -->
        <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script> -->

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://mdbootstrap.com/api/snippets/static/download/MDB-Pro_4.5.14/js/mdb.min.js"></script>
        <script type="text/javascript" src="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/js/plugins/mdb-plugins-gathered.min.js"></script>

        <!-- Styles -->
        <style>

            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .contentUnggah {
                padding:50px;
            }
            /* .container-fluid {
                padding-top:50px;
            } */

            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }

            .title {
                font-size: 84px;
            }

            /* #bs-example-navbar-collapse-1{
                display: flex;
                align-items: right;
                justify-content: flex-end;
            } */

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            
            .card-columns-2 {
                column-count: 2;
            }

            .my-custom-scrollbar {
                position: relative;
                scrollbar-color: #4285F4 #F5F5F5;
                width: 100%;
                height: 200px;
                overflow: auto;
            }

        </style>
    </head>
    
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" role="navigation">
                <div class="container pt-2 pb-2">
                    <a class="navbar-brand font-weight-bold" href="www.wakprint.com">WAKPRINT</a>
                    <div class="collapse navbar-collapse" id="exCollapsingNavbar">
                            <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                                <li class="nav-item mr-4"><a class="nav-link" href="#"><span class="sr-only"></span>Chat</a></li>
                                <li class="nav-item mr-4"><a class="nav-link" href="#"><span class="sr-only"></span><i class="fa fa-bell mr-2"></i></a></li>
                                <li class="nav-item mr-4"><a class="nav-link" href="#"><span class="sr-only"></span>Rp. 12.000<i class="fa fa-user ml-3"></i></a></li>
                            </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <body>
        <div class="container pl-5 pr-5">
            
            <div class="container pt-2 pb-5" style="margin-top:72px">

                <div class="container mt-5">
                    <h1 class="font-weight-bold mb-5">Tambah Alamat Pengiriman</h1>
                    
                    <div class="container mb-3">
                        <div class="row">
                            <div class="container col-md-6">
                                <p class="font-weight-bold mb-2">Nama Penerima</p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nama Penerima" 
                                    aria-label="Masukkan Nama Penerima" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <p class="font-weight-bold mb-2">Nomor HP</p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nomor HP Penerima" 
                                    aria-label="Masukkan Nomor HP Penerima" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <p class="font-weight-bold mb-2">Provinsi</p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Provinsi" 
                                    aria-label="Masukkan Provinsi" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <p class="font-weight-bold mb-2">Kabupaten / Kota</p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nama Kabupaten / Kota" 
                                    aria-label="Masukkan Nama Kabupaten / Kota" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>

                            <div class="container col-md-6">
                                <p class="font-weight-bold mb-2">Kecamatan</p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nama Kecamatan" 
                                    aria-label="Masukkan Nama Kecamatan" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <p class="font-weight-bold mb-2">Kelurahan</p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nama Kelurahan" 
                                    aria-label="Masukkan Nama Kelurahan" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <p class="font-weight-bold mb-2">Kode Pos</p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nama Penerima" 
                                    aria-label="Masukkan Nama Penerima" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <p class="font-weight-bold mb-2">Alamat</p>
                                <div class="input-group mb-3">
                                    <textarea class="form-control" aria-label="Alamat"></textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="container text-right col-md-10 mr-0 mb-4">
                                <button type="button" class="btn btn-default font-weight-bold" style="margin-right:-25px;">Batal</button>
                            </div>
                            <div class="container text-right col-md-2 mb-4">
                                <button type="button" class="btn btn-primary font-weight-bold pl-4 pr-4" style="border-radius:30px;">Simpan</button>
                            </div>
                        </div>
                    </div>

                    
                    
                </div>
            </div>

            
        </div>
    </body>
    <footer>
        <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="font-weight-bold">WAKPRINT</h4>
                    </div>

                    <div class="col-md-3">
                        <h4 class="mb-4 font-weight-bold">Kontak</h4>
                        <p class="mb-2">+6281263638</p>
                        <p>dev@wakprint.com</p>
                    </div>

                    <div class="col-md-3">
                        <h4 class="mb-4 font-weight-bold">Informasi Umum</h4>
                        <p class="mb-2"><a href="">Tentang Kami</a></p>
                        <p><a href="#">Kebijakan Privasi</a></p>
                        <p><a href="#">Syarat & Ketentuan</a></p>
                        <p><a href="#">FAQ</a></p>
                    </div>

                    <div class="col-md-3">
                        <div class="row mb-4">
                            <h4 class="font-weight-bold">Sosial Media</h4>
                            <img src="frame.png" class="img-responsive ml-4" alt="" width="24" height="24">
                            <img src="frame.png" class="img-responsive ml-4" alt="" width="24" height="24">
                            <img src="frame.png" class="img-responsive ml-4" alt="" width="24" height="24">
                            <img src="frame.png" class="img-responsive ml-4" alt="" width="24" height="24">
                        </div>
                        <div class="" style="margin-left:-15px; margin-top:-10px">
                            <p><i class="fa fa-copyright"> Copyright Wakprint 2020</i></p>
                        </div>
                    </div>
                </div>
        </div>
    </footer>
</html>


