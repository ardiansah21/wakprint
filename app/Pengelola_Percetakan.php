<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class Pengelola_Percetakan extends Authenticable
{
    use Notifiable;
 
    protected $table = "pengelola_percetakan";
    protected $primaryKey = 'id_pengelola';

    //set nilai kolom db default
    protected $attributes = [
        'rating_toko' => 5.0,
     ];
    //  protected $guard = 'partner';
     protected $guarded = [];
 
     protected $hidden = ['password','remember_token'];

     protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
