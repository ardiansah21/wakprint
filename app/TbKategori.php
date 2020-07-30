<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
 
class TbKategori extends Model
{
    protected $table = "tb_kategoris";
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;
}
