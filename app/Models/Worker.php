<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_workers')
            ->withPivot('amount')
            ->withTimestamps();
    }
}
