<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText("hello response");
    }

    public function testHeader()
    {
        $this->get('response/header')
            ->assertStatus(200)
            ->assertSeeText('Alif')->assertSeeText('Avaldo')
            ->assertHeader('Content-Type', 'aplication/json')
            ->assertHeader('Author', 'Alif Avaldo')
            ->assertHeader('App', 'Belajar Laravel Dasar');
    }

    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText("Hello Alif");
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                "firstname" => "Alif",
                "lastname" => "Avaldo"
            ]);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', "image/jpeg");
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('githubpp.jpeg');
    }
}
