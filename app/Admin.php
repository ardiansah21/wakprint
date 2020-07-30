<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticable
{
    use Notifiable;
    
    protected $table = "admin";
    protected $primaryKey = 'id_admin';

    // protected $guard = 'admin';


    // protected $fillable = [
    //     'nama', 'email', 'password','email_verfied_at'
    // ];
    protected $guarded = [];

    protected $hidden = ['password','remember_token'];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
