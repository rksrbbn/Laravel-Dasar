<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\App;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class EnvironmentTest extends TestCase
{
    public function testEnv()
    {
        $appName = env("APPLICATION");
        self::assertEquals("Belajar PHP", $appName);
    }

    public function testDefaultValue()
    {
        $author = env("AUTHOR", "Raka");
        assertEquals("Raka", $author);
    }

    public function testEnvironment()
    {
        if (App::environment("testing")) {
            echo "LOGIC IN TESTING ENV " . PHP_EOL;
            assertTrue(true);
        }
    }
}
