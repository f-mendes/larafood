<?php

namespace App\Services;

use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryService
{

    protected $tenantRepository, $categoryRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, 
        CategoryRepositoryInterface $categoryRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->categoryRepository = $categoryRepository;
    }


    public function getCategoriesByTenantUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);


        return $this->categoryRepository->getCategoriesByTenantId($tenant->id);

    }

    public function getCategoryByUuid(string $identify)
    {
        return $this->categoryRepository->getCategoryByUuid($identify);
    }
}