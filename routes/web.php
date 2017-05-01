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

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('/systeminfo', ['as' => 'systeminfo', 'uses' => 'HomeController@systeminfo']);

    Route::get('/messages', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('/messages/{message}', ['as' => 'message.detail', 'uses' => 'MessagesController@show']);
    Route::get('/messages/{message}/content', ['as' => 'message.content', 'uses' => 'MessagesController@read_mail']);
    Route::get('/lists', ['as' => 'lists', 'uses' => 'HomeController@lists']);
    Route::get('/quarantine', ['as' => 'quarantine', 'uses' => 'HomeController@quarantine']);

    Route::get('/reports', ['as' => 'reports', 'uses' => 'ReportsController@index']);
    Route::get('/reports/filter', ['as' => 'reports.filter.data', 'uses' => 'ReportsController@get_filtered_data']);
    Route::get('/reports/filter/options', ['as' => 'reports.filter.options', 'uses' => 'ReportsController@get_filter_options']);
    Route::get('/reports/filter/messages_by_date', ['as' => 'reports.filter.messages.by_date', 'uses' => 'ReportsController@filter_messages_by_date']);
    Route::post('/reports/filter', ['as' => 'reports.filter.apply', 'uses' => 'ReportsController@apply_filter']);
    Route::delete('/reports/filter/{filter}', ['as' => 'reports.filter.delete', 'uses' => 'ReportsController@remove_filter']);
    Route::get('/reports/messages', ['as' => 'reports.messages', 'uses' => 'ReportsController@messages_report']);
    Route::get('/reports/messages-by-date', ['as' => 'reports.message.by_date', 'uses' => 'ReportsController@messages_by_date']);
    Route::get('/reports/audit', ['as' => 'reports.audit_log', 'uses' => 'ReportsController@audit']);

    Route::get('/tools', ['as' => 'tools', 'uses' => 'HomeController@tools']);
    Route::get('/tools/mysql-status', ['as' => 'tools.status.mysql', 'uses' => 'ToolsController@mysql_status']);
    Route::get('/tools/mailscanner-config', ['as' => 'tools.status.mailscanner', 'uses' => 'ToolsController@mailscanner_config']);

    Route::get('/user', ['as' => 'users.show', 'uses' => 'UsersController@show']);
    Route::get('/users', ['as' => 'users', 'uses' => 'UsersController@index']);
    Route::get('/users/create', ['as' => 'users.create', 'uses' => 'UsersController@create']);
    Route::put('/users/create', ['as' => 'users.store', 'uses' => 'UsersController@store']);
    Route::get('/users/{user}/update', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
    Route::patch('/users/{user}/update', ['as' => 'users.update', 'uses' => 'UsersController@update']);
    Route::get('/users/{user}/delete', ['as' => 'users.delete', 'uses' => 'UsersController@delete']);
    Route::delete('/users/{user}/delete', ['as' => 'users.destroy', 'uses' => 'UsersController@destroy']);

    Route::get('/settings', ['as' => 'settings', 'uses' => 'SettingsController@index']);
});

Auth::routes();
