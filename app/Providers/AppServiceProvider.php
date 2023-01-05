<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{
    Plan,
    Tenant,
    Category
};

use App\Observers\{
    PlanObserver, 
    TenantObserver,
    CategoryObserver
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
    }
}
