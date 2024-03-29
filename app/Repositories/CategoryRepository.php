<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{   
    protected $table;

    public function __construct()
    {
        $this->table = 'categories';
    }

    public function getCategoriesByTenantUuid(string $uuid)
    {   
        return DB::table($this->table)
        ->join('tenants', 'categories.tenant_id', '=' , 'tenants.id')
        ->where('tenants.uuid',$uuid)
        ->select('categories.*')
        ->get();

    }
    
    public function getCategoriesByTenantId(int $id)
    {   
        return DB::table($this->table)->where('tenant_id', $id)->get();

    }

    public function getCategoryByUuid(string $identify)
    {
        return DB::table($this->table)->where('uuid', $identify)->first();

    }

}
