<?php

use Mockery as m;
use Minimal\Http\Request;
use Minimal\Http\HttpKernel;
use Minimal\Routing\RouteDispatcher;
use Minimal\Routing\CallableResolver;

class HttpKernelTest extends PHPUnit_Framework_TestCase {
    protected $routeDispatcher;
    protected $callableResolver;
    protected $httpKernel;

    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        $this->routeDispatcher = m::mock(RouteDispatcher::class);

        $this->callableResolver = m::mock(CallableResolver::class);

        $this->httpKernel = new HttpKernel($this->routeDispatcher, $this->callableResolver);
    }

    /** @test */
    public function http_kernel_can_retrieve_route_dispatcher_instance()
    {
        $this->assertInstanceOf(RouteDispatcher::class, $this->httpKernel->routeDispatcher());
    }

    /** @test */
    public function http_kernel_can_retrieve_callable_resolver_instance()
    {
        $this->assertInstanceOf(CallableResolver::class, $this->httpKernel->callableResolver());
    }

    /** @test */
    public function http_kernel_can_handle_request()
    {
        $request = m::mock(Request::class);

        $callable = function () {
            return 'foo';
        };

        $this->routeDispatcher
            ->shouldReceive('dispatchWithRequest')
            ->once()
            ->with($request)
            ->andReturn([RouteDispatcher::FOUND, $callable, []]);

        $this->callableResolver
            ->shouldReceive('resolve')
            ->once()
            ->with($callable, [])
            ->andReturn('foo');

        $this->assertEquals('foo', $this->httpKernel->handle($request));
    }
}
