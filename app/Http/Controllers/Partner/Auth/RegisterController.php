<?php

namespace App\Http\Controllers\Partner\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Pengelola_Percetakan;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



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
            'nomor_hp' => "asdasd",
            'nama_bank' => "tes",
            'nomor_rekening' => "tes",
            'nama_toko' => "tes",
            'alamat_toko' => json_encode("tess"),
            'url_google_maps' => "tes",
            'status_toko' => 'Buka',
            'url_google_maps' => "tes",
            'url_google_maps' => "tes",
        ]);

        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
    }

    protected function guard() 
    {
        return Auth::guard('partner');
    }

    // public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();

    //     event(new Registered($partner = $this->create($request->all())));

    //     $this->guard()->login($partner);
        
    //     // if ($response = $this->registered($request, $user)) {
    //     //     return $response;
    //     // }

    //     return $request->wantsJson()
    //                 ? new Response('', 201)
    //                 : redirect($this->redirectPath());
    // }
}
