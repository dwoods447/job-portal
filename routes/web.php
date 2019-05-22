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
Route::get('/jobs/all', 'JobController@index')->name('all.jobs');
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
Route::post('/jobseeker/profile/store', 'ProfileController@store')->name('profile.store');
Route::post('/jobseeker/avatar/upload', 'ProfileController@uploadAvatar')->name('upload.avatar');
Route::post('/jobseeker/resume/upload', 'ProfileController@uploadResume')->name('upload.resume');
Route::post('/jobseeker/cover_letter/upload', 'ProfileController@uploadCoverLetter')->name('upload.coverletter');


//Employer job creation form
Route::get('/employer/create/job', 'JobController@jobCreationForm')->name('employer.jobcreationform');
Route::post('/employer/create/job','JobController@createJob')->name('post.job');


//List jobs that belong to an employer
Route::get('/employer/jobs', 'EmployerController@getJobs')->name('employer.jobs');
//Edit jobs that belong to an employer
Route::get('/employer/{user_id}/job/{id}', 'EmployerController@editJob')->name('edit.job');
//Update jobs that belong to an employer
Route::post('/employer/job/{id}', 'EmployerController@updateJob')->name('update.job');


//Job seeker  can apply for a job
Route::post('/application/{id}', 'JobController@submitApplication')->name('submit.application');
//Employer can view job applicants
Route::get('/jobs/applications', 'JobController@getApplicants')->name('job.applicants');