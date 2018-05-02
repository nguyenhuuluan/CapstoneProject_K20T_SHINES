<?php
// if (env('APP_ENV') === 'local') {
//     URL::forceScheme('https');
// }
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
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
Route::get('/recruitments', 'HomeController@listRecruitments')->name('lst.recruitment');
Route::get('/recruitments/total', 'RecruitmentController@totalRecruitments')->name('recruitment.total');


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

Route::get('/recruitments/{id}', 'RecruitmentController@detailrecruitment')->name('detailrecruitment');
Route::GET('student/recruitments/{id}/apply', 'Student\StudentRecruitmentController@apply')->name('student.apply.recruitment')->middleware('student');
Route::GET('student/recruitments/{id}/save', 'Student\StudentRecruitmentController@saveRecruitment')->name('student.save.recruitment')->middleware('student');
Route::POST('student/recruitments/{id}/apply', 'Student\StudentRecruitmentController@store')->name('student.apply.recruitment.store')->middleware('student');


// Route::get('/recruitments/{id}', 'RecruitmentController@detailrecruitment')->name('detailrecruitment');

Route::group(['middleware' => 'filter'], function() {
    Route::get('/recruitments/{id}', 'RecruitmentController@detailrecruitment')->name('detailrecruitment');
});

Route::get('search', 'RecruitmentController@search')->name('recruitments.search');

Route::get('/recruitment/increaseView/{recruitmentID}', 'RecruitmentController@increaseView')->name('recruitment.increaseview');

// Company - WEB
// Route::get('/company/details/{id}', 'CompanyController@details')->name('company.details');
// Route::get('/company/details/{id}', 'CompanyController@details')->name('company.details');
Route::get('/companies/{id}', 'CompanyController@details')->name('company.details');
Route::GET('/companies/', 'Company\CompanyController@list')->name('companies.list');



// Student - WEB

Route::POST('student','StudentController@register')->name('student.register');
Route::GET('student/confirm/{token}','StudentController@confirm')->name('student.confirm');
Route::POST('student/confirm','StudentController@confirmInfomation')->name('student.confirm-information');
Route::GET('student/update-success','StudentController@updateSuccess')->name('student.update-success');




Route::middleware(['student', 'web'])->group(function () {

Route::get('student/profile', 'Student\StudentProfileController@index')->name('profile.index');
Route::get('student/profile/edit', 'Student\StudentProfileController@edit')->name('profile.edit');
Route::post('student/profile/edit', 'Student\StudentProfileController@update')->name('profile.update');

Route::POST('student/photo/update', 'Student\StudentProfileController@editPhoto')->name('student.photo.edit');


Route::GET('student/cv', 'Student\StudentCvController@show')->name('student.cv.show');
Route::POST('student/cv/{id}', 'Student\StudentCvController@store')->name('student.cv.store');
Route::POST('student/cv/', 'Student\StudentCvController@destroy')->name('student.cv.destroy');


// Route::resource('student/cv', 'Student\StudentCvController');

Route::GET('student/recruitments/apply', 'Student\StudentRecruitmentController@showApply')->name('student.apply.show');
Route::GET('student/recruitments/save', 'Student\StudentRecruitmentController@showRecruitment')->name('student.recruitment.show');

// Route::get('student/profile', 'StudentController@profile')->name('student.profile');

Route::get('student/profile/update', 'StudentController@updateProfile')->name('student.profile.update');
// Route::POST('student/profile/update', 'StudentController@editProfile')->name('student.profile.edit');
});



Route::GET('student/cvs/download/{name}','Student\StudentCvController@download')->name('student.cv.download');
Route::GET('student/cvs/preview/{name}','Student\StudentCvController@preview')->name('student.cv.preview');





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
	Route::GET('admin', 'Admin\AdminController@index')->name('admin.home');  
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
	Route::get('admin/recruitment/feedback/{recruitmentID}/{message}', 'Admin\AdminRecruitmentController@feedback')->name('admin.recruitments.feedback');




	//Route::get('/admin/recruitment/{id}/preview', 'RecruitmentController@preview')->name('preview');


	//Company - ADMIN
	Route::get('/admin/getcompanies', 'CompanyController@getCompanies')->name('getcompanies');
	Route::get('/admin/company', 'CompanyController@index')->name('company');
	Route::get('/admin/company/approve/{companyID}', 'CompanyController@approveCompany')->name('approvecompany');
	Route::get('/admin/company/active/{companyID}', 'CompanyController@setActiveCompany')->name('activecompany');
	Route::get('/admin/company/company-registration', 'CompanyController@companyRegistration')->name('company.registration');
	Route::get('/admin/company/sendemailconfirm/{accID}/{repreID}/{compID}', 'CompanyController@sendConfirmEmail')->name('company.sendConfirmEmail');

	//Blog - ADMIN
	Route::resource('/admin/blogs', 'Admin\AdminBlogController');
	Route::get('/admin/getdata/blogs', 'Admin\AdminBlogController@getdata')->name('blogs.getdata');


	//Faculty - ADMIN
	// Route::get('/admin/faculties', 'Admin\AdminFacultyController@index')->name('admin.faculties');
	// Route::resource('/admin/faculties/create', 'Admin\AdminFacultyController@create')->name('admin.faculties.create');
	Route::resource('/admin/faculties', 'Admin\AdminFacultyController');
	Route::post('/admin/ajax/update/faculties', 'Admin\AdminFacultyController@update')->name('faculties.update');
	Route::get('/admin/getdata/faculties', 'Admin\AdminFacultyController@getdata')->name('faculties.getdata');

	Route::delete('/admin/removedata/faculties', 'Admin\AdminFacultyController@destroy')->name('faculties.removedata');


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
	Route::GET('representative', 'Representative\RepresentativeController@index')->name('company.statistic');   

	Route::GET('representative/home', 'Representative\RepresentativeController@index');   
	Route::resource('representative/recruitments', 'Representative\RepresentativeRecruitmentController');

	//Company
	Route::get('/company/update', 'CompanyController@update')->name('company.update');
	Route::POST('/company/edit/{id}', 'CompanyController@edit')->name('company.edit');
	Route::POST('/company/updateLogo', 'CompanyController@updateLogo')->name('company.updateLogo');
	Route::POST('/company/updateImages', 'CompanyController@updateImages')->name('company.updateImages');
	Route::POST('/company/deleteImage', 'CompanyController@deleteImage')->name('company.deleteImage');
	
});

Route::GET('representative/reset-password/{token}','Representative\RepresentativeController@resetPassword')->name('representative.resetpassword');

Route::GET('representative/update-success','Representative\ResetPasswordController@updateSuccess')->name('representative.update-success');



Route::POST('representative/reset-password','Representative\ResetPasswordController@resetPassword')->name('representative.reset-password');

// District
Route::get('/districts/{cityID}','AddressController@getDistricts')->name('address.districts');


Route::get('/test/{id}','RecruitmentController@test')->name('test');

Route::get('/tags','TagController@getTags')->name('tags');

