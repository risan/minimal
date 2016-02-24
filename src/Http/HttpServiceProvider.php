<?php

namespace Minimal\Http;

use Minimal\Support\ServiceProvider;

class HttpServiceProvider extends ServiceProvider
{
    protected $provides = [
        'request',
        'response',
        'Minimal\Http\Contracts\HttpKernel',
    ];

    public function register()
    {
        $this->registerRequest();

        $this->registerResponse();

        $this->registerHttpKernel();
    }

    protected function registerRequest()
    {
        $this->app()->bind('request', function () {
            return Request::capture();
        });
    }

    protected function registerResponse()
    {
        $this->app()->bind('response', function () {
            return new Response;
        });
    }

    protected function registerHttpKernel()
    {
        $this->app()->bind('Minimal\Http\Contracts\HttpKernel', function () {
            $routeDispatcher = $this->app()->make('Minimal\Routing\Contracts\RouteDispatcher');
            $callableResolver = $this->app()->make('Minimal\Routing\Contracts\CallableResolver');

            return new HttpKernel($routeDispatcher, $callableResolver);
        });
    }
}
