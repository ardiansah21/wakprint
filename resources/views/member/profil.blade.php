@extends('layouts.member')

@section('content')
    @php
    use Carbon\Carbon;
    @endphp
    <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
        <div class="row justify-content-between mb-2 ml-0 mr-0">
            <div class="">
                <label class="font-weight-bold" style="font-size: 48px;">
                    {{ __('Profil Saya') }}
                </label>
            </div>
            <div class="my-auto">
                <a class="align-self-center text-right text-primary-purple" href="{{ route('profile.edit') }}"
                    style="font-size: 18px;">
                    {{ __('Ubah Profil') }}
                </a>
            </div>
        </div>
        <table class="table borderless align-middle mb-5" style="font-size: 24px;
                        table-layout: fixed;
                        word-wrap: break-word;
                        border-collapse: separate;
                        border-spacing: 0 0em;">
            <tbody class="ml-0 mr-0">
                <tr class="mb-0">
                    <td class="SemiBold">
                        {{ __('Nama Lengkap') }}
                    </td>
                    <td>
                        {{ $member->nama_lengkap }}
                    </td>
                </tr>
                <tr>
                    <td class="SemiBold">
                        {{ __('Tanggal Lahir') }}
                    </td>
                    <td>
                        {{ $tanggalLahir }}
                    </td>
                </tr>
                <tr>
                    <td class="SemiBold">
                        {{ __('Jenis Kelamin') }}
                    </td>
                    <td>
                        @if ($member->jenis_kelamin === 'L')
                            {{ __('Laki-Laki') }}
                        @elseif ($member->jenis_kelamin === 'P')
                            {{ __('Perempuan') }}
                        @else
                            {{ __('-') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="SemiBold">
                        {{ __('Email') }}
                    </td>
                    <td class="row justify-content-left ml-0">
                        @if (!empty($member->email_verified_at))
                            <label class="text-truncate" style="font-size: 24px;">
                                {{ $member->email }}
                            </label>
                        @else
                            <a class="col-md-9 p-0 text-danger text-truncate" style="font-size: 24px;"
                                href="#">{{ $member->email }}
                            </a>
                            <a class="col-md-2 text-danger align-self-center" style="font-size: 24px;" href="#">
                                <i class="fa fa-warning ml-2"></i>
                            </a>
                        @endif

                    </td>
                </tr>
                <tr>
                    <td class="SemiBold">
                        {{ __('Nomor HP') }}
                    </td>
                    <td>
                        {{ $member->nomor_hp }}
                    </td>
                </tr>
            </tbody>
        </table>
        <h1 class="font-weight-bold mb-5 ml-2" style="font-size: 48px;">{{__('Konfigurasi Terakhir') }}</h1>
        <div class="table-scrollbar mb-5 ml-0 pr-2">
            <table class="table table-hover" style="border-radius:25px 25px 15px 15px;">
                <thead class="bg-primary-purple text-white">
                    <tr style="font-size: 18px;">
                        <th scope="col-md-auto">{{__('ID') }}</th>
                        <th scope="col-md-auto">{{__('Tanggal') }}</th>
                        <th scope="col-md-auto">{{__('Total File') }}</th>
                        <th scope="col-md-auto">{{__('Metode') }}</th>
                        <th scope="col-md-auto">{{__('Biaya') }}</th>
                        <th scope="col-md-auto">{{__('Status') }}</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14px;">
                    @if (!empty($pesanan))
                        @foreach ($pesanan as $p)
                            @if (!empty($p->status))
                                <tr class="cursor-pointer" onclick="window.location.href='{{ route('konfirmasi.pembayaran',$p->id_pesanan) }}'">
                                    <td scope="row">{{$p->id_pesanan}}</td>
                                    <td>{{Carbon::parse($p->updated_at)->translatedFormat('d F Y')}}</td>
                                    <td>{{count($p->konfigurasiFile)}}</td>
                                    <td>
                                        @if ($p->metode_penerimaan != "Ditempat")
                                            {{__('Antar ke Rumah')}}
                                        @else
                                            {{__('Ambil di Tempat')}}
                                        @endif
                                    </td>
                                    <td>{{rupiah($p->biaya)}}</td>
                                    <td>{{$p->status}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        {{-- <div class="table-scrollbar mb-5 mr-0">
            <table class="table table-hover" style="border-radius:25px 25px 15px 15px;">
                <thead class="bg-primary-purple text-white" style="font-size: 18px;">
                    <tr>
                        <th scope="col-md-auto">{{ __('ID') }}</th>
                        <th scope="col-md-auto">{{ __('File') }}</th>
                        <th scope="col-md-auto">{{ __('Kapan') }}</th>
                        <th scope="col-md-auto">{{ __('Biaya') }}</th>
                        <th scope="col-md-auto">{{ __('Sisa Waktu') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($konfigurasi as $k => $value)
                        @if (!empty($value) && $value->id_member === $member->id_member)
                            <tr style="font-size: 14px;">
                                <td scope="row">{{ $value->id_konfigurasi }}</td>
                                <td><a href="#">{{ $value->nama_file }}</a></td>
                                <td>{{ date('l, d M Y H:i', strtotime($value->waktu)) }}</td>
                                <td>Rp. {{ $value->biaya }}</td>
                                <td @for ($i = 0; $i < count($arrKonfigurasi); $i++)
                                    id="sisaWaktuBayar{{ $i }}"
                        @endfor
                        >{{ __('1h 5m') }}
                        <span class="material-icons md-18 align-middle text-danger ml-2">
                            delete
                        </span>
                        </td>
                        </tr>
                    @endif
                    @endforeach
                    <input id="arrKonfigurasi" type="number" value="{{ count($arrKonfigurasi) }}" hidden>
                </tbody>
            </table>
        </div> --}}
        <script>
            var msg = '{{ Session::get('
            alert ') }}';
            var exist = '{{ Session::has('
            alert ') }}';
            if (exist) {
                alert(msg);
            }

            function startTimer(duration, display) {
                var timer = duration,
                    minutes, seconds;
                setInterval(function() {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "" + minutes : minutes;
                    seconds = seconds < 10 ? "" + seconds : seconds;

                    display.textContent = minutes + "m" + " " + seconds + "s";

                    if (--timer < 0) {
                        timer = 0;
                    }
                }, 1000);
            }

            function countDownTimer(timeLeft) {
                // Set the date we're counting down to
                var countDownDate = new Date(timeLeft).getTime();

                // Update the count down every 1 second
                var x = setInterval(function() {

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in the element with id="demo"
                    for (i = 0; i < $('#arrKonfigurasi').val(); i++) {
                        document.getElementById("sisaWaktuBayar" + i).innerHTML = days + "d " + hours + "h " +
                            minutes + "m " + seconds + "s ";
                    }

                    // If the count down is finished, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("sisaWaktuBayar" + 0).innerHTML = "Sisa Waktu Anda Telah Habis";
                        // for (i = 0; i < $('#arrKonfigurasi').val(); i++) {

                        // }
                    }
                }, 1000);
            }

            window.onload = function() {
                // var timeLeft = "Nov 4, 2020 20:03:00";
                // countDownTimer(timeLeft);
                // var display = document.querySelector('#sisaWaktuBayar');
                // for (i = 0; i < $('#arrKonfigurasi').val(); i++) {
                //     var fiveMinutes = 60 * 30;
                //     var display = document.querySelector('#sisaWaktuBayar' + i);
                //     startTimer(fiveMinutes, display);
                //     // console.log(i);
                // }
            };

        </script>
    </div>

@endsection
