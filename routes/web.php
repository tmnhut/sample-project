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

Route::get('test', 'TestController@index')->middleware(['auth', 'throttle']);

//Auth::routes();

// Pages route
Route::get('/', 'PagesController@index')->name('home');

Route::get('terms-of-service', 'PagesController@terms');

Route::get('privacy', 'PagesController@privacy');

// Widget routes
Route::get('widget', 'WidgetController@index')->name('widget.index');
Route::get('widget/create', 'WidgetController@create')->name('widget.create');
Route::post('widget/create', 'WidgetController@store')->name('widget.store');
Route::get('widget/edit/{id}', 'WidgetController@edit')->name('widget.edit');
Route::post('widget/edit/{id}', 'WidgetController@update')->name('widget.update');
Route::get('widget/{id}-{slug?}', 'WidgetController@show')->name('widget.show');

// Admin route
Route::get('/admin', 'AdminController@index')->name('admin');

// Socialite routes
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

// Authentication routes
Route::get('login', 'Auth\AuthController@showLoginForm')->name('login');
Route::post('login', 'Auth\AuthController@login');
Route::post('logout', 'Auth\AuthController@logout')->name('logout');

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Registration routes
Route::get('register', 'Auth\AuthController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\AuthController@register');

// Profile routes
Route::get('show-profile', 'ProfileController@showProfileToUser')->name('show-profile');

Route::get('determine-profile-route', 'ProfileController@determineProfileRoute')->name('determine-profile-route');

Route::resource('profile', 'ProfileController');

Route::resource('user', 'UserController');

// Setting routes
Route::get('settings', 'SettingsController@edit');
Route::post('settings', 'SettingsController@update')->name('user-update');

// Maketing Image
Route::resource('marketing-image', 'MarketingImageController');
