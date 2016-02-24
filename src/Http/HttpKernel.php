<?php

namespace Minimal\Http;

use Minimal\Routing\RouteDispatcher;
use Minimal\Http\Exception\NotFoundHttpException;
use Minimal\Http\Contracts\Request as RequestContract;
use Minimal\Http\Exception\MethodNotAllowedHttpException;
use Minimal\Http\Contracts\HttpKernel as HttpKernelContract;
use Minimal\Routing\Contracts\RouteDispatcher as RouteDispatcherContract;
use Minimal\Routing\Contracts\CallableResolver as CallableResolverContract;

class HttpKernel implements HttpKernelContract
{
    protected $routeDispatcher;

    protected $callableResolver;

    public function __construct(RouteDispatcherContract $routeDispatcher, CallableResolverContract $callableResolver)
    {
        $this->routeDispatcher = $routeDispatcher;
        $this->callableResolver = $callableResolver;
    }

    public function routeDispatcher()
    {
        return $this->routeDispatcher;
    }

    public function callableResolver()
    {
        return $this->callableResolver;
    }

    public function handle(RequestContract $request)
    {
        $routeInfo = $this->routeDispatcher()->dispatchWithRequest($request);

        switch ($routeInfo[0]) {
            case RouteDispatcher::NOT_FOUND;
                throw new NotFoundHttpException;
            case RouteDispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                throw new MethodNotAllowedHttpException;
            case RouteDispatcher::FOUND:
                $callable = $routeInfo[1];
                $args = $routeInfo[2];

                return $this->callableResolver()->resolve($callable, $args);
        }
    }
}
