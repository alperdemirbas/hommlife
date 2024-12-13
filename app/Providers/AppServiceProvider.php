<?php

namespace App\Providers;

use App\Repositories\CampaignPeriodProductRepository;
use App\Repositories\CampaignPeriodProductRepositoryInterface;
use App\Repositories\CampaignPeriodRepository;
use App\Repositories\CampaignPeriodRepositoryInterface;
use App\Repositories\CampaignRepository;
use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\CartRepository;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CampaignRepositoryInterface::class, CampaignRepository::class);
        $this->app->bind(CampaignPeriodRepositoryInterface::class, CampaignPeriodRepository::class);
        $this->app->bind(CampaignPeriodProductRepositoryInterface::class, CampaignPeriodProductRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('admin', function () {
            return request()->is('admin/*');
        });

        Blade::if('user', function () {
            return !request()->is('admin/*') && request()->is('/*');
        });


    }
}
