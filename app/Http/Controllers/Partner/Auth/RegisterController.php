<?php

namespace App\Http\Controllers\Partner\Auth;

use App\Http\Controllers\Controller;
use App\Pengelola_Percetakan;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/partner';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegisterPage()
    {
        return view('pengelola.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pengelola_percetakan'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required|same:password',
            'nomor_hp' => ['required', 'string', 'min:11', 'max:12', 'unique:pengelola_percetakan'],
            'nama_bank' => ['required', 'string', 'max:100'],
            'nomor_rekening' => ['required', 'string', 'max:20'],
            'nama_toko' => ['required', 'string', 'max:150'],
            'deskripsi_toko' => ['required', 'string', 'max:255'],
            'alamat_toko' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\
     */
    protected function create(array $data)
    {
        return pengelola_percetakan::create([
            'nama_lengkap' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nomor_hp' => $data['nomor_hp'],
            'nama_bank' => $data['nama_bank'],
            'nomor_rekening' => $data['nomor_rekening'],
            'nama_toko' => $data['nama_toko'],
            'deskripsi_toko' => $data['deskripsi_toko'],
            'alamat_toko' => json_encode($data['alamat_toko']),
        ]);
    }

    protected function guard()
    {
        return Auth::guard('partner');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($partner = $this->create($request->all())));

        $this->guard()->login($partner);

        if (empty($this->guard()->user()->email_verified_at)) {
            alert()->info('Menunggu Konfirmasi', 'Akun Anda telah berhasil dibuat, silahkan tunggu verifikasi akun Anda dari Admin kami yah');
            return redirect()->back();
        }

        return $request->wantsJson()
        ? new Response('', 201)
        : redirect($this->redirectPath());
    }
}
