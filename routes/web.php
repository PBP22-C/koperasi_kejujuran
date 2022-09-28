<?php

use App\Http\Controllers\BarangController;
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

// route index check auth
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
});

Route::get('/dashboard', [BarangController::class, 'index'])->middleware('auth');
Route::get('/barang', 'App\Http\Controllers\BarangController@show');
Route::get('/barang/create', 'App\Http\Controllers\BarangController@create');
Route::post('/barang/store', 'App\Http\Controllers\BarangController@store');
Route::get('/barang/edit/{id}', 'App\Http\Controllers\BarangController@edit');
Route::post('/barang/update', 'App\Http\Controllers\BarangController@update');
Route::get('/barang/delete/{id}', 'App\Http\Controllers\BarangController@destroy');

Route::get('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/register', 'App\Http\Controllers\AuthController@register_action');
Route::get('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/login', 'App\Http\Controllers\AuthController@login_action');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout');
