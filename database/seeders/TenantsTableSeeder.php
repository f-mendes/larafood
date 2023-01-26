<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '23882706000100', // CNPJ da empresa
            'name' => 'Empresa Teste',
            'email' => 'empresateste@mail.com'
        ]);
    }
}
