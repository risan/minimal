<?php

use Mockery as m;
use Minimal\Container\Container;
use Minimal\Routing\CallableResolver;

class CallableResolverTest extends PHPUnit_Framework_TestCase {
    protected $container;
    protected $callableResolver;

    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        $this->container = m::mock(Container::class);

        $this->callableResolver = new CallableResolver($this->container);
    }

    /** @test */
    public function callable_resolver_can_retrieve_container_instance()
    {
        $this->assertInstanceOf(Container::class, $this->callableResolver->container());
    }

    /** @test */
    public function callable_resolver_can_resolve_callable_closure()
    {
        $callable = function () {
            return 'foo';
        };

        $this->container->shouldReceive('call')
            ->once()
            ->with($callable, [])
            ->andReturn('foo');

        $this->assertEquals('foo', $this->callableResolver->resolve($callable));
    }

    /** @test */
    public function callable_resolver_can_resolve_class_and_method_pair()
    {
        $this->container->shouldReceive('get')
            ->once()
            ->with('Foo')
            ->andReturn(new Foo);

        $this->container->shouldReceive('call')
            ->once()
            ->with([new Foo, 'bar'], [])
            ->andReturn('foo');

        $this->assertEquals('foo', $this->callableResolver->resolve('Foo@bar'));
    }

    /** @test */
    public function callable_resolver_can_check_if_callable_is_class_and_method_pair()
    {
        $this->assertTrue($this->callableResolver->isClassAndMethodPair('Foo@bar'));
    }

    /** @test */
    public function callable_resolver_can_create_callable_from_string()
    {
        $this->container->shouldReceive('get')
            ->once()
            ->with('Foo')
            ->andReturn(new Foo);

        $callable = $this->callableResolver->createCallableFromString('Foo@bar');

        $this->assertCount(2, $callable);
        $this->assertInstanceOf(Foo::class, $callable[0]);
        $this->assertEquals('bar', $callable[1]);
    }
}

class Foo
{
    public function bar()
    {
        return 'foo';
    }
}
