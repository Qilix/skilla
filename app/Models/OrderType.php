<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderType extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    protected $dates = ['deleted_at'];
}
