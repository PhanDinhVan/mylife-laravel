<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class News extends Model
{
    use SoftDeletes;

    protected $table = 'news';

    public $fillable = ['name', 'content', 'url', 'image', 'status', 'createdBy'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'createdBy');
    }
}
