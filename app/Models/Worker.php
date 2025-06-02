<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use SoftDeletes, HasFactory;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_workers')
            ->withPivot('amount')
            ->withTimestamps();
    }
}
