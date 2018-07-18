<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $table = 'booking';

    public $fillable = ['userId', 'shopId', 'state', 'date', 'time', 'numberPerson', 'extraData'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'userId');
    }

    public function shop()
    {
        return $this->hasOne('App\Shop', 'id', 'shopId');
    }
}