<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wakprint</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,600" rel="stylesheet">

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{url('style.css')}}">

</head>
<body>
    
    <!-- bagian header -->
    @yield('header')

    <!-- bagian konten -->
    @yield('konten')

    <!-- bagian footer -->
    @yield('footer')
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://mdbootstrap.com/api/snippets/static/download/MDB-Pro_4.5.14/js/mdb.min.js"></script>
    <script type="text/javascript" src="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/js/plugins/mdb-plugins-gathered.min.js"></script>
    
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
    
    {{-- visibility password --}}
    <script src="js/show-password.js">
    </script>

    {{-- validate form --}}
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
                });
            }, false);
        })();
    </script>

    {{-- visibility password --}}
    <script>
        function showPassword(){                
            var pw = document.getElementById('showPasswordLogin');
            var tp = document.getElementById('togglePassword');
            $(this).toggleClass("fa-eye fa-eye-slash");
            if(pw.type == "text"){
                pw.type = "password";
                tp.addClass( "fa-eye-slash" );
                tp.removeClass( "fa-eye" );
            }
            else{
                pw.type = "text";
                tp.removeClass( "fa-eye-slash" );
                tp.addClass( "fa-eye" );
            }
        }
    </script>

    {{-- tab pencarian --}}
    <script type="text/javascript">
        $(function () {
            $('#pills-produk li:first-child a').tab('show') // Select first tab
            $('#pills-tempat-percetakan li:last-child a').tab('show') // Select last tab
        })
    </script>

    {{-- tab kelola saldo admin --}}
    <script type="text/javascript">
        $(function () {
            $('#pills-saldo-member li:first-child a').tab('show') // Select first tab
            $('#pills-saldo-pengelola li:last-child a').tab('show') // Select last tab
        })
    </script>

</body>
</html>