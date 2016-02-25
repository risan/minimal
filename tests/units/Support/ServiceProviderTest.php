<?php

use Mockery as m;
use Minimal\Foundation\Application;
use Minimal\Support\ServiceProvider;

class ServiceProviderTest extends PHPUnit_Framework_TestCase {
    protected $application;
    protected $serviceProvider;

    public function tearDown()
    {
        m::close();
    }

    function setUp()
    {
        $this->application = m::mock(Application::class);

        $this->serviceProvider = m::mock(ServiceProvider::class);
    }

    /** @test */
    function service_provider_can_retrieve_application_instance()
    {
        $this->serviceProvider
            ->shouldReceive('setContainer')
            ->once()
            ->with($this->application);

        $this->serviceProvider->setContainer($this->application);

        $this->serviceProvider
            ->shouldReceive('app')
            ->once()
            ->andReturn($this->application);

        $this->assertInstanceOf(Application::class, $this->serviceProvider->app());
    }
}
