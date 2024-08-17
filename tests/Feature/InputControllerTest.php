<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/controller/input?name=anto')
            ->assertSeeText("Hello anto");

        $this->post('/controller/input', ['name' => 'anto'])
            ->assertSeeText("Hello anto");
    }

    public function testNestedInput()
    {
        $this->post('/controller/input/first', ['name' => ['first' => 'anto']])
            ->assertSeeText("Hello anto");
    }

    public function testGetAllInput()
    {
        $this->post('/controller/input/get-all', [
            'name' => [
                'first' => 'anto',
                'middle' => 'potong',
                'last' => 'ayam'
            ]
        ])->assertSeeText('name')->assertSeeText('first')
            ->assertSeeText('middle')->assertSeeText('last')
            ->assertSeeText('anto')->assertSeeText('potong')
            ->assertSeeText('ayam');
    }

    public function testInputType()
    {
        $this->post('/controller/input/type', [
            'name' => 'anto',
            'married' => 'true',
            'birth_date' => '2000-09-12'
        ])->assertSeeText('anto')
            ->assertSeeText('true')
            ->assertSeeText('2000-09-12');
    }

    public function testFilterOnly()
    {
        $this->post('/controller/input/type', [
            'name' => [
                'first' => 'anto',
                'middle' => 'potong',
                'last' => 'ayam'
            ],
            'admin' => 'true',
            'address' => [
                'city' => 'medan',
                'country' => 'indonesia'
            ]
        ])
            ->assertSeeText('anto')->assertSeeText('potong')
            ->assertDontSee('medan')->assertDontSee('indonesia')
            ->assertDontSee('true');
    }
    public function testFilterExcept()
    {
        $this->post('/controller/input/type', [
            'name' => [
                'first' => 'anto',
                'middle' => 'potong',
                'last' => 'ayam'
            ],
            'admin' => 'true',
            'address' => [
                'city' => 'medan',
                'country' => 'indonesia'
            ]
        ])
            ->assertDontSee('admin');
    }
    public function testFilterMerge()
    {
        $this->post('/controller/input/type', [
            'name' => [
                'first' => 'anto',
                'middle' => 'potong',
                'last' => 'ayam'
            ],
            'admin' => 'true', //input dari user akan selalu ditimpa
            'address' => [
                'city' => 'medan',
                'country' => 'indonesia'
            ]
        ])->assertSeeText('false');
    }
}
