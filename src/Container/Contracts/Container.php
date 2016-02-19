<?php

namespace Minimal\Container\Contracts;

use Interop\Container\ContainerInterface as InteropContainerContract;

interface Container extends InteropContainerContract
{
    public function bind($abstract, $concrete = null, $shared = false);

    public function singleton($abstract, $concrete = null);

    public function register($provider);

    public function make($abstract, array $parameters = []);
}
