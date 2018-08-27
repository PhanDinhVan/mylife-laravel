<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class News extends Model
{
    use SoftDeletes;

    protected $table = 'news';

    public $fillable = ['name', 'content', 'url', 'image', 'status', 'createdBy', 'publishDate', 'name'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'createdBy');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile', 'userId', 'createdBy');
    }
}
