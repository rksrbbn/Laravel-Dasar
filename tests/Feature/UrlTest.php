<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlTest extends TestCase
{
    public function testCurrent()
    {
        $this->get('/url/current?name=Eko')
            ->assertSeeText("/url/current?name=Eko");
    }

    public function testNamed()
    {
        $this->get('/url/named')
            ->assertSeeText("/redirect/name/Eko");
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText("/form");
    }
}
