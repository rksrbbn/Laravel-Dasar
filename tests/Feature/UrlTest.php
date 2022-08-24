<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlTest extends TestCase
{
    public function testCurrent()
    {
        $this->get('/url/current?name=Raka')
            ->assertSeeText("/url/current?name=Raka");
    }

    public function testNamed()
    {
        $this->get('/url/named')
            ->assertSeeText("/redirect/name/Raka");
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText("/form");
    }
}
