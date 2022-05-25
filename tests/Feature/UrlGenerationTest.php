<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlGenerationTest extends TestCase
{
    public function testUrlCurrent()
    {
        $this->get('/url/current?name=Alif')
            ->assertSeeText('/url/current?name=Alif');
    }

    public function testNamed()
    {
        $this->get('/redirect/named')
            ->assertSeeText("/redirect/name/Alif");
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText("/form");
    }
}
