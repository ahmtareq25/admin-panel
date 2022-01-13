<?php
use Illuminate\Support\Facades\Route;

Auth::routes();




// Authentication Routes...
Route::get('login', 'Admin\Auth\LoginController@showLoginForm')
    ->name('login');

Route::post('login', 'Admin\Auth\LoginController@login');

Route::post('logout', 'Admin\Auth\LoginController@logout')
    ->name('logout');

// Registration Routes...
Route::get('register', 'Admin\Auth\RegisterController@showRegistrationForm')
    ->name('register');

Route::post('register', 'Admin\Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');

Route::post('password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.email');

Route::get('password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');

Route::post('password/reset', 'Admin\Auth\ResetPasswordController@reset');

Route::group(['middleware' => 'auth'], function(){

    Route::get('/', 'Admin\HomeController@index')->name('home');

    Route::group(['middleware'=> 'permission'], function(){

        Route::group(['prefix'=> 'users'], function(){

            Route::get('/', 'Admin\UserController@index')
                ->name(config('routename.USER_LANDING'));

            Route::match(['GET', 'POST'],'/add', 'Admin\UserController@add')
                ->name(config('routename.USER_ADD'));

            Route::match(['GET', 'UPDATE'],'/edit/{id}', 'Admin\UserController@edit')
                ->name(config('routename.USER_EDIT'));

            Route::delete('/delete/{id}', 'Admin\UserController@delete')
                ->name(config('routename.USER_DELETE'));
        });

        Route::group(['prefix'=> 'roles'], function(){

            Route::get('/', 'Admin\RoleController@index')
                ->name(config('routename.ROLE_LANDING'));

            Route::match(['GET', 'POST'],'/add', 'Admin\RoleController@add')
                ->name(config('routename.ROLE_ADD'));

            Route::match(['GET', 'POST'],'/edit/{id}', 'Admin\RoleController@edit')
                ->name(config('routename.ROLE_EDIT'));

            Route::post('/delete/{id}', 'Admin\RoleController@delete')
                ->name(config('routename.ROLE_DELETE'));
        });

        Route::group(['prefix'=> 'role-page-associations'], function(){

            Route::get('/', 'Admin\RolePageAssociationController@index')
                ->name(config('routename.ROLE_AND_PAGE_ASSOCIATION_LANDING'));

            Route::match(['GET', 'POST'],'/edit/{id}', 'Admin\RolePageAssociationController@updateRolePageAssociation')
                ->name(config('routename.ROLE_AND_PAGE_ASSOCIATION_UPDATE'));
        });

        Route::group(['prefix'=> 'system-settings'], function(){

            Route::get('/', 'Admin\SystemSettingController@index')
                ->name(config('routename.SYSTEM_SETTING_LANDING'));

            Route::match(['GET', 'POST'],'/edit/{id}', 'Admin\SystemSettingController@updateRolePageAssociation')
                ->name(config('routename.SYSTEM_SETTING_UPDATE'));
        });



    });
});

