<?php

namespace Minimal\Support\Contracts;

use League\Container\ServiceProvider\ServiceProviderInterface as LeagueServiceProviderContract;
use League\Container\ServiceProvider\BootableServiceProviderInterface as LeagueBootableServiceProviderContract;

interface ServiceProvider extends LeagueServiceProviderContract, LeagueBootableServiceProviderContract
{
    public function app();
}
