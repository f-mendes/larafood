<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class Product extends Model
{
    use TenantTrait;
    
    protected $fillable = ['name', 'url', 'image', 'price', 'description', 'tenant_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function categoriesAvailable($filter = null){

        $categories = Category::whereNotIn('id', function($query){
            $query->select('product_category.category_id');
            $query->from('product_category');
            $query->whereRaw("product_category.product_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter){
            if($filter)
                $queryFilter->where('categories.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $categories;
    }


    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_category');
    }

   
}
