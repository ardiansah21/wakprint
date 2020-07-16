<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @extends('navbar.pengelola.navbar_after_pengelola')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container" style="margin-top:120px;">
            
            <h1 class="font-weight-bold mb-5 mt-5">Profil Tempat Percetakan</h1>
            
            <label class="mb-2">Foto Tempat Percetakan</label>
    
            {{-- <div class="scrolling-wrapper"> --}}
                <div class="row justify-content-left mb-2">
                    <div class="col-auto">
                        <div class="row justify-content-left">
                            <div class="col-auto">
                                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive bg-light" style="width:250px; height:200px; border-radius:10px;">
                                <div class="container mb-3">
                                    <button type="button" class="btn btn-outline-yellow font-weight-bold pl-4 pr-4 mb-0" style="position: absolute;
                                    bottom: 30px;
                                    right: 35px;
                                    border-radius:30px;">Pilih Foto
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto align-self-center mb-3">
                        <button class="btn btn-circle shadow-sm" role="button"><i class="material-icons md-36 align-middle" style="color: white; margin-left:-6px;">add</i></button>
                    </div>
                    
                </div>
            {{-- </div> --}}
            
                <label class="mb-2">Nama Tempat Percetakan</label>
                <div class="col input-group mb-4" style="margin-left:-15px;">
                    <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nama Tempat Percetakan" 
                    aria-label="Masukkan Nama Tempat Percetakan" aria-describedby="inputGroup-sizing-sm">
                </div>
                
                <label class="mb-2">Deskripsi Tempat Percetakan</label>
                <div class="col input-group mb-4" style="margin-left:-15px;">
                    <textarea class="form-control" aria-label="Deskripsi Percetakan"></textarea>
                </div>
    
                <label class="mb-2">Alamat Tempat Percetakan</label>
                <div class="col input-group mb-4" style="margin-left:-15px;">
                    <textarea class="form-control" aria-label="Alamat Tempat Percetakan"></textarea>
                </div>
    
                <label class="mb-2">URL Google Maps</label>
                <div class="col input-group mb-4" style="margin-left:-15px;">
                    <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan URL Titik Lokasi Anda" 
                    aria-label="Masukkan URL Titik Lokasi Anda" aria-describedby="inputGroup-sizing-sm">
                </div>
    
                <label class="mb-2">Jam Operasional</label>
                    <div class="container col-6 mb-2" style="margin-left:-30px;"> 
                        <label class="container"> 
                            Buka
                            <input type="text mr-4" class="form-input" style="width:48px;"> :
                            <input type="text mr-4" class="form-input" style="width:48px;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Tutup
                            <input type="text mr-4" class="form-input" style="width:48px;"> :
                            <input type="text mr-4" class="form-input" style="width:48px;">
                        </label>
                    </div>
                
                <label class="mb-2">Syarat & Ketentuan</label>
                <div class="col input-group mb-4" style="margin-left:-15px;">
                    <textarea class="form-control" aria-label="Syarat & Ketentuan"></textarea>
                </div>
                
            <div class="row justify-content-between mb-5">
                <div class="col-auto">
                    <label class="mb-2">Metode Pelayanan</label>
                    <div class="row justify-content-left mb-2">
                        
                        <div class="custom-control custom-checkbox mt-2 ml-3">
                            <input type="checkbox" class="custom-control-input" id="checkboxAmbil">
                            <label class="custom-control-label" for="checkboxAmbil">Ambil di Tempat</label>
                        </div>
    
                        <div class="custom-control custom-checkbox mt-2 ml-4">
                            <input type="checkbox" class="custom-control-input" id="checkboxDiantar">
                            <label class="custom-control-label" for="checkboxDiantar">Diantar ke Tempat</label>
                        </div>
                    </div>
                </div>
    
                <div class="col-auto text-right" style="margin-right:30px;">
                    <p class="mb-2">Akurasi Tingkat Keakuratan Deteksi Warna Halaman<button class="btn btn-default text-primary-purple ml-2" data-toggle="modal" data-target="#infoModal">Info</button></p>
                    <div class="dropdown">
                        <button class="btn btn-default btn-block shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Akurasi Tingkat Keakuratan Deteksi Warna
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Penuh</a>
                            <a class="dropdown-item" href="#">Tinggi</a>
                            <a class="dropdown-item" href="#">Sedang</a>
                            <a class="dropdown-item" href="#">Rendah</a>
                            <a class="dropdown-item" href="#">Sangat Rendah</a>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="container col-auto text-right mb-5">
                <div class="container">
                    <button type="button" class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                    onclick="window.location='{{ url('pengelola/profil') }}'"
                    style="border-radius:30px;">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
    
            <div class="container" style="margin-left:-15px;">
                <h1 class="font-weight-bold mb-5 mt-2">Profil Pemilik Tempat Percetakan</h1>
            </div>
    
            <div class="row mb-5">
                <div class="col-auto">
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive bg-light" style="width:250px; height:250px; border-radius:10px;">
                    <div class="container mb-3">
                        <button type="button" class="btn btn-outline-yellow font-weight-bold pl-4 pr-4 mb-0" style="position: absolute;
                        bottom: 30px;
                        right: 35px;
                        border-radius:30px;">Pilih Foto</button>
                    </div>
                </div>
    
                <div class="col-9">
                    <label class="mb-2">Nama Pemilik Tempat Percetakan</label>
                    <div class="col input-group mb-3" style="margin-left:-15px;">
                        <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nama Pemilik Tempat Percetakan" 
                        aria-label="Masukkan Nama Pemilik Tempat Percetakan" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <label class="mb-2">Nomor HP Pemilik Tempat Percetakan</label>
                    <div class="col input-group mb-3" style="margin-left:-15px;">
                        <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nomor HP Pemilik Tempat Percetakan" 
                        aria-label="Masukkan Nomor HP Pemilik Tempat Percetakan" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-5">
                            <label class="mb-2">Nama Bank Pemilik Tempat Percetakan</label>
                            <div class="dropdown" style="margin-left:0px;">
                                <button class="btn btn-default btn-block shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    BRI
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">BCA</a>
                                    <a class="dropdown-item" href="#">Mandiri</a>
                                    <a class="dropdown-item" href="#">BNI</a>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-7" style="">
                            <label class="mb-2 ml-0">Nomor Rekening Pemilik Tempat Percetakan</label>
                            <div class="col input-group mb-3" style="margin-left:-15px;">
                                <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nomor Rekening Pemilik Tempat Percetakan" 
                                aria-label="Masukkan Nomor Rekening Pemilik Tempat Percetakan" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
    
            <div class="container col-auto text-right mb-5">
                <div class="container">
                    <button type="button" class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                    onclick="window.location='{{ url('pengelola/profil') }}'"
                    style="border-radius:30px; margin-right:0px;">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        
            {{-- pop up info --}}
            <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <h1 id="infoModalLabel" class="font-weight-bold mb-5 mt-5">Akurasi Tingkat Keakuratan Deteksi Warna Halaman</h1>
                        
                        <div class="row justify-content-between mb-4">
                            <div class="col-9">
                                <p class="font-weight-bold mb-0 ml-0 mt-2">1. Penuh</p>
                                <p class="mb-0 ml-0 mt-2">Ini juga cuma contoh penjelasan/deskripsi apa yang dimaksud dari kata penuh.
                                tidak perlu dibaca sampai disini. Terimkasih</p>
                            </div>
            
                            <div class="col-3">
                                <label class="mb-0 ml-0 mt-2 mb-3">Contoh</label>
                                <img src="{{url('Deteksi-Penuh.png')}}" class="img-responsive" style="width:250px; height:400px; border-radius:10px;">
                            </div>
                        </div>
                        <div class="row justify-content-between mb-4">
                            <div class="col-9">
                                <p class="font-weight-bold mb-0 ml-0 mt-2">2. Tinggi</p>
                                <p class="mb-0 ml-0 mt-2">Ini juga cuma contoh penjelasan/deskripsi apa yang dimaksud dari kata penuh.
                                tidak perlu dibaca sampai disini. Terimkasih</p>
                            </div>
            
                            <div class="col-3">
                                <label class="mb-0 ml-0 mt-2 mb-3">Contoh</label>
                                <img src="{{url('Deteksi-Tinggi.png')}}" class="img-responsive" style="width:250px; height:400px; border-radius:10px;">
                            </div>
                            
                        </div>
            
                        <div class="row justify-content-between mb-4">
                            <div class="col-9">
                                <p class="font-weight-bold mb-0 ml-0 mt-2">3. Sedang</p>
                                <p class="mb-0 ml-0 mt-2">Ini juga cuma contoh penjelasan/deskripsi apa yang dimaksud dari kata penuh.
                                tidak perlu dibaca sampai disini. Terimkasih</p>
                            </div>
            
                            <div class="col-3">
                                <label class="mb-0 ml-0 mt-2 mb-3">Contoh</label>
                                <img src="{{url('Deteksi-Sedang.png')}}" class="img-responsive" style="width:250px; height:400px; border-radius:10px;">
                            </div>
                            
                        </div>
            
                        <div class="row justify-content-between mb-4">
                            <div class="col-9">
                                <p class="font-weight-bold mb-0 ml-0 mt-2">4. Rendah</p>
                                <p class="mb-0 ml-0 mt-2">Ini juga cuma contoh penjelasan/deskripsi apa yang dimaksud dari kata penuh.
                                tidak perlu dibaca sampai disini. Terimkasih</p>
                            </div>
            
                            <div class="col-3">
                                <label class="mb-0 ml-0 mt-2 mb-3">Contoh</label>
                                <img src="{{url('Deteksi-Rendah.png')}}" class="img-responsive" style="width:250px; height:400px; border-radius:10px;">
                            </div>
                            
                        </div>
            
                        <div class="row justify-content-between mb-4">
                            <div class="col-9">
                                <p class="font-weight-bold mb-0 ml-0 mt-2">5. Sangat Rendah</p>
                                <p class="mb-0 ml-0 mt-2">Ini juga cuma contoh penjelasan/deskripsi apa yang dimaksud dari kata penuh.
                                tidak perlu dibaca sampai disini. Terimkasih</p>
                            </div>
            
                            <div class="col-3">
                                <label class="mb-0 ml-0 mt-2 mb-3">Contoh</label>
                                <img src="{{url('Deteksi-Sangat-Rendah.png')}}" class="img-responsive" style="width:250px; height:400px; border-radius:10px;">
                            </div>
                        </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>
@endsection

