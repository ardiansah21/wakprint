<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = "ulasan";
    //set nilai kolom db default
    protected $attributes = [
        'rating' => 5.0,
     ];
}
