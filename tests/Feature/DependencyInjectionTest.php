<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotSame;
use function PHPUnit\Framework\assertSame;

class DependencyInjectionTest extends TestCase
{
    public function testDependency() 
    {
        $foo = new Foo();
        $bar = new Bar($foo);

        assertEquals("Foo and Bar", $bar->bar());
    }

    public function testCreateDependency()
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        assertEquals("Foo", $foo->foo());
        assertEquals("Foo", $foo2->foo());
        assertNotSame($foo, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function($app) {
            return new Person("Raka","Rabbani");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        assertEquals("Raka", $person1->firstname);
        assertEquals("Raka", $person2->firstname);
        assertNotSame($person1,$person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function($app) {
            return new Person("Raka", "Rabbani");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        assertEquals("Raka", $person1->firstname);
        assertEquals("Raka", $person2->firstname);
        assertSame($person1,$person2);
    }

    public function testInstance()
    {
        $person = new Person("Raka", "Rabbani");
        $this->app->instance(Person::class,$person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        assertEquals("Raka", $person1->firstname);
        assertEquals("Raka", $person2->firstname);
        assertSame($person,$person1);
        assertSame($person1,$person2);
    }

    public function testDependencyInjection() 
    {
        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        assertEquals("Foo and Bar", $bar->bar());
        assertSame($foo, $bar->foo);
    }

    public function testDependencyInjectionClosure()
    {
        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function($app) {
            return new Bar($app->make(Foo::class));
        });

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);
        assertSame($bar1,$bar2);
    }

    public function testHelloService()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);
        assertEquals("Halo Raka", $helloService->hello("Raka"));
    }
}
