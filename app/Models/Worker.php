<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    public function scopeCanTakeOrderType($query, array $orderTypeIds)
    {
        if (empty($orderTypeIds)) {
            return $query;
        }

        return $query->whereNotIn('id', function ($subQuery) use ($orderTypeIds) {
            $subQuery->select('worker_id')
                ->from('workers_ex_order_types')
                ->whereIn('order_type_id', $orderTypeIds)
                ->groupBy('worker_id')
                ->havingRaw('COUNT(DISTINCT order_type_id) = ?', [count($orderTypeIds)]);
        });
    }
}

