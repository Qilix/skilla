<?php

namespace App\Http\Services;

use App\Http\DTOs\Order\CreateOrderDTO;
use App\Http\Repositories\OrderRepository;
use App\Models\Order;

class OrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create(CreateOrderDTO $dto): Order
    {
        return $this->orderRepository->create([
            'type_id' => $dto->typeId,
            'partnership_id' => $dto->partnershipId,
            'user_id' => $dto->userId,
            'description' => $dto->description,
            'date' => $dto->date,
            'address' => $dto->address,
            'amount' => $dto->amount,
            'status' => $dto->status,
        ]);
    }
}
