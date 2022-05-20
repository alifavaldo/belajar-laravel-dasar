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

class ServiceContainerTest extends TestCase
{
    public function testDepedency()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());

        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person("Alif", "Avaldo");
        });

        $person1 = $this->app->make(Person::class); // closure() new Person("Alif", "Avaldo");
        $person2 = $this->app->make(Person::class); // closure() new Person("Alif", "Avaldo");

        self::assertEquals('Alif', $person1->firstName);
        self::assertEquals('Alif', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingelTon()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Alif", "Avaldo");
        });

        $person1 = $this->app->make(Person::class); // closure() new Person("Alif", "Avaldo"); if not exist
        $person2 = $this->app->make(Person::class); // return existing

        self::assertEquals('Alif', $person1->firstName);
        self::assertEquals('Alif', $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Alif", "Avaldo");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // closure() new Person("Alif", "Avaldo"); if not exist
        $person2 = $this->app->make(Person::class); // return existing

        self::assertEquals('Alif', $person1->firstName);
        self::assertEquals('Alif', $person2->firstName);
        self::assertSame($person1, $person2);
    }



    public function testDepedencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }


    public function testDepedencyInjectionClosure()
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
        //cara 1 =   $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndonesia();
        });   // cara 2 tapi sama

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo Alif', $helloService->hello('Alif'));
    }
}
