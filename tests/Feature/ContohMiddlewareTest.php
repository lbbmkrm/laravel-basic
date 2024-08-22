<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{
    public function testInvalid()
    {
        $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText("Access Denied");
    }

    public function testValid()
    {
        $this->withHeaders([
            "X-API-KEY" => "KEY"
        ])->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText("ok");
    }
    public function testInvalidGroup()
    {
        $this->get('/middleware/group')
            ->assertStatus(401)
            ->assertSeeText("Access Denied");
    }

    public function testValidGroup()
    {
        $this->withHeaders([
            "X-API-KEY" => "KEY"
        ])->get('/middleware/group')
            ->assertStatus(200)
            ->assertSeeText("group");
    }
}
