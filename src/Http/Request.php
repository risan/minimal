<?php

namespace Minimal\Http;

use Minimal\Http\Contracts\Request as RequestContract;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest implements RequestContract
{
    public static function capture()
    {
        return static::createFromGlobals();
    }

    public function method()
    {
        return $this->getMethod();
    }

    public function path()
    {
        return $this->getPathInfo();
    }
}
