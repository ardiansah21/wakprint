<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class NotificationController extends Controller
{
    public function index()
    {
        $data = array();
        $notifs = auth(activeGuard())->user()->unreadNotifications;

        foreach ($notifs as $n) {
            $notif = new stdClass();
            $notif->id = $n->id;
            $notif->title = $n->data['title'];
            $notif->description = $n->data['description'];
            $notif->url = $n->data['url'];
            $notif->data = $n->data['pesanan'];
            $notif->pageAndroid = $n->data['pageAndroid'];
            $notif->created_at = $n->data['created_at'];
            array_push($data, $notif);
        }

        if (request()->is('api/*')) {
            return responseSuccess("data seluruh notifikasi", $data);
        }
        return response()->json($data, 200);

    }

    public function read(Request $request)
    {
        auth(activeGuard())->user()->unreadNotifications->where('id', $request->id)->markAsRead();
        if (request()->is('api/*')) {
            return responseSuccess("notifikasi id: " . $request->id . " telah dibaca ");
        }
        // return auth(activeGuard())->user()->unreadNotifications;
    }

    public function readAll()
    {
        if (auth(activeGuard())->user()->notifications()->delete()) {
            if (request()->is('api/*')) {
                return responseSuccess("semua notifikasi telah dibaca");
            }
            return auth(activeGuard())->user()->unreadNotifications;
        }
        return responseError("Permintaan gagal");
    }

}
