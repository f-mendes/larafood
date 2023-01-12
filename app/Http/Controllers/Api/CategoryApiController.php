<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\Api\TenantFormRequest;

class CategoryApiController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $service)
    {
        $this->categoryService = $service;
    }

    public function categoriesByTenant(TenantFormRequest $request)
    {
        $catgegories = $this->categoryService->getCategoriesByTenantUuid($request->token_company);
        return CategoryResource::collection($catgegories);
    }

    public function show(TenantFormRequest $request, $url)
    {
        $category = $this->categoryService->getCategoryByUrl($url);
        if(!$category)
            return response()->json(['message', 'Category Not Found'],404);
            
        return new CategoryResource($category);
    }
}
