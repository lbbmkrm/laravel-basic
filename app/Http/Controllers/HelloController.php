<?php

namespace App\Http\Controllers;

use App\Service\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    private HelloService $helloService;
    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    public function helloLangInd(string $name): string
    {
        return $this->helloService->hello($name);
    }
    public function Hello(): string
    {
        return "Hello world!";
    }
}
