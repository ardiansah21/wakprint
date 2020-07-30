<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\Member;
use App\Pengelola_Percetakan;
use App\Http\Controllers\cariMember;

class AdminController extends Controller{
    public function index()
    {   
        $member = DB::table('member')->get();
        $pengelola = DB::table('pengelola_percetakan')->get();
        //$id = DB::table('member')->where('id_member',$member->id_member)->get();
        //showDataMember('id_member');
        //getDateBorn();
        
        // if(isset($_GET['carimember'])){
        //     $cariMember = $_GET['carimember'];
        //     $data = DB::table('member')->where('nama_lengkap','like',"%".$cariMember."%");				
        // }
        // else{
        //     $data = DB::table('member')->all();
        // }
        
        // cariMember();

        return view('admin.homepage',[
            'member' => $member,
            'pengelola_percetakan' => $pengelola
        ]);
    }

    public function cariMember()
    {
        // if(isset($_GET['carimember'])){
        //     $cariMember = $_GET['carimember'];
        //     $data = Member::where('nama_lengkap','like',"%".$cariMember."%");				
        // }
        // else{
        //     $data = Member::all();
        // }
        $cariMember = $request->carimember;
        // $output="";
        $member = Member::where('nama_lengkap','like',"%".$cariMember."%")->get();
        // if($member){
        //     foreach ($dataMember as $key => $member) {
        //         $output.='<tr>'.
        //         '<td>'.$member->id_member.'</td>'.
        //         '<td>'.$member->nama_lengkap.'</td>'.
        //         '<td>'.$member->email.'</td>'.
        //         '</tr>';
        //     }
        // }
        // return Response($output);
        return redirect()->route('dashboard');
    }

    // public function showDataMember($id){
    //     $member = DB::table('member')->find('id_member',$id)->get();
    // }

    // public function search(Request $request)
    // {
    //     if($request->ajax())
    //     {
    //         $output="";
    //         $dataMember=DB::table('member')->where('nama_lengkap','LIKE','%'.$request->carimember."%")->get();
    //         if($dataMember)
    //         {
    //             foreach ($dataMember as $key => $member) {
    //                 $output.='<tr>'.
    //                 '<td>'.$member->id_member.'</td>'.
    //                 '<td>'.$member->nama_lengkap.'</td>'.
    //                 '<td>'.$member->email.'</td>'.
    //                 '</tr>';
    //             }
    //         }
    //     }
    //     return Response($output);
    // }
}
?>