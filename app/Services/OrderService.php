<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class OrderService
{
    protected $orderRepository, $tenantRepository, $tableRepository, $productRepository;

    public function __construct(
        OrderRepositoryInterface  $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository,
        ProductRepositoryInterface $productRepository

    ){
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
        $this->productRepository = $productRepository;
    }

    public function createNewOrder(array $order)
    {

        $products = $this->getProductsByOrder($order['products']);
        
        $identify = $this->getIdentifyOrder();
        $total    = $this->getTotalOrder($products);
        $status   = 'open';
        $tenantId = $this->getTenantIdByOrder($order['token_company']);
        $comment  = isset($order['comment']) ? $order['comment'] : '';
        $cleintId = $this->getClientIdByOrder();
        $tableId  = $this->getTableIdByOrder($order['table'] ?? '');

        $order = $this->orderRepository->createNewOrder(
            $identify, 
            $total, 
            $status, 
            $tenantId, 
            $comment,
            $cleintId,
            $tableId  
        );

        $this->orderRepository->registerProductOrder($order->id, $products);
        
        return $order;

    }

    public function getOrderByIdentify($identify)
    {
        $order = $this->orderRepository->getOrderByIdentify($identify);
        return $order;
    }

    public function ordersByIdClient()
    {
        $idClient = $this->getClientIdByOrder();
        return $this->orderRepository->ordersByIdClient($idClient);
    }

    
    private function getIdentifyOrder(int $qtyCaraceters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        // $specialCharacters = str_shuffle('!@#$%*-');

        // $characters = $smallLetters.$numbers.$specialCharacters;
        $characters = $smallLetters.$numbers;

        $identify = substr(str_shuffle($characters), 0, $qtyCaraceters);

        if ($this->orderRepository->getOrderByIdentify($identify)) {
            $this->getIdentifyOrder($qtyCaraceters + 1);
        }

        return $identify;
    }

    private function getProductsByOrder(array $productsOrder)
    {
        $products = [];
        foreach ($productsOrder as $productOrder) {
            
            $uuid = $productOrder['identify'];
            $product = $this->productRepository->getProductByUuid($uuid);

            array_push($products, [
                'id' => $product->id,
                'qty' => $productOrder['qty'],
                'price' => $product->price
            ]);
        }

        return $products;
    }


    private function getTotalOrder(array $products): float
    {
        $total = 0;
        foreach ($products as $product) {
            $total += ($product['qty'] * $product['price']);
        }
        return $total;
    }

    private function getTenantIdByOrder(string $uuid)
    {   
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $tenant->id;
    }

    private function getTableIdByOrder(string $uuid = '')
    {   
        if($uuid){
            $table = $this->tableRepository->getTableByUuid($uuid);
            return $table->id;
        }
        
        return '';
    }

    private function getClientIdByOrder()
    {
        $client = auth()->check() ? auth()->user()->id : '';

        return $client;
    }


}