<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class RedirectController extends Controller
{
    public function redirectTo(): string
    {
        return "Redirect to";
    }

    public function redirectFrom(): RedirectResponse
    {
        return redirect('/redirect/to');
    }

    public function redirectName(): RedirectResponse
    {
        return redirect()->route("redirect-hello", [
            "name" => "anto"
        ]);
    }

    public function redirectHello(string $name): string
    {
        return "Hello $name";
    }

    public function redirectAction()
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], ['name' => 'anto']);
    }

    public function redirectAway(): RedirectResponse
    {
        return redirect()->away("https://github.com/lbbmkrm");
    }
}
