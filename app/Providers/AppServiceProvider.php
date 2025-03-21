<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\ApiClientInterface;
use App\Services\NytApiClient;
use App\Repositories\BestSellersRepositoryInterface; // Import the BestSellersRepositoryInterface
use App\Repositories\NytBestSellersRepository; // Import the NytBestSellersRepository


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(
            ApiClientInterface::class,
            NytApiClient::class
        );

        // Bind BestSellersRepositoryInterface to NytBestSellersRepository
        $this->app->bind(
            BestSellersRepositoryInterface::class,
            NytBestSellersRepository::class
        );
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
