<?php

namespace Minimal\Foundation;

use Minimal\Container\Container;
use Minimal\Foundation\Contracts\Application as ApplicationContract;

class Application extends Container implements ApplicationContract
{
    protected $basePath;

    public function __construct($basePath = null)
    {
        if ( ! is_null($basePath)) {
            $this->setBasePath($basePath);
        }
    }

    public function basePath()
    {
        return $this->basePath;
    }

    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

        return $this;
    }
}
