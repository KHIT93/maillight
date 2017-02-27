<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/systeminfo', 'HomeController@systeminfo');
Auth::routes();
Route::get('/messages', 'MessagesController@index');
Route::get('/messages/{message}', 'MessagesController@show');
Route::get('/messages/{message}/content', 'MessagesController@read_mail');
Route::get('/lists', 'HomeController@lists');
Route::get('/quarantine', 'HomeController@quarantine');

Route::get('/reports', 'ReportsController@index');
Route::get('/reports/filter', 'ReportsController@get_filtered_data');
Route::get('/reports/filter/options', 'ReportsController@get_filter_options');
Route::get('/reports/filter/messages_by_date', 'ReportsController@filter_messages_by_date');
Route::post('/reports/filter', 'ReportsController@apply_filter');
Route::delete('/reports/filter/{filter}', 'ReportsController@remove_filter');
Route::get('/reports/messages', 'ReportsController@messages_report');
Route::get('/reports/messages-by-date', 'ReportsController@messages_by_date');
Route::get('/reports/audit', 'ReportsController@audit');

Route::get('/tools', 'HomeController@tools');
Route::get('/tools/mysql-status', 'ToolsController@mysql_status');
Route::get('/tools/mailscanner-config', 'ToolsController@mailscanner_config');

Route::get('/users', 'UsersController@index');
Route::get('/users/create', 'UsersController@create');
Route::put('/users/create', 'UsersController@store');
Route::get('/users/{user}/update', 'UsersController@edit');
Route::patch('/users/{user}/update', 'UsersController@update');
Route::get('/users/{user}/delete', 'UsersController@delete');
Route::delete('/users/{user}/delete', 'UsersController@destroy');

Route::get('/settings', 'SettingsController@index');
