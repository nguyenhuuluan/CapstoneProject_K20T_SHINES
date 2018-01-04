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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/' , 'HomeController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/recruitment/searchtag', 'RecruitmentController@searchtag')->name('searchtag');
Route::get('/recruitment/create', 'RecruitmentController@create');
Route::get('/recruitment/{id}', 'RecruitmentController@detailrecruitment')->name('detailrecruitment');

Route::post('/recruitment', 'RecruitmentController@store');


//Admin login

Route::GET('admin/home', 'AdminController@index');   
Route::GET('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::POST('admin','Admin\LoginController@login');
Route::POST('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::GET('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::POST ('admin-password/reset','Admin\ResetPasswordController@reset');
Route::GET('password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset'); 


Route::get('/admin/recruitment', 'RecruitmentController@index')->middleware('auth:admin');
Route::patch('/admin/recruitment/{id}', 'RecruitmentController@status');
Route::get('/admin/recruitment/{id}/preview', 'RecruitmentController@preview')->name('preview');

Route::get('/test/{id}','RecruitmentController@test')->name('test');
