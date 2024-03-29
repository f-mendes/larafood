<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Api\TenantFormRequest;

class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $service)
    {
        $this->productService = $service;
    }

    public function productsByTenant(TenantFormRequest $request)
    {   
        $products = $this->productService->getProductsByTenantUuid(
            $request->token_company,
            $request->get('categories', [])
        );
        return ProductResource::collection($products);
    }

    public function show(TenantFormRequest $request, $identify)
    {
        $product = $this->productService->getProductByUuid($identify);
        if(!$product)
            return response()->json(['message', 'Product Not Found'],404);
            
        return new ProductResource($product);
    }
}
