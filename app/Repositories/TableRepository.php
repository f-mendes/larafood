<?php

namespace App\Repositories;

use App\Models\Table;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\TableRepositoryInterface;

class TableRepository implements TableRepositoryInterface
{   
    protected $table;

    public function __construct()
    {
        $this->table = 'tables';
    }

    public function getTablesByTenantUuid(string $uuid)
    {   
        return DB::table($this->table)
        ->join('tenants', 'tables.tenant_id', '=' , 'tenants.id')
        ->where('tenants.uuid',$uuid)
        ->select('tables.*')
        ->get();

    }
    
    public function getTablesByTenantId(int $id)
    {   
        return DB::table($this->table)->where('tenant_id', $id)->get();

    }

    public function getTableByName(string $name)
    {
        return DB::table($this->table)->where('name', $name)->first();

    }

}
