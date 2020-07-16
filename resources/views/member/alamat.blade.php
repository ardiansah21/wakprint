<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @extends('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container-fluid pt-2 pb-5" style="margin-top:72px">
            <div class="container mt-5">
                <h1 class="font-weight-bold mb-5">Alamat Pengiriman</h1>
                <div class="container mb-4" style="margin-left:-10px;">
                    <button type="button" class="btn btn-primary-yellow shadow-sm font-weight-bold pl-4 pr-4" data-toggle="modal" data-target="#alamatModal" style="border-radius:30px;"><i class="material-icons align-middle mr-2">location_on</i>Tambah Alamat Baru</button>
                </div>

                <div class="table-scrollbar pr-4">
                    <table id="table-wrapper" class="table table-hover" style="border-radius:25px 25px 15px 15px;">
                        <thead class="bg-primary-purple text-white">
                            <tr>
                                <th class="align-middle" scope="col">Nama Pengguna</th>
                                <th class="align-middle" scope="col">Alamat</th>
                                <th class="align-middle" scope="col">No. HP</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td class="align-middle" scope="row">Ilham Maulana Habibie</td>
                                    <td class="align-middle">Jl. Air Bersih Ujung, Medan Denai, Medan, Sumatera Utara (20228)</td>
                                    <td class="align-middle">+62831453435</td>
                                </tr>
                                <tr>
                                    <td class="align-middle" scope="row">Habibie</td>
                                    <td class="align-middle">Jl. Air Bersih, Medan Denai, Medan, Sumatera Utara (20228)</td>
                                    <td class="align-middle">+62831433435</td>
                                </tr>
                                <tr>
                                    <td class="align-middle" scope="row">Ilham</td>
                                    <td class="align-middle">Jl. Air Ujung, Medan Denai, Medan, Sumatera Utara (20228)</td>
                                    <td class="align-middle">+62831453435</td>
                                </tr>
                                <tr>
                                    <td class="align-middle" scope="row">Maulana</td>
                                    <td class="align-middle">Jl. Bersih Ujung, Medan Denai, Medan, Sumatera Utara (20228)</td>
                                    <td class="align-middle">+62831453435</td>
                                </tr>
                                <tr>
                                    <td class="align-middle" scope="row">Habib</td>
                                    <td class="align-middle">Jl. Air Bersih Ujung, Medan Denai, Medan, Sumatera Utara (20228)</td>
                                    <td class="align-middle">+62831453435</td>
                                </tr>
                                <tr>
                                    <td class="align-middle" scope="row">Habib</td>
                                    <td class="align-middle">Jl. Air Bersih Ujung, Medan Denai, Medan, Sumatera Utara (20228)</td>
                                    <td class="align-middle">+62831453435</td>
                                </tr>
                                <tr>
                                    <td class="align-middle" scope="row">Habib</td>
                                    <td class="align-middle">Jl. Air Bersih Ujung, Medan Denai, Medan, Sumatera Utara (20228)</td>
                                    <td class="align-middle">+62831453435</td>
                                </tr>
                                
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="alamatModal" tabindex="-1" role="dialog" aria-labelledby="alamatModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-body">
                            <div class="container mb-3">
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h1 id="alamatModalLabel" class="modal-title font-weight-bold ml-0 mb-5">Tambah Alamat Pengiriman</h1>

                                <div class="row">
                                    <div class="container col-6">
                                        <label class="font-weight-bold mb-2">Nama Penerima</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nama Penerima" 
                                            aria-label="Masukkan Nama Penerima" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                        <label class="font-weight-bold mb-2">Nomor HP</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nomor HP Penerima" 
                                            aria-label="Masukkan Nomor HP Penerima" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                        <label class="font-weight-bold mb-2">Provinsi</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Provinsi" 
                                            aria-label="Masukkan Provinsi" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                        <label class="font-weight-bold mb-2">Kabupaten / Kota</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nama Kabupaten / Kota" 
                                            aria-label="Masukkan Nama Kabupaten / Kota" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                    </div>
        
                                    <div class="container col-6">
                                        <label class="font-weight-bold mb-2">Kecamatan</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nama Kecamatan" 
                                            aria-label="Masukkan Nama Kecamatan" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                        <label class="font-weight-bold mb-2">Kelurahan</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nama Kelurahan" 
                                            aria-label="Masukkan Nama Kelurahan" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                        <label class="font-weight-bold mb-2">Kode Pos</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control pt-2 pb-2" placeholder="Masukkan Nama Penerima" 
                                            aria-label="Masukkan Nama Penerima" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                        <label class="font-weight-bold mb-2">Alamat</label>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" aria-label="Alamat"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="container text-right col-8 mr-0">
                                        <button type="button" class="btn btn-default font-weight-bold pl-4 pr-4" data-dismiss="modal" style="border-radius:30px; margin-right:-65px;">Batal</button>
                                    </div>
                                    <div class="container text-right col-auto">
                                        <button type="button" class="btn btn-primary-wakprint font-weight-bold pl-4 pr-4" style="border-radius:30px; margin-right:-65px;">Simpan</button>
                                    </div>
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

@section('footer')
        <footer>
            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-3">
                            <h4 id="judulLogoWakprint" class="font-weight-bold">WAKPRINT</h4>
                    </div>

                    <div class="col-3">
                            <h4 class="mb-4 font-weight-bold">Kontak</h4>
                            <p class="mb-2">+6281263638</p>
                            <p class="mb-2">dev@wakprint.com</p>
                                    
                    </div>

                    <div class="col-3">
                            <h4 class="mb-4 font-weight-bold">Informasi Umum</h4>
                            <p class="mb-2"><a class="text-dark" href="">Tentang Kami</a></p>
                            <p><a class="text-dark" href="#">Kebijakan Privasi</a></p>
                            <p><a class="text-dark" href="#">Syarat & Ketentuan</a></p>
                            <p><a class="text-dark" href="{{ url('/member/faq') }}">FAQ</a></p>
                    </div>

                    <div class="col-md-3">
                            <h4 class="font-weight-bold mb-3">Sosial Media</h4>
                            <div class="row justify-content-left mb-4">
                                <img src="{{url('instagram.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                                <img src="{{url('facebook.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                                <img src="{{url('youtube.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                                <img src="{{url('whatsapp.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                            </div>
                            <div class="" style="margin-left:-0px; margin-top:-10px">
                                <p>
                                    <i class="fa fa-copyright"> Copyright Wakprint 2020</i>
                                </p>
                            </div>
                    </div>
                </div>
            </div>
        </footer>
@endsection

