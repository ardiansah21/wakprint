<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengelola_Percetakan extends Model
{
    protected $table = "pengelola_percetakan";
    //set nilai kolom db default
    protected $attributes = [
        'rating_toko' => 5.0,
     ];


}
