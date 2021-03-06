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
Route::get('/t', function () {
    event(new \App\Events\SendMessage());
    cache()->set('name', 'max');
    echo cache()->get('name');
    dd('Event Run Successfully.');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
