<?php

namespace Minimal\Http\Contracts;

interface Request
{
    public static function capture();

    public function method();

    public function path();
}
