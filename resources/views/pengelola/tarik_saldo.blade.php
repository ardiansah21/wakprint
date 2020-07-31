@extends('layouts.pengelola')

@section('content')

<div class="tab-pane fade" id="v-pills-beranda" role="tabpanel">
    <div class="row justify-content-between mb-5 ml-0 mr-0">
        <div class="col-md-3 bg-light-purple p-4 text-center" style="border-radius:10px;">
            <label class="font-weight-bold text-break text-truncate" style="font-size: 48px;
                                        width:100%;">
                {{__('43')}}
            </label>
            <br>
            <label class="font-weight-bold" style="font-size: 18px;
                                    width:100%;">
                {{__('Total Pesanan')}}
            </label>
        </div>
        <div class=" col-md-4 bg-light-purple p-4 text-center" style="border-radius:10px;">
            <label class="font-weight-bold text-break text-truncate" style="font-size: 48px;
                                width:100%;">
                {{__('30')}}
            </label>
            <br>
            <label class="font-weight-bold text-break text-truncate" style="font-size: 18px;
                                width:100%;">
                {{__('Total Pelanggan')}}
            </label>
        </div>

        <div class="col-md-4 bg-light-purple p-4 text-center" style="border-radius:10px;">
            <label class="font-weight-bold text-break text-truncate" style="font-size: 48px;
                                    width:100%;">
                {{__('4.5')}}
            </label>
            <br>
            <label class="font-weight-bold text-break" style="font-size: 18px;
                                    width:100%;">
                {{__('Rating Tempat Percetakan')}}
            </label>
        </div>
    </div>
    <label class="font-weight-bold mb-4 ml-0 mr-0" style="font-size: 36px;">
        {{__('Pesanan Masuk')}}
    </label>
    <div class="table-scrollbar mb-5 ml-0 mr-0">
        <table class="table table-hover">
            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;
                                    font-size:16px;">
                <tr>
                    <th scope="col-md-auto">{{__('No')}}</th>
                    <th scope="col-md-auto">{{__('Waktu')}}</th>
                    <th scope="col-md-auto">{{__('Tanggal')}}</th>
                    <th scope="col-md-auto">{{__('Jumlah Dokumen')}}</th>
                    <th scope="col-md-auto">{{__('Pengambilan')}}</th>
                    <th scope="col-md-auto">{{__('Status')}}</th>
                </tr>
            </thead>
            <tbody style="font-size:12px;">

                {{-- @foreach ($collection as $item) --}}
                <tr>

                    {{-- @foreach ($collection as $item) --}}
                    <td scope="row">{{__('1')}}</td>
                    <td>{{__('09:34')}}</td>
                    <td>{{__('5/7/2020')}}</td>
                    <td>{{__('2')}}</td>
                    <td>{{__('Ambil Sendiri')}}</td>
                    <td>{{__('Pending')}}</td>
                    {{-- @endforeach --}}

                </tr>
                {{-- @endforeach --}}

            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane fade show active" role="tabpanel">
    <div class="container card shadow-sm p-4">
        <span>
            <a class="close material-icons md-32" href="{{ route('partner.home') }}">
                close
            </a>
            <label class="font-weight-bold ml-0 mb-5"
                style="font-size: 36px;">
                {{__('Tarik Saldo')}}
            </label>
        </span>
        <br>
        <label class="font-weight-bold mb-0 ml-1"
        style="font-size: 14px;">
            {{__('Nama Pemilik Rekening')}}
        </label>
        <br>
        <label class="mb-2 ml-1"
            style="font-size: 16px;">
            {{__('Agus')}}
        </label>
        <br>
        <label class="font-weight-bold mb-0 ml-1"
        style="font-size: 14px;">
            {{__('Nama Bank')}}
        </label>
        <br>
        <label class="mb-2 ml-1"
            style="font-size: 16px;">
            {{__('BRI')}}
        </label>
        <br>
        <label class="font-weight-bold mb-0 ml-1"
        style="font-size: 14px;">
            {{__('Nomor Rekening')}}
        </label>
        <br>
        <label class="mb-2 ml-1"
            style="font-size: 16px;">
            {{__('016748359004048')}}
        </label>
        <br>
        <label class="font-weight-bold mb-2 ml-1"
        style="font-size: 14px;">
            {{__('Jumlah Saldo yang Ditarik')}}
        </label>
        <br>
        <form>
            <div class="row justify-content-between mb-2 ml-0">
                <label class="col-auto text-center mb-0 mr-0"
                    style="font-size: 16px;">
                    {{__('Rp.')}}
                </label>
                <div class="col-md-11 form-group mb-4">
                    <input type="text"
                        class="form-control form-control-lg border-primary-purple pt-2 pb-2"
                        placeholder="300.000" 
                        aria-label="300.000"
                        aria-describedby="inputGroup-sizing-sm"
                        style="font-size: 16px;">
                </div>
            </div>
            <div class="container bg-light-purple ml-0 mb-5"
                style="height:200px; 
                    border-radius:10px;">
                <div class="short-scrollbar">
                    <div class="p-3">
                        <label class="SemiBold mb-4"
                            style="font-size:24px;">
                            {{__('Info Tarik Saldo, Syarat, dan Ketentuan')}}
                        </label>
                        <p class=" mr-3 mb-4"
                            style="font-size:16px;">
                            {{__('Ini adalah halaman informasi untuk penarikan saldo serta syarat juga ketentuan apa saja yang harus di miliki oleh si penarik saldo. 
                            Silahkan perhatikan baik baik apa saja yang harus diperhatikan pada syarat.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, assumenda nostrum explicabo numquam eius cupiditate ducimus illo optio deserunt pariatur quod, magni necessitatibus fugiat, fugit ad unde qui quo sed!
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde consequatur quae expedita soluta repellat, libero itaque saepe alias sed sapiente totam, nobis minus deleniti natus, laboriosam molestiae eaque odit accusantium.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae autem sapiente cumque iusto at iure aliquam fuga, et repellat similique earum libero nulla voluptate distinctio. Temporibus labore ipsam provident est!')}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end ml-0 mr-0 mb-3">
                <div class="form-group mr-3">
                    <button class="btn btn-default btn-lg text-primary-purple SemiBold pl-5 pr-5 mb-0"
                    style="border-radius:30px;
                        font-size:18px;">
                        {{__('Batal')}}
                    </button>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-0"
                        style="border-radius:30px;
                        font-size:18px;">
                        {{__('Konfirmasi')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="tab-pane fade ml-0 mr-0" id="v-pills-pesanan" role="tabpanel">
    @include('pengelola.pesanan')
</div>
<div class="tab-pane fade" id="v-pills-saldo" role="tabpanel">
    @include('pengelola.saldo')
</div>
<div class="tab-pane fade" id="v-pills-produk" role="tabpanel">
    @include('pengelola.produk')
</div>
<div class="tab-pane fade" id="v-pills-promo" role="tabpanel">
    @include('pengelola.promo')
</div>
<div class="tab-pane fade" id="v-pills-atk" role="tabpanel">
    @include('pengelola.atk')
</div>
<div class="tab-pane fade" id="v-pills-info" role="tabpanel">
    @include('pengelola.info_bantuan')
</div>

@endsection
