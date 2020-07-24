<div class="row jusify-content-between mb-3 mr-0">
    <div class="col-md-10">
        <div class="form-group search-input">
            <div class="main-search-input-item">
                <input type="text"
                    role="search"
                    class="form-control"
                    placeholder="Cari data saldo disini..."
                    aria-label="Cari data saldo disini"
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
                id="filterDataSaldo"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                style="font-size: 16px;">
                {{__('Semua')}}
            </button>
            <div class="dropdown-menu"
                aria-labelledby="filterDataSaldo"
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
                    {{__('Jumlah Tertinggi')}}
                </a>
                <a class="dropdown-item"
                    href="#">
                    {{__('Jumlah Terendah')}}
                </a>
                <a class="dropdown-item"
                    href="#">
                    {{__('Pending')}}
                </a>
                <a class="dropdown-item"
                    href="#">
                    {{__('Berhasil')}}
                </a>
                <a class="dropdown-item"
                    href="#">
                    {{__('Gagal')}}
                </a>
            </div>
        </div>
    </div>
</div>
<div class="ml-0 mr-0">
    <ul class="nav nav-pills mb-3"
        id="pills-tab"
        role="tablist"
        style="font-size: 16px;">
        <li class="nav-item mr-3">
            <a class="nav-link active"
                id="pills-saldo-member-tab"
                data-toggle="tab"
                href="#pills-saldo-member"
                role="tab"
                aria-controls="pills-saldo-member"
                aria-selected="true"
                style="border-radius:10px 10px 0px 0px;">
                <i class="material-icons align-middle mr-2">
                    account_circle
                </i>
                {{__('Member')}}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
                id="pills-saldo-pengelola-tab"
                data-toggle="tab"
                href="#pills-saldo-pengelola"
                role="tab" 
                aria-controls="pills-saldo-pengelola"
                aria-selected="false"
                style="border-radius:10px 10px 0px 0px;">
                <i class="material-icons align-middle mr-2">
                    print
                </i>
                {{__('Pengelola Percetakan')}}
            </a>
        </li>
    </ul>
    <div class="tab-content ml-0 mr-0"
        id="pills-tabContent">
        <div class="tab-pane fade show active"
            id="pills-saldo-member"
            role="tabpanel"
            aria-labelledby="pills-saldo-member-tab">
            <div class="my-custom-scrollbar">
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
                                    {{__('Kode Pembayaran')}}
                                </th>
                                <th scope="col-md-auto">
                                    {{__('Jumlah Top Up')}}
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
                                            {{__('329842617')}}
                                        </td>
                                        <td>
                                            {{__('Rp. 20.000')}}
                                        </td>
                                        <td>
                                            {{__('Pending')}}
                                        </td>
                                        <td>
                                            <a href="">
                                                <i class="material-icons"
                                                    style="color: #7BD6AF;">
                                                    check_circle
                                                </i>
                                            </a>
                                            <a href="" data-toggle="modal"
                                                data-target="#tolakModal">
                                                <i class="material-icons"
                                                    style="color: #FF4949;">
                                                    cancel
                                                </i>
                                            </a>
                                        </td>
                                    {{-- @endforeach --}}
                                    
                                </tr>
                            {{-- @endforeach --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade"
            id="pills-saldo-pengelola"
            role="tabpanel"
            aria-labelledby="pills-saldo-pengelola-tab">
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
                                {{__('Jumlah Penarikan')}}
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
                                        {{__('Rp. 20.000')}}
                                    </td>
                                    <td>
                                        {{__('Pending')}}
                                    </td>
                                    <td>
                                        <a href="">
                                            <i class="material-icons"
                                                style="color: #7BD6AF;">
                                                check_circle
                                            </i>
                                        </a>
                                        <a href="" data-toggle="modal"
                                            data-target="#tolakModal">
                                            <i class="material-icons"
                                                style="color: #FF4949;">
                                                cancel
                                            </i>
                                        </a>
                                    </td>
                                {{-- @endforeach --}}
                                
                            </tr>
                        {{-- @endforeach --}}

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.tolak_pengelola')