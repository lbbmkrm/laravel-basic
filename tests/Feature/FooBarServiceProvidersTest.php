<?php

namespace Tests\Feature;

require_once __DIR__ . "/../../vendor/autoload.php";

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Foo;
use App\Data\Bar;

class FooBarServiceProvidersTest extends TestCase
{
    public function testServiceProviders()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertSame($foo1, $foo2);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);
        self::assertSame($bar1, $bar2);

        self::assertSame($foo1, $bar1->foo);
    }
}
