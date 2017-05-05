<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('/blacklist/search', 'BlacklistsController@search');
Route::put('/blacklist/create', 'BlacklistsController@store');
Route::delete('/blacklist/destroy/{blacklist}', 'BlacklistsController@destroy');

Route::post('/whitelist/search', 'WhitelistsController@search');
Route::put('/whitelist/create', 'WhitelistsController@store');
Route::delete('/whitelist/destroy/{whitelist}', 'WhitelistsController@destroy');

Route::get('/messages', 'MessagesController@list');

Route::post('/tools/update-geoip', 'ToolsController@geoip');

Route::post('/sa/release', 'SpamAssassinController@release');
Route::delete('/sa/destroy', 'SpamAssassinController@destroy');
Route::post('/sa/learn', 'SpamAssassinController@learn');
Route::post('/sa/update-rules', 'SpamAssassinRulesController@update');

Route::post('/login/redirect', 'Auth\LoginController@getRedirectAddress');
