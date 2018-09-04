<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileStaff extends Model
{
    //
    use SoftDeletes;

    protected $table = 'profile_staffs';

    protected $fillable = ['memberCode', 'staffId', 'name', 'avatar', 'gender', 'birthday', 'phone', 'nationality'];

    protected $dates = ['deleted_at'];
}
