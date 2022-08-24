<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get('/session/create')
            ->assertSeeText("OK")
            ->assertSessionHas("User-Id", "raka")
            ->assertSessionHas("Is-Member", "true");
    }

    public function testGetSession()
    {
        $this->withSession([
            'UserId' => 'raka',
            'IsMember' => 'true'
        ])
        ->get('/session/get')
            ->assertSeeText("raka")
            ->assertSeeText("true");
    }
}
