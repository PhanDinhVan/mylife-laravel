<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuCategory extends Model
{
    use SoftDeletes;

    protected $table = 'menu_item_category';

    public $fillable = ['description'];

    protected $dates = ['deleted_at'];

}
