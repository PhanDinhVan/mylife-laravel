<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $table = 'company';

    protected $fillable = ['name', 'type', 'description', 'contact'];

    protected $dates = ['deleted_at'];
}
