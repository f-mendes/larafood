<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TableTest extends TestCase
{
    /**
     * Erro Get Tables by Tenant
     *
     * @return void
     */
    public function testGetTablesByTenantError()
    {
        $response = $this->getJson("/api/v1/tables");

        $response->assertStatus(422);
    }

    /**
     * Get Tables by Tenant
     *
     * @return void
     */
    public function testGetTablesByTenant()
    {
        $tenant = factory(Tenant::class)->create();
        factory(Table::class,3)->create(['tenant_id'=>$tenant->id]);


        $response = $this->getJson("/api/v1/tables?token_company={$tenant->uuid}");

        //$response->dump();

        $response->assertStatus(200);
    }


     /**
     * Error Get Table by Tenant
     *
     * @return void
     */
    public function testGetTableByTenantError()
    {
        $table = 'fake_value';
        $tenant = factory(Tenant::class)->create();


        $response = $this->getJson("/api/v1/tables/{$table}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

     /**
     * Get Table by Tenant
     *
     * @return void
     */
    public function testGetTableByTenant()
    {
        $tenant = factory(Tenant::class)->create();
        $table = factory(Table::class)->create(['tenant_id'=>$tenant->id]);

        $response = $this->getJson("/api/v1/tables/{$table->uuid}?token_company={$tenant->uuid}");

        //$response->dump();
        $response->assertStatus(200);
    }
}
