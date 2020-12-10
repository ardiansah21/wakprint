<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ChatController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    //untuk member
    public function index()
    {
        return view('member.chat');
    }

    public function pesanan()
    {
        if (auth()->guard('partner')->check()) {
            $pesanans = auth()->guard('partner')->user()->pesanan;
        } else {
            $pesanans = Auth::user()->pesanans;
        }
        $itemListPesanan = array();

        foreach ($pesanans as $pesanan) {
            //TODO pengecekan apakah pesanan tersebut sudah bayar

            $data = new stdClass();
            if (Auth::guard('partner')->check()) {
                $data->id = $pesanan->id_pesanan;
                $data->nama_member = $pesanan->member->nama_lengkap;
                $data->penerimaan = $pesanan->metode_penerimaan;
                $data->status = $pesanan->status;

                $data->id_pesanan = $pesanan->id_pesanan;
                $data->id_member = $pesanan->id_member;
                $data->id_pengelola = $pesanan->id_pengelola;
                $data->avatar = ($pesanan->member)->getFirstMediaUrl('avatar') == null ? 'https://ui-avatars.com/api/?name=' . $pesanan->member->nama_lengkap . '&background=BC41BE&color=F2FF58' : ($pesanan->member)->getFirstMediaUrl('avatar');
                $data->count = Chat::where('id_pesanan', $pesanan->id_pesanan)->where('from_user', "member")->whereNull('read_at')->count();
            } else {

                $data->id = $pesanan->id_pesanan;
                $data->nama_toko = $pesanan->partner->nama_toko;
                $data->penerimaan = $pesanan->metode_penerimaan;
                $data->status = $pesanan->status;

                $data->id_pesanan = $pesanan->id_pesanan;
                $data->id_member = $pesanan->id_member;
                $data->id_pengelola = $pesanan->id_pengelola;
                $data->nama_pengelola = $pesanan->partner->nama_lengkap;
                $data->avatar = ($pesanan->partner)->getFirstMediaUrl('avatar') == null ? 'https://ui-avatars.com/api/?name=' . $pesanan->partner->nama_lengkap . '&background=BC41BE&color=F2FF58' : ($pesanan->partner)->getFirstMediaUrl('avatar');
                $data->count = Chat::where('id_pesanan', $pesanan->id_pesanan)->where('from_user', "partner")->whereNull('read_at')->count();
            }
            array_push($itemListPesanan, $data);
        }

        return $itemListPesanan;
    }

    //untuk partner
    public function indexPartner()
    {
        return view('pengelola.chat');
    }

    //all
    public function message($id)
    {
        $chat = Chat::where('id_pesanan', $id)->get();
        if (!$chat->isEmpty()) {
            if (Auth::guard('partner')->check()) {
                // $count = Chat::where('id_pesanan', $id)
                //     ->where('from_user', "member")
                //     ->whereNull('read_at')->count();
                Chat::where('id_pesanan', $id)
                    ->where('from_user', "member")
                    ->whereNull('read_at')
                    ->update(['read_at' => now()]);
            } else {
                // $count = Chat::where('id_pesanan', $id)
                //     ->where('from_user', "partner")
                //     ->whereNull('read_at')->count();
                Chat::where('id_pesanan', $id)
                    ->where('from_user', "partner")
                    ->whereNull('read_at')
                    ->update(['read_at' => now()]);
            }
            $chat->fresh();

            // $message = array();
            // foreach ($chat as $c) {
            //     $temp = new stdClass();
            //     $temp->id_pesanan = $c->id_pesanan;
            //     $temp->id_pengelola = $c->id_pengelola;
            //     $temp->from_user = $c->from_user;
            //     $temp->pesan = $c->pesan;
            //     $temp->read_at = $c->read_at;
            //     $temp->created_at = $c->created_at;
            //     $temp->count = $c->count;
            //     array_push($message, $temp);
            // }
            return $chat;
        }
    }

    protected function send(Request $request)
    {

        $message = Chat::create($request->all());

        event(new ChatEvent($message));

        return $message;

        // event(new MessageEvent($message));

        // $message = new MessageResource($message);

        // return response()->json($message);
    }

    protected function read($id)
    {
        if (Auth::guard('partner')->check()) {
            Chat::where('id_pesanan', $id)
                ->where('from_user', "member")
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        } else {
            Chat::where('id_pesanan', $id)
                ->where('from_user', "partner")
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }
    }

}
