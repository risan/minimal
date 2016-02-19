<?php

namespace Minimal\Support;

use Minimal\Support\Contracts\ServiceProvider as ServiceProviderContract;
use League\Container\ServiceProvider\AbstractServiceProvider as LeagueServiceProvider;

abstract class ServiceProvider extends LeagueServiceProvider implements ServiceProviderContract
{

}
