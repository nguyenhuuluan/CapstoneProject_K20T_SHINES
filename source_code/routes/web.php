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

Route::get('/test/{companyID}', 'CompanyController@test')->name('test');


//Password reset routes
// Route::get('account_password/reset', 'AccountAuth\ForgotPasswordController@showLinkRequestForm');
// Route::post('account_password/email', 'AccountAuth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('account_password/reset/{token}', 'AccountAuth\ResetPasswordController@showResetForm');
// Route::post('account_password/reset', 'AccountAuth\ResetPasswordController@reset');

//Company

Route::get('/admin/getcompanies', 'CompanyController@getCompanies')->name('getcompanies');
Route::get('/admin/company', 'CompanyController@index')->name('company');
Route::get('/admin/company/approve/{companyID}', 'CompanyController@approveCompany')->name('approvecompany');
Route::get('/admin/company/active/{companyID}', 'CompanyController@setActiveCompany')->name('activecompany');

Route::get('/recruitment/searchtag', 'RecruitmentController@searchtag')->name('searchtag');

Route::get('/recruitments/{id}', 'RecruitmentController@detailrecruitment')->name('detailrecruitment');




//Admin login
Route::GET('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::POST('admin','Admin\LoginController@login');
Route::POST('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::GET('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::POST ('admin-password/reset','Admin\ResetPasswordController@reset');
Route::GET('password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset'); 


//Admin Controller
Route::middleware(['admin', 'web'])->group(function () {

	Route::GET('admin/home', 'Admin\AdminController@index');  
	Route::resource('admin/recruitment', 'Admin\AdminRecruitmentController') ;
	//Route::get('/admin/recruitment/{id}/preview', 'RecruitmentController@preview')->name('preview');
});


//login representatitive 

Route::GET('representative/login','Representative\LoginController@showLoginForm')->name('representative.login');
Route::POST('representative/login','Representative\LoginController@login');
Route::POST('representative-password/email','Representative\ForgotPasswordController@sendResetLinkEmail')->name('representative.password.email');
Route::GET('representative-password/reset','Representative\ForgotPasswordController@showLinkRequestForm')->name('representative.password.request');
Route::POST ('representative-password/reset','Representative\ResetPasswordController@reset');
Route::GET('password/reset/{token}','Representative\ResetPasswordController@showResetForm')->name('representative.password.reset'); 


//Representative Controller

Route::middleware(['representative', 'web'])->group(function () {
	Route::GET('representative', 'Representative\RepresentativeController@index');   

	Route::GET('representative/home', 'Representative\RepresentativeController@index');   
	Route::resource('representative/recruitments', 'Representative\RepresentativeRecruitmentController');

});







Route::get('/test/{id}','RecruitmentController@test')->name('test');
