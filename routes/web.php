<?php

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

Route::get('/', 'HomeController@index')->name('home');
//Auth
Route::group(['as' => 'auth.', 'prefix' => 'auth', 'namespace' => 'Auth'], function (){
    //Register
    Route::group(['as' => 'register.', 'prefix' => 'register'], function (){
        Route::get('/customers', 'RegisterController@index')->name('customers.index');
        Route::post('/customers', 'RegisterController@customerRegister')->name('customers.register');
    });
    //Login || Logout
    Route::group(['prefix' => 'login'], function (){
        Route::get('/', 'LoginController@index')->name('login.index');
        Route::post('/', 'LoginController@login')->name('login');

        Route::get('/{provider}', 'LoginController@redirectToProvider')->name('social');
        Route::get('{provider}/callback', 'LoginController@handleProviderCallback')->name('social.callback');
    });
    Route::get('logout', 'LoginController@logout')->name('logout');
});

//Profile
Route::group(['as' => 'profile.', 'prefix' => 'profile', 'middleware' => 'auth:web'], function (){
    Route::get('/', 'ProfileController@index')->name('index');
    Route::post('/update/{user}', 'ProfileController@update')->name('update');
});
//Request to become Suppliers
Route::group(['as' => 'request-suppliers.', 'prefix' => 'request-suppliers'], function (){
    Route::get('/', 'RequestSupplierController@index')->name('index')->middleware('admin');
    Route::post('/', 'RequestSupplierController@store')->name('create');
    Route::post('/{requestSupplier}/accept', 'RequestSupplierController@accept')->name('accept');
    Route::post('/{requestSupplier}/reject', 'RequestSupplierController@reject')->name('reject');
});
