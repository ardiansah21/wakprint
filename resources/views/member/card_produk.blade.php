@php
    $member = Auth::user();
@endphp
<div class="card shadow cursor-pointer mb-2" style="border-radius: 10px;">
    {{-- <a class="text-decoration-none"
        href="{{ route('detail.produk', $p->id_produk) }}" style="color: black;"> --}}
        @if (!empty($p->jumlah_diskon))
            <div class="text-center" style="position: relative;">
                <div class="bg-promo"
                    style="position: absolute; top: 55%; left: 10%; width:75px; height:50px; border-radius:0px 0px 8px 8px;">
                    <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{ __('Promo') }}</label>
                </div>
            </div>
        @else
            <div class="text-center" style="position: relative;" hidden>
                <div class="bg-promo"
                    style="position: absolute; top: 55%; left: 10%; width:75px; height:50px; border-radius:0px 0px 8px 8px;">
                    <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{ __('Promo') }}</label>
                </div>
            </div>
        @endif
        <form id="favorit-form" action="{{ route('favorit.status', $p->id_produk) }}" method="POST">
            @csrf
            <input id="id_produk" name="id_produk" value="{{ $p->id_produk }}" hidden>
            @auth
                @if ($member->cekProdukFavorit($member->id_member, $p->id_produk))
                    <button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer text-danger"
                        style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>
                @else
                    <button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer"
                        style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>
                @endif
            @endauth
        </form>
        <input id="fotoProduk" type="text" value="{{ $p->foto_produk[0] }}" hidden>
        <img class="card-img-top cursor-pointer" src="{{ $p->foto_produk[0] }}"
            @if (request()->fromKonfigurasi == true && request()->fromTambahKonfigurasi == false)
                onclick="window.location.href='{{ route('detail.produk', [$p->id_produk, 'id_konfigurasi' => request()->id_konfigurasi, 'fromKonfigurasi' => 'true', 'fromTambahKonfigurasi' => 'false']) }}'"
            @else
                onclick="window.location.href='{{ route('detail.produk', $p->id_produk) }}'"
            @endif style="height: 180px; object-fit:cover; border-radius: 10px 10px 0px 0px;" alt="Terdapat Kesalahan Penampilan Foto"/>
        <div class="card-body cursor-pointer"
            @if (request()->fromKonfigurasi == true && request()->fromTambahKonfigurasi == false)
                onclick="window.location.href='{{ route('detail.produk', [$p->id_produk, 'id_konfigurasi' => request()->id_konfigurasi, 'fromKonfigurasi' => 'true', 'fromTambahKonfigurasi' => 'false']) }}'"
            @else
                onclick="window.location.href='{{ route('detail.produk', $p->id_produk) }}'"
            @endif>
            <div class="row justify-content-between">
                <label class="col-md-7 text-truncate ml-0"
                    style="font-size: 14px;">{{ $p->partner->nama_toko ?? '-' }}</label>
                <label class="col-md-auto card-text text-right mr-0" style="font-size: 14px;">
                    <i class="material-icons md-18 align-middle mr-0">location_on</i>
                    {{ __($p->partner->jarak / 1000 . ' km') }}
                </label>
            </div>
            <label class="card-title text-truncate-multiline font-weight-bold"
                style="font-size: 24px; min-height:75px;">{{ $p->nama ?? '' }}</label>
            <label class="card-text text-truncate-multiline"
                style="font-size: 18px; min-height:65px;">{{ $p->partner->alamat_toko }}</label>
            <div class="row justify-content-left ml-0 mr-0">
                <label class="card-text text-truncate SemiBold mr-2" style="font-size: 14px;"><i
                        class="material-icons md-18 align-middle mr-1">description</i>{{ $p->jenis_kertas ?? '' }}</label>
                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i
                        class="material-icons md-18 align-middle mr-1">print</i>{{ $p->jenis_printer ?? '' }}</label>
            </div>
        </div>
        <div class="card-footer card-footer-primary cursor-pointer"
            @if (request()->fromKonfigurasi == 'true' && request()->fromTambahKonfigurasi == 'false')
                onclick="window.location.href='{{ route('detail.produk', [$p->id_produk, 'fromKonfigurasi' => 'true', 'fromTambahKonfigurasi' => 'false']) }}'"
            @else
                onclick="window.location.href='{{ route('detail.produk', $p->id_produk) }}'"
            @endif
            style="border-radius: 0px 0px 10px 10px;">
            <div class="row justify-content-between ml-0 mr-0">
                <div>
                    @php
                        $jumlahDiskonGray = $p->harga_hitam_putih * $p->jumlah_diskon;
                        $jumlahDiskonWarna = $p->harga_berwarna * $p->jumlah_diskon;

                        if($jumlahDiskonGray > $p->maksimal_diskon){
                            $hargaHitamPutih = $p->harga_hitam_putih - $p->maksimal_diskon;
                            $hargaBerwarna = $p->harga_berwarna - $p->maksimal_diskon;
                        }
                        else{
                            $hargaHitamPutih = $p->harga_hitam_putih - $jumlahDiskonGray;
                            $hargaBerwarna = $p->harga_berwarna - $jumlahDiskonWarna;
                        }
                    @endphp
                    @if (!empty($p->harga_hitam_putih) && !empty($p->harga_berwarna) && !empty($p->jumlah_diskon))
                        <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 12px;">
                            <del>{{ rupiah($p->harga_hitam_putih) ?? '-' }}</del>
                        </label>
                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                            {{ rupiah($hargaHitamPutih) ?? '-' }}
                        </label>
                        <br>
                        <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 12px;">
                            <del>{{ rupiah($p->harga_berwarna) ?? '-' }}</del>
                        </label>
                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                            {{ rupiah($hargaBerwarna) ?? '-' }}
                        </label>
                    @elseif(!empty($p->harga_hitam_putih) && !empty($p->jumlah_diskon))
                        <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 12px;">
                            <del>{{ rupiah($p->harga_hitam_putih) ?? '-' }}</del>
                        </label>
                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                            {{ rupiah($hargaHitamPutih) ?? '-' }}
                        </label>
                        <br>
                        <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                            {{ __('Tidak Tersedia') }}
                        </label>
                    @elseif(!empty($p->harga_berwarna))
                        <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                            {{ rupiah($p->harga_hitam_putih) ?? '-' }}
                        </label>
                        <br>
                        <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                            {{ rupiah($p->harga_berwarna) ?? '-' }}
                        </label>
                    @else
                        <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                            {{ rupiah($p->harga_hitam_putih) ?? '-' }}
                        </label>
                        <br>
                        <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                            {{ __('Tidak Tersedia') }}
                        </label>
                    @endif
                </div>
                <div class="my-auto">
                    <label class="card-text mt-0 mr-0 SemiBold" style="font-size: 18px;">
                        <i class="material-icons md-24 align-middle mr-1" style="color: #FCFF82">star</i>
                        {{ $p->rating ?? '-' }}
                    </label>
                </div>
            </div>
        </div>
</div>
