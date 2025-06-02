<?php

namespace App\Http\Controllers;

use App\Exceptions\OrderException;
use App\Http\DTOs\Order\CreateOrderDTO;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Services\OrderService;

class OrderController extends Controller
{
    private OrderService $service;
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function store(CreateOrderRequest $request)
    {
        $dto = CreateOrderDTO::fromRequest($request);
        try{
            $order = $this->service->create($dto);
        }catch(OrderException $e){
            return response(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $order]);
    }
}
