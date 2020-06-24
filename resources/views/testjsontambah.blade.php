<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>tes json</title>
    <style>
        body{
            width: 50%;
            margin: 0 auto;
        }
        #tt{

        }
    </style>
</head>
<body>

    <br><br>

    <form action="/testjson/store" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Price*</label>
            <input type="number" name="price" class="form-control" step="0.01">
        </div>
        <div class="form-group">
            <label for="properties">Properties</label>
            <div class="row">
                <div class="col-md-2">
                    Key:
                </div>
                <div class="col-md-4">
                    Value:
                </div>
            </div>
            @for ($i=0; $i <= 4; $i++)
            <div class="row">
                <div class="col-md-2">
                    <input type="text" name="properties[{{ $i }}][key]" class="form-control" value="{{ old('properties['.$i.'][key]') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="properties[{{ $i }}][value]" class="form-control" value="{{ old('properties['.$i.'][value]') }}">
                </div>
            </div>
            @endfor
            {{-- <div class="row">
                <div class="col-md-2">
                    <input type="text" name="properties[{{ 0 }}][key]" class="form-control" value="{{ old('properties[0][key]') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="properties[{{ 0 }}][value]" class="form-control" value="{{ old('properties[0][value]') }}">
                </div>
            </div> --}}
        </div>
        <div>
            <input class=" btn btn-danger" type="submit">
        </div>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
