<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Role extends Model
{
    use SoftDeletes;

    protected $table = 'roles';

    public $fillable = [
        'name', 'description'
    ];

    protected $dates = ['deleted_at'];
}
