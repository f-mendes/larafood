<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    protected $category, $product;

    public function __construct(Category $category, Product $product)
    {

        $this->category = $category;
        $this->product = $product;

        $this->middleware(['can:categories']);
    }

    public function categories($idProduct)
    {
        $product = $this->product->find($idProduct);
        
        if(!$product)
            return redirect()->back();

        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.index', compact('product', 'categories'));
    }

    public function categoriesAvailable(Request $request, $idProduct)
    {
        
        if(!$product = $this->product->find($idProduct))
            return redirect()->back();


        $filters = $request->except('_token');
        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.categories.available', compact('product', 'categories', 'filters'));
    }

    public function attachCategoryProduct(Request $request, $idProduct)
    {
        if(!$product = $this->product->find($idProduct))
            return redirect()->back();

        if(!$request->categories || count($request->categories) == 0){
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma categoria');
        }

        $product->categories()->attach($request->categories);

        return redirect()->route('products.categories', $product->id);
    }

    public function detachCategoryProduct($idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        if(!$product || !$category)
            return redirect()->back();

        $product->categories()->detach($category);

        return redirect()->route('products.categories', $product->id);
    }
}
