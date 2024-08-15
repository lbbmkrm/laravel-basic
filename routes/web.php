<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lbb', function () {
    return "Hello";
});

Route::redirect('/redirect', '/lbb');

Route::fallback(function () {
    return '404 Web not found';
});

Route::view('/hello', 'hello', ['name' => 'anto']); //menampilkan view. isi parameter (path,file,isi)
Route::get('/hello-again', function () {
    return view('hello', ['name' => 'again']);
}); //menampilkan view juga


Route::get('/hello-world', function () {
    return view('hello.world', ['name' => 'world']);
});
