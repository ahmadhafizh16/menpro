<?php

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
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/jurusan', 'HomeController@jurusan')->name('manage_jurusan');
Route::get('/regis', 'HomeController@regisMhs')->name('regis');
Route::get('/uplProposal', 'HomeController@uplProposal')->name('uplProposal');
Route::get('/tahunajaran', 'HomeController@tahunAjaran')->name('tahunajaran');
Route::get('/setKelas', 'HomeController@setKelas')->name('setKelas');

Route::get('/datagen/{dataN}/{var?}', 'HomeController@dataGen')->name('dataGen');
Route::get('/orders', 'HomeController@index')->name('order');
