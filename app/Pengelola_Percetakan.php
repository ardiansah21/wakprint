<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengelola_Percetakan extends Model
{
    //set nilai kolom db default
    protected $attributes = [
        'rating_toko' => 5.0,
     ];

}
