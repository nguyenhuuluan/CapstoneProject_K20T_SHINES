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
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
Route::get('/recruitments', 'HomeController@listRecruitments')->name('lst.recruitment');


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


// Blog - WEB
Route::get('/blogs/{slug}', 'HomeController@detailblog')->name('detailblog');


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


	//Recruitment-- ADMIN
	Route::resource('admin/recruitments', 'Admin\AdminRecruitmentController', [
		'names' => [
			'index' => 'admin.recruitments.index',
			'show' => 'admin.recruitments.show',
			'edit' => 'admin.recruitments.edit',
			'update'=>'admin.recruitments.update'
		],
		'except' => ['destroy', 'store', 'create']
	]);
	// Route::get('admin/recruitments/{id}/edit', 'Admin\AdminRecruitmentController@edit')->name('admin.recruitments.edit');



	Route::get('admin/approve/recruitments', 'Admin\AdminRecruitmentController@approve')->name('admin.recruitments.approve');
	Route::get('/admin/recruitments/approve/{recruitmentID}', 'Admin\AdminRecruitmentController@approveRecruitment')->name('approverecruitment');
	Route::get('/admin/recruitments/active/{recruitment_id}', 'Admin\AdminRecruitmentController@setActiveRecruitment')->name('activerecruitment');
	Route::get('admin/recruitment/feedback/{recruitmentID}/{message}', 'Admin\AdminRecruitmentController@feedback')->name('admin.recruitments.feedback');



	//Staff - ADMIN
	//them middleware->lỗi chuyển sang page 403
	// Route::resource('admin/staffs', 'Admin\AdminStaffController')->middleware('can:accounts.staff');
	Route::resource('admin/staffs', 'Admin\AdminStaffController', ['except' => ['update','show']]);
	Route::patch('admin/staffs', 'Admin\AdminStaffController@update')->name('staffs.update');
	Route::get('admin/staffs/{id}/{type}', 'Admin\AdminStaffController@show')->name('staffs.show');

	//Company - ADMIN
	Route::get('/admin/getcompanies', 'CompanyController@getCompanies')->name('getcompanies');
	Route::get('/admin/companies', 'Admin\AdminCompanyController@index')->name('company');
	Route::get('/admin/company/approve/{companyID}', 'Admin\AdminCompanyController@approveCompany')->name('approvecompany');
	Route::get('/admin/company/active/{companyID}', 'Admin\AdminCompanyController@setActiveCompany')->name('activecompany');

	Route::get('/admin/company/setishot/{companyID}', 'Admin\AdminCompanyController@setIsHotCompany')->name('ishotcompany');


	Route::get('/admin/company/company-registration', 'Admin\AdminCompanyController@companyRegistration')->name('company.registration');
	Route::get('/admin/company/sendemailconfirm/{accID}/{repreID}/{compID}', 'Admin\AdminCompanyController@sendConfirmEmail')->name('company.sendConfirmEmail');


	//Dashboard 
	Route::get('/admin/dashboard', 'Admin\DashboardController@index')->name('admin.dasboard');
	// [1]
	Route::get('/admin/statistics/statisticsNumberOfRecruitmentByYear/{year}', 'Admin\AdminController@statisticsNumberOfRecruitmentByYear')->name('admin.statistics.statisticsNumberOfRecruitmentByYear');

	// [2]
	Route::get('/admin/statistics/statisticsNumberOfRecruitmentByAllFaculties', 'Admin\AdminController@statisticsNumberOfRecruitmentByAllFaculties')->name('admin.statistics.statisticsNumberOfRecruitmentByAllFaculties');

	// [3]
	Route::get('/admin/statistics/statisticsCategiesOfRecruitments', 'Admin\AdminController@statisticsCategiesOfRecruitments')->name('admin.statistics.statisticsCategiesOfRecruitments');

	// [4] [5]
	Route::get('/admin/statistics/statisticsNumberOfView', 'Admin\AdminController@statisticsNumberOfView')->name('admin.statistics.statisticsNumberOfView');

	// [7]
	Route::get('/admin/statistics/statisticsStudentAndCVByFaculty', 'Admin\AdminController@statisticsStudentAndCVByFaculty')->name('admin.statistics.statisticsStudentAndCVByFaculty');

	// [10]
	Route::post('/admin/statistics/statisticsTagsInStudentByRangeDate', 'Admin\AdminController@statisticsTagsInStudentByRangeDate')->name('admin.statistics.statisticsTagsInStudentByRangeDate');

	// [11]
	Route::post('/admin/statistics/statisticsTagsInRecruitmentByRangeDate', 'Admin\AdminController@statisticsTagsInRecruitmentByRangeDate')->name('admin.statistics.statisticsTagsInRecruitmentByRangeDate');

	//[12]
	Route::post('/admin/statistics/fetchUserTypes', 'Admin\AdminController@fetchUserTypes')->name('admin.statistics.fetchUserTypes');

	//[13]
	Route::post('/admin/statistics/fetchTopBrowsers', 'Admin\AdminController@fetchTopBrowsers')->name('admin.statistics.fetchTopBrowsers');

	// [14]
	Route::get('/admin/statistics/statisticsNumberOfCompanyByYear/{year}', 'Admin\AdminController@statisticsNumberOfCompanyByYear')->name('admin.statistics.statisticsNumberOfCompanyByYear');



	//Blog - ADMIN
	Route::resource('/admin/blogs', 'Admin\AdminBlogController',['except' => ['destroy']]);
	Route::get('/admin/getdata/blogs', 'Admin\AdminBlogController@getdata')->name('blogs.getdata');
	Route::delete('/admin/removedata/blogs', 'Admin\AdminBlogController@destroy')->name('blogs.destroy');



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
	Route::get('/representative/getdata/recruitments', 'Representative\RepresentativeRecruitmentController@getCV')->name('recruitments.getcv');

	//Company
	Route::get('/company/update', 'CompanyController@update')->name('company.update');
	Route::POST('/company/edit/{id}', 'CompanyController@edit')->name('company.edit');
	Route::POST('/company/updateLogo', 'CompanyController@updateLogo')->name('company.updateLogo');
	Route::POST('/company/updateImages', 'CompanyController@updateImages')->name('company.updateImages');
	Route::GET('/company/deleteImage/{imageName}', 'CompanyController@deleteImage')->name('company.deleteImage');
});




Route::GET('representative/reset-password/{token}','Representative\RepresentativeController@resetPassword')->name('representative.resetpassword');

Route::GET('representative/update-success','Representative\ResetPasswordController@updateSuccess')->name('representative.update-success');



Route::POST('representative/reset-password','Representative\ResetPasswordController@resetPassword')->name('representative.reset-password');

// District
Route::get('/districts/{cityID}','AddressController@getDistricts')->name('address.districts');


Route::get('/test/{id}','RecruitmentController@test')->name('test');

Route::get('/tags','TagController@getTags')->name('tags');

