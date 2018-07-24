<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Promotion extends Model
{
    use SoftDeletes;

    protected $table = 'promotion';

    public $fillable = ['name', 'url', 'image', 'startDate', 'endDate', 'status', 'createdBy'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'createdBy');
    }
}
