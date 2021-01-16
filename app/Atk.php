<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Atk extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $table = "atk";
    protected $primaryKey = "id_atk";
    protected $fillable = ['id_pengelola', 'nama', 'harga', 'jumlah', 'foto', 'status'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url_image'];

    /**
     * Get the url_image atk
     *
     * @param  string  $value
     * @return string
     */
    public function getUrlImageAttribute($value)
    {
        return $this->getFirstMediaUrl('default');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')->singleFile();
    }

    public function partner()
    {
        return $this->belongsTo('App\Pengelola_Percetakan', 'id_pengelola');
    }
}
