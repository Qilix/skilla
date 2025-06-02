<?php

namespace App\Http\Repositories;

use App\Models\Worker;

class WorkerRepository extends AbstractRepository
{
    public function __construct(Worker $model)
    {
        parent::__construct($model);
    }

    public function filter(array $orderTypeIds)
    {
        return $this->model->canTakeOrderType($orderTypeIds)->get();
    }
}
