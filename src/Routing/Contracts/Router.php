<?php

namespace Minimal\Routing\Contracts;

interface Router
{
    public function get($uri, $action);
    public function post($uri, $action);
    public function put($uri, $action);
    public function patch($uri, $action);
    public function delete($uri, $action);
    public function options($uri, $action);
    public function any($uri, $action);
    public function addRoute($methods, $uri, $action);
    public function getData();
    public function staticRouteMap();
    public function variableRouteData();
}
