<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText("Hello Alif Avaldo");

        $this->get('/hello-again')
            ->assertSeeText('Hello Edo Ganteng');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('Hello Edo Ganteng');
    }

    public function testViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Edo'])
            ->assertSeeText('Hello Edo');

        $this->view('hello.world', ['name' => 'Edo'])
            ->assertSeeText('Hello Edo');
    }
}
