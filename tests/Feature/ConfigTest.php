<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.author.first');
        self::assertEquals('labib', $firstName);

        $email = config('contoh.email', 'lbbmkrm');
        self::assertEquals('labibmakarim197@gmail.com', $email);
    }
}
