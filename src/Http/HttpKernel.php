<?php

namespace Minimal\Http;

use Minimal\Foundation\Application;
use Minimal\Routing\RouteDispatcher;
use Minimal\Http\Exception\NotFoundHttpException;
use Minimal\Http\Contracts\Request as RequestContract;
use Minimal\Http\Exception\MethodNotAllowedHttpException;
use Minimal\Http\Contracts\HttpKernel as HttpKernelContract;
use Minimal\Routing\Contracts\RouteDispatcher as RouteDispatcherContract;

class HttpKernel implements HttpKernelContract
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function app()
    {
        return $this->app;
    }

    public function routeDispatcher()
    {
        return $this->app->make('Minimal\Routing\Contracts\RouteDispatcher');
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
                $action = $routeInfo[1];

                $args = array_merge([$this->app()['request'], $this->app()['response']], $routeInfo[2]);

                return call_user_func_array($action, $args);
        }
    }
}
