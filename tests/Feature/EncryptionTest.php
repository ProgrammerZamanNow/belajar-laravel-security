<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testEncryption()
    {
        $value = "Eko Kurniawan Khannedy";

        $encrypted = Crypt::encryptString($value);
        $decrypted = Crypt::decryptString($encrypted);

        self::assertEquals($value, $decrypted);
    }

}
