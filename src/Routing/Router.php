<?php

namespace Minimal\Routing;

use FastRoute\RouteCollector as FastRouteCollector;
use Minimal\Routing\Contracts\Router as RouterContract;

class Router extends FastRouteCollector implements RouterContract
{
    protected $data;

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

    public function getData()
    {
        if (is_null($this->data)) {
            $this->data = parent::getData();
        }

        return $this->data;
    }

    public function staticRouteMap()
    {
        return $this->getData()[0];
    }

    public function variableRouteData()
    {
        return $this->getData()[1];
    }
}
