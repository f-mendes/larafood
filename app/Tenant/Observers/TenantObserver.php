<?php

namespace App\Tenant\Observers;

use App\Models\Tenant;
use App\Tenant\ManagementTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{

    /**
    * Handle the tenants "creating" event.
    *
    * @param  Illuminate\Database\Eloquent\Model $model
    * @return void
    */
   public function creating(Model $model)
   {
       $model->tenant_id = app(ManagementTenant::class)->getTenantIdentify();
   }

}