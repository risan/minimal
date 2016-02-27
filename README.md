# Minimal

A bare minimum PHP framework.

## Dependencies

This framework is powered up by these following great pacakages:

* [League Container](https://github.com/thephpleague/container)
* [Nikic FastRoute](https://github.com/nikic/FastRoute)
* [Symfony Http Foundation](https://github.com/symfony/http-foundation)

## Installation

To install this framework using [Composer](https://getcomposer.org/), run the following command inside your project directory:

```bash
composer require risan/minimal
```

Or you may also add the `risan\minimal` package into your `composer.json` file like so:

```bash
"require": {
  "risan/master": "dev-master"
}
```

Once it's save, run the following command to install this framework:

```bash
composer install
```

## Hello World

Here is the hello world example.

```php
<?php

// Include composer autoloder file.
require __DIR__.'/vendor/autoload.php';

// Create a new instance of Minimal application.
$app = new Minimal\Foundation\Application();

// Register new route.
$app['router']->get('/', function (Minimal\Http\Request $request, Minimal\Http\Response $response) {
    return $response->setContent('Hello World.');
});
```

## Route Parameter

```php
$app['router']->get('/hello/{name}', function (Minimal\Http\Request $request, Minimal\Http\Response $response, $name) {
    return $response->setContent(sprintf('Hello %s.', $name));
});
```

## Route with Controller

```php
$app['router']->get('/hello/{name}', 'MyController@hello');
```

Your `MyController.php` will look like this:

```php
<?php

use Minimal\Http\Request;
use Minimal\Http\Response;

class MyController
{
    public function hello(Request $request, Response $response, $name)
    {
        return $response->setContent(sprintf('Hello %s.', $name));
    }
}
}
```
