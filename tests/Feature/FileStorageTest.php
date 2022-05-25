<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testStorage()
    {
        $filseSystem = Storage::disk("local");

        $filseSystem->put("file.txt", "Alif Avaldo");
        $content = $filseSystem->get("file.txt");

        self::assertEquals("Alif Avaldo", $content);
    }

    public function testPublic()
    {
        $filseSystem = Storage::disk("public");

        $filseSystem->put("file.txt", "Alif Avaldo");
        $content = $filseSystem->get("file.txt");

        self::assertEquals("Alif Avaldo", $content);
    }
}
