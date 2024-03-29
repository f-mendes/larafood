<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderCreated;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrder;
use App\Http\Resources\OrderResource;

class OrderApiController extends Controller
{

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(StoreOrder $request)
    {
       $order = $this->orderService->createNewOrder($request->all());

       broadcast(new OrderCreated($order));

       return new OrderResource($order);
    }

    public function show($identify)
    {
        $order = $this->orderService->getOrderByIdentify($identify);
        if(!$order){
            return response()->json(['message', 'Not Found'],404);
        }

        return new OrderResource($order);
    }

    public function myOrders()
    {
        $orders = $this->orderService->ordersByIdClient();

        return OrderResource::collection($orders);
    }
}
