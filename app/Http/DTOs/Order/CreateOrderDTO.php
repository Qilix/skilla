<?php

namespace App\Http\DTOs\Order;

use App\Http\Enums\OrderStatus;
use App\Http\Requests\Order\CreateOrderRequest;
use Carbon\Carbon;

class CreateOrderDTO
{
    public int $typeId;
    public int $partnershipId;
    public int $userId;
    public string $description;
    public Carbon $date;
    public string $address;
    public float $amount;
    public OrderStatus $status;

    public static function fromRequest(CreateOrderRequest $request): self
    {
        $dto = new self();
        $dto->typeId = $request->input('type_id');
        $dto->partnershipId = $request->input('partnership_id');
        $dto->userId = $request->user()->id;
        $dto->description = $request->input('description');
        $dto->date = Carbon::createFromFormat('Y-m-d H:i:s', ($request->input('date')));
        $dto->address = $request->input('address');
        $dto->amount = $request->input('amount');
        $dto->status = OrderStatus::from($request->input('status'));

        return $dto;
    }
}
