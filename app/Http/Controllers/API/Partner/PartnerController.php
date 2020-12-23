<?php

namespace App\Http\Controllers\API\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        return responseSuccess("data user yang login", request()->user());
    }
}
