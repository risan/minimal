<?php

namespace Minimal\Http\Contracts;

interface Request
{
    public static function capture();

    public function method();

    public function root();

    public function url();

    public function fullUrl();

    public function path();

    public function ip();

    public function ips();

    public function isAjax();

    public function isJson();

    public function contentType();

    public function header($key, $default = null);

    public function query($key, $default = null);

    public function cookie($key, $default = null);

    public function content();

    public function json($key = null, $default = null);

    public function input($key = null, $default = null);

    public function inputSource();
}
