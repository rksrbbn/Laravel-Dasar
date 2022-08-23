<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    // public function testController()
    // {
    //     $this->get('/controller/hello')
    //         ->assertSeeText("Hello World");
    // }

    public function testController()
    {
        $this->get('/controller/hello/Eko')
            ->assertSeeText("Halo Eko");
    }

    public function testInput()
    {
        $this->get('/input/hello?name=Eko')->assertSeeText("Hello Eko");
        $this->post('/input/hello["name"="Eko"]')->assertSeeText("Hello Eko");
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            'name' =>
            [
                'first' => 'Eko'
            ]
        ])->assertSeeText('Hello Eko');
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
                "first" => "Eko",
                "Middle" => "Kurniawan",
                "last" => "Khannedy"
            ]
        ])->assertSeeText("Eko")->assertSeeText("Khannedy")
            ->assertDontSeeText("Kurniawan");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "Khannedy",
            "admin" => "true",
            "password" => "rahasia"
        ])->assertSeeText("Khannedy")->assertSeeText("rahasia")
            ->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "Khannedy",
            "admin" => "true",
            "password" => "rahasia"
        ])->assertSeeText("Khannedy")->assertSeeText("rahasia")
            ->assertSeeText("admin")->assertSeeText("false");
    }
}
