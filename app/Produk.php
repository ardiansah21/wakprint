<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Produk extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $table = "produk";
    protected $primaryKey = 'id_produk';

    //set nilai kolom db default
    protected $attributes = [
        'rating' => 5.0
     ];

    protected $guarded = [];
}
