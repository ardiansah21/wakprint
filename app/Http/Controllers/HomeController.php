<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    /*
  File upload
  */ 
  public function fileupload(Request $request){

    if($request->hasFile('file')) {

      // Upload path
      $destinationPath = 'files/';

      // Create directory if not exists
      if (!file_exists($destinationPath)) {
         mkdir($destinationPath, 0755, true);
      }

      // Get file extension
      $extension = $request->file('file')->getClientOriginalExtension();

      // Valid extensions
      $validextensions = array("jpeg","jpg","png","pdf");

      // Check extension
      if(in_array(strtolower($extension), $validextensions)){

        // Rename file 
        $fileName = Str::slug(Carbon::now()->toDayDateTimeString()).rand(11111, 99999) .'.' . $extension;
        
        // Uploading file to given path
        $request->file('file')->move($destinationPath, $fileName); 

      }

    }
 }


    // public function profile()
    // {
    //     return view('member.profil');
    // }
    // public function logout(Request $request)
    // {
    //     $this->guard()->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     if ($response = $this->loggedOut($request)) {
    //         return $response;
    //     }

    //     return $request->wantsJson()
    //         ? new Response('', 204)
    //         : redirect('/');
    // }
}
