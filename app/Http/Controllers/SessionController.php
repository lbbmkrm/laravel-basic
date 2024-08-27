<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
        $request->session()->put("userId", "anto");
        $request->session()->put("isMember", true);
        return "Success!";
    }

    public function getSession(Request $request): string
    {
        $userId = $request->session()->get("userId", "guest");
        $isMember = $request->session()->get("isMember", false);
        return "User ID : {$userId} Member : {$isMember}";
    }
}
