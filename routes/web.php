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

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', 'TestController@index')->middleware(['auth', 'throttle']);

Auth::routes();

// Pages route
Route::get('/', 'PagesController@index')->name('home');


Route::get('terms-of-service', 'PagesController@terms');

Route::get('privacy', 'PagesController@privacy');

Route::get('widget/create', 'WidgetController@create')->name('widget.create');

Route::get('widget/{widget}-{slug?}', 'WidgetController@show')->name('widget.show');

Route::patch('widget/{widget}', 'WidgetController@update');

Route::resource('widget', 'WidgetController');

// Admin route
Route::get('/admin', 'AdminController@index')->name('admin');

// socialite routes
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
