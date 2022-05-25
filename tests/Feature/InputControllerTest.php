<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Edo')
            ->assertSeeText('Hello Edo');

        $this->get('/input/hello', [
            'name' => 'Edo'
        ])->assertSeeText('Hello');
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Alif",
                "last" => "Avaldo"
            ]
        ])->assertSeeText("Hello Alif");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Alif",
                "last" => "Avaldo"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Alif")->assertSeeText("Avaldo");
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple Mac Book Pro",
                    "price" => 3000
                ],
                [
                    "name" => "Samsung A52",
                    "price" => 1500
                ]
            ]
        ])->assertSeeText("Apple Mac Book Pro")->assertSeeText("Samsung A52");
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Alif',
            'married' => 'false',
            'birth_date' => '1997-07-07'
        ])->assertSeeText('Alif')->assertSeeText('false')->assertSeeText('1997-07-07');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name' => [
                "first" => "Alif",
                "middle" =>   "Avaldo",
                "last" => "Crayon"
            ]
        ])->assertSeeText('Alif')->assertSeeText('Crayon')->assertDontSeeText('Avaldo');
    }

    public function testFilterExcep()
    {
        $this->post('/input/filter/except', [
            "username" => "alif",
            "password" => "avaldo",
            "admin" => "true"
        ])->assertSeeText("alif")->assertSeeText("avaldo")->assertDontSeeText('admin');
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "alif",
            "password" => "avaldo",
            "admin" => "true"
        ])->assertSeeText("alif")->assertSeeText("avaldo")
            ->assertSeeText("admin")->assertSeeText("false");
    }
}
