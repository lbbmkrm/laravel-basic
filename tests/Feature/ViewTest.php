<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello anto');

        $this->get('/hello-again')
            ->assertSeeText('Hello again');

        $this->get('/hello-world')
            ->assertSeeText('Hello world');
    }

    public function testTemplate() //untuk testing template yang tidak ada route
    {
        $this->view('hello', ['name' => 'anto'])
            ->assertSeeText('Hello anto');
    }
}
