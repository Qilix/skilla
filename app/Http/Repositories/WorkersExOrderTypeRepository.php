<?php

namespace App\Http\Repositories;

use App\Models\WorkersExOrderType;

class WorkersExOrderTypeRepository extends AbstractRepository
{
    public function __construct(WorkersExOrderType $model)
    {
        parent::__construct($model);
    }

    public function rejected($workerId, $orderTypeId)
    {
        return $this->model->where('worker_id', $workerId)
            ->where('order_type_id', $orderTypeId)
            ->exists();
    }
}
