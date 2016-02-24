<?php

namespace Minimal\Foundation;

use Minimal\Container\Container;
use Minimal\Routing\RouteDispatcher;
use Minimal\Foundation\Contracts\Application as ApplicationContract;

class Application extends Container implements ApplicationContract
{
    protected $basePath;

    protected $coreServiceProviders = [
        \Minimal\Http\HttpServiceProvider::class,
        \Minimal\Routing\RoutingServiceProvider::class,
    ];

    public function __construct($basePath = null)
    {
        parent::__construct();

        if ( ! is_null($basePath)) {
            $this->setBasePath($basePath);
        }

        $this->bootstrap();
    }

    public function basePath()
    {
        return $this->basePath;
    }

    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

        return $this;
    }

    public function bootstrap()
    {
        $this->registerCoreServiceProviders();
    }

    public function coreServiceProviders()
    {
        return $this->coreServiceProviders;
    }

    public function registerCoreServiceProviders()
    {
        foreach ($this->coreServiceProviders() as $provider) {
            $this->register($provider);
        }
    }

    public function start()
    {
        $httpKernel = $this->make('Minimal\Http\Contracts\HttpKernel');

        $response = $httpKernel->handle($this['request']);

        $response->prepare($this['request']);

        $response->send();
    }
}
