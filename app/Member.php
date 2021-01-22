<?php

namespace App;

use App\Message;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Member extends Authenticable implements HasMedia, MustVerifyEmail
{
    use Notifiable, HasMediaTrait, HasApiTokens;

    protected $table = "member";

    // protected $guard = 'member';
    protected $primaryKey = 'id_member';

    protected $attributes = [
        'jumlah_saldo' => 0,
        'alamat' => array(
            'IdAlamatUtama' => 0,
            'alamat' => array(),
        ),
    ];

    protected $guarded = [];
    // protected $guarded = ['id_member', 'created_at', 'updated_at'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'alamat' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function konfigurasi()
    {
        return $this->hasMany('App\Konfigurasi_file', 'id_member');
    }

    public static function cekProdukFavorit($idMember, $idProduk): bool
    {
        $produkFavorit = Member::find($idMember)->produk_favorit;

        return in_array($idProduk, json_decode($produkFavorit));
    }

    // public function pesanans()
    // {
    //     return $this->hasMany(Pesanan::class, 'id_member');
    // }

    public function messages()
    {
        return $this->hasMany('App\Message', 'id_member');
    }

    public function transaksiSaldo()
    {
        return $this->hasMany('App\Transaksi_saldo', 'id_member');
    }

    public function pesanans()
    {
        return $this->hasMany('App\Pesanan', 'id_member');
    }

    public function ulasans()
    {
        return $this->hasMany('App\Ulasan', 'id_member');
    }

    ////
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'avatar',
    ];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        if (!empty($this->getFirstMediaUrl('avatar'))) {
            return $this->getFullUrl('avatar');
        }
        return 'https://ui-avatars.com/api/?name=' . $this->nama_lengkap . '&background=BC41BE&color=F2FF58';
    }

    public function messagesTo()
    {
        return $this->hasOne(Message::class, 'to_id')->latest();
    }

    public function messagesFrom()
    {
        return $this->hasOne(Message::class, 'from_id')->latest();
    }
    //endTemp

    // /**
    //  * The accessors to append to the model's array form.
    //  *
    //  * @var array
    //  */
    // protected $appends = ['avatar'];

    // public function getAvatarAttribute()
    // {
    //     return 'https://ui-avatars.com/api/?name=' . $this->nama_lengkap . '&background=BC41BE&color=F2FF58';
    // }

    public function chatTo()
    {
        return $this->hasOne('App\Chat', 'to_id')->lates();
    }
    public function chatFrom()
    {
        return $this->hasOne('App\Chat', 'from_id')->lates();
    }

    //notif
    public function receivesBroadcastNotificationsOn()
    {
        return 'Notif-Broadcast.Member.' . $this->id_member;
    }

    public function routeNotificationFor($channel)
    {

        switch ($channel) {
            case 'PusherPushNotifications':
                return 'Notif.Member.' . $this->id_member;
                break;
            case 'mail':
                return $this->email;
                break;
            case 'database':
                return $this->notifications();
                break;

            default:
                $class = str_replace('\\', '.', get_class($this));

                return $class . '.' . $this->getKey();
                break;
        }

    }

}
