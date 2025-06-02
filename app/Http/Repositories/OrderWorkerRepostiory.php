<?php

namespace App\Http\Repositories;

use App\Models\OrderWorker;

class OrderWorkerRepostiory extends AbstractRepository
{
    public function __construct(OrderWorker $model)
    {
        parent::__construct($model);
    }
}
