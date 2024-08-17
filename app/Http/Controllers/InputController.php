<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $name = $request->input('name');
        return "Hello $name";
    }
    public function helloFirstName(Request $request): string
    {
        $firstName = $request->input('name.first');
        return "Hello $firstName";
    }

    public function getAllInput(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }

    public function inputType(Request $request): string
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birthDate = $request->date('birth_date', 'Y-m-d');

        return json_encode([
            'name' => $name,
            'married' => $married,
            'birth_date' => $birthDate
        ]);
    }

    public function inputFilterOnly(Request $request): string
    {
        $input = $request->only('first.name', 'last.name');
        return json_encode($input);
    }

    public function inputFilterExcept(Request $request): string
    {
        $except = $request->except('admin');
        return json_encode($except);
    }
    public function inputFilterMerge(Request $request): string
    {
        $request->merge([
            'admin' => 'false' //menimpa semua inputan client menjadi false
        ]);
        $user = $request->input();
        return json_encode($user);
    }
}
