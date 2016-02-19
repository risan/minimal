<?php

namespace Minimal\Foundation\Contracts;

interface Application
{
    public function basePath();

    public function setBasePath($basePath);
}
