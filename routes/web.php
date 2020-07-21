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

Route::get('/', "HomeController@lpHome");

Route::get('/news/{id}',"HomeController@news");
Route::get('/proposalview/{id}',"HomeController@propview");

Auth::routes();
Route::post('admin-login', ['as' => 'admin-login', 'uses' => 'Auth\AdminLoginController@login']);
Route::middleware('guest')->group(function () {
    Route::get('admin-login', function(){
        return view("auth.adminLogin");
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/getIn', 'HomeController@getIn');

    Route::post("like","HomeController@like");
    Route::post("unlike","HomeController@unlike");

    Route::middleware('admin')->group(function () {
    #ROUTE GET
        Route::get('/home', 'HomeController@index')->name('dashboard');
        Route::get('/jurusan', 'HomeController@jurusan')->name('manage_jurusan');
        Route::get('/setKelas', 'HomeController@setKelas')->name('setKelas');
        Route::get('/setDosen', 'HomeController@setDosen')->name('setDosen');
        Route::get('/setUser', 'HomeController@setUser')->name('setUser');
        Route::get('/setKoor', 'HomeController@setKoor');
        Route::get('/tahunajaran', 'HomeController@tahunAjaran')->name('tahunajaran');
        
        #ROUTE ADD
        Route::post("addJurusan","AdminController@addJurusan");
        Route::post("addTAjaran","AdminController@addTAjaran");
        Route::post("addKelas","AdminController@addKelas");
        Route::post("addDosen","AdminController@addDosen");
        Route::post("addUser","AdminController@addUser");
        Route::post("addKoor","AdminController@addKoor");
        
        #ROUTE DATAGEN
        Route::get("jurusanData","AdminController@jurusanData");
        Route::get("tajaranData","AdminController@tajaranData");
        Route::get("kelasData","AdminController@kelasData");
        Route::get("dosenData","AdminController@dosenData");
        Route::get("userData","AdminController@userData");
        Route::get("koorData","AdminController@koorData");
        
        #ROUTE EDIT
        Route::post("editJurusan","AdminController@editJurusan");
        Route::post("editTAjaran","AdminController@editTAjaran");
        Route::post("editKelas","AdminController@editKelas");
        Route::post("editDosen","AdminController@editDosen");
        Route::post("editUser","AdminController@editUser");
        Route::post("editKoor","AdminController@editKoor");
        Route::post("editKoorText","AdminController@editKoorText");
        
        #ROUTE delete
        Route::post("deleteJurusan","AdminController@deleteJurusan");
        Route::post("deleteTAjaran","AdminController@deleteTAjaran");
        Route::post("deleteKelas","AdminController@deleteKelas");
        Route::post("deleteDosen","AdminController@deleteDosen");
        Route::post("deleteUser","AdminController@deleteUser");
        Route::post("deleteKoor","AdminController@deleteKoor");
        
    });
    
    Route::middleware('dosenp')->group(function () {
        Route::get('/koordb', 'KoorController@index');
        Route::get('/createPengumuman', 'KoorController@createPengumuman')->name('createPengumuman');
        
        Route::post('/addPengumuman', 'KoorController@addPengumuman');
        
        Route::post('/editPengumuman', 'KoorController@editPengumuman');
        
        Route::post('/deletePengumuman', 'KoorController@deletePengumuman');
        
        
        Route::get('/getPengumuman', 'KoorController@getPengumuman');
    });

    Route::middleware('dosen')->group(function () {
        Route::get('/dosendb', 'DosenController@index');
        Route::get('/dataKelompok', 'DosenController@dataKelompok')->name('dataKelompok');
        
        Route::post('/editKelompok', 'DosenController@editKelompok');
        
        Route::get('/getTaughClass/{id?}', 'DosenController@getTaughClass');
        Route::get('/getKelDetail/{id}', 'DosenController@getKelDetail');
    });

    Route::middleware('Mhs')->group(function () {
        Route::get('/regis', 'HomeController@regisMhs')->name('regis');
        Route::get('/uplProposal', 'HomeController@uplProposal')->name('uplProposal');
        Route::get('/uplBanner', 'HomeController@uplBanner')->name('uplBanner');


        Route::post('/addKelompok', 'HomeController@addKelompok');
        Route::post('/editKelompok', 'HomeController@editKelompok');
        Route::post('/addProposal', 'HomeController@addProposal');

        Route::post('/editProposal', 'HomeController@editProposal');
        Route::post('/uploadProp', 'HomeController@uploadProp');
        Route::post('/uploadBanner', 'HomeController@uploadBanner');
        Route::post('/uploadCanvas', 'HomeController@uploadCanvas');
        
        Route::post('/deleteProp', 'HomeController@deleteProp');
    });
    
});

#ROUTE DATA PROVIDER
Route::get('/getJurusanActive', 'AdminController@getJurusanActive');
Route::get('/getDosen', 'AdminController@getDosen');
Route::get('/getKelas', 'AdminController@getKelas');
Route::get('/getMhs', 'AdminController@getMhs');

Route::get('/proposal/{jur?}/{jenis?}/{bidang?}/{search?}', 'HomeController@proposal');


Route::get('/datagen/{dataN}/{var?}/{action?}', 'HomeController@dataGen')->name('dataGen');

