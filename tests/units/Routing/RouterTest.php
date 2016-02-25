<?php

use Mockery as m;
use Minimal\Routing\Router;
use FastRoute\RouteParser\Std as RouteParser;
use FastRoute\DataGenerator\GroupCountBased as DataGenerator;

class RouterTest extends PHPUnit_Framework_TestCase {
    protected $route;
    protected $routeParser;
    protected $dataGenerator;
    protected $router;

    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        $this->route = '/foo';

        $this->routeParser = m::mock(RouteParser::class);

        $this->dataGenerator = m::mock(DataGenerator::class);

        $this->router = new Router($this->routeParser, $this->dataGenerator);
    }

    /** @test */
    public function router_can_register_get_route()
    {
        $this->routeParserParseShouldBeCalled($this->route);

        $this->dataGeneratorAddRouteShouldBeCalled(['GET', 'HEAD']);

        $this->assertNull($this->router->get($this->route, null));
    }

    /** @test */
    public function router_can_register_post_route()
    {
        $this->routeParserParseShouldBeCalled($this->route);

        $this->dataGeneratorAddRouteShouldBeCalled('POST');

        $this->assertNull($this->router->post($this->route, null));
    }

    /** @test */
    public function router_can_register_put_route()
    {
        $this->routeParserParseShouldBeCalled($this->route);

        $this->dataGeneratorAddRouteShouldBeCalled('PUT');

        $this->assertNull($this->router->put($this->route, null));
    }

    /** @test */
    public function router_can_register_patch_route()
    {
        $this->routeParserParseShouldBeCalled($this->route);

        $this->dataGeneratorAddRouteShouldBeCalled('PATCH');

        $this->assertNull($this->router->patch($this->route, null));
    }

    /** @test */
    public function router_can_register_delete_route()
    {
        $this->routeParserParseShouldBeCalled($this->route);

        $this->dataGeneratorAddRouteShouldBeCalled('DELETE');

        $this->assertNull($this->router->delete($this->route, null));
    }

    /** @test */
    public function router_can_register_options_route()
    {
        $this->routeParserParseShouldBeCalled($this->route);

        $this->dataGeneratorAddRouteShouldBeCalled('OPTIONS');

        $this->assertNull($this->router->options($this->route, null));
    }

    /** @test */
    public function router_can_register_any_route()
    {
        $this->routeParserParseShouldBeCalled($this->route);

        $this->dataGeneratorAddRouteShouldBeCalled(['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE']);

        $this->assertNull($this->router->any($this->route, null));
    }

    /** @test */
    public function router_can_retrieve_route_data()
    {
        $this->dataGeneratorGetDataShouldBeCalled();

        $this->assertCount(2, $this->router->getData());
    }

    /** @test */
    public function router_can_retrieve_static_route_map()
    {
        $this->dataGeneratorGetDataShouldBeCalled();

        $this->assertEquals('foo', $this->router->staticRouteMap());
    }

    /** @test */
    public function router_can_retrieve_variable_route_data()
    {
        $this->dataGeneratorGetDataShouldBeCalled();

        $this->assertEquals('bar', $this->router->variableRouteData());
    }

    protected function routeParserParseShouldBeCalled($route)
    {
        $this->routeParser
            ->shouldReceive('parse')
            ->once()
            ->with($route)
            ->andReturn(['bar']);
    }

    protected function dataGeneratorAddRouteShouldBeCalled($methods)
    {
        if (is_string($methods)) {
            $methods = [$methods];
        }

        foreach ($methods as $method) {
            $this->dataGenerator
               ->shouldReceive('addRoute')
               ->once()
               ->with($method, 'bar', null);
        }
    }

    protected function dataGeneratorGetDataShouldBeCalled()
    {
        $this->dataGenerator
            ->shouldReceive('getData')
            ->once()
            ->andReturn(['foo', 'bar']);
    }
}
