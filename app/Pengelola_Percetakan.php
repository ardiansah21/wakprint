<?php

namespace App;

use App\Notifications\PartnerResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Pengelola_Percetakan extends Authenticable implements HasMedia
{
    use Notifiable, HasMediaTrait, HasApiTokens;

    protected $table = "pengelola_percetakan";
    protected $primaryKey = 'id_pengelola';

    //set nilai kolom db default
    protected $attributes = [
        'rating_toko' => 5.0,
        'status_toko' => 'Buka',
        'ntkwh' => 0,
    ];
    //  protected $guard = 'partner';
    protected $guarded = [];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'jarak',
        'avatar',
        'foto_percetakan',
        'atks',
    ];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        if (!empty($this->getFirstMediaUrl('avatar'))) {
            return 'https://wakprint.com' . $this->getFirstMediaUrl('avatar');
        }
        return 'https://ui-avatars.com/api/?name=' . trim($this->nama_lengkap, " ") . '&background=BC41BE&color=F2FF58';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function getFotoPercetakanAttribute()
    {
        if (!empty($this->getFirstMediaUrl('foto_percetakan'))) {

            return $this->getMedia('foto_percetakan')->map(function ($media) {
                return $media->getFullUrl();
            });
            // return 'https://wakprint.com' . $this->getFirstMediaUrl('foto_percetakan');
        }

        return ['https://ui-avatars.com/api/?name=' . trim($this->nama_toko, " ") . '&background=BC41BE&color=F2FF58'];
    }

    public function getAtksAttribute()
    {
        return $this->atk;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PartnerResetPasswordNotification($token));
    }

    /**
     * Get all of the user's images.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function products()
    {
        return $this->hasMany('App\Produk', 'id_pengelola');
    }

    public function atk()
    {
        return $this->hasMany('App\Atk', 'id_pengelola');
    }

    //simulasi jarak
    public function getJarakAttribute()
    {
        return $this->id_pengelola * 100;
    }

    public function pesanans()
    {
        return $this->hasMany('App\Pesanan', 'id_pengelola');
    }

    public function transaksiSaldo()
    {
        return $this->hasMany('App\Transaksi_saldo', 'id_pengelola');
    }

    //notif
    public function receivesBroadcastNotificationsOn()
    {
        return 'Notif-Broadcast.Partner.' . $this->id_pengelola;
    }

    public function routeNotificationFor($channel)
    {

        switch ($channel) {
            case 'PusherPushNotifications':
                return 'Notif.Partner.' . $this->id_pengelola;
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
