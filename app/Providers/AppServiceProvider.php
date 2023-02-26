<?php

namespace App\Providers;

use App\Repositories\Contracts\ProductsFilterInterface;
use App\Repositories\ProductsFilter;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(ProductsFilterInterface::class, ProductsFilter::class);
    }
}
