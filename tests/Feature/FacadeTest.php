<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstname1 = config("contoh.author.first");
        $firstname2 = Config::get("contoh.author.first");

        assertEquals($firstname1,$firstname2);
    }

    public function testConfigDependency()
    {
        $config = $this->app->make("config");
        $firstname1 = $config->get("contoh.author.first");
        $firstname2 = Config::get("contoh.author.first");

        assertEquals($firstname1,$firstname2);
    }

    public function testConfigMock()
    {
        Config::shouldReceive('get')
        ->with('contoh.author.first')
        ->andReturn("Eko Keren");

        $firstname = Config::get('contoh.author.first');

        assertEquals("Eko Keren",$firstname);
    }
}
