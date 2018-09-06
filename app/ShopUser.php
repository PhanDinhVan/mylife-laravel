<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopUser extends Model
{
    //
    use SoftDeletes;

    protected $table = 'shop_user';

    public $fillable = ['userId', 'shopId'];

    protected $dates = ['deleted_at'];
}
