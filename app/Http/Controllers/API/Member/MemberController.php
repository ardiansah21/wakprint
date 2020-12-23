<?php

namespace App\Http\Controllers\API\Member;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function index()
    {
        return responseSuccess("data user yang login", request()->user());
    }

}
