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

Route::get('/', function () {
    return view('template');
});
Route::get('/barang/{item}', 'SembakoController@index')->name('index.sembako');
Route::get('/tambah', 'SembakoController@create')->name('sembako.tambah');
Route::post('/tambah', 'SembakoController@store')->name('sembako.store');
Route::get('/sembako/edit/{id}/{item}', 'SembakoController@edit')->name('sembako.edit');
Route::match(['put', 'patch'], '/sembako/edit/{id}/{item}', 'SembakoController@update')->name('sembako.update');
Route::delete('/sembako/delete/{id}', 'SembakoController@destroy')->name('sembako.destroy');
