<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = "produk";

    //set nilai kolom db default
    protected $attributes = [
        'rating' => 5.0
     ];
}
