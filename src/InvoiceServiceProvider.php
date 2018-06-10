<?php

namespace Railken\LaraOre;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Railken\LaraOre\Api\Support\Router;

class InvoiceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->publishes([
            __DIR__.'/../config/ore.invoice.php' => config_path('ore.invoice.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutes();

        /*config(['ore.user.permission.managers' => array_merge(Config::get('ore.user.permission.managers'), [
            \Railken\LaraOre\Invoice\InvoiceManager::class,
        ])]);*/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Railken\Laravel\Manager\ManagerServiceProvider::class);
        $this->app->register(\Railken\LaraOre\ApiServiceProvider::class);
        $this->app->register(\Railken\LaraOre\UserServiceProvider::class);
        $this->mergeConfigFrom(__DIR__.'/../config/ore.invoice.php', 'ore.invoice');
    }

    /**
     * Load routes.
     *
     * @return void
     */
    public function loadRoutes()
    {
        Router::group(array_merge(Config::get('ore.invoice.router'), [
            'namespace' => 'Railken\LaraOre\Http\Controllers',
        ]), function ($router) {
            $router->get('/', ['uses' => 'InvoicesController@index']);
            $router->post('/', ['uses' => 'InvoicesController@create']);
            $router->put('/{id}', ['uses' => 'InvoicesController@update']);
            $router->delete('/{id}', ['uses' => 'InvoicesController@remove']);
            $router->get('/{id}', ['uses' => 'InvoicesController@show']);
        });
    }
}
