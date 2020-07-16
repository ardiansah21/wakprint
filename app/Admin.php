<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticable
{
    use Notifiable;
    
    protected $table = "admin";

    protected $guard = 'admin';

    protected $fillable = [
        'nama', 'email', 'password','email_verfied_at'
    ];

    protected $hidden = ['password','remember_token'];
    
}
