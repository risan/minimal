<?php

namespace Minimal\Routing\Contracts;

use Minimal\Http\Contracts\Request as RequestContract;

interface RouteDispatcher
{
    public function router();

    public function dispatchWithRequest(RequestContract $request);

    public function setRouteMapAndData();
}
