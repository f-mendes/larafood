<?php

namespace App\Services;

use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductService
{

    protected $tenantRepository, $productRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, 
        ProductRepositoryInterface $productRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->productRepository = $productRepository;
    }


    public function getProductsByTenantUuid(string $uuid, array $categories)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);


        return $this->productRepository->getProductsByTenantId($tenant->id, $categories);

    }

    public function getProductByUuid(string $identify)
    {
        return $this->productRepository->getProductByUuid($identify);
    }

}