<?php

namespace App\Http\DTOs\Order;

use App\Http\Requests\Order\AssignWorkerRequest;

class AssignWorkerDTO
{
    public int $workerId;
    public int $orderTypeId;
    public float $amount;

    public static function fromRequest(AssignWorkerRequest $request): self
    {
        $dto = new self();
        $dto->workerId = $request->input('worker_id');
        $dto->orderTypeId = $request->input('order_type_id');
        $dto->amount = $request->input('amount');

        return $dto;
    }
}
