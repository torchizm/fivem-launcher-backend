<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PageController@index');

Route::get('/dashboard/server/add', 'ServerController@create')->middleware('auth');
Route::post('/dashboard/server/add', 'ServerController@store')->middleware('auth')->name('add-server');
Route::get('/dashboard/server/{server}', 'ServerController@show')->middleware('auth')->name('server-show');
Route::get('/dashboard/server/{server}/edit', 'ServerController@edit')->middleware('auth');
Route::patch('/dashboard/server/{server}/edit', 'ServerController@update')->middleware('auth');
Route::delete('/dashboard/server/{server}/delete', 'ServerController@destroy')->middleware('auth');
Route::post('/dashboard/server/{server}/logo', 'ServerController@storeLogo')->middleware('auth')->name('logo');

Route::get('/dashboard/admin/launcher/add', 'LauncherController@create')->middleware('auth');
Route::post('/dashboard/admin/launcher/add', 'LauncherController@store')->middleware('auth')->name('add-launcher');
Route::get('/dashboard/admin/launcher/{launcher}', 'LauncherController@show')->middleware('auth');
Route::get('/dashboard/admin/launcher/{launcher}/edit', 'LauncherController@edit')->middleware('auth');
Route::patch('/dashboard/admin/launcher/{launcher}/edit', 'LauncherController@update')->middleware('auth');
Route::delete('/dashboard/admin/launcher/{launcher}/delete', 'LauncherController@destroy')->middleware('auth');

Route::get('/dashboard/admin/server/{server}', 'ServerAdminController@show')->middleware('auth');
Route::get('/dashboard/admin/server/{server}/edit', 'ServerAdminController@edit')->middleware('auth');
Route::patch('/dashboard/admin/server/{server}/edit', 'ServerAdminController@update')->middleware('auth');
Route::delete('/dashboard/admin/server/{server}/delete', 'ServerAdminController@destroy')->middleware('auth');
Route::post('/dashboard/admin/server/{server}/logo', 'ServerAdminController@storeLogo')->middleware('auth');

Route::get('/dashboard/admin/user/add', 'UserController@create')->middleware('auth');
Route::post('/dashboard/admin/user/add', 'UserController@store')->middleware('auth')->name('add-user');
Route::get('/dashboard/admin/user/{user}', 'UserController@show')->middleware('auth');
Route::delete('/dashboard/admin/user/{user}/delete', 'UserController@destroy')->middleware('auth');

Route::get('/dashboard/player/{player}', 'PlayerController@show')->middleware('auth');
Route::get('/dashboard/player/{player}/ban', 'PlayerController@create')->middleware('auth');
Route::post('/dashboard/player/{player}/ban', 'PlayerController@store')->middleware('auth')->name('ban-player');
Route::post('/dashboard/players/{ban}/unban', 'PlayerController@unban')->middleware('auth');
Route::get('/dashboard/player/{player}/edit', 'PlayerController@edit')->middleware('auth');
Route::post('/dashboard/player/{player}/edit', 'PlayerController@editPerm')->middleware('auth')->name('edit-player');
Route::get('/dashboard/user/{player}/delete', 'PlayerController@destroyPlayer')->middleware('auth');

Route::get('/dashboard/product/add', 'ProductController@create')->middleware('auth');
Route::post('/dashboard/product/add', 'ProductController@store')->middleware('auth')->name('add-product');

Route::get('/aboutus', 'PageController@aboutIndex');

Auth::routes();
// Auth::routes(['register' => false]);
Route::patch('/dashboard/first/{user}', 'HomeController@firstLogin')->middleware('auth');

Route::get('/dashboard', 'HomeController@index')->middleware('auth')->name('dashboard');
Route::get('/where-can-i-find-my-discord-uid', 'HomeController@discorduid');
Route::get('/setup-discord-whitelist', 'HomeController@setupDiscordWhitelist');
Route::get('/setup-discord-rpc', 'HomeController@setupDiscordRpc');

Route::redirect('/discord', 'https://discord.gg/cWK4Nkkntq');
Route::redirect('bot', 'https://discord.com/oauth2/authorize?permissions=8&client_id=740640785988321301&scope=bot');