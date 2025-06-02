<?php

namespace App\Http\Services;

use App\Http\DTOs\Order\AssignWorkerDTO;
use App\Http\DTOs\Order\CreateOrderDTO;
use App\Http\Enums\OrderStatus;
use App\Http\Repositories\OrderRepository;
use App\Http\Repositories\OrderWorkerRepostiory;
use App\Http\Repositories\WorkersExOrderTypeRepository;
use App\Models\Order;

class OrderService
{
    private OrderRepository $orderRepository;
    private OrderWorkerRepostiory $orderWorkerRepostiory;
    private WorkersExOrderTypeRepository $workersExOrderTypeRepository;

    public function __construct(OrderRepository $orderRepository, OrderWorkerRepostiory $orderWorkerRepostiory, WorkersExOrderTypeRepository $workersExOrderTypeRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderWorkerRepostiory = $orderWorkerRepostiory;
        $this->workersExOrderTypeRepository = $workersExOrderTypeRepository;
    }

    /*
     * Создать заказ
     */
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

    /*
     * Поменять статус заказа
     * @see App\Http\Enums\OrderStatus
     */
    public function setStatus(int $orderId, OrderStatus $status)
    {
        return $this->orderRepository->update($orderId, ['status' => $status]);
    }

    /*
     * Задать исполнителя для заказа
     */
    public function assignWorker(AssignWorkerDTO $dto, int $orderId): array
    {
        $rejected = $this->workersExOrderTypeRepository->rejected($dto->workerId, $dto->orderTypeId);

        if (empty($rejected)) {
            $this->orderWorkerRepostiory->create([
                'worker_id' => $dto->workerId,
                'order_id' => $orderId
            ]);

            /*
             * Задать статус "назначен исполнитель" для заказа
             */
            $this->setStatus($orderId, OrderStatus::ASSIGNED);
        } else {
            return ['msg' => "Worker can't take this type of order"];
        }

        return ['msg' => 'Success assign'];
    }
}
