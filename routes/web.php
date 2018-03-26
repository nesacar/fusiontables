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

//Route::get('/', 'PagesController@index');
//Route::get('o-nama', 'PagesController@about');
//Route::get('dizajn', 'PagesController@design');
//Route::get('iskustva', 'PagesController@testimonials');
//Route::get('kvalitet', 'PagesController@quality');
//Route::get('press', 'PagesController@press');
//Route::get('galerija', 'PagesController@gallery');
//Route::get('kontakt', 'PagesController@contact');
//Route::post('kontakt', 'PagesController@contactForm');
//
//Route::get('kolekcije', 'PagesController@collections');
//Route::get('kolekcije/{slug}', 'PagesController@collections2');
//
//Route::get('{collection}/{product}/{id}', 'PagesController@product');

Route::get('/admin', function () {
    return view('layouts.admin-app');
});

Auth::routes();

Route::post('kontakt', 'PagesController@contactForm');
Route::get('proba', 'PagesController@proba');

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('proba', 'PagesController@proba');

// filemanager
Route::middleware('auth')->get('filemanager/show', 'FilemanagerController@index');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function() {
        Route::get('/', 'PagesController@index');

        Route::get('o-nama', 'PagesController@about');
        Route::get('about-us', 'PagesController@about');

        Route::get('dizajn', 'PagesController@design');
        Route::get('design', 'PagesController@design');

        Route::get('iskustva', 'PagesController@testimonials');
        Route::get('testimonials', 'PagesController@testimonials');

        Route::get('kvalitet', 'PagesController@quality');
        Route::get('quality', 'PagesController@quality');

        Route::get('press', 'PagesController@press');

        Route::get('galerija', 'PagesController@gallery');
        Route::get('gallery', 'PagesController@gallery');

        Route::get('kontakt', 'PagesController@contact');
        Route::get('contact', 'PagesController@contact');

        Route::get('kolekcije', 'PagesController@collections');
        Route::get('collections', 'PagesController@collections');

        Route::get('kolekcije/{slug}', 'PagesController@collections2');
        Route::get('collections/{slug}', 'PagesController@collections2');

        Route::get('{collection}/{product}/{id}', 'PagesController@product');
    }
);
