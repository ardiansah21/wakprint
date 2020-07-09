<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Halaman Tingkat Akurasi Warna Pengelola Wakprint</title>

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
                overflow: auto;
            }

            .my-custom-scrollbar-2 {
                position: relative;
                scrollbar-color: #4285F4 #F5F5F5;
                width: 100%;
                height: 398px;
                overflow: auto;
            }

            .switch {
            position: relative;
            display: inline-block;
            width: 90px;
            height: 34px;
            }

            .switch input {display:none;}

            .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ca2222;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 34px;
            }

            .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 50%;
            }

            input:checked + .slider {
            background-color: #2ab934;
            }

            input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
            }

            input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(55px);
            }

            /*------ ADDED CSS ---------*/
            .slider:after
            {
            content:'Mati';
            color: white;
            display: block;
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 50%;
            font-size: 10px;
            font-family: Verdana, sans-serif;
            }

            input:checked + .slider:after
            {  
            content:'Hidup';
            }


        </style>
    </head>

    <body>
        <div class="container">
            <div class="container" style="margin-top:100px; margin-left:-20px;">
                <h1 class="font-weight-bold mb-5 mt-5">Akurasi Tingkat Keakuratan Deteksi Warna Halaman</h1>
            </div>

            <div class="row justify-content-between mb-4">
                <div class="col-10">
                    <p class="font-weight-bold mb-0 ml-0 mt-2">1. Penuh</p>
                    <p class="mb-0 ml-0 mt-2">Ini juga cuma contoh penjelasan/deskripsi apa yang dimaksud dari kata penuh.

                    tidak perlu dibaca sampai disini. Terimkasih</p>
                </div>

                <div class="col-2">
                    <p class="mb-0 ml-0 mt-2 mb-3">Contoh</p>
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive" style="width:250px; height:400px; border-radius:10px;">
                </div>
                
            </div>

            <div class="row justify-content-between mb-4">
                <div class="col-10">
                    <p class="font-weight-bold mb-0 ml-0 mt-2">2. Tinggi</p>
                    <p class="mb-0 ml-0 mt-2">Ini juga cuma contoh penjelasan/deskripsi apa yang dimaksud dari kata penuh.

                    tidak perlu dibaca sampai disini. Terimkasih</p>
                </div>

                <div class="col-2">
                    <p class="mb-0 ml-0 mt-2 mb-3">Contoh</p>
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive" style="width:250px; height:400px; border-radius:10px;">
                </div>
                
            </div>

            <div class="row justify-content-between mb-4">
                <div class="col-10">
                    <p class="font-weight-bold mb-0 ml-0 mt-2">3. Sedang</p>
                    <p class="mb-0 ml-0 mt-2">Ini juga cuma contoh penjelasan/deskripsi apa yang dimaksud dari kata penuh.

                    tidak perlu dibaca sampai disini. Terimkasih</p>
                </div>

                <div class="col-2">
                    <p class="mb-0 ml-0 mt-2 mb-3">Contoh</p>
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive" style="width:250px; height:400px; border-radius:10px;">
                </div>
                
            </div>

            <div class="row justify-content-between mb-4">
                <div class="col-10">
                    <p class="font-weight-bold mb-0 ml-0 mt-2">4. Rendah</p>
                    <p class="mb-0 ml-0 mt-2">Ini juga cuma contoh penjelasan/deskripsi apa yang dimaksud dari kata penuh.

                    tidak perlu dibaca sampai disini. Terimkasih</p>
                </div>

                <div class="col-2">
                    <p class="mb-0 ml-0 mt-2 mb-3">Contoh</p>
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive" style="width:250px; height:400px; border-radius:10px;">
                </div>
                
            </div>

            <div class="row justify-content-between mb-4">
                <div class="col-10">
                    <p class="font-weight-bold mb-0 ml-0 mt-2">5. Sangat Rendah</p>
                    <p class="mb-0 ml-0 mt-2">Ini juga cuma contoh penjelasan/deskripsi apa yang dimaksud dari kata penuh.

                    tidak perlu dibaca sampai disini. Terimkasih</p>
                </div>

                <div class="col-2">
                    <p class="mb-0 ml-0 mt-2 mb-3">Contoh</p>
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive" style="width:250px; height:400px; border-radius:10px;">
                </div>
                
            </div>

        </div>
    </body>

</html>
