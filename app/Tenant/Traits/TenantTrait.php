<?php

namespace App\Tenant\Traits;

use App\Tenant\Scopes\TenantScope;
use App\Tenant\Observers\TenantObserver;

trait TenantTrait
{
     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::observe(TenantObserver::class);

        static::addGlobalScope(new TenantScope);
    }
}