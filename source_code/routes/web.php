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


Route::get('/' , 'HomeController@index')->name('home');
//Auth::routes();s

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test/{companyID}', 'CompanyController@test')->name('test');


//Password reset routes
// Route::get('account_password/reset', 'AccountAuth\ForgotPasswordController@showLinkRequestForm');
// Route::post('account_password/email', 'AccountAuth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('account_password/reset/{token}', 'AccountAuth\ResetPasswordController@showResetForm');
// Route::post('account_password/reset', 'AccountAuth\ResetPasswordController@reset');

//Company

Route::get('company', 'CompanyController@getCompanies')->name('getCompanies');

Route::get('/recruitment/searchtag', 'RecruitmentController@searchtag')->name('searchtag');
Route::get('/recruitment/create', 'RecruitmentController@create');
Route::get('/recruitment/{id}', 'RecruitmentController@detailrecruitment')->name('detailrecruitment');

Route::post('/recruitment', 'RecruitmentController@store');
Route::get('/admin/recruitment', 'RecruitmentController@index');
Route::patch('/admin/recruitment/{id}', 'RecruitmentController@status');
Route::get('/admin/recruitment/{id}/preview', 'RecruitmentController@preview')->name('preview');


