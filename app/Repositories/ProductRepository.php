<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{   
    protected $table;

    public function __construct()
    {
        $this->table = 'products';
    }


    public function getProductsByTenantId(int $id, array $categories)
    {       
        return DB::table($this->table)
        ->join('product_category', 'product_category.product_id', 'products.id')
        ->join('categories', 'product_category.category_id', 'categories.id')
        ->where('products.tenant_id', $id)
        ->where('categories.tenant_id', $id)
        ->where(function ($query) use($categories){
            if(!empty($categories)){
                $query->whereIn('categories.uuid', $categories);
            }
        })
        ->select('products.*')
        ->get();

    }

    public function getProductByUuid(string $identify)
    {
        return DB::table($this->table)->where('uuid', $identify)->first();

    }


    
}
