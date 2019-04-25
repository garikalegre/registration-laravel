<?php

namespace App\Providers;


use App\Adapters\Config\Contracts\ConfigRepository;
use App\Adapters\Container\Contracts\Container;
use App\Source\User\UserRepository;
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
        $this->app->bind(Container::class, \App\Adapters\Container\Container::class);
        $this->app->bind(ConfigRepository::class, \App\Adapters\Config\ConfigRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
