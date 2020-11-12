<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Lapor_produk;
use App\Mail\TanggapiKeluhanMail;
use App\Member;
use App\Pengelola_Percetakan;
use App\Pesanan;
use App\Transaksi_saldo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        $member = Member::all();
        $partner = Pengelola_Percetakan::all();
        $pesanan = Pesanan::all();

        $jumlahMember = count($member);
        $jumlahPartner = count($partner);
        $jumlahTransaksi = count($pesanan);

        return view('admin.homepage', [
            'member' => $member,
            'jumlahMember' => $jumlahMember,
            'partner' => $partner,
            'jumlahPartner' => $jumlahPartner,
            'jumlahTransaksi' => $jumlahTransaksi,
        ]);
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cariMember = $request->carimember;
        dd($cariMember);
        // mengambil data dari table pegawai sesuai pencarian data
        $member = Member::all()
            ->where('pegawai_nama', 'like', "%" . $cariMember . "%")
            ->paginate();

        // mengirim data pegawai ke view index
        //return view('index',['pegawai' => $pegawai]);

    }

    public function dataMember()
    {
        $member = Member::all();

        return view('admin.data_member', [
            'member' => $member,
        ]);
    }

    public function memberJson()
    {
        return datatables(Member::all())->make(true);
    }

    public function partnerJson()
    {
        return datatables(Pengelola_Percetakan::all())->make(true);
    }

    public function saldoJson()
    {
        $member = Member::all();
        $partner = Pengelola_Percetakan::all();
        $transaksiSaldo = Transaksi_saldo::all()->union($member);
        // return datatables($transaksiSaldo)->addIndexColumn()->make(true);
        return datatables(Transaksi_saldo::all())->make(true);
    }

    public function keluhanJson()
    {
        return datatables(Lapor_produk::all())->make(true);
    }

    public function detailMember($id)
    {
        $member = Member::find($id);
        return view('admin.detail_member', [
            'member' => $member,
            'tanggalLahir' => $this->getDateBorn($id),
        ]);
    }

    public function hapusMember($id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect()->route('admin.member');
    }

    public function getDateBorn($id)
    {
        $member = Member::find($id);
        if (empty($member->tanggal_lahir)) {
            return "-";
        } else {
            $monthName = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            $date = $member->tanggal_lahir;
            $tanggal = intval(substr($date, 8, 2));
            $bulan = $monthName[intval(substr($date, 5, 2) - 1)];
            $tahun = substr($date, 0, 4);
            return "$tanggal $bulan $tahun";
        }
    }

    public function dataPartner()
    {
        $partner = Pengelola_Percetakan::all();

        return view('admin.data_pengelola', compact('partner'));
    }

    public function detailPartner($id)
    {
        $partner = Pengelola_Percetakan::find($id);

        return view('admin.detail_pengelola', compact('partner'));
    }

    public function terimaPartner($id)
    {
        $partner = Pengelola_Percetakan::find($id);
        $partner->email_verified_at = Carbon::now()->format('Y:m:d H:i:s');

        $partner->save();
        return redirect()->route('admin.partner');
    }

    public function tolakPartner($id)
    {
        $partner = Pengelola_Percetakan::find($id);
        // $partner->save();
        return view('admin.tolak_pengelola', compact('partner'));
    }

    public function dataSaldo()
    {
        $member = Member::all();
        $partner = Pengelola_Percetakan::all();
        $transaksi_saldo = Transaksi_saldo::all();

        return view('admin.konfirmasi_saldo', compact('member', 'partner', 'transaksi_saldo'));
    }

    public function saldoTolak()
    {
        $pengelola = Pengelola_Percetakan::all();
        $member = Member::all();

        return view('admin.tolak_pengelola', [
            'member' => $member,
            'pengelola_percetakan' => $pengelola,
        ]);
    }

    public function keluhan()
    {
        $member = Member::all();
        $partner = Pengelola_Percetakan::all();

        return view('admin.kelola_keluhan', [
            'member' => $member,
            'pengelola_percetakan' => $partner,
        ]);
    }

    public function detailKeluhan($id)
    {
        $laporProduk = Lapor_produk::find($id);
        return view('admin.tanggapi_keluhan', compact('laporProduk'));
    }

    public function tanggapiKeluhan(Request $request)
    {
        $laporan = Lapor_produk::find($request->id_laporan);
        $laporan->pesan_tanggapan = $request->tanggapan_keluhan;
        $laporan->save();
        $m = (Mail::to($laporan->member->email)->send(new TanggapiKeluhanMail($laporan)));
        // dd($m);
        try {
            Mail::to($laporan->member->email)->send(new TanggapiKeluhanMail($laporan));
            //TODO:  buat pesan sukses
            $laporan->status = 'Ditanggapi';
            $laporan->save();
            return redirect()->route('admin.keluhan');
        } catch (\Throwable $th) {
            //TODO:  buat pesan gagal
            dd('gagal kirim email');
        }

    }

    // public function tableDataMember(){
    //     return Datatables::of(Member::all())->make(true);
    // }

    // public function memberByGroupDatatables(Request $request, $type, $param_id){
    //     // The columns variable is used for sorting
    //     $columns = array (
    //             // datatable column index => database column name
    //             0 =>'id',
    //             1 =>'nama_lengkap',
    //             2 =>'email'
    //     );
    //     //Getting the data
    //     $member = Member::all()
    //     ->where('member.group_id','=',$group_id)
    //     ->select ( 'member.id',
    //         'member.nama_lengkap',
    //         'member.email'
    //     );
    //     $totalData = $member->count ();            //Total record
    //     $totalFiltered = $totalData;      // No filter at first so we can assign like this
    //     // Here are the parameters sent from client for paging
    //     $start = $request->input ( 'start' );           // Skip first start records
    //     $length = $request->input ( 'length' );   //  Get length record from start
    //     /*
    //      * Where Clause
    //      */
    //     if ($request->has ( 'search' )) {
    //         if ($request->input ( 'search.value' ) != '') {
    //             $searchTerm = $request->input ( 'search.value' );
    //             /*
    //             * Seach clause : we only allow to search on user_name field
    //             */
    //             $candidates->where ( 'member.nama_lengkap', 'Like', '%' . $searchTerm . '%' );
    //         }
    //     }
    //     /*
    //      * Order By
    //      */
    //     if ($request->has ( 'order' )) {
    //         if ($request->input ( 'order.0.column' ) != '') {
    //             $orderColumn = $request->input ( 'order.0.column' );
    //             $orderDirection = $request->input ( 'order.0.dir' );
    //             $jobs->orderBy ( $columns [intval ( $orderColumn )], $orderDirection );
    //         }
    //     }
    //     // Get the real count after being filtered by Where Clause
    //     $totalFiltered = $member->count ();
    //     // Data to client
    //     $jobs = $member->skip ( $start )->take ( $length );

    //     /*
    //      * Execute the query
    //      */
    //     $member = $member->get ();
    //     /*
    //     * We built the structure required by BootStrap datatables
    //     */
    //     $data = array ();
    //     foreach ( $member as $m ) {
    //         $nestedData = array ();
    //         $nestedData [0] = $m->id;
    //         $nestedData [1] = $m->nama_lengkap;
    //         $nestedData [2] = $m->email;

    //         // $nestedData [1] = '<small class="label bg-' . $user->display . '">' .  $user->email . '</small>';
    //         $data [] = $nestedData;
    //     }
    //     /*
    //     * This below structure is required by Datatables
    //     */
    //     $tableContent = array (
    //             "draw" => intval ( $request->input ( 'draw' ) ), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    //             "recordsTotal" => intval ( $totalData ), // total number of records
    //             "recordsFiltered" => intval ( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
    //             "data" => $data
    //     );
    //     return $tableContent;
    // }

    // public function usersByGroupDatatables(Request $request, $type, $param_id){
    //     // The columns variable is used for sorting
    //     $columns = array (
    //             // datatable column index => database column name
    //             0 =>'user_name',
    //             1 =>'email',
    //             2 =>'dob',
    //             3 =>'id',
    //     );
    //     //Getting the data
    //     $users = DB::table ( 'users' )
    //     ->where('users.group_id','=',$group_id)
    //     ->select ( 'users.id',
    //         'users.user_name',
    //         'users.email',
    //         'users.dob',
    //     );
    //     $totalData = $users->count ();            //Total record
    //     $totalFiltered = $totalData;      // No filter at first so we can assign like this
    //     // Here are the parameters sent from client for paging
    //     $start = $request->input ( 'start' );           // Skip first start records
    //     $length = $request->input ( 'length' );   //  Get length record from start
    //     /*
    //      * Where Clause
    //      */
    //     if ($request->has ( 'search' )) {
    //         if ($request->input ( 'search.value' ) != '') {
    //             $searchTerm = $request->input ( 'search.value' );
    //             /*
    //             * Seach clause : we only allow to search on user_name field
    //             */
    //             $candidates->where ( 'users.user_name', 'Like', '%' . $searchTerm . '%' );
    //         }
    //     }
    //     /*
    //      * Order By
    //      */
    //     if ($request->has ( 'order' )) {
    //         if ($request->input ( 'order.0.column' ) != '') {
    //             $orderColumn = $request->input ( 'order.0.column' );
    //             $orderDirection = $request->input ( 'order.0.dir' );
    //             $jobs->orderBy ( $columns [intval ( $orderColumn )], $orderDirection );
    //         }
    //     }
    //     // Get the real count after being filtered by Where Clause
    //     $totalFiltered = $users->count ();
    //     // Data to client
    //     $jobs = $users->skip ( $start )->take ( $length );

    //     /*
    //      * Execute the query
    //      */
    //     $users = $users->get ();
    //     /*
    //     * We built the structure required by BootStrap datatables
    //     */
    //     $data = array ();
    //     foreach ( $users as $user ) {
    //         $nestedData = array ();
    //         $nestedData [0] = $user->user_name;
    //         $nestedData [1] = $job->email;
    //         $nestedData [2] = $job->dob;
    //         $nestedData [3] = $job->id;
    //         $data [] = $nestedData;
    //     }
    //     $nestedData [1] = '<small class="label bg-' . $user->display . '">' .  $user->email . '</small>';
    //     /*
    //     * This below structure is required by Datatables
    //     */
    //     $tableContent = array (
    //             "draw" => intval ( $request->input ( 'draw' ) ), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    //             "recordsTotal" => intval ( $totalData ), // total number of records
    //             "recordsFiltered" => intval ( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
    //             "data" => $data
    //     );
    //     return $tableContent;
    // }
}
