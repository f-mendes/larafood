<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Tenant;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    /**
     * Erro Get Categories by Tenant
     *
     * @return void
     */
    public function testGetCategoriesByTenantError()
    {
        $response = $this->getJson("/api/v1/categories");

        $response->assertStatus(422);
    }

    /**
     * Get Categories by Tenant
     *
     * @return void
     */
    public function testGetCategoriesByTenant()
    {
        $tenant = factory(Tenant::class)->create();
        factory(Category::class,3)->create(['tenant_id'=>$tenant->id]);


        $response = $this->getJson("/api/v1/categories?token_company={$tenant->uuid}");

        //$response->dump();

        $response->assertStatus(200);
    }


     /**
     * Error Get Category by Tenant
     *
     * @return void
     */
    public function testGetCategoryByTenantError()
    {
        $category = 'fake_value';
        $tenant = factory(Tenant::class)->create();


        $response = $this->getJson("/api/v1/categories/{$category}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

     /**
     * Get Category by Tenant
     *
     * @return void
     */
    public function testGetCategoryByTenant()
    {
        $tenant = factory(Tenant::class)->create();
        $category = factory(Category::class)->create(['tenant_id'=>$tenant->id]);

        $response = $this->getJson("/api/v1/categories/{$category->uuid}?token_company={$tenant->uuid}");

        //$response->dump();
        $response->assertStatus(200);
    }
}
