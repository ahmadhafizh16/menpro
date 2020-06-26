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
    return view("lpHome");
});

Route::get('/news', function () {
    return view("lpNews");
});

Auth::routes();
Route::post('admin-login', ['as' => 'admin-login', 'uses' => 'Auth\AdminLoginController@login']);
Route::middleware('guest')->group(function () {
    Route::get('admin-login', function(){
        return view("auth.adminLogin");
    });
});


Route::middleware('auth:admin')->group(function () {
    #ROUTE GET
    Route::get('/home', 'HomeController@index')->name('dashboard');
    Route::get('/jurusan', 'HomeController@jurusan')->name('manage_jurusan');
    Route::get('/setKelas', 'HomeController@setKelas')->name('setKelas');
    Route::get('/tahunajaran', 'HomeController@tahunAjaran')->name('tahunajaran');

    Route::get('/dataKelompok', 'HomeController@dataKelompok')->name('dataKelompok');
    Route::get('/dataProposal', 'HomeController@dataProposal')->name('dataProposal');
    Route::get('/createPengumuman', 'HomeController@createPengumuman')->name('createPengumuman');
    
    #ROUTE ADD
    Route::post("addJurusan","AdminController@addJurusan");
    Route::post("addTAjaran","AdminController@addTAjaran");
    Route::post("addKelas","AdminController@addKelas");
    
    #ROUTE DATAGEN
    Route::get("jurusanData","AdminController@jurusanData");
    Route::get("tajaranData","AdminController@tajaranData");
    Route::get("kelasData","AdminController@kelasData");
    
    #ROUTE EDIT
    Route::post("editJurusan","AdminController@editJurusan");
    Route::post("editTAjaran","AdminController@editTAjaran");
    Route::post("editKelas","AdminController@editKelas");
    
    #ROUTE delete
    Route::post("deleteJurusan","AdminController@deleteJurusan");
    Route::post("deleteTAjaran","AdminController@deleteTAjaran");
    Route::post("deleteKelas","AdminController@deleteKelas");
    
    
    
});

#ROUTE DATA PROVIDER
Route::get('/getJurusanActive', 'AdminController@getJurusanActive');
Route::get('/getDosen', 'AdminController@getDosen');
Route::get('/getKelas', 'AdminController@getKelas');
Route::get('/getMhs', 'AdminController@getMhs');

Route::middleware('auth:web')->group(function () {
    Route::get('/regis', 'HomeController@regisMhs')->name('regis');
    Route::get('/uplProposal', 'HomeController@uplProposal')->name('uplProposal');
    Route::get('/uplBanner', 'HomeController@uplBanner')->name('uplBanner');


    Route::post('/addKelompok', 'HomeController@addKelompok');
    Route::post('/addProposal', 'HomeController@addProposal');

    Route::post('/editProposal', 'HomeController@editProposal');
    Route::post('/uploadProp', 'HomeController@uploadProp');
    Route::post('/uploadBanner', 'HomeController@uploadBanner');
    
    Route::post('/deleteProp', 'HomeController@deleteProp');
});

Route::get('/l', 'HomeController@index')->name('home');


Route::get('/datagen/{dataN}/{var?}/{action?}', 'HomeController@dataGen')->name('dataGen');
Route::get('/orders', 'HomeController@index')->name('order');

