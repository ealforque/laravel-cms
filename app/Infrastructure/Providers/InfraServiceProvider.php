<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Infrastructure\Common\Interfaces\FractalServiceInterface;
use App\Infrastructure\Common\Interfaces\PaginatorServiceInterface;
use App\Infrastructure\Common\Interfaces\RUIDServiceInterface;
use App\Infrastructure\Common\Services\FractalService;
use App\Infrastructure\Common\Services\PaginatorService;
use App\Infrastructure\Common\Services\RUIDService;
use Illuminate\Support\ServiceProvider;

class InfraServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FractalServiceInterface::class, FractalService::class);
        $this->app->bind(PaginatorServiceInterface::class, PaginatorService::class);
        $this->app->bind(RUIDServiceInterface::class, RUIDService::class);
    }
}
