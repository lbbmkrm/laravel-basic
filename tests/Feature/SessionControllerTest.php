<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testSessionCreate()
    {
        $this->get("/session/create")
            ->assertSessionHas("userId", "anto")
            ->assertSessionHas("isMember", true)
            ->assertSeeText("Success!");
    }

    public function testGetSession()
    {
        $this->withSession(["userId" => "anto", "isMember" => true])->get("/session/get")
            ->assertSeeText("User ID : anto")
            ->assertSeeText("Member : 1");
    }
}
