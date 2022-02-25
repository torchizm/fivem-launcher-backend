<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/connect', 'Api\LauncherLoginController@connect');
Route::post('/launcher_login', 'Api\LauncherLoginController@index');
Route::get('/launcher_login/{server}', 'Api\LauncherLoginController@isUsingLauncher');
Route::post('/launcher_login/{server}', 'Api\LauncherLoginController@playButton')->middleware('api-token');
Route::post('/launcher_login/exit/{server}', 'Api\LauncherLoginController@exitLauncher');
Route::post('/player/launcher/isready/{server}', 'Api\LauncherLoginController@isPlayerReady');

Route::get('/server/{server}', 'Api\ServerController@show');
Route::get('/server', 'Api\ServerController@getName');
Route::get('/launcher/check', 'Api\ServerController@check');

Route::post('/photo/upload', 'Api\ServerController@storeImage')->middleware('api-token');
Route::post('/cdn/upload', 'Api\ServerController@storeFile')->middleware('api-token');

Route::get('/rules/{server}', 'Api\ServerController@showRules')->middleware('api-token');
Route::post('/rules/{server}', 'Api\ServerController@addRules')->middleware('api-token');

Route::get('/updates/{server}', 'Api\ServerController@showUpdates')->middleware('api-token');
Route::post('/updates/{server}', 'Api\ServerController@addUpdates')->middleware('api-token');
Route::post('/update/delete/{server}/{update}', 'Api\ServerController@deleteUpdate')->middleware('api-token');

Route::get('/posts/{server}', 'Api\ServerController@showPosts')->middleware('api-token');
Route::post('/post/{server}', 'Api\ServerController@addPost')->middleware('api-token');
Route::post('/post/like/{server}/{post}', 'Api\ServerController@likePost')->middleware('api-token');
Route::post('/post/active/{server}/{post}', 'Api\ServerController@activePost')->middleware('api-token');
Route::post('/post/delete/{server}/{post}', 'Api\ServerController@deletePost')->middleware('api-token');

Route::get('/players/{server}', 'Api\PlayerController@index')->middleware('api-token');
Route::get('/player/{server}', 'Api\PlayerController@show')->middleware('api-token');
Route::post('/player/{server}', 'Api\PlayerController@update')->middleware('api-token');
Route::get('/player/launcher/check', 'Api\PlayerController@check');

Route::get('/reports/{server}', 'Api\PlayerController@reports')->middleware('api-token');
Route::post('/report/{server}', 'Api\PlayerController@report')->middleware('api-token');

Route::get('/hashes', 'Api\CheatController@getHashes');
Route::get('/blacklist', 'Api\CheatController@index')->middleware('api-token');
Route::get('/cheats/{server}', 'Api\CheatController@show')->middleware('api-token');
Route::post('/detection/{server}', 'Api\CheatController@store')->middleware('api-token');

Route::get('/logs/{server}', 'Api\ServerController@getLog')->middleware('api-token');
// Route::get('/license/check', 'Api\LicenseController@getIp');