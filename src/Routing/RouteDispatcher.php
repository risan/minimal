<?php

namespace Minimal\Routing;

use Minimal\Http\Contracts\Request as RequestContract;
use Minimal\Routing\Contracts\Router as RouterContract;
use FastRoute\Dispatcher\GroupCountBased as FastRouteDispatcher;
use Minimal\Routing\Contracts\RouteDispatcher as RouteDispatcherContract;

class RouteDispatcher extends FastRouteDispatcher implements RouteDispatcherContract
{
    protected $router;

    public function __construct(RouterContract $router)
    {
        $this->router = $router;
    }

    public function router()
    {
        return $this->router;
    }

    public function dispatchWithRequest(RequestContract $request)
    {
        $this->setRouteMapAndData();

        return parent::dispatch($request->method(), $request->path());
    }

    public function setRouteMapAndData()
    {
        $this->staticRouteMap = $this->router()->staticRouteMap();
        $this->variableRouteData = $this->router()->variableRouteData();
    }
}
