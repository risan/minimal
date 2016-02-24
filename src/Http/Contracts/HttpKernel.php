<?php

namespace Minimal\Http\Contracts;

use Minimal\Foundation\Application;
use Minimal\Http\Contracts\Request as RequestContract;

interface HttpKernel
{
    public function routeDispatcher();

    public function callableResolver();

    public function handle(RequestContract $request);
}
