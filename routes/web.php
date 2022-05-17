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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// --------------------------frontend----------------------------------------------------
Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@about')->name('about');
// Route::get('/', 'HomeController@services')->name('services');

// Contact
// Route::get('contacts', 'HomeController@getContacts')->name('contacts');
Route::post('/', 'HomeController@sendMail')->name('contact.mail');
// --------------------------End frontend----------------------------------------------------

Route::group(['namespace' => 'Auth'], function(){
    Route::get('lawfirmfinal-login', ['as' => 'login', 'uses' => 'LoginController@login']);
    Route::post('lawfirmfinal-login', ['as' => 'auth.login', 'uses' => 'LoginController@authenticate']);
    Route::post('logout', ['as' => 'auth.logout', 'uses' => 'LoginController@logout']);
});
