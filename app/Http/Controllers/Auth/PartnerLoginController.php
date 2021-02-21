<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Pengelola_Percetakan;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class PartnerLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'partner';
    protected $redirectTo = '/partner/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.partner_login');
    }

    public function guard()
    {
        return auth()->guard('partner');
    }

    public function showRegisterPage()
    {
        return view('auth.partner_register');
    }

    public function register(Request $request)
    {
        Pengelola_Percetakan::create([
            'nama_lengkap' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('partner.login')->with('success', 'Registration Success');
    }

    public function login(Request $request)
    {
        if (auth()->guard('partner')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('partner.home');
        }

        return back()->withErrors(['email' => 'Email or password are wrong.'])->onlyInput('email');
    }

}
