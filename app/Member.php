<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticable
{
    use Notifiable;

    protected $table = "member";
    
    // protected $guard = 'member';
    protected $primaryKey = 'id_member';

    protected $guarded = [];
    // protected $guarded = ['id_member', 'created_at', 'updated_at'];

    protected $hidden = ['password','remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'alamat' => 'array'
    ];
}
