<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table = 'menu_item';

    public $fillable = ['description', 'price', 'companyId', 'menuCategoryId', 'image'];

    protected $dates = ['deleted_at'];

    public function MenuCategory()
    {
        return $this->hasOne('App\MenuCategory', 'id', 'menuCategoryId');
    }

    public function Company()
    {
        return $this->hasOne('App\Company', 'id', 'companyId');
    }
}
