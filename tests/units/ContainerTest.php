<?php

use Minimal\Container\Container;

class ContainerTest extends PHPUnit_Framework_TestCase {
    protected $container;

    function setUp()
    {
        $this->container = new Container;

        $this->container->bind('fooBar', function () {
            return new FooBar;
        });
    }

    /** @test */
    function container_can_check_if_service_is_exists()
    {
        $this->assertTrue($this->container->offsetExists('fooBar'));
    }

    /** @test */
    function container_can_check_if_service_is_not_exists()
    {
        $this->assertFalse($this->container->offsetExists('notExists'));
    }

    /** @test */
    function container_can_retrieve_service()
    {
        $this->assertInstanceOf(FooBar::class, $this->container['fooBar']);
    }
}

class FooBar
{
    //
}
