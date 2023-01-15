<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the product "creating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {   //$ascii = Str::ascii($product->name);
        //$product->url = Str::kebab($ascii);
        $product->url = Str::slug($product->name);
        $product->uuid = Str::uuid();

    }

    /**
     * Handle the product "updating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        $product->url = Str::slug($product->name);
    }
}
