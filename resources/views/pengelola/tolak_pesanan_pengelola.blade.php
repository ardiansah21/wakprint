<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Halaman Tolak Pesanan Masuk Pengelola Wakprint</title>

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


            .my-custom-scrollbar-1 {
                position: relative;
                scrollbar-color: #4285F4 #F5F5F5;
                width: 100%;
                height: 498px;
                overflow: auto;
            }

            .my-custom-scrollbar-2 {
                position: relative;
                scrollbar-color: #4285F4 #F5F5F5;
                width: 100%;
                height: 398px;
                overflow: auto;
            }


        </style>
    </head>

    <body>
        <div class="container mt-4">
            <h1 class="font-weight-bold ml-0 mb-5">Alasan Penolakan</h1>
            
            <p class="font-weight-bold mb-2">Isi Sendiri</p>
            <div class="input-group mb-4">
                <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Alasan Penolakan" 
                aria-label="Masukkan Alasan Penolakan" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="row justify-content-between">
                            
                <div class="container col text-right">
                    <div class="container mb-3">
                        <button type="button" class="btn btn-default font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px; margin-right:0px;">Batal</button>
                    </div>
                </div>

                <div class="container col-auto text-right">
                    <div class="container mb-3">
                        <button type="button" class="btn btn-primary font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px; margin-right:-20px;">Kirim</button>
                    </div>
                </div>
            </div>
            
        </div>
    </body>

</html>
