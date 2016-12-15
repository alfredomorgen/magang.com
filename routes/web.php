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

///////////
// Admin //
///////////
Route::group(['middleware' => 'admin'], function(){
    Route::get('admin/searchJobseeker',function(){
        $search = urlencode(e(\Illuminate\Support\Facades\Input::get('search')));
        $route = "admin/search_jobseeker/$search";
        return redirect($route);
    });

    Route::get('admin/searchJob',function(){
        $search = urlencode(e(\Illuminate\Support\Facades\Input::get('search')));
        $route = "admin/search_job/$search";
        return redirect($route);
    });

    Route::get('/admin/search_company', [
        'uses' => 'SiteController@indexCompany'
    ]);

    Route::get('/admin/search_company/search', [
        'uses' => 'SiteController@searchCompany'
    ]);

    Route::get('/admin/search_jobseeker', [
        'uses' => 'SearchController@indexJobseeker'
    ]);

    Route::get('/admin/search_jobseeker/{search}', [
        'uses' => 'SearchController@searchJobseeker'
    ]);

    Route::get('/admin/search_job', [
        'uses' => 'SearchController@indexJob'
    ]);

    Route::get('/admin/search_job/{search}', [
        'uses' => 'SearchController@searchJob'
    ]);

    Route::get('/admin/delete_job/{id}',[
        'uses' => 'AdminController@deleteJob'
    ]);

    Route::get('/admin/delete_company/{id}',[
        'uses' => 'AdminController@deleteCompany'
    ]);
    Route::get('/admin/delete_jobseeker/{id}',[
        'uses' => 'AdminController@deleteJobseeker'
    ]);
});

//////////////
// Company //
/////////////
Route::get('/company/post_job', [
    'uses' => 'CompanyController@post_job',
    'as' => 'company.post_job'
]);

Route::post('/company/post_job/store',[
    'uses' => 'CompanyController@store',
    'as' => 'company.store'
]);

Route::get('/company/manage_post',[
    'uses' => 'CompanyController@manage_post',
    'as' => 'company.manage_post'
]);

Route::get('/company/post_job/edit/{id}',[
    'uses' => 'CompanyController@manage_post_edit',
    'as' => 'company.manage_post_edit'
]);

Route::post('/company/post_job/update/{id}',[
    'uses' => 'CompanyController@manage_post_update',
    'as' => 'company.manage_post_update'
]);

Route::get('/company/post_job/close/{id}',[
    'uses' => 'CompanyController@manage_post_close',
    'as' => 'company.manage_post_close'
]);

Route::get('/company/search_jobseeker/search',[
    'uses' => 'CompanyController@searchJobseeker',
    'as' => 'company.search_jobseeker'
]);

Route::get('/company/search_jobseeker',[
    'uses' => 'CompanyController@indexJobseeker',
]);

Route::get('company/view_candidate/resume/user/{id}',[

    'uses' => 'CompanyController@view_resume',
    'as' => 'company.view_candidate_resume'
]);

Route::get('company/view_candidate/{id}',[
    'uses' => 'CompanyController@view_candidate',
    'as' => 'company.view_candidate'
]);

Route::get('company/transaction_approve/{id}',[
    'uses' => 'CompanyController@approve',
    'as' => 'company.transaction_approve'
]);


Route::get('/company/{user_id}/edit', [
    'uses' => 'CompanyController@edit',
    'as' => 'company.edit',
]);

Route::post('/company/{user_id}/update', [
    'uses' => 'CompanyController@update',
    'as' => 'company.update',
]);

Route::get('/company/bookmark_jobseeker/',[
    'uses' => 'CompanyController@bookmark_jobseeker',
    'as' => 'company.bookmark_jobseeker'
]);

Route::get('/company/add_bookmark_jobseeker/{id}',[
    'uses'  => 'CompanyController@add_bookmark_jobseeker',
    'as' => 'company.add_bookmark_jobseeker'
]);

Route::get('/company/delete_bookmark_jobseeker/{id}',[
    'uses' => 'CompanyController@delete_bookmark_jobseeker',
    'as' => 'company.delete_bookmark_jobseeker'
]);

Route::get('/company/remove_job/{job_id}', [
    'uses' => 'CompanyController@remove_bookmark_jobseeker',
    'as' => 'company.remove_bookmark_jobseeker',
]);

///////////////
// Jobseeker //
///////////////
Route::get('/jobseeker/bookmark', [
    'uses' => 'JobseekerController@bookmark_index',
    'as' => 'jobseeker.bookmark_index',
]);

Route::get('/jobseeker/bookmark/add_company/{company_id}', [
    'uses' => 'JobseekerController@bookmark_add_company',
    'as' => 'jobseeker.bookmark_add_company',
]);

Route::get('/jobseeker/bookmark/remove_company/{company_id}', [
    'uses' => 'JobseekerController@bookmark_remove_company',
    'as' => 'jobseeker.bookmark_remove_company',
]);

Route::get('/jobseeker/bookmark/add_job/{job_id}', [
    'uses' => 'JobseekerController@bookmark_add_job',
    'as' => 'jobseeker.bookmark_add_job',
]);

Route::get('/jobseeker/bookmark/remove_job/{job_id}', [
    'uses' => 'JobseekerController@bookmark_remove_job',
    'as' => 'jobseeker.bookmark_remove_job',
]);

Route::get('/jobseeker/bookmark/remove/{bookmark_id}', [
    'uses' => 'JobseekerController@bookmark_remove',
    'as' => 'jobseeker.bookmark_remove',
]);

Route::get('/jobseeker/applied_jobs', [
    'uses' => 'JobseekerController@applied_jobs',
    'as' => 'jobseeker.applied_jobs',
]);

Route::get('/job/{id}/apply', [
    'uses' => 'JobseekerController@apply',
    'as' => 'jobseeker.apply'
]);

Route::post('/job/{id}/report', [
    'uses' => 'JobseekerController@report_job',
    'as' => 'jobseeker.report_job',
]);

Route::get('/jobseeker/{user_id}/edit', [
    'uses' => 'JobseekerController@edit',
    'as' => 'jobseeker.edit',
]);

Route::post('/jobseeker/{user_id}/update',[
    'uses' => 'JobseekerController@update',
    'as' => 'jobseeker.update',
]);

////////////////
// All users //
///////////////
Auth::routes();

Route::get('/', [
    'uses' => 'SiteController@index',
]);

Route::get('/home', [
    'uses' => 'SiteController@index',
]);

Route::get('/login/{user_type}',[
    'uses' => 'SiteController@loginType'
]);

Route::get('/register/{user_type}',[
    'uses' => 'SiteController@registerType'
]);

Route::get('/search_job',[
    'uses' => 'JobController@search_job',
    'as' => 'job.search'
]);

Route::get('/home/search_job',[
    'uses' => 'SiteController@searchJob',
    'as' => 'home.search',
]);

Route::get('/search_company/search',[
    'uses' => 'SiteController@searchCompany',
    'as' => 'search_company'
]);

Route::get('/search_company',[
    'uses' => 'SiteController@indexCompany',
    'as' => 'index_company',
]);

Route::get('/company/{user_id}', [
    'uses' => 'CompanyController@index',
    'as' => 'company.index',
]);

Route::get('/job/{id}', [
    'uses' => 'JobController@index',
    'as' => 'job.index',
]);

Route::get('/jobseeker/{user_id}', [
    'uses' => 'JobseekerController@index',
    'as' => 'jobseeker.index',
]);

Route::get('/home/readNotifications', [
    'uses' => 'SiteController@readNotifications',
]);