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

Route::get('/', 'PagesController@index');
Route::get('o-nama', 'PagesController@about');
Route::get('dizajn', 'PagesController@design');
Route::get('iskustva', 'PagesController@testimonials');
Route::get('kvalitet', 'PagesController@quality');
Route::get('press', 'PagesController@press');
Route::get('galerija', 'PagesController@gallery');

Route::get('/admin', function () {
    return view('layouts.admin-app');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('proba', 'PagesController@proba');

// filemanager
Route::middleware('auth')->get('filemanager/show', 'FilemanagerController@index');
