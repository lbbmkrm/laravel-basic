<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    public function testBasicRoute()
    {
        $this->get('/lbb')
            ->assertStatus(200)
            ->assertSeeText('Hello');
    }
    public function testRedirect()
    {
        $this->get('/redirect')
            ->assertRedirect('/lbb');
    }

    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertStatus(404);
    }

    public function testUrlParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product id : 1');
        $this->get('/products/1/items/2')
            ->assertSeeText('Product id : 1, Item id : 2');
    }

    public function testParameterRegex()
    {
        $this->get('/categories/123')
            ->assertSeeText('Category : 123');

        $this->get('categories/anto')
            ->assertSeeText('404 Web not found');
    }

    public function testOptionalParam()
    {
        $this->get('/users/123')
            ->assertSeeText("User id : 123");
        $this->get('users')
            ->assertSeeText('User id is null');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/12345')
            ->assertSeeText('Link http://localhost/products/12345');

        $this->get('produk-redirect/123456')
            ->assertRedirect('/products/123456');
    }
}
