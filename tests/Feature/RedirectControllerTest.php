<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    public function testRedirect()
    {
        $this->get('/redirect/from')
            ->assertRedirect('/redirect/to');
    }

    public function testRedirectName()
    {
        $this->get("/redirect/name")
            ->assertRedirect("/redirect/name/anto");
    }

    public function testreditectAction()
    {
        $this->get("/redirect/action")
            ->assertRedirect("/redirect/name/anto");
    }
    public function testRedirectAway()
    {
        $this->get("/redirect/away")
            ->assertRedirect("https://github.com/lbbmkrm");
    }
}
