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
            margin: 0 auto;
        }
    </style>
    </head>
<body>
    @php
        $a = "aa";
    @endphp
    <button type='button' data-a="<?echo $fila['idPlaza'];?>" href='#editarUsuario' class='modalEditarUsuario btn btn-warning btn-xs' data-toggle='modal' data-backdrop='static' data-keyboard='false' title='Editar usuario'>
        <img src='../images/edit.png' width='20px' height='20px'>
    </button>
    <a href="/testjson/tambah" id="tambah" class="btn btn-warning" style="margin-top: 50px">tambah</a>
    <br><br>

    <table class="table table-dark">
        <tbody>

            @foreach($products as $product)
                <tr>
                    <td>
                        {{ $product->name ?? '' }}

                    </td>
                    <td>
                        {{ $product->price ?? '' }}
                    </td>
                    <td>
                        @foreach ($product->properties as $property)
                            <b>{{ $property['desa'] }}</b>: {{ $property['kecamatan'] }}<br />
                        @endforeach
                    </td>
                    <td>
                        <a href="/testjson/update/{{ $product->id }}">edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- MODAL EDITAR-->
    <div id="editarUsuario" class="modal fade modal" role="dialog">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                
            </div>
            </div>
        </div>
    </div>



</body>
<script>
    $(document).ready(function(){
        $('.modalEditarUsuario').click(function(){
            //alert('<?php $a ?>'}});
        var ID=$(this).attr('data-a');
        $.ajax({url:"public/NewPage.php"+ID,cache:false,success:function(result){
            $(".modal-content").html(result);
            }});
        });

        $('#tambah').click(function(){
            alert('ISINYA');
        });
    });
    
</script>
</html>

{{-- @extends('layouts.app')
@section('content')
<i class="fa fa-user-circle" aria-hidden="true"></i>
<a href="/testjson/tambah" class="btn btn-warning" style="margin-top: 50px">tambah</a>
<br><br>

<table class="table table-dark">
    <tbody>

        @foreach($products as $product)
        <tr>
            <td>
                {{ $product->name ?? '' }}

            </td>
            <td>
                {{ $product->price ?? '' }}
            </td>
            <td>
                @foreach ($product->properties as $property)
                <b>{{ $property['desa'] }}</b>: {{ $property['kecamatan'] }}<br />
                @endforeach
            </td>
            <td>
                <a href="/testjson/update/{{ $product->id }}">edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open
    modal for @mdo</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open
    modal for @fat</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
    data-whatever="@getbootstrap">Open modal for @getbootstrap</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control r" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) Button that triggered the modal
            var recipient = button.data('whatever') Extract info from data-* attributes
            If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body .r').val(recipient)
        })
</script>
@endsection --}}

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script> --}}




