<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TbBlog extends Model
{
    protected $table = "tb_blogs";
    protected $primaryKey = 'id_blog';
    public $timestamps = false;
}
