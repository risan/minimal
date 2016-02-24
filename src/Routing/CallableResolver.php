<?php

namespace Minimal\Routing;

use Minimal\Container\Contracts\Container as ContainerContract;
use Minimal\Routing\Contracts\CallableResolver as CallableResolverContract;

class CallableResolver implements CallableResolverContract
{
    const CLASS_METHOD_SEPARATOR = '@';

    protected $container;

    public function __construct(ContainerContract $container)
    {
        $this->container = $container;
    }

    public function container()
    {
        return $this->container;
    }

    public function resolve($callable, array $args = [])
    {
        if ($this->isClassAndMethodPair($callable)) {
            $callable = $this->createCallableFromString($callable);
        }

        return $this->container->call($callable, $args);
    }

    public function isClassAndMethodPair($callable)
    {
        return is_string($callable) && strpos($callable, self::CLASS_METHOD_SEPARATOR) !== false;
    }

    public function createCallableFromString($callable)
    {
        list($className, $methodName) = $this->getClassAndMethodPair($callable);

        $classInstance = $this->container()->get($className);

        return [$classInstance, $methodName];
    }

    protected function getClassAndMethodPair($callable)
    {
        return explode(self::CLASS_METHOD_SEPARATOR, $callable);
    }
}
