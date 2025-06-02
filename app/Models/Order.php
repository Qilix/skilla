<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function workers()
    {
        return $this->belongsToMany(Worker::class, 'order_workers')
            ->withPivot('amount')
            ->withTimestamps();
    }
}
