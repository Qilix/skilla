<?php

namespace App\Http\Repositories;

use App\Models\Order;

class OrderRepository extends AbstractRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }
}
