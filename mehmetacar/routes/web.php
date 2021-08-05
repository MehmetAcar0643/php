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
//
//Route::get('/', function () {
//    return view('welcome');
//});


Route::namespace('Admin')->group(function () {

    Route::prefix('admins')->group(function () {

        //DEFAULT
        Route::get('/', 'DefaultController@index')->name("admin.index");


        //BLOGLAR
        Route::resource('bloglar', 'BlogsController');
        Route::post('/bloglar/sortable', 'BlogsController@sortable')->name("bloglar.sortable");
        Route::post('/bloglar/status', 'BlogsController@status')->name("bloglar.status");


        //ÇALIŞMALAR
        Route::resource('calismalar', 'StudiesController');
        Route::post('/calismalar/sortable', 'StudiesController@sortable')->name("studies.sortable");
        Route::post('/calismalar/status', 'StudiesController@status')->name("studies.status");
        Route::post('/calismalar/projects_status', 'StudiesController@projects_status')->name("studies.projects_status");

        //PROJELER
        Route::resource('calismalar/{study_id}/projeler', 'ProjectsController');
        Route::post('projeler/sortable', 'ProjectsController@sortable')->name("project.sortable");
        Route::post('projeler/status', 'ProjectsController@status')->name("project.status");


        //PROJE RESİMLERİ
        Route::resource('proje/{proje_id}/resimler', 'ProjectsImagesController');
        Route::post('/resimler/sortable', 'ProjectsImagesController@sortable')->name("images.sortable");
        Route::post('resimler/status', 'ProjectsImagesController@status')->name("images.status");


    });

    Route::prefix('admins/hakkımda')->group(function () {
        Route::get('/', 'AboutController@index')->name("about.index");
        Route::post('/{id}', 'AboutController@update')->name("about.update");
    });


});




Route::namespace('Frontend')->group(function () {
    Route::get('/', 'DefaultController@index')->name("home.index");
    Route::resource('calisma', 'StudiesController');
    Route::resource('proje', 'ProjectsController');

});

