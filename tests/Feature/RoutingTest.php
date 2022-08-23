<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testBasicRouting()
    {
        $this->get("/home")
            ->assertStatus(200)
            ->assertSeeText("Welcome to Home");
    }

    public function testRedirect()
    {
        $this->get("/info")
            ->assertRedirect("/home");
    }

    public function testFallback()
    {
        $this->get("/test")
            ->assertSeeText("404");
    }

    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Raka');

        $this->get('/hello-again')
            ->assertSeeText('Hello Eko');
    }

    public function testNestedView()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Raka');
    }

    public function testViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Raka'])
            ->assertSeeText('Hello Raka');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText("Products : 1");

        $this->get('/products/1/items/xxx')
            ->assertSeeText("Products : 1, Items : xxx");
    }

    public function testRouteParameterRegex()
    {
        $this->get('categories/12345')->assertSeeText('Categories : 12345');
        $this->get('categories/salah')->assertSeeText('404');
    }

    public function testRouteOptionalParameter()
    {
        $this->get('users/12345')->assertSeeText('Users : 12345');
        $this->get('users/')->assertSeeText('Users : 404');
    }

    public function testNamed()
    {
        $this->get('http://localhost/products/12345')->assertSeeText('Products : 12345');
        $this->get('http://localhost/products/12345')->assertSeeText('Products : 12345');
    }
}
