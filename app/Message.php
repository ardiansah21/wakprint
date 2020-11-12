<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['message'];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }
}
