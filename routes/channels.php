<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('Notif-Broadcast.Member.{id}', function ($user) {
    return Auth::check();
});

Broadcast::channel('Notif-Broadcast.Partner.{id}', function ($user) {
    return (Auth::guard('partner')->check() || auth('sanctum')->check());
}, ['guards' => ['partner', 'sanctum']]);
