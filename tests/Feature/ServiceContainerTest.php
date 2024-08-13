<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Foo;
use App\Data\Bar;
use App\Data\Person;
use App\Service\HelloService;
use App\Service\HelloServiceInd;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        $foo1 = $this->app->make(Foo::class); //seperti membuat object dari class Foo
        $foo2 = $this->app->make(Foo::class); //tanpa menggunakan new dan app adalah properti global

        self::assertEquals("foo", $foo1->foo());
        self::assertEquals("foo", $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person("Anto", "Potong");
        }); //memberitahu laravel ketika ada class yang mempunyai __construct , lakukan

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Anto Potong", "$person1->firstName $person1->lastName");
        self::assertEquals("Anto Potong", "$person2->firstName $person2->lastName");
        self::assertNotSame($person1, $person2); //2 object berbeda
    }
    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Anto", "Potong");
        }); //object person dibuat sekali

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Anto Potong", "$person1->firstName $person1->lastName");
        self::assertEquals("Anto Potong", "$person2->firstName $person2->lastName");
        self::assertSame($person1, $person2); //2 object yang sama
    }
    public function testInstance()
    {
        $person = new Person("Anto", "Potong");
        $this->app->instance(Person::class, $person); //jika ada object yang sudah ada jadi tidak ada membuat instance lagi

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Anto Potong", "$person1->firstName $person1->lastName");
        self::assertEquals("Anto Potong", "$person2->firstName $person2->lastName");
        self::assertSame($person1, $person2); //2 object yang sama
    }

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }

    public function testInterfaceToClass()
    {
        $this->app->singleton(HelloService::class, HelloServiceInd::class);

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals("Halo Anto", $helloService->hello("Anto"));
    }
}
