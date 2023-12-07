<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HashTest extends TestCase
{
    public function testHash()
    {
        $password = "rahasia";
        $hash = Hash::make($password);

        $result = Hash::check("rahasia", $hash);
        self::assertTrue($result);

    }

}
