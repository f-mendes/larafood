<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{
    Plan,
    Tenant,
    Category,
    Client,
    Product,
    Table
};

use App\Observers\{
    PlanObserver, 
    TenantObserver,
    CategoryObserver,
    ClientObserver,
    ProductObserver,
    TableObserver
};
use Illuminate\Support\Facades\Blade;

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
        Product::observe(ProductObserver::class);
        Table::observe(TableObserver::class);
        Client::observe(ClientObserver::class);

         /**
         * Custom If Statements
         */
        Blade::if('admin', function () {
            $user = auth()->user();

            return $user->isAdmin();
        });
    }
}
