<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncriptionTest extends TestCase
{
    public function testEncription()
    {
        $encrypt = Crypt::encrypt('Alif Avaldo');

        $decryp = Crypt::decrypt($encrypt);

        self::assertEquals('Alif Avaldo', $decryp);
    }
}
