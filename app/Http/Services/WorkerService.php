<?php

namespace App\Http\Services;

use App\Http\DTOs\Worker\WorkerByOrderTypeDTO;
use App\Http\Repositories\WorkerRepository;
use Illuminate\Support\Collection;

class WorkerService
{
    private WorkerRepository $workerRepository;

    public function __construct(WorkerRepository $workerRepository)
    {
        $this->workerRepository = $workerRepository;
    }

    /*
     * Получить отфильтрованных исполнителей
     */
    public function getFilteredWorkers(WorkerByOrderTypeDTO $dto): Collection
    {
        return $this->workerRepository->filter($dto->orderTypeIds);
    }
}
