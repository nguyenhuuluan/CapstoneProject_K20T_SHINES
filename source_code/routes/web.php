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

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/recruitment/{id}', 'HomeController@detail')->name('detail');

Route::get('/test/{companyID}', 'CompanyController@test')->name('test');



Route::get('account/reset','MyAuth\ForgotPasswordController@showLinkRequestForm');

Route::post('account/email','MyAuth\PasswordController@sendResetLinkEmail');

Route::get('account/getreset/{token}','MyAuth\PasswordController@showRequestForm');

Route::post('account/postreset/{token}','MyAuth\PasswordController@postReset');
