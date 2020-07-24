<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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


     protected $guard = 'pengelola';
     protected $guarded = ['id_pengelola', 'created_at', 'updated_at'];
 
     protected $hidden = ['password','remember_token'];

     protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
