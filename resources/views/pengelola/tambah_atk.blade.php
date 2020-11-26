@extends('layouts.pengelola')

@section('content')
    <div class="container mt-5 mb-5" style="font-size: 16px;">
        <label class="font-weight-bold mb-4 ml-0 mr-0" style="font-size:36px;">
            {{ __('Tambah ATK') }}
        </label>
        <form action="{{ route('partner.atk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-between mb-2 ml-0" style="list-style-position: inside">
                <div class="col-md-2">
                    <img id="gambarAtk" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                        class="img-responsive bg-light"
                        style="width:163px;height:163px;border-radius:10px; object-fit:contain;" alt="foto atk">
                    <a id="editGambarAtk" class="pointer" onclick="document.getElementById('imgupload').click();"
                        style="color: black; position: relative;bottom: 40px;left:130px;right: 0px;">
                        <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2" style="border-radius: 5px;">
                            edit
                        </i>
                    </a>
                    <input id="imgupload" type="file" name="foto_atk" hidden accept="image/png, image/jpeg"
                        onchange="document.getElementById('gambarAtk').src=window.URL.createObjectURL(this.files[0]);"
                        hidden>
                </div>
                <div class="col-md-10">
                    <label class="mb-2">Nama Atk</label>
                    <div class="form-group mb-4">
                        <input name="nama" id="nama" type="text" class="form-control form-control-lg pt-2 pb-2"
                            placeholder="Masukkan Nama ATK" aria-label="" aria-describedby="inputGroup-sizing-sm"
                            style="font-size: 16px;" required>
                    </div>
                    <div class="row justify-content-between">
                        <div class="row col-md-6 form-group ">
                            <label class="align-self-center"
                                style="display: inline-block; width: 10%; text-align: right; padding-right:8px"> Rp </label>
                            <input id="harga" name="harga" type="number" min="0"
                                class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga ATK"
                                aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 16px; width:90%" required>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <input id="jumlah" type="number" name="jumlah" min="0" class="form-control pt-2 pb-2"
                                aria-label="Jumlah Atk" placeholder="Masukkan Jumlah Atk" aria-label="Masukkan Jumlah ATK"
                                aria-describedby="inputGroup-sizing-sm" style="font-size: 16px;" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end ml-0 mr-0 mb-5">
                <div class="form-group mr-3">
                    <button onclick="window.location.href='{{ route('partner.atk.index') }}'"
                        class="btn btn-default btn-lg text-primary-purple font-weight-bold pl-5 pr-5 mb-0"
                        style="border-radius:30px;">
                        {{ __('Batal') }}
                    </button>
                </div>
                <div class="form-group mr-0">
                    <button type="submit" class="btn btn-lg btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0"
                        style="border-radius:30px;">
                        {{ __('Tambah') }}
                    </button>
                </div>
            </div>
            {{-- <div id="tambahanAtk">
                <label class="mb-4 ml-0 mt-2">
                    {{ __('Tambahan ATK Anda') }}
                </label>
                <div class="row justify-content-between mb-2 ml-0" style="list-style-position: inside">
                    <div class="col-md-2">
                        <img id="blah" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                            class="img-responsive bg-light" style="width:163px;height:163px;border-radius:10px;"
                            alt="foto atk">
                        <a id="editGambarAtk" class="pointer" onclick="document.getElementById('imgupload').click();"
                            style="color: black; position: relative;bottom: 40px;left:130px;right: 0px;">
                            <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2" style="border-radius: 5px;">
                                edit
                            </i>
                        </a>
                        <input id="imgupload" type="file" name="foto-atk" hidden accept="image/png, image/jpeg"
                            onchange="document.getElementById('blah').src=window.URL.createObjectURL(this.files[0]);"
                            hidden>
                    </div>
                    <div class="col-md-9">
                        <div class="row justify-content-between mr-1">
                            <div class="col-md-6 form-group mb-3">
                                <input name="nama" id="nama" type="text" class="form-control form-control-lg pt-2 pb-2"
                                    placeholder="Masukkan Nama Paket" aria-label="" aria-describedby="inputGroup-sizing-sm"
                                    style="font-size: 16px;" required>
                            </div>
                            <div class="row col-md-6 form-group "> <label class="align-self-center"
                                    style=" display: inline-block; width: 10%; text-align: right; padding-right:8px"> Rp
                                </label>
                                <input id="harga" name="harga" type="number" min="0"
                                    class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga Produk"
                                    aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm"
                                    style="font-size: 16px; width:90%" required>
                            </div>
                        </div>
                        <label class="mb-2"> Deskripsi Atk</label>
                        <div class="form-group mb-4 mr-0">
                            <textarea id="deskripsi" name="deskripsi" class="form-control d-flex" aria-label="Deskripsi Atk"
                                placeholder="Masukkan Deskripsi Atk Tambahan Anda"></textarea>
                        </div>
                    </div>
                    <div class="col-md-auto align-self-center mr-0 mb-3">
                        <button id="hapus" class="btn btn-circle-trash shadow-sm" type="button" role="button">
                            <i class="fa fa-trash fa-2x" style="color: white" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div> --}}
        </form>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // var i = 0;
            // var namaAtk = document.getElementsByName('nama').value;
            // $("#tambahanAtk").append(
            //         '<div class="row justify-content-between mb-2 ml-0" style="list-style-position: inside">'+
            //             '<div class="col-md-2">'+
            //                 '<img id="blah'+i+'" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"'+
            //                     'class="img-responsive bg-light" style="width:163px;height:163px;border-radius:10px;" alt="foto atk">'+
            //                 '<a id="editGambarAtk" class="pointer" onclick="document.getElementById(\'imgupload'+i+'\').click();"'+
            //                     'style="color: black; position: relative;bottom: 40px;left:130px;right: 0px;">'+
            //                     '<i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2" style="border-radius: 5px;"> edit'+
            //                     '</i>'+
            //                 '</a>'+
            //                 '<input id="imgupload'+i+'" type="file" name="fitur[tambahan]['+i+'][foto_fitur]" hidden accept="image/png, image/jpeg"'+
            //                     'onchange="document.getElementById(\'blah'+i+'\').src=window.URL.createObjectURL(this.files[0]);" hidden>'+
            //             '</div>'+
            //             '<div class="col-md-9">'+
            //                 '<div class="row justify-content-between mr-1">'+
            //                     '<div class="col-md-6 form-group mb-3">'+
            //                         '<input name="fitur[tambahan]['+i+'][nama]" id="nama" type="text"'+
            //                             'class="form-control form-control-lg pt-2 pb-2" placeholder="Masukkan Nama Paket" aria-label=""'+
            //                             'aria-describedby="inputGroup-sizing-sm" style="font-size: 16px; " required>'+
            //                     '</div>'+
            //                     '<div class="row col-md-6 form-group "> <label class="align-self-center"'+
            //                             'style=" display: inline-block; width: 10%; text-align: right; padding-right:8px"> Rp </label>'+
            //                         '<input id="harga" name="fitur[tambahan]['+i+'][harga]" type="number" min="0"'+
            //                             'class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga Produk"'+
            //                             'aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm"'+
            //                             'style="font-size: 16px; width:90%" required> </div>'+
            //                 '</div>'+
            //                 '<label class="mb-2 "> Deskripsi Fitur </label>'+
            //                 '<div class="form-group mb-4 mr-0">'+
            //                     '<textarea id="deskripsi" name="fitur[tambahan]['+i+'][deskripsi]" class="form-control d-flex"'+
            //                         'aria-label="Deskripsi Fitur" placeholder="Masukkan Deskripsi Paket Tambahan Anda"></textarea>'+
            //                 '</div>'+
            //             '</div>'+
            //             '<div class="col-md-auto align-self-center mr-0 mb-3">'+
            //                 '<button id="hapus" class="btn btn-circle-trash shadow-sm" type="button" role="button">'+
            //                     '<i class="fa fa-trash fa-2x" style="color: white" aria-hidden="true"></i>'+
            //                 '</button>'+
            //             '</div>'+
            //         '</div>'
            //         '<button id="tambahAtk" type="button" class="btn btn-primary-yellow btn-block center SemiBold mt-2 mb-5">'+
            //             'Tambah ATK'+
            //         '</button>'
            // );

            // $("#tambahAtk").click(function() {
            //     var namaAtk = document.getElementsById('nama').value;
            //     alert($('#nama').attr('value'));
            //     $("#areaTambah").append(

            //         '<div class="row justify-content-between ml-0 mr-0">'+
            //         '    <div class="form-group custom-control custom-checkbox">'+
            //         '        <input type="checkbox" class="custom-control-input" name="nama['+i+']" id="checkboxAtk['+i+']">'+
            //         '        <label id="namaAtk" class="custom-control-label align-middle" for="checkboxAtk['+i+']">'+
            //         '            '+$('#nama').val()+
            //         '        </label>'+
            //         '    </div>'+
            //         '   <label class="font-weight-bold mb-2 ml-0">'+
            //         '       Rp. harga['+i+']'+
            //         '   </label>'+
            //         '   <div class="form-group">'+
            //         '       <label class="ml-0">'+
            //         '           <i class="fa fa-plus ml-2 mr-2"></i>'+
            //         '       </label>'+
            //         '       <input type="text ml-3" class="form-input" style="width:48px;">'+
            //         '       <label class="ml-2">'+
            //         '           <i class="fa fa-minus ml-0 mr-0"></i>'+
            //         '       </label>'+
            //         '   </div>'+
            //         '</div>'
            //     );
            //     i++;
            // });

            // $("#tambahanAtk").on("click","#hapus",function(){
            //     $($(this).parents('li').get(0)).remove();
            // });

            $("#editGambarAtk").on("click", function() {
                $('#imgupload').trigger('click');
                return false;
            });

            $("#gambarAtk").on("change", "#imgupload", function() {
                document.getElementById('gambarAtk').src = window.URL.createObjectURL(this.files[0]);
            });

        });

    </script>
@endsection
