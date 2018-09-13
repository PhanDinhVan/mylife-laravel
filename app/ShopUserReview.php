<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopUserReview extends Model
{
    //
    use SoftDeletes;

    protected $table = 'shop_user_review';

    public $fillable = ['userId', 'shopId'];

    protected $dates = ['deleted_at'];

    // get list shop
    public function shop(){
        return $this->hasOne('App\Shop','id','shopId');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile', 'userId', 'userId');
    }
}
