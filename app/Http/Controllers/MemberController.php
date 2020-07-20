<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \stdClass;
use Auth;
use App\Member;
use phpDocumentor\Reflection\Types\This;

class MemberController extends Controller
{
    private $member;
    private $id;
    public function __construct()
    {
        if (Auth::check()) {
            $this->member = Auth::User();         
        }
        else{
            $this->member = null;
        }
        // $this->member = Member::where('id_member', $id)->get();
        //$this->member->id_member = "123456789";
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('member.profil', ['m' => $this->member]);
    }

    // public function profil()
    // {
    //     return view('member.profil');
    // }

    // public function logout()
    // {
    //     Auth::guard('member')->logout();
    //     return redirect()->route('member.login');
    // }
    // public function logout(Request $request)
    // {
    //     Auth::guard('member')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     if ($response = $this->loggedOut($request)) {
    //         return $response;
    //     }

    //     return $request->wantsJson()
    //         ? new Response('', 204)
    //         : redirect('/member/login');
    // }


}
