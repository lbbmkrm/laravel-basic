<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    public function testBasicRoute()
    {
        $this->get('/lbb')
            ->assertStatus(200)
            ->assertSeeText('Hello');
    }
    public function testRedirect()
    {
        $this->get('/redirect')
            ->assertRedirect('/lbb');
    }

    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertSeeText('404 Web not found');
    }
}
