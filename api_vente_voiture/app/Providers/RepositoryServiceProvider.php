<?php

namespace App\Providers;

use App\Interfaces\OperationRepositoryInterface;
use App\Repositories\OperationRepository;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OperationRepositoryInterface::class, OperationRepository::class);


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
