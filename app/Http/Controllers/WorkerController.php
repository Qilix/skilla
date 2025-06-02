<?php

namespace App\Http\Controllers;

use App\Exceptions\WorkerException;
use App\Http\DTOs\Worker\WorkerByOrderTypeDTO;
use App\Http\Requests\Worker\FilteredByOrderTypeRequest;
use App\Http\Services\WorkerService;

class WorkerController extends Controller
{
    private WorkerService $service;
    public function __construct(WorkerService $service)
    {
        $this->service = $service;
    }

    /*
     * Вывести отфильтрованных исполнителей
     */
    public function getFilteredByOrderType(FilteredByOrderTypeRequest $request)
    {
        $dto = WorkerByOrderTypeDTO::fromRequest($request);

        try{
            $workers = $this->service->getFilteredWorkers($dto);
        } catch (WorkerException $e) {
            throw new WorkerException($e->getMessage());
        }

        return response()->json(['data' => $workers]);
    }
}
