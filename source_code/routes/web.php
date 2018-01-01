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
Route::get('/recruitment/searchtag', 'RecruitmentController@searchtag')->name('searchtag');
Route::get('/recruitment/create', 'RecruitmentController@create');
Route::get('/recruitment/{id}', 'RecruitmentController@detailrecruitment')->name('detailrecruitment');

Route::post('/recruitment', 'RecruitmentController@store');
Route::get('/admin/recruitment', 'RecruitmentController@index');
Route::patch('/admin/recruitment/{id}', 'RecruitmentController@status');
Route::get('/admin/recruitment/{id}/preview', 'RecruitmentController@preview')->name('adminpreviewrecruitment');


