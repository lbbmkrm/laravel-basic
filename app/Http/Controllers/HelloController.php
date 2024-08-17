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

    public function helloLangInd(Request $request, string $name): string
    {
        // $request->path();
        // $request->url();
        // $request->fullUrl();
        return $this->helloService->hello($name);
    }
    public function Hello(): string
    {
        return "Hello world!";
    }
    public function request(Request $request): string
    {
        return $request->path() . "\n" .
            $request->url() . "\n" .
            $request->fullUrl() . "\n" .
            $request->method() . "\n" .
            $request->header('Accept') . "\n";
    }
}
