<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    protected $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }

    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        $comment = '',
        $clientId = '',
        $tableId = ''

    ){

        $data = [
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'tenant_id' => $tenantId,
            
        ];
        
        if($comment) $data['comment'] = $comment;
        if($clientId) $data['client_id'] = $clientId;
        if($tableId)  $data['table_id']  = $tableId;

        $order = $this->entity->create($data);

        return $order;

    }


    public function getOrderByIdentify(string $identify)
    {
        return $this->entity->where('identify', $identify)->first();
    }

    public function registerProductOrder(int $ortderId, array $products)
    {
        $orderProducts = [];
        $order = $this->entity->find($ortderId);

        foreach ($products as $product) {
            $orderProducts[$product['id']] = [

                'qty'   => $product['qty'],
                'price' => $product['price']
            ];
        }

        $order->products()->attach($orderProducts);

        // foreach ($products as $product) {
        //     array_push($orderProducts,[
        //         'order_id' => $ortderId,
        //         'product_id' => $product['id'],
        //         'qty' => $product['qty'],
        //         'price' => $product['price']
        //     ]);
        // }

        // DB::table('order_product')->insert($orderProducts);
    }

    public function ordersByIdClient(int $idClient)
    {
        return $this->entity->where('client_id', $idClient)->paginate();
    }

}