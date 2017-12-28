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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/recruitment/{id}', 'HomeController@detail')->name('detail');

Route::get('/test/{companyID}', 'CompanyController@test')->name('test');


//Password reset routes
Route::get('account_password/reset', 'AccountAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('account_password/email', 'AccountAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('account_password/reset/{token}', 'AccountAuth\ResetPasswordController@showResetForm');
Route::post('account_password/reset', 'AccountAuth\ResetPasswordController@reset');
