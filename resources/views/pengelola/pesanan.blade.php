<div class="row justify-content-between mb-3">
    <div class="col-md-10">
        <div class="form-group search-input">
            <div class="main-search-input-item">
                <input type="text"
                    role="search"
                    class="form-control"
                    placeholder="Cari pesanan anda disini..."
                    aria-label="Cari percetakan atau produk disini"
                    aria-describedby="basic-addon2"
                    style="border:0px solid white;
                        border-radius:30px;
                        font-size:16px;">
                    <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                        style="position: absolute;
                            top: 50%; left: 95%;
                            transform: translate(-50%, -50%);
                            -ms-transform: translate(-50%, -50%);">
                        search
                    </i>
            </div>
        </div>
    </div>
    <div class="col-md-2 mr-0">
        <div class="form-group dropdown">
            <button class="btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" 
                id="filter-pesanan"
                data-toggle="dropdown" 
                aria-haspopup="true"
                aria-expanded="false"
                style="font-size: 16px;">
                {{__('Semua')}}
            </button>
            <div class="dropdown-menu"
                aria-labelledby="filter-pesanan"
                style="font-size: 16px;">
                <a class="dropdown-item"
                    href="#">
                    {{__('Terbaru')}}
                </a>
                <a class="dropdown-item"
                    href="#">
                    {{__('Harga Tertinggi')}}
                </a>
                <a class="dropdown-item"
                    href="#">
                    {{__('Harga Terendah')}}
                </a>
            </div>
        </div>
    </div>
</div>
<div class="table-scrollbar mb-5 mr-0 pr-2">
    <table class="table table-hover">
        <thead class="bg-primary-purple text-white"
            style="border-radius:25px 25px 15px 15px;">
            <tr style="font-size: 16px;">
                <th scope="col-md-auto">{{__('No')}}</th>
                <th scope="col-md-auto">{{__('Waktu')}}</th>
                <th scope="col-md-auto">{{__('Tanggal')}}</th>
                <th scope="col-md-auto">{{__('Jumlah Dokumen')}}</th>
                <th scope="col-md-auto">{{__('Pengambilan')}}</th>
                <th scope="col-md-auto">{{__('Status')}}</th>
            </tr>
        </thead>
        <tbody style="font-size: 12px;">

            {{-- @foreach ($collection as $item) --}}
                <tr onclick="window.location.href='{{ route('partner.detail.pesanan') }}'">

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