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
            // alert('<?php $a ?>'}});
        var ID=$(this).attr('data-a');
        $.ajax({url:"public/NewPage.php"+ID,cache:false,success:function(result){
            $(".modal-content").html(result);
            }});                    `
        });

        $('#tambah').click(function(){
            alert('ISINYA');
        });
    });
    
</script>
</html>
