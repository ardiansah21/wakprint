<div class="row jusify-content-between mb-3 mr-0">
    <div class="col-md-10">
        <div class="form-group search-input">
            <div class="main-search-input-item">
                <input type="text"
                    role="search"
                    class="form-control"
                    placeholder="Cari keluhan pelanggan disini..."
                    aria-label="Cari keluhan pelanggan disini"
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
    <div class="col-md-2">
        <div class="dropdown">
            <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                id="filterKeluhan"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                style="font-size: 16px;">
                {{__('Semua')}}
            </button>
            <div class="dropdown-menu"
                aria-labelledby="filterKeluhan"
                style="font-size: 16px;">
                <a class="dropdown-item"
                    href="#">
                    {{__('Terbaru')}}
                </a>
                <a class="dropdown-item"
                    href="#">
                    {{__('A-Z')}}
                </a>
                <a class="dropdown-item"
                    href="#">
                    {{__('Z-A')}}
                </a>
                <a class="dropdown-item"
                    href="#">
                    {{__('Pending')}}
                </a>
                <a class="dropdown-item"
                    href="#">
                    {{__('Tertanggapi')}}
                </a>
            </div>
        </div>
    </div>
</div>
<div class="table-scrollbar mb-5 pr-2">
    <table class="table table-hover">
        <thead class="bg-primary-purple text-white"
            style="border-radius:25px 25px 15px 15px;
                font-size:16px;">
            <tr>
                <th scope="col-md-auto">
                    {{__('ID')}}
                </th>
                <th scope="col-md-auto">
                    {{__('Nama')}}
                </th>
                <th scope="col-md-auto">
                    {{__('Keluhan')}}
                </th>
                <th scope="col-md-auto">
                    {{__('Status')}}
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody style="font-size: 12px;">

            {{-- @foreach ($collection as $item) --}}
                <tr>

                    {{-- @foreach ($collection as $item) --}}
                        <td scope="row">
                            {{__('000001')}}
                        </td>
                        <td>
                            {{__('Agus')}}
                        </td>
                        <td>
                            {{__('Cemananya ini bla bla bla bla')}}
                        </td>
                        <td>
                            {{__('Pending')}}
                        </td>
                        <td>
                            <a href=""
                                data-toggle="modal"
                                data-target="#keluhanModal">
                                <i class="material-icons"
                                    style="color: #BC41BE;">
                                    play_circle_filled
                                </i>
                            </a>
                        </td>
                    {{-- @endforeach --}}
                    
                </tr>
            {{-- @endforeach --}}

        </tbody>
    </table>
</div>
@include('admin.tanggapi_keluhan')
