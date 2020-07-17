<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \stdClass;

class MemberController extends Controller
{
    private $member;
    public function __construct() {
        $this->member= new StdClass();
        $this->member->id_member = "123456789";
    }

    public function profil()
    {
        return view('member.profil');
    }

    // public function logout()
    // {
    //     Auth::guard('member')->logout();
    //     return redirect()->route('member.login');
    // }
    public function logout(Request $request)
    {
        Auth::guard('member')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/member/login');
    }
    
    
}
