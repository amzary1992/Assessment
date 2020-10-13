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
    return view('welcome');
});


Route::get('/gorest', 'GorestController@index')->name('gorest.index');
Route::post('/gorest/store', 'GorestController@store')->name('gorest.store');
Route::get('/gorest/create', 'GorestController@create')->name('gorest.create');
Route::get('/gorest/show/{id}', 'GorestController@show')->name('gorest.show');
Route::post('gorest/update', 'GorestController@update');
Route::delete('/gorest/destroy/{id}', 'GorestController@destroy')->name('gorest.destroy');
Route::get('/gorest/edit/{id}', 'GorestController@edit')->name('gorest.edit');