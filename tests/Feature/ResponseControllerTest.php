<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')->assertStatus(200)
            ->assertSeeText("Hello Response");
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('anto')
            ->assertSeeText('potong')
            ->assertHeader('content type', 'application/json')
            ->assertHeader('author', 'lbbmkrm')
            ->assertHeader('app', 'Belajar Laravel');
    }

    public function testView()
    {
        $this->get('/response/view')
            ->assertSeeText('Hello anto');
    }

    public function testJson()
    {
        $this->get('/response/json')
            ->assertJson(['firstName' => 'anto', 'lastName' => 'potong']);
    }
    public function testFile()
    {
        $this->get('/response/file')
            ->assertHeader('Content-Type', 'image/jpeg');
    }

    public function testDownload()
    {
        $this->get('/response/download')
            ->assertDownload('laptop.jpg');
    }
}
