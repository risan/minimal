<?php

namespace Minimal\Http\Contracts;

use Minimal\Foundation\Application;
use Minimal\Http\Contracts\Request as RequestContract;

interface HttpKernel
{
    public function app();

    public function routeDispatcher();

    public function handle(RequestContract $request);
}
