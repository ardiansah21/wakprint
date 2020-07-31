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
        $member = Member::all();
        $pengelola = Pengelola_Percetakan::all();

        return view('admin.homepage',[
            'member' => $member,
            'pengelola_percetakan' => $pengelola
        ]);
    }

    public function cariMember()
    {
        $cariMember = $request->carimember;
        $member = Member::where('nama_lengkap','like',"%".$cariMember."%")->get();
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
