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

Route::get('/alif', function () {
    return "Hello Alif Avaldo";
});

Route::redirect('/crayon', '/alif');

Route::fallback(function () {
    return "404 By Alif Avaldo";
});

Route::view('/hello', 'hello', ['name' => 'Alif Avaldo']);

Route::get('/hello-again', function () {
    return view('hello', ['name' => 'Edo Ganteng']);
});

Route::get('/hello-world', function () {
    return view('hello.world', ['name' => 'Edo Ganteng']);
});
