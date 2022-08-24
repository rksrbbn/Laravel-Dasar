<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testController()
    {
        $this->get('/controller/hello')
            ->assertSeeText("Hello World");
    }

    // public function testController()
    // {
    //     $this->get('/controller/hello/Raka')
    //         ->assertSeeText("Halo Raka");
    // }

    public function testInput()
    {
        $this->get('/input/hello?name=Raka')->assertSeeText("Hello Raka");
        $this->post('/input/hello["name"="Raka"]')->assertSeeText("Hello Raka");
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            'name' =>
            [
                'first' => 'Raka'
            ]
        ])->assertSeeText('Hello Raka');
    }

    public function testArrayInput()
    {
        $this->post('/input/hello/array', [
            'products' =>
            [
                ['name' => 'Apple Mac Book Pro'],
                ['name' => 'Samsung Galaxy S']
            ]
        ])->assertSeeText('Apple Mac Book Pro')->assertSeeText('Samsung Galaxy S');
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Budi',
            'married' => true,
            'birth_date' => '1990-10-10'
        ])->assertSeeText('Budi')->assertSeeText('true')->assertSeeText('1990-10-10');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Raka",
                "Middle" => "Santang",
                "last" => "Rabbani"
            ]
        ])->assertSeeText("Raka")->assertSeeText("Rabbani")
            ->assertDontSeeText("Santang");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "Raka",
            "admin" => "true",
            "password" => "rahasia"
        ])->assertSeeText("Raka")->assertSeeText("rahasia")
            ->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "Raka",
            "admin" => "true",
            "password" => "rahasia"
        ])->assertSeeText("Raka")->assertSeeText("rahasia")
            ->assertSeeText("admin")->assertSeeText("false");
    }
}
