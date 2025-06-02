<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function workers()
    {
        return $this->belongsToMany(Worker::class, 'order_workers')
            ->withPivot('amount')
            ->withTimestamps();
    }

    public function types()
    {
        return $this->hasOne(Worker::class, 'order_type');
    }
}
