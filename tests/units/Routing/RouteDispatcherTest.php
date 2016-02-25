<?php

use Mockery as m;
use Minimal\Http\Request;
use Minimal\Routing\Router;
use Minimal\Routing\RouteDispatcher;

class RouteDispatcherTest extends PHPUnit_Framework_TestCase {
    protected $router;
    protected $routeDispatcher;

    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        $this->router = m::mock(Router::class);

        $this->routeDispatcher = new RouteDispatcher($this->router);
    }

    /** @test */
    public function router_dispatcher_can_retrieve_router_instance()
    {
        $this->assertInstanceOf(Router::class, $this->routeDispatcher->router());
    }

    /** @test */
    public function router_dispatcher_can_dispatch_with_request()
    {
        $request = m::mock(Request::class);

        $this->router->shouldReceive('staticRouteMap')->once()->andReturn([]);

        $this->router->shouldReceive('variableRouteData')->once()->andReturn([]);

        $request->shouldReceive('method')->once()->andReturn('GET');

        $request->shouldReceive('path')->once()->andReturn('foo');

        $this->assertInternalType('array', $this->routeDispatcher->dispatchWithRequest($request));
    }

    /** @test */
    public function router_dispatcher_can_set_route_map_and_data()
    {
        $this->router->shouldReceive('staticRouteMap')->once()->andReturn([]);

        $this->router->shouldReceive('variableRouteData')->once()->andReturn([]);

        $this->assertNull($this->routeDispatcher->setRouteMapAndData());
    }
}
