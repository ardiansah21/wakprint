<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Member;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ChatController extends Controller
{

    //untuk member
    public function index()
    {
        return view('member.chat');
    }

    public function pesanan()
    {
        if (!activeGuard()) {
            return response()->json(['error' => "Unauthenticated."], 401);
        }
        $pesanans = auth(activeGuard())->user()->pesanans;

        $itemListPesanan = array();

        foreach ($pesanans as $pesanan) {

            if ($pesanan->isPaid() && $pesanan->status !== null) {
                $data = new stdClass();
                if (auth(activeGuard())->user() instanceof Member) {
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
                } else {
                    $data->id = $pesanan->id_pesanan;
                    $data->nama_member = $pesanan->member->nama_lengkap;
                    $data->penerimaan = $pesanan->metode_penerimaan;
                    $data->status = $pesanan->status;

                    $data->id_pesanan = $pesanan->id_pesanan;
                    $data->id_member = $pesanan->id_member;
                    $data->id_pengelola = $pesanan->id_pengelola;
                    $data->avatar = ($pesanan->member)->getFirstMediaUrl('avatar') == null ? 'https://ui-avatars.com/api/?name=' . $pesanan->member->nama_lengkap . '&background=BC41BE&color=F2FF58' : ($pesanan->member)->getFirstMediaUrl('avatar');
                    $data->count = Chat::where('id_pesanan', $pesanan->id_pesanan)->where('from_user', "member")->whereNull('read_at')->count();
                }
                array_push($itemListPesanan, $data);
            }
        }

        if (request()->is('api/*')) {
            return responseSuccess("data seluruh pesanan chat", $itemListPesanan);
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
        $chat = Chat::where('id_pesanan', $id)->orderBy("created_at", "desc")->get();
        if (!$chat->isEmpty()) {
            if (Auth::guard('partner')->check() || auth('partner-api')->check()) {
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
            $chat->fresh();

            $message = array();
            foreach ($chat as $c) {
                $temp = new stdClass();
                $temp->id_pesanan = $c->id_pesanan;
                $temp->id_pengelola = $c->id_pengelola;
                $temp->from_user = $c->from_user;
                $temp->pesan = $c->pesan;
                $temp->read_at = $c->read_at;
                $temp->created_at = $c->created_at;
                $temp->count = $c->count;
                array_push($message, $temp);
            }

            if (request()->is('api/*')) {
                return responseSuccess("seluruh chat di pesanan " . $id, $chat);
            }
            return $chat;
        };
        if (request()->is('api/*')) {
            return responseSuccess("Belum ada pesan", $chat);
        }
        return $chat;

    }

    protected function send(Request $request)
    {

        $message = Chat::create($request->all());

        event(new ChatEvent($message));

        $message->read_at = null;

        if (request()->is('api/*')) {
            return responseSuccess("Pesan telah terkirim", $message);
        }
        return $message;
    }

    protected function read($id)
    {
        if (Auth::guard('partner')->check() || auth('partner-api')->check()) {
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
        return responseSuccess("Chat dengan pesanan " . $id . " sudah dibaca semua", null);
    }

}
