<?php

use Minimal\Foundation\Application;

class ApplicationTest extends PHPUnit_Framework_TestCase {
    protected $basePath;
    protected $application;

    function setUp()
    {
        $this->basePath = 'foo';
        $this->application = new Application($this->basePath);
    }

    /** @test */
    function application_has_base_path()
    {
        $this->assertEquals($this->basePath, $this->application->basePath());
    }

    /** @test */
    function application_can_set_base_path()
    {
        $this->assertInstanceOf(Application::class, $this->application->setBasePath('bar'));

        $this->assertEquals('bar', $this->application->basePath());
    }

    /** @test */
    function application_can_bootstrap()
    {
        $this->assertNull($this->application->bootstrap());
    }

    /** @test */
    function application_has_core_service_providers()
    {
        $this->assertInternalType('array', $this->application->coreServiceProviders());
    }

    /** @test */
    function application_can_register_core_service_providers()
    {
        $this->assertNull($this->application->registerCoreServiceProviders());
    }

    /**
     * @test
     * @expectedException Minimal\Http\Exception\NotFoundHttpException
     */
    function application_can_be_started()
    {
        $this->application->start();
    }
}
