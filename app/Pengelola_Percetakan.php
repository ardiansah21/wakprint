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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
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

    //TODO diganti dengan yang ada s nya di cek lagi mana aja yang tidak menggunakan s
    public function pesanan()
    {
        return $this->hasMany('App\Pesanan', 'id_pengelola');
    }
    public function pesanans()
    {
        return $this->hasMany('App\Pesanan', 'id_pengelola');
    }

    public function transaksiSaldo()
    {
        return $this->hasMany('App\Transaksi_saldo', 'id_transaksi');
    }

    // public function hapus()
    // {

    //     // $this->atk()->delete();
    //     // $this->products()->delete();
    //     return parent::delete();
    // }

    // // this is a recommended way to declare event handlers
    // public static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($partner) { // before delete() method call this
    //         $partner->atk()->delete();
    //         $partner->products()->delete();
    //         // do the rest of the cleanup...
    //     });
    // }

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
