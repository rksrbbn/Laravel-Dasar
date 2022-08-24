<?php

namespace App\Providers;

use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider //implements DeferrableProvider
{
   
    // public function provides():array
    // {
    //     return [HelloService::class, Foo::class, Bar::class];
    // }

    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];

    public function register()
    {   
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);
        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function($app) {
            return new Bar($app->make(Foo::class));
        });
    }

    
    public function boot()
    {
        //
    }
}
