<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = "chat";

/**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
    protected $guarded = [];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_chat';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function members()
    {
        return $this->belongsTo('App\Member', 'id_Member');
    }

    public function partners()
    {
        return $this->belongsTo('App\Pengelola_Percetakan');
    }
}
