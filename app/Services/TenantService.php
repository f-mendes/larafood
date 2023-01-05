<?php

namespace App\Services;

use App\Models\Plan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class TenantService
{

    private $plan, $data = [];

    public function make(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->createTenant();
        $user = $this->createUser($tenant);

        return $user;
    }

    public function createTenant()
    {
        return $this->plan->tenants()->create([
            'cnpj' => $this->data['cnpj'],
            'name' => $this->data['empresa'],
            'url' => Str::slug($this->data['empresa']),
            'email' => $this->data['email'],

            'subscription' => now(),
            'expires_at' => now()->addDays(7),
        ]);
    }

    public function createUser($tenant)
    {
        return $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => Hash::make($this->data['password']),
        ]);
    }


}