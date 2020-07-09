<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.pengelola.navbar_after_pengelola')
@endsection

@section('konten')
    <div class="container-fluid mt-4">
        <div class="container" style="margin-top: 120px;">
            <h1 class="font-weight-bold mb-5">Pesanan Masuk</h1>
            <div class="row mb-5">
                <div class="col border-primary-purple mr-5" style="height:500px; border-radius:10px;">
                    <div class="my-custom-scrollbar-pesanan-masuk-1 p-4">

                        {{-- @foreach ($collection as $item) --}}
                            <div class="row">
                                <div class="col-7">
                                    @include('card_produk')
                                </div>

                                <div class="col">
                                    <div class="container mb-3">
                                        <button type="button" class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px;">Lihat</button>
                                    </div>

                                    <div class="container mb-4">
                                        <button type="button" class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-2" style="border-radius:30px;">Cetak</button>
                                    </div>
                                </div>
                            </div>
                        {{-- @endforeach --}}

                    </div>

                </div>

                <div class="col border-primary-purple ml-5" style="height:500px; border-radius:10px;">
                    <div class="my-custom-scrollbar-pesanan-masuk-2">
                        <div class="container p-3">
                            <p class="font-weight-bold mb-1">Waktu Pemesanan</p>
                            <p class=" mr-3 mb-4">04:25 &nbsp; 17 Agustus 2020 </p>

                            <p class="font-weight-bold mb-1">Nama Pemesan</p>
                            <p class=" mr-3 mb-4">Tobey Maguire </p>

                            <p class="font-weight-bold mb-1">No Hp Pemesan</p>
                            <p class=" mr-3 mb-4">+62 821 7635 8392</p>

                            <p class="font-weight-bold mb-1">Jumlah Dokumen</p>
                            <p class=" mr-3 mb-4">2</p>

                            <p class="font-weight-bold mb-1">Metode Penerimaan</p>
                            <p class=" mr-3 mb-4">Diantar ke Tempat</p>

                            <div class="mb-4">
                                <p class="font-weight-bold mr-3 mb-2">Warna Halaman</p>

                                {{-- @foreach ($collection as $item) --}}
                                    <p class="mr-3 mb-0">(Skripsilagee.pdf)</p>
                                    <div class="row justify-content-between ml-0 mb-0 mr-0">
                                        <p class="mb-0" style="font-size: 12px;">25 Halaman Hitam-Putih</p>
                                        <p class="font-weight-bold mb-0" style="font-size: 12px;">x Rp. 2k / hal</p>
                                    </div>
                                    <div class="row justify-content-between ml-0 mb-0 mr-0">
                                        <p class="mb-0" style="font-size: 12px;">25 Halaman Berwarna</p>
                                        <p class="font-weight-bold mb-0" style="font-size: 12px;">x Rp. 3k / hal</p>
                                    </div>
                                {{-- @endforeach --}}
                                
                            </div>

                            <div class="mb-4">
                                <p class="font-weight-bold mb-1">Halaman yang Dicetak</p>

                                {{-- @foreach ($collection as $item) --}}
                                    <div class="row justify-content-between ml-0 mb-0">
                                        <p class="mr-3 mb-0">(Skripsilagee.pdf)</p>
                                        <p class="font-weight-bold mr-3 mb-0">Semua Halaman</p>
                                    </div>
                                {{-- @endforeach --}}

                            </div>
                            
                            <div class="mb-4">
                                <p class="font-weight-bold mr-3 mb-1">Jumlah Salinan</p>

                                {{-- @foreach ($collection as $item) --}}
                                    <div class="row justify-content-between ml-0 mb-0">
                                        <p class="mr-3 mb-0">(Skripsilagee.pdf)</p>
                                        <p class="font-weight-bold mr-3 mb-0">2</p>
                                    </div>
                                {{-- @endforeach --}}

                            </div>
                            
                            <div class="mb-4">
                                <p class="font-weight-bold mb-1">Cetak</p>

                                {{-- @foreach ($collection as $item) --}}
                                    <div class="row justify-content-between ml-0 mb-0">
                                        <p class="mr-3 mb-0">(Skripsilagee.pdf)</p>
                                        <p class="font-weight-bold mr-3 mb-0">Satu Sisi</p>
                                    </div>
                                {{-- @endforeach --}}

                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="row justify-content-between bg-light-purple pl-3 pr-3 pt-2 pb-2 mb-5" style="border-radius:0px 0px 10px 10px;">
                            <div class="col-auto" style="border-radius:5px;">
                                <p class="font-weight-bold mr-3 mb-1">Jumlah Biaya</p>
                                <p class="mr-3">Rp. 20.000</p>
                            </div>

                            <div class="col text-right align-self-center">
                                <div class="container">
                                    <button type="button" class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                                    data-toggle="modal" data-target="#detailBiayaModal"
                                    style="border-radius:30px; margin-right:0px;">Detail Biaya</button>
                                </div>
                            </div>
                    </div>

                </div>
                        
            </div>

            <div class="row justify-content-between">
                            
                <div class="container col text-right">
                    <div class="container mb-3">
                        <button type="button" class="btn btn-default text-primary-purple font-weight-bold pl-5 pr-5 mb-0"
                        data-toggle="modal" data-target="#tolakPesananModal"
                        style="border-radius:30px; margin-right:0px;">Tolak</button>
                    </div>
                </div>

                <div class="container col-auto text-right">
                    <div class="container mb-3">
                        <button type="button" class="btn btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0"
                        onclick="window.location='{{ url('/pengelola/pesanan') }}'"
                        style="border-radius:30px; margin-right:-30px;">Terima</button>
                    </div>
                </div>
            </div>
            
            {{-- pop up detail biaya --}}
            <div class="modal fade" id="detailBiayaModal" tabindex="-1" role="dialog" aria-labelledby="detailBiayaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-body bg-light-purple">
                        <div class="container p-4">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <h1 class="font-weight-bold mb-4">Rincian Harga</h1>
        
                            <div class="row justify-content-between">
                                <div class="col text-left">
                                    <label class="mb-2">Jumlah File Pesanan</label><br>
                                    <label class="mb-2">Total Produk Pesanan</label>
                                </div>
                                <div class="col text-right">
                                    <p class="mb-2">2</p>
                                    <p class="mb-2">2</p>
                                </div>
                            </div>
        
                            <div class="row row-bordered mt-2 mb-4">
                            </div>
        
                            {{-- @foreach ($collection as $item) --}}
                            <p class="font-weight-bold mt-2 mb-3">Cetak Skripsi Mahasiswa</p>
                            <p class="font-weight-bold mb-2">Skripsi.pdf</p>
                            <div class="row justify-content-between">
                                <div class="col-6 text-left">
                                    <p>25 Halaman Hitam-Putih</p>
                                </div>
                                <div class="col-6 text-right">
                                    <p>Rp. 10.000</p>
                                </div>
                            </div>
        
                            <div class="row justify-content-between">
                                <div class="col-6 text-left">
                                    <p>25 Halaman Berwarna</p>
                                </div>
                                <div class="col-6 text-right">
                                    <p>Rp. 15.000</p>
                                </div>
                            </div>
        
                            <div class="row justify-content-between">
                                <div class="col-6 text-left">
                                    <p>Timbal Balik</p>
                                </div>
                                <div class="col-6 text-right">
                                    <p>Rp. 5.000</p>
                                </div>
                            </div>
        
                            <div class="row justify-content-between mb-2">
                                <div class="col-6 text-left">
                                    <p>Jumlah Salinan</p>
                                </div>
                                <div class="col-6 text-right">
                                    <p>1</p>
                                </div>
                            </div>
        
                            <p class="font-weight-bold mt-2 mb-2">Fitur Tambahan</p>
        
                            {{-- @foreach ($collection as $item) --}}
                            <div class="row justify-content-between mb-2">
                                <div class="col-6 text-left">
                                    <p>Paket Jilid Lakban Hitam</p>
                                </div>
                                <div class="col-6 text-right">
                                    <p>Rp. 10.000</p>
                                </div>
                            </div>
                            {{-- @endforeach --}}
        
                            <div class="row row-bordered mt-2 mb-4">
                            </div>
        
                            {{-- @endforeach --}}
        
                            <p class="font-weight-bold mb-2">ATK</p>
        
                            {{-- @foreach ($collection as $item) --}}
                            <div class="row justify-content-between">
                                <div class="col-6 text-left">
                                    <p>Pensil (x4)</p>
                                </div>
                                <div class="col-6 text-right">
                                    <p>Rp. 2.000</p>
                                </div>
                            </div>
                            {{-- @endforeach --}}
        
                            <p class="font-weight-bold mt-3 mb-2">Biaya Pengiriman</p>
                            <div class="row justify-content-between mb-2">
                                <div class="col-6 text-left">
                                    <p>Diantar ke Tempat</p>
                                </div>
                                <div class="col-6 text-right">
                                    <p>Rp. 10.000</p>
                                </div>
                            </div>
        
                            <div class="row row-bordered">
                            </div>
        
                            <div class="row justify-content-between font-weight-bold mt-2">
                                <div class="container col-6 text-left">
                                    <p>Total Harga Pesanan</p>
                                </div>
                                <div class="container col-6 text-right">
                                    <p>Rp. 20.000</p>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                
            </div>

            {{-- pop up tolak --}}
            <div class="modal fade" id="tolakPesananModal" tabindex="-1" role="dialog" aria-labelledby="tolakPesananModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="container mt-4">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h1 class="font-weight-bold ml-0 mb-5">Alasan Penolakan</h1>
                            
                            <label class="font-weight-bold mb-2">Isi Sendiri</label>
                            <div class="input-group mb-4">
                                <textarea type="text" class="form-control pt-2 pb-2"></textarea>
                            </div>
                
                            <div class="row justify-content-between">
                                            
                                <div class="container col text-right">
                                    <div class="container mb-3">
                                        <button type="button" class="btn btn-default text-primary-purple font-weight-bold pl-5 pr-5 mb-0"
                                        data-dismiss="modal" aria-label="Close"
                                        style="border-radius:30px; margin-right:0px;">Batal</button>
                                    </div>
                                </div>
                
                                <div class="container col-auto text-right">
                                    <div class="container mb-3">
                                        <button type="button" class="btn btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px; margin-right:-20px;">Kirim</button>
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
