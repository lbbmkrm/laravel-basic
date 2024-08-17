<?php

namespace Tests\Feature;

use App\Service\HelloService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testHello()
    {
        $this->get('/controller/hello')
            ->assertSeeText("Hello world!");
    }

    public function testHelloLangInd()
    {
        $this->get('/controller/hello/budi')
            ->assertSeeText('Halo budi');
    }

    public function testRequest()
    {
        $this->get('/controller/hello/request', ['accept' => 'plain/text'])
            ->assertSeeText("/controller/hello/request")
            ->assertSeeText("http://localhost/controller/hello/request")
            ->assertSeeText("GET")
            ->assertSeeText("plain/text");
    }
}
