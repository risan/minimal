<?php

namespace Minimal\Routing;

use Minimal\Support\ServiceProvider;
use FastRoute\RouteParser\Std as RouteParser;
use FastRoute\DataGenerator\GroupCountBased as DataGenerator;

class RoutingServiceProvider extends ServiceProvider
{
    protected $provides = [
        'router',
        'Minimal\Routing\Contracts\RouteDispatcher',
        'Minimal\Routing\Contracts\CallableResolver',
    ];

    public function register()
    {
        $this->registerRouter();

        $this->registerRouteDispatcher();

        $this->registerCallableResolver();
    }

    protected function registerRouter()
    {
        $this->app()->singleton('router', function () {
            return new Router(new RouteParser, new DataGenerator);
        });
    }

    protected function registerRouteDispatcher()
    {
        $this->app()->singleton('Minimal\Routing\Contracts\RouteDispatcher', function () {
            return new RouteDispatcher($this->app()['router']);
        });
    }

    protected function registerCallableResolver()
    {
        $this->app()->singleton('Minimal\Routing\Contracts\CallableResolver', function () {
            return new CallableResolver($this->app());
        });
    }
}
