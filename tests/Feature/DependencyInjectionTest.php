<?php

namespace Tests\Feature;

require_once __DIR__ . "/../../vendor/autoload.php";

use App\Data\Foo;
use App\Data\Bar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependencyInjectionTest extends TestCase
{

    public function testDependencyInjection()
    {
        $foo = new Foo;
        $bar = new Bar($foo);

        self::assertEquals("foo and bar", $bar->bar());
    }
}
