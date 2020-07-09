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

    public function index()
    {
        return view('member.homepage',['member'=>$this->member]);
    }

    public function login()
    {
        return view('member.login_member');
    }

    public function register()
    {
        return view('member.register_member');
    }
    
    public function profil()
    {
        return view('member.profil_member',['member'=>$this->member]);
    }

    public function profil_edit()
    {
        return view('member.edit_profil_member',['member'=>$this->member]);
    }
    
    public function pesanan()
    {
        return view('member.pesanan_member',['member'=>$this->member]);
    }

    public function ulasan()
    {
        return view('member.ulasan_member',['member'=>$this->member]);
    }
    
    
}
