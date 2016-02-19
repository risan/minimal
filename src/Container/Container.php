<?php

namespace Minimal\Container;

use ArrayAccess;
use League\Container\Container as BaseContainer;
use Minimal\Container\Contracts\Container as ContainerContract;

class Container extends BaseContainer implements ArrayAccess, ContainerContract
{
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    public function offsetGet($key)
    {
        return $this->make($key);
    }

    public function offsetSet($key, $value)
    {
        $this->bind($key, $value);
    }

    public function offsetUnset($key)
    {
        unset($this->shared[$key], $this->sharedDefinitions[$key], $this->definitions[$key]);
    }

    public function bind($abstract, $concrete = null, $shared = false)
    {
        $this->add($abstract, $concrete, $shared);
    }

    public function singleton($abstract, $concrete = null)
    {
        return $this->bind($abstract, $concrete, true);
    }

    public function make($abstract, array $parameters = [])
    {
        return $this->get($abstract, $parameters);
    }
}
