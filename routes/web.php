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

Route::group(['prefix'=> 'admin'], function(){

    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['middleware'=> 'permission'], function(){

        Route::group(['prefix'=> 'users'], function(){
            Route::get('/', 'UserController@index')->name(config('routename.USER_LANDING'));
            Route::match(['GET', 'POST'],'/add', 'UserController@add')->name(config('routename.USER_ADD'));
            Route::match(['GET', 'UPDATE'],'/edit/{id}', 'UserController@edit')->name(config('routename.USER_EDIT'));
            Route::delete('/delete/{id}', 'UserController@delete')->name(config('routename.USER_DELETE'));
        });

        Route::group(['prefix'=> 'roles'], function(){
            Route::get('/', 'RoleController@index')->name(config('routename.ROLE_LANDING'));
            Route::match(['GET', 'POST'],'/add', 'RoleController@add')->name(config('routename.ROLE_ADD'));
            Route::match(['GET', 'POST'],'/edit/{id}', 'RoleController@edit')->name(config('routename.ROLE_EDIT'));
            Route::post('/delete/{id}', 'RoleController@delete')->name(config('routename.ROLE_DELETE'));
        });

        Route::group(['prefix'=> 'role-page-associations'], function(){
            Route::get('/', 'RolePageAssociationController@index')->name(config('routename.ROLE_AND_PAGE_ASSOCIATION_LANDING'));
            Route::match(['GET', 'POST'],'/edit/{id}', 'RolePageAssociationController@updateRolePageAssociation')->name(config('routename.ROLE_AND_PAGE_ASSOCIATION_UPDATE'));
        });

        Route::group(['prefix'=> 'system-settings'], function(){
            Route::get('/', 'SystemSetting@index')->name(config('routename.SYSTEM_SETTING_LANDING'));
            Route::match(['GET', 'POST'],'/edit/{id}', 'SystemSetting@updateRolePageAssociation')->name(config('routename.SYSTEM_SETTING_UPDATE'));
        });



    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
