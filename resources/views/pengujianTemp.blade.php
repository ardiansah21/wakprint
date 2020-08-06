<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="http://wakprint.test/js/app.js"></script>
    <link href="http://wakprint.test/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Pengujian</title>

    <style>
        .progress {
            position: relative;
            width: 100%;
        }

        .bar {
            background-color: #008000;
            width: 0%;
            height: 20px;
        }

        .percent {
            position: absolute;
            display: inline-block;
            left: 50%;
            color: #7F98B2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="container">
            <h2>Laravel File Upload With Progress Bar Tutorial Example</h2>
            <form method="POST" action="{{route('pdf.store')}}" enctype="multipart/form-data">
                {{-- <input type="hidden" name="_token" value="O29022D9Cr7vWVXGyyxHiv6a661gVcmvDkR9QmpL"> --}}
                @csrf
                <div class="form-group">
                    <input name="file" type="file" class="form-control"><br>
                    <div class="progress">
                        <div class="bar"></div>
                        <div class="percent" style="margin-top: 10px;">0%</div>
                    </div>
                    <br>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
        <button type="button" name="" id="loading" class="btn btn-secondary" btn-lg btn-block">ini loading</button>
        <div id="aa"></div>
    </div>



    {{--
    <div class="container cst-con">
        <div class="row cst-row">
            <div class="col-md-12 cst-md">
                <!-- add space -->
                <p>&nbsp;</p>
                <!-- add space -->
                <p>&nbsp;</p>
                <button type="button" id="buttonno1" class="btn btn-success cst-btn btn-block">Click Here To Start
                    Progress Bar</button>

                <button type="button" id="buttonno2" class="btn btn-danger cst-btn btn-block">Click Here To Stop
                    Progress Bar</button>
            </div>
            <div class="col-md-12 cst-md">

                <div id="progressbar" style="border:2px solid #cbc; border-radius: 6px; "></div>

                <!-- add Progress informations -->
                <br>
                <div id="informations" class="cst-md"></div>
            </div>
        </div>
    </div>


    &lt;<iframe id="loadarea_show" class="cst-md" style="display:none;"></iframe><br>
    <script>
        // script progress bar using PHP
        $("#buttonno1").click(function(){
        document.getElementById('loadarea_show').src = "{{url('/php/progressbar_val.php')}}";
    });
    $("#buttonno2").click(function(){
    document.getElementById('loadarea_show').src = '';
    });
    </script> --}}






    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#loading').hide();
             $(document).ready(function()
             {
                    var bar = $('.bar');
                    var percent = $('.percent');

                $('form').ajaxForm({
                    beforeSend: function() {
                        var percentVal = '0%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                        $('#loading').show();
                    },
                    complete: function(xhr) {
                        // alert('File Uploaded Successfully');
                        // window.location.href = "/pdf";
                        // $('form').submit;
                        // alert(xhr['path']);
                        // document.getElementsByClassName('aa').html(xhr.path)

                        var data = xhr.responseText;
                        var pdf =  JSON.parse(data);

                        $('#aa').html(pdf['namaFile']);
                        $('#aa').ready(function(){
                            $('#loading').hide();
                        });
                    }

                });
            });
        });
    </script>



























</body>

</html>
