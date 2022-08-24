<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class EncryptTest extends TestCase
{
    public function testEncrypt()
    {
        $encrypt = Crypt::encrypt('Raka Santang');
        $decrypt = Crypt::decrypt($encrypt);

        assertEquals('Raka Santang', $decrypt);
    }
}
