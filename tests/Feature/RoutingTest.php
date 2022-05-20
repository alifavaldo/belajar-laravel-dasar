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
}
