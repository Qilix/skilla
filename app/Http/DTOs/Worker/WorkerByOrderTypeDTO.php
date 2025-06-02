<?php

namespace App\Http\DTOs\Worker;

use App\Http\Requests\Worker\FilteredByOrderTypeRequest;

class WorkerByOrderTypeDTO
{
    public array $orderTypeIds;

    public static function fromRequest(FilteredByOrderTypeRequest $request): self
    {
        $dto = new self();
        $dto->orderTypeIds = $request->input('order_type_id');

        return $dto;
    }
}
