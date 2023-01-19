<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Test Products without token_company
     *
     * @return void
     */
    public function testProductsWithoutTokenCompany()
    {
        $response = $this->getJson('/api/v1/products');

        $response->assertStatus(422);
    }


    /**
     * Test Products with token_company
     *
     * @return void
     */
    public function testProductsWithTokenCompany()
    {
        $tenant = factory(Tenant::class)->create();
        // factory(Product::class, 3)->create(['tenant_id'=> $tenant->id]);
        
        
        $response = $this->getJson("/api/v1/products?token_company={$tenant->uuid}");
       

        $response->assertStatus(200);
    }


     /**
     * Test Product not found
     *
     * @return void
     */
    public function testProductNotFound()
    {
        $tenant = factory(Tenant::class)->create();
        $product = 'fake_value';

        $response = $this->getJson("/api/v1/product/{$product}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Test Product finded
     *
     * @return void
     */
    public function testProductFinded()
    {
        $tenant = factory(Tenant::class)->create();
        $product = factory(Product::class)->create(['tenant_id' => $tenant->id]);

        $response = $this->getJson("/api/v1/product/{$product->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
