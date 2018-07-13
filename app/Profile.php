<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Profile extends Model
{
    use SoftDeletes;

    protected $table = 'profile';

    protected $fillable = ['memberCode', 'userId', 'name', 'avatar', 'gender', 'birthday', 'phone', 'nationality'];

    protected $dates = ['deleted_at'];
}
