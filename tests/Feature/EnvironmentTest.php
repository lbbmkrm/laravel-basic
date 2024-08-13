<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnvironment()
    {
        $github = env('GITHUB');
        self::assertEquals("lbbmkrm", $github);
    }

    public function testDefaultEnv()
    {
        $author = Env('author', 'lbbmkrm');
        self::assertEquals("lbbmkrm", $author);
    }
}
