<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    //
    use SoftDeletes;

    protected $table = 'reviews';

    public $fillable = ['userId', 'shopId', 'score', 'review_date', 'comments', 'created_date'];

    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->hasOne('App\User', 'id', 'userId');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile', 'userId', 'userId');
    }

    public function shop()
    {
        return $this->hasOne('App\Shop', 'id', 'shopId');
    }
}
