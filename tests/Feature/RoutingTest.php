<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/alif')
            ->assertStatus(200)
            ->assertSeeText('Hello Alif Avaldo');
    }

    public function testRedirect()
    {
        $this->get('/crayon')
            ->assertRedirect("/alif");
    }

    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertSeeText('404 By Alif Avaldo');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText("Product 1");

        $this->get('/products/2')
            ->assertSeeText('Product 2');


        $this->get('/products/1/items/XXX')
            ->assertSeeText("Product 1, Item XXX");

        $this->get('/products/2/items/YYY')
            ->assertSeeText("Product 2, Item YYY");
    }

    public function testParameterRegex()
    {
        $this->get('categories/100')
            ->assertSeeText("Category 100");

        $this->get('categories/edo')
            ->assertSeeText('404 By Alif Avaldo');
    }

    public function testParameterOptional()
    {
        $this->get('users/crayon')
            ->assertSeeText("User crayon");

        $this->get('users/')
            ->assertSeeText('User 404');
    }

    public function testRouteConflict()
    {
        $this->get('conflict/edo')
            ->assertSeeText("Conflict edo");

        $this->get('conflict/alif')
            ->assertSeeText('Conflict alif');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/12345')
            ->assertSeeText("Link http://localhost/products/12345");

        $this->get('/produk-redirect/12345')
            ->assertRedirect('/products/12345');
    }
}
