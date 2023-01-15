<?php

namespace App\Services;

use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;

class TableService
{

    protected $tenantRepository, $tableRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, 
        TableRepositoryInterface $tableRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
    }


    public function getTablesByTenantUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);


        return $this->tableRepository->getTablesByTenantId($tenant->id);

    }

    public function getTableByUuid(string $identify)
    {
        return $this->tableRepository->getTableByUuid($identify);
    }
}