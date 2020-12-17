@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card shadow col-md-6 mx-auto pt-4 pl-4 pr-4 mt-5 mb-5"
            style="border-radius: 10px;">
            <label class="font-weight-bold text-primary-purple text-center mb-4"
                style="font-size: 48px;">
                {{__('ADMIN')}}
            </label>
            <form method="POST"
                action="{{ route('admin.login') }}"
                style="font-size: 18px;">
                {{-- @csrf --}}
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email"
                        class="">
                        {{ __('Email') }}
                    </label>
                    <div>
                        <input id="email"
                            type="email"
                            class="form-control form-control-lg mb-3
                            @error('email')
                            is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus>
                        @error('email')
                        <span class="invalid-feedback"
                            role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="password"
                        class="">
                        {{ __('Password') }}
                    </label>
                    <div class="input-group">
                        <input id="password"
                            type="password"
                            class="form-control form-control-lg
                            @error('password')
                            is-invalid
                            @enderror"
                            name="password"
                            required
                            autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback"
                                role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="input-group-append">
                                <span class="input-group-text bg-white"
                                    style="border-radius: 0px 5px 5px 0px;">
                                    <i id="togglePassword"
                                        toggle="#password-field"
                                        class="fa fa-fw fa-eye field_icon toggle-password">
                                    </i>
                                </span>
                            </div>
                    </div>
                </div>
                <div class="form-group mb-4 mt-4">
                    <button type="submit"class="btn btn-primary-wakprint btn-block SemiBold"
                        style="font-size: 22px;">
                        {{ __('Masuk') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script>
        $("body").on('click', '.toggle-password', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#password");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endsection
