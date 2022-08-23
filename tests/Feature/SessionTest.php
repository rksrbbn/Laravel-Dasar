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
            ->assertSessionHas("User-Id", "khannedy")
            ->assertSessionHas("Is-Member", "true");
    }

    public function testGetSession()
    {
        $this->withSession([
            'UserId' => 'khannedy',
            'IsMember' => 'true'
        ])
        ->get('/session/get')
            ->assertSeeText("khannedy")
            ->assertSeeText("true");
    }
}
