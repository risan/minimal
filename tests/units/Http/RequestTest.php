<?php

use Mockery as m;
use Minimal\Http\Request;

class RequestTest extends PHPUnit_Framework_TestCase {
    protected $request;

    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        $this->request = new Request;
    }

    /** @test */
    public function request_can_be_instantiated_from_current_environment()
    {
        $this->assertInstanceOf(Request::class, Request::capture());
    }

    /** @test */
    public function request_can_retrieve_http_method()
    {
        $this->assertEquals('GET', $this->request->method());
    }

    /** @test */
    public function request_can_retrieve_root_url()
    {
        $this->assertEquals('http://:', $this->request->root());
    }

    /** @test */
    public function request_can_retrieve_url()
    {
        $this->assertEquals('http://:', $this->request->url());
    }

    /** @test */
    public function request_can_retrieve_full_url()
    {
        $this->assertEquals('http://:', $this->request->fullUrl());
    }

    /** @test */
    public function request_can_retrieve_path()
    {
        $this->assertEquals('/', $this->request->path());
    }

    /** @test */
    public function request_can_retrieve_ip()
    {
        $this->assertNull($this->request->ip());
    }

    /** @test */
    public function request_can_retrieve_ips()
    {
        $this->assertInternalType('array', $this->request->ips());
    }
}
