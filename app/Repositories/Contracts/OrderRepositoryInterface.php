<?php

namespace App\Repositories\Contracts;


interface OrderRepositoryInterface
{
    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        $clientId = '',
        $tableId = ''

    );
    public function getOrderByIdentify(string $identify);
    public function registerProductOrder(int $ortderId, array $products);
    public function ordersByIdClient(int $idClient);
    public function getOrdersByTenantId(int $idTenant, string $status, string $date = null);
    public function updateStatusOrder(string $identify, string $status);

}
