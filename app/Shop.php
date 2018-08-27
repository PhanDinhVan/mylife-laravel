<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes;

    protected $table = 'shop';

    public $fillable = ['name', 'phone', 'address','ward', 'district', 'city', 'lat', 'lng', 'image', 'type', 'openTime', 'creditCard', 'wifi'];

    protected $dates = ['deleted_at'];

    public function company()
    {
        return $this->hasOne('App\Company', 'id', 'type');
    }
}
