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

    /**
     * @test
     * @expectedException League\Container\Exception\NotFoundException
     */
    function container_throws_exception_when_accessing_non_existed_service()
    {
        $this->container['notExists'];
    }

    /** @test */
    function container_can_set_a_service()
    {
        $this->container->offsetSet('baz', new FooBar);

        $this->assertInstanceOf(FooBar::class, $this->container['baz']);
    }

    /** @test */
    function container_can_unset_a_service()
    {
        $this->container->offsetSet('baz', new FooBar);

        $this->container->offsetUnset('baz');

        $this->assertFalse($this->container->offsetExists('baz'));
    }

    /** @test */
    function container_can_bind_service()
    {
        $this->container->bind('baz', function () {
            return new FooBar;
        });

        $this->assertInstanceOf(FooBar::class, $this->container['baz']);
    }
}

class FooBar
{
    //
}
