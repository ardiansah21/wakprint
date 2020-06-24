<?php

namespace App;

use App\Http\Requests\StoreProductRequest;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $casts = [
        'properties' => 'array'
    ];
    protected $fillable = ['name','price','properties'];

    public function setPropertiesAttribute($value)
    {
        $properties = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $properties[] = $array_item;
            }
        }

        $this->attributes['properties'] = json_encode($properties);
    }
}
