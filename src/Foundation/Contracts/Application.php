<?php

namespace Minimal\Foundation\Contracts;

interface Application
{
    public function basePath();

    public function setBasePath($basePath);

    public function bootstrap();

    public function coreServiceProviders();

    public function registerCoreServiceProviders();
}
