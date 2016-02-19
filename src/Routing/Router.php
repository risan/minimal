<?php

namespace Minimal\Routing;

use FastRoute\RouteCollector;
use Minimal\Routing\Contacts\Routing as RoutingContract;

class Router implements RoutingContract
{
    protected $routeCollector;

    public function __construct(RouteCollector $routeCollector)
    {
        $this->routeCollector = $routeCollector;
    }

    public function routeCollector()
    {
        return $this->routeCollector;
    }

    public function get($uri, $action)
    {
        $this->addRoute(['GET', 'HEAD'], $uri, $action);
    }

    public function post($uri, $action)
    {
        $this->addRoute('POST', $uri, $action);
    }

    public function put($uri, $action)
    {
        $this->addRoute('PUT', $uri, $action);
    }

    public function patch($uri, $action)
    {
        $this->addRoute('PATCH', $uri, $action);
    }

    public function delete($uri, $action)
    {
        $this->addRoute('DELETE', $uri, $action);
    }

    public function options($uri, $action)
    {
        $this->addRoute('OPTIONS', $uri, $action);
    }

    public function any($uri, $action)
    {
        $verbs = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE'];

        $this->addRoute($verbs, $uri, $action);
    }

    public function addRoute($methods, $uri, $action)
    {
        $this->routeCollector()->addRoute($methods, $uri, $action);
    }

    public function getData()
    {
        $this->routeCollector()->getData();
    }
}
