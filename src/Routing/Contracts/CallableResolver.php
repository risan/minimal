<?php

namespace Minimal\Routing\Contracts;

interface CallableResolver
{
    public function container();

    public function resolve($callable, array $args = []);

    public function isClassAndMethodPair($callable);

    public function createCallableFromString($callable);
}
