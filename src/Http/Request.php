<?php

namespace Minimal\Http;

use Symfony\Component\HttpFoundation\ParameterBag;
use Minimal\Http\Contracts\Request as RequestContract;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest implements RequestContract
{
    protected $json;

    public static function capture()
    {
        return static::createFromGlobals();
    }

    public function method()
    {
        return $this->getMethod();
    }

    public function root()
    {
        $url = $this->getSchemeAndHttpHost() . $this->getBaseUrl();

        return rtrim($url, '/');
    }

    public function url()
    {
        $url = preg_replace('/\?.*/', '', $this->getUri());

        return rtrim($url, '/');
    }

    public function fullUrl()
    {
        $query = $this->getQueryString();

        $question = $this->getBaseUrl() . $this->getPathInfo() === '/' ? '/?' : '?';

        return $query ? $this->url() . $question . $query : $this->url();
    }

    public function path()
    {
        return $this->getPathInfo();
    }

    public function ip()
    {
        return $this->getClientIp();
    }

    public function ips()
    {
        return $this->getClientIps();
    }

    public function isAjax()
    {
        return $this->isXmlHttpRequest();
    }

    public function isJson()
    {
        $contentType = $this->contentType();

        if (strpos($contentType, '/json') !== false) {
            return true;
        }

        if (strpos($contentType, '+json') !== false) {
            return true;
        }

       return false;
    }

    public function contentType()
    {
        return $this->header('CONTENT_TYPE');
    }

    public function header($key, $default = null)
    {
        return $this->headers->get($key, $default);
    }

    public function query($key, $default = null)
    {
        return $this->query->get($key, $default);
    }

    public function cookie($key, $default = null)
    {
        return $this->cookies->get($key, $default);
    }

    public function content()
    {
        return $this->getContent();
    }

    public function json($key = null, $default = null)
    {
        if ( ! isset($this->json)) {
            $this->json = new ParameterBag((array) json_decode($this->content(), true));
        }

        if (is_null($key)) {
            return $this->json;
        }

        return $this->json->get($key, $default);
    }

    public function input($key = null, $default = null)
    {
        $inputSource = $this->inputSource();

        if (is_null($key)) {
            return $inputSource;
        }

        if (is_string($key)) {
            return $inputSource->get($key, $default);
        }

        $inputs = [];

        foreach ($key as $inputKey) {
            array_push($inputs, $inputSource->get($inputKey));
        }

        return $inputs;
    }

    public function inputSource()
    {
        if ($this->isJson()) {
            return $this->json();
        }

        return $this->method() === 'GET' ? $this->query : $this->request;
    }
}
