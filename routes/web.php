<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index');
Route::get('/components/{component:slug}', 'ComponentController@show');
Route::get('/components/{component:slug}/edit', 'ComponentController@edit')->middleware('can:update,component');
Route::post('/components', 'ComponentController@store')->middleware('verified', 'auth');
Route::patch('/components/{component:slug}', 'ComponentController@update')->middleware('verified', 'auth');
