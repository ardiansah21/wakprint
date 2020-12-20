@extends('layouts.pengelola')

@section('content')
<div class="tab-pane fade show active" role="tabpanel">
    <div class="container card shadow-sm p-4">
        <span>
            <a class="close material-icons md-32" href="{{ route('partner.saldo') }}">
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
            {{$partner->nama_lengkap}}
        </label>
        <br>
        <label class="font-weight-bold mb-0 ml-1"
        style="font-size: 14px;">
            {{__('Nama Bank')}}
        </label>
        <br>
        <label class="mb-2 ml-1"
            style="font-size: 16px;">
            {{$partner->nama_bank}}
        </label>
        <br>
        <label class="font-weight-bold mb-0 ml-1"
        style="font-size: 14px;">
            {{__('Nomor Rekening')}}
        </label>
        <br>
        <label class="mb-2 ml-1"
            style="font-size: 16px;">
            {{$partner->nomor_rekening}}
        </label>
        <br>
        <label class="font-weight-bold mb-2 ml-1"
        style="font-size: 14px;">
            {{__('Jumlah Saldo yang Ditarik')}}
        </label>
        <br>
        <form action="{{ route('partner.saldo.tarik.store') }}" method="POST">
            @csrf
            <div class="row justify-content-between mb-2 ml-0">
                <label class="col-auto text-center mb-0 mr-0"
                    style="font-size: 16px;">
                    {{__('Rp.')}}
                </label>
                <div class="col-md-11 form-group mb-4">
                    <input type="text" name="jumlah_saldo" class="form-control form-control-lg border-primary-purple pt-2 pb-2" placeholder="300.000" aria-label="300.000" aria-describedby="inputGroup-sizing-sm"
                        oninput="this.value=formatRupiah(this.value,'')"
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
                    <button onclick="window.location.href='{{ route('partner.saldo') }}'"
                        class="btn btn-default btn-lg text-primary-purple SemiBold pl-5 pr-5 mb-0"
                        style="border-radius:30px;
                        font-size:18px;">
                        {{__('Batal')}}
                    </button>
                </div>
                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-0"
                        style="border-radius:30px;
                        font-size:18px;">
                        {{__('Konfirmasi')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
