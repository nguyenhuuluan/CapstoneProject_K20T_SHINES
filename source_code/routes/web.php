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


Route::get('/' , 'HomeController@index')->name('index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/test/{companyID}', 'CompanyController@test')->name('test');


//Password reset routes
// Route::get('account_password/reset', 'AccountAuth\ForgotPasswordController@showLinkRequestForm');
// Route::post('account_password/email', 'AccountAuth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('account_password/reset/{token}', 'AccountAuth\ResetPasswordController@showResetForm');
// Route::post('account_password/reset', 'AccountAuth\ResetPasswordController@reset');






// Company Registration - WEB
Route::get('/partnership', 'CompanyRegistrationController@partnership')->name('company.partnership');

Route::GET('/partnership/register', 'CompanyRegistrationController@registerPartnershipForm')->name('company.register.partnership.form');
Route::POST('/partnership/register', 'CompanyRegistrationController@registerPartnership')->name('company.register.partnership.store');


// Recruitment - WEB
Route::get('/recruitment/searchtag', 'RecruitmentController@searchtag')->name('searchtag');

Route::get('/recruitments/{id}', 'RecruitmentController@detailrecruitment')->name('detailrecruitment');

// Company - WEB
Route::get('/company/detail/{id}', 'CompanyController@detail')->name('company.detail');




// Student - WEB

Route::POST('student','StudentController@register')->name('student.register');
Route::GET('student/confirm/{token}','StudentController@confirm')->name('student.confirm');
Route::POST('student/confirm','StudentController@confirmInfomation')->name('student.confirm-information');
Route::GET('student/update-success','StudentController@updateSuccess')->name('student.update-success');

Route::get('student/profile', 'StudentController@profile')->name('student.profile')->middleware('student');
Route::get('student/profile/update', 'StudentController@updateProfile')->name('student.profile.update')->middleware('student');
Route::POST('student/profile/update/{id}', 'StudentController@editProfile')->name('student.profile.edit')->middleware('student');
Route::POST('student/profile/update/photo/{id}', 'StudentController@editPhoto')->name('student.photo.edit')->middleware('student');

Route::POST('student/profile/update/cv/{id}', 'Student\StudentCvController@store')->name('student.cv.store')->middleware('student');
Route::POST('student/profile/update/photo/{id}', 'StudentController@editPhoto')->name('student.photo.store')->middleware('student');

Route::GET('student/profile/update/cv', 'Student\StudentCvController@show')->name('student.cv.show')->middleware('student');

Route::GET('student/cv/{id}', 'Student\StudentCvController@destroy')->name('student.cv.destroy')->middleware('student');

// Route::post('ajaxImageUpload', ['as'=>'ajaxImageUpload','uses'=>'Student\StudentCvController@store']);



//Admin login - ADMIN
Route::GET('admin/login','Admin\LoginController@showLoginForm')->name('admin.login');
Route::POST('admin/login','Admin\LoginController@login');
Route::POST('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::GET('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::POST ('admin-password/reset','Admin\ResetPasswordController@reset');
Route::GET('password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset'); 


//Admin - ADMIN
Route::middleware(['admin', 'web'])->group(function () {
	Route::GET('admin', 'Admin\AdminController@index');  
	Route::GET('admin/home', 'Admin\AdminController@index');  
	Route::resource('admin/recruitments', 'Admin\AdminRecruitmentController', [
		'names' => [
			'index' => 'admin.recruitments.index',
			'store' => 'admin.recruitments.store',
			'create' => 'admin.recruitments.create',
			'show' => 'admin.recruitments.show',
			'update' => 'admin.recruitments.update',
			'destroy' => 'admin.recruitments.destroy',
			'edit' => 'admin.recruitments.edit',
			
		]]);
	Route::get('admin/approve/recruitments', 'Admin\AdminRecruitmentController@approve')->name('admin.recruitments.approve');

	Route::get('/admin/recruitments/approve/{recruitmentID}', 'Admin\AdminRecruitmentController@approveRecruitment')->name('approverecruitment');
	Route::get('/admin/recruitments/active/{recruitment_id}', 'Admin\AdminRecruitmentController@setActiveRecruitment')->name('activerecruitment');


	//Route::get('/admin/recruitment/{id}/preview', 'RecruitmentController@preview')->name('preview');


	//Company - ADMIN

	Route::get('/admin/getcompanies', 'CompanyController@getCompanies')->name('getcompanies');
	Route::get('/admin/company', 'CompanyController@index')->name('company');
	Route::get('/admin/company/approve/{companyID}', 'CompanyController@approveCompany')->name('approvecompany');
	Route::get('/admin/company/active/{companyID}', 'CompanyController@setActiveCompany')->name('activecompany');

	Route::get('/admin/company/company-registration', 'CompanyController@companyRegistration')->name('company.registration');

	Route::get('/admin/company/sendemailconfirm/{accID}/{repreID}/{compID}', 'CompanyController@sendConfirmEmail')->name('company.sendConfirmEmail');


});



//login representatitive - WEB 
Route::GET('representative/login','Representative\LoginController@showLoginForm')->name('representative.login');
Route::POST('representative/login','Representative\LoginController@login');



Route::POST('representative-password/email','Representative\ForgotPasswordController@sendResetLinkEmail')->name('representative.password.email');
Route::GET('representative-password/reset','Representative\ForgotPasswordController@showLinkRequestForm')->name('representative.password.request');
Route::POST ('representative-password/reset','Representative\ResetPasswordController@reset');
Route::GET('password/reset/{token}','Representative\ResetPasswordController@showResetForm')->name('representative.password.reset'); 


//Representative Controller
//Representative middleware
Route::middleware(['representative', 'web'])->group(function () {
	Route::GET('representative', 'Representative\RepresentativeController@index');   

	Route::GET('representative/home', 'Representative\RepresentativeController@index');   
	Route::resource('representative/recruitments', 'Representative\RepresentativeRecruitmentController');

	//Company
	Route::get('/company/update/{id}', 'CompanyController@update')->name('company.update');

});

Route::GET('representative/reset-password/{token}','Representative\RepresentativeController@resetPassword')->name('representative.resetpassword');

Route::GET('representative/update-success','Representative\ResetPasswordController@updateSuccess')->name('representative.update-success');



Route::POST('representative/reset-password','Representative\ResetPasswordController@resetPassword')->name('representative.reset-password');




Route::get('/test/{id}','RecruitmentController@test')->name('test');

Route::get('/tags','TagController@getTags')->name('tags');

