<?php

namespace Railken\LaraOre;

use Illuminate\Support\Facades\Config;
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
        $this->publishes([
            __DIR__.'/../config/ore.invoice-item.php' => config_path('ore.invoice-item.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../config/ore.invoice-tax.php' => config_path('ore.invoice-tax.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutes();

        /*config(['ore.user.permission.managers' => array_merge(Config::get('ore.user.permission.managers'), [
            \Railken\LaraOre\Invoice\InvoiceManager::class,
            \Railken\LaraOre\InvoiceItem\InvoiceItemManager::class,
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
        $this->app->register(\Railken\LaraOre\TaxonomyServiceProvider::class);
        $this->app->register(\Railken\LaraOre\LegalEntityServiceProvider::class);
        $this->app->register(\Railken\LaraOre\ListenerServiceProvider::class);
        $this->mergeConfigFrom(__DIR__.'/../config/ore.invoice.php', 'ore.invoice');
        $this->mergeConfigFrom(__DIR__.'/../config/ore.invoice-item.php', 'ore.invoice-item');
        $this->mergeConfigFrom(__DIR__.'/../config/ore.invoice-tax.php', 'ore.invoice-tax');
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

        Router::group(array_merge(Config::get('ore.invoice-item.router'), [
            'namespace' => 'Railken\LaraOre\Http\Controllers',
        ]), function ($router) {
            $router->get('/', ['uses' => 'InvoiceItemsController@index']);
            $router->post('/', ['uses' => 'InvoiceItemsController@create']);
            $router->put('/{id}', ['uses' => 'InvoiceItemsController@update']);
            $router->delete('/{id}', ['uses' => 'InvoiceItemsController@remove']);
            $router->get('/{id}', ['uses' => 'InvoiceItemsController@show']);
        });

        Router::group(array_merge(Config::get('ore.invoice-tax.router'), [
            'namespace' => 'Railken\LaraOre\Http\Controllers',
        ]), function ($router) {
            $router->get('/', ['uses' => 'InvoiceTaxesController@index']);
            $router->post('/', ['uses' => 'InvoiceTaxesController@create']);
            $router->put('/{id}', ['uses' => 'InvoiceTaxesController@update']);
            $router->delete('/{id}', ['uses' => 'InvoiceTaxesController@remove']);
            $router->get('/{id}', ['uses' => 'InvoiceTaxesController@show']);
        });
    }
}
