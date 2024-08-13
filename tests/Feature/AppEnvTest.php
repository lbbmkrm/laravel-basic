<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\App; // Import class App

class AppEnvTest extends TestCase
{
    public function testAppEnv()
    {
        var_dump(App::environment());
    }
}
