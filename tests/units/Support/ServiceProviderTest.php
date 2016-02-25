<?php

use Minimal\Foundation\Application;
use Minimal\Support\ServiceProvider;

class ServiceProviderTest extends PHPUnit_Framework_TestCase {
    protected $application;
    protected $serviceProvider;

    function setUp()
    {
        $application = new Application;

        $this->serviceProvider = new FooBarServiceProvider;

        $this->serviceProvider->setContainer($application);
    }

    /** @test */
    function service_provider_has_application()
    {
        $this->assertInstanceOf(Application::class, $this->serviceProvider->app());
    }
}

class FooBarServiceProvider extends ServiceProvider
{
    protected $provides = ['fooBar'];

    public function register()
    {
        $this->app()->bind('fooBar', 'fooBar');
    }
}
