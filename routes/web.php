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

Route::get('/company/create', 'CompanyController@create');
Route::post('upload/company/logo', 'uploadLogo')->name('upload.logo');
Route::post('upload/company/cover_photo', 'CompanyController@uploadCoverPhoto')->name('upload.coverphoto');
Route::post('/company/store', 'CompanyController@store')->name('company.store');
