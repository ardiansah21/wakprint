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

    // /////

    // // public function userFrom()
    // // {
    // //     Log::info($this->id_pesanan);
    // //     if ($this->from === "member") {
    // //         return $this->belongsTo(Member::class, 'id_member', 'from_id');
    // //         // return $this->belo;
    // //     } else {
    // //         return $this->belongsTo('App\Pengelola_Percetakan', 'from_id');
    // //     }
    // // }
    // // public function userTo()
    // // {
    // //     if ($this->from === 'member') {
    // //         return $this->belongsTo('App\Pengelola_Percetakan', 'to_id');
    // //     }
    // //     return $this->belongsTo('App\Member', 'to_id');
    // // }

    // public function users()
    // {
    //     return $this->belongsTo(Member::class, 'from_id');
    // }

    // public function userFrom()
    // {
    //     return $this->belongsTo(Member::class, 'from_id');
    // }

    // public function userTo()
    // {
    //     return $this->belongsTo(Member::class, 'to_id');
    // }
}
