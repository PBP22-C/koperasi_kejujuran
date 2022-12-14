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

Route::get('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/register', 'App\Http\Controllers\AuthController@register_action');
Route::get('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/login', 'App\Http\Controllers\AuthController@login_action');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout');


// Route::get('/', 'App\Http\Controllers\MenuPenjualController@index');
Route::middleware(['auth', 'revalidate'])->group(function () {
    // Get saldo total
    Route::get('/saldo', 'App\Http\Controllers\TransaksiController@saldo');

    // Menu penjual
    Route::get('/dashboard/menu-penjual', 'App\Http\Controllers\MenuPenjualController@index');
    Route::get('/dashboard/menu-penjual/create', 'App\Http\Controllers\MenuPenjualController@create');
    Route::post('/dashboard/menu-penjual/store', 'App\Http\Controllers\MenuPenjualController@store');
    Route::get('/dashboard/menu-penjual/edit/{id}', 'App\Http\Controllers\MenuPenjualController@edit');
    Route::post('/dashboard/menu-penjual/update', 'App\Http\Controllers\MenuPenjualController@update');
    Route::get('/dashboard/menu-penjual/delete/{id}', 'App\Http\Controllers\MenuPenjualController@destroy');
    Route::get('/dashboard/menu-penjual/show', 'App\Http\Controllers\MenuPenjualController@show');

    // Menu pembeli
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
    Route::get('/dashboard/getData', 'App\Http\Controllers\DashboardController@getData');
    Route::get('/dashboard/getData/kategori/{idKategori}', 'App\Http\Controllers\DashboardController@getBarangByKategori');
    Route::get('/dashboard/getData/kategori/{idKategori}/keyword/{keyword}', 'App\Http\Controllers\DashboardController@getBarangByKeywordKategori');
    Route::get('/dashboard/getData/keyword/{keyword}', 'App\Http\Controllers\DashboardController@getBarangByKeyword');

    // Transaksi
    Route::post('/dashboard/withdraw', 'App\Http\Controllers\TransaksiWithdrawController@withdraw');
    Route::post('/dashboard/withdraw/edit', 'App\Http\Controllers\TransaksiWithdrawController@edit');
    Route::delete('/dashboard/withdraw/delete/{idTransaksi}', 'App\Http\Controllers\TransaksiWithdrawController@delete');
    Route::post('/dashboard/buy', 'App\Http\Controllers\TransaksiBeliController@store');
    Route::get('/dashboard/transaksi', 'App\Http\Controllers\TransaksiController@index');
    Route::get('/dashboard/transaksi/getData', 'App\Http\Controllers\TransaksiController@getData');

    Route::get('/name', 'App\Http\Controllers\DashboardController@getNamaUser');
});
