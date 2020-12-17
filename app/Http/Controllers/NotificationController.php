<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Member;
use App\Pengelola_Percetakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class NotificationController extends Controller
{
    public function index()
    {
        $data = array();
        if (auth()->guard('partner')->check()) {

            $notifs = auth()->guard('partner')->user()->unreadNotifications;
        } else {
            $notifs = Auth::User()->unreadNotifications;
        }

        foreach ($notifs as $n) {
            $notif = new stdClass();
            $notif->id = $n->id;
            $notif->title = $n->data['title'];
            $notif->description = $n->data['description'];
            $notif->url = $n->data['url'];
            $notif->created_at = $n->data['created_at'];
            array_push($data, $notif);
        }

        return response()->json($data, 200);

    }

    public function read(Request $request)
    {
        if (auth()->guard('partner')->check()) {
            auth()->guard('partner')->user()->unreadNotifications->where('id', $request->id)->markAsRead();
            return auth()->guard('partner')->user()->unreadNotifications;
        }

        Auth::User()->unreadNotifications->where('id', $request->id)->markAsRead();
        return Auth::User()->unreadNotifications;

    }

    public function readAll()
    {
        if (auth()->guard('partner')->check()) {
            Pengelola_Percetakan::find(auth()->guard('partner')->id())->notifications()->delete();
            return auth()->guard('partner')->user()->unreadNotifications;
        }

        Member::find(Auth::id())->notifications()->delete();
        return Auth::User()->unreadNotifications;
    }

}
