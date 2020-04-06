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
Route::post('/components', 'ComponentController@store')->middleware('verified', 'auth');
Route::patch('/components/{component:slug}', 'ComponentController@update')->middleware('verified', 'auth');

Route::get('/components/{component:slug}/preview', 'ComponentPreviewController@show');
