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

// Route::get('/', 'App\Http\Controllers\MenuPenjualController@index');
Route::get('/dashboard/menu-penjual', 'App\Http\Controllers\MenuPenjualController@index');
Route::get('/dashboard/menu-penjual/create', 'App\Http\Controllers\MenuPenjualController@create');
Route::post('/dashboard/menu-penjual/store', 'App\Http\Controllers\MenuPenjualController@store');
Route::get('/dashboard/menu-penjual/edit/{id}', 'App\Http\Controllers\MenuPenjualController@edit');
Route::post('/dashboard/menu-penjual/update', 'App\Http\Controllers\MenuPenjualController@update');
Route::get('/dashboard/menu-penjual/delete/{id}', 'App\Http\Controllers\MenuPenjualController@destroy');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
Route::get('/dashboard/getData', 'App\Http\Controllers\DashboardController@getData');
Route::post('/dashboard/buy', 'App\Http\Controllers\DashboardController@buy');