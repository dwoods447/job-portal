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



//Get all Jobs
Route::get('/jobs/all', 'JobController@index');
//Get Specific Job
Route::get('/job/{id}/slug/{slug}', 'JobController@show')->name('job.show');


//Get Specific Company Info
Route::get('/company/{id}/{name}', 'CompanyController@index')->name('companies.index');

//Employer signup
Route::get('/employer/signup', 'EmployerController@signup')->name('employer.signup');
//Employer register
Route::post('/employer/register', 'EmployerController@register')->name('employer.register');

//Jobseeker signup
Route::get('/jobseeker/signup', 'JobController@signup')->name('jobseeker.signup');
//Jobseeker register
Route::post('/jobseeker/register', 'JobController@register')->name('jobseeker.register');


//Company profile
Route::get('/company/create', 'CompanyController@create')->name('company.profile');
Route::post('/upload/company/logo', 'CompanyController@uploadLogo')->name('upload.logo');
Route::post('/upload/company/cover_photo', 'CompanyController@uploadCoverPhoto')->name('upload.coverphoto');
Route::post('/company/store', 'CompanyController@store')->name('company.store');


//Jobseeker Profile
Route::get('/jobseeker/profile', 'ProfileController@create')->name('jobseeker.profile');
Route::post('/jobseeker/profile/store', 'JobController@store')->name('profile.store');
Route::post('/jobseeker/avatar/upload', 'JobController@uploadAvatar')->name('upload.avatar');
Route::post('/jobseeker/resume/upload', 'JobController@uploadResume')->name('upload.resume');
Route::post('/jobseeker/cover_letter/upload', 'JobController@uploadCoverLetter')->name('upload.coverletter');