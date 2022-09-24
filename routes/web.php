<?php

use App\Http\Controllers\BarangController;
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

Route::get('/', 'App\Http\Controllers\BarangController@index');
Route::get('/barang', 'App\Http\Controllers\BarangController@show');
Route::get('/barang/create', 'App\Http\Controllers\BarangController@create');
Route::post('/barang/store', 'App\Http\Controllers\BarangController@store');
Route::get('/barang/edit/{id}', 'App\Http\Controllers\BarangController@edit');
Route::post('/barang/update', 'App\Http\Controllers\BarangController@update');
Route::get('/barang/delete/{id}', 'App\Http\Controllers\BarangController@destroy');
