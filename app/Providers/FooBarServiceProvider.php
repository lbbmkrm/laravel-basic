<?php

namespace App\Providers;

use App\Data\Bar;
use Illuminate\Support\ServiceProvider;
use App\Data\Foo;
use App\Service\HelloService;
use App\Service\HelloServiceInd;
use Illuminate\Contracts\Support\DeferrableProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        HelloService::class => HelloServiceInd::class
    ];
    public function register()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($this->app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {}
    public function provides()
    {
        return [HelloService::class, Foo::class, Bar::class];
    } //dependensi tidak diload jika tidak dibutuhkan,provides adalah func dari interface Defferable
}
