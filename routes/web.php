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

Route::prefix('admin')->namespace('Admin')->as('admin.')->middleware('auth')->group(function () {
  Route::resource('categories', 'CategoryController');
  Route::resource('blocks', 'BlockController');
  Route::resource('pages', 'PageController');
  Route::resource('fields', 'FieldController');
  Route::resource('users', 'UserController');
  Route::resource('stores', 'StoreController');
  #Route::resource('admin/contacts', 'ContactController');

  //personales
	Route::post('pages/duplicate', ['as' => 'pages.duplicate', 'uses' => 'PageController@duplicate']);
});

Auth::routes();

Route::prefix('dashboard')->namespace('Dashboard')->as('dashboard')->middleware('auth')->group(function () {
  Route::resource('stores', 'StoreController');
});

Route::get('/home', 'WebController@index')->name('home');
Route::get('/admin', function() {
	return redirect()->route('admin.pages.index');
});

Route::get('/', 'WebController@index');

Route::post('/contact', 'ContactController@store');
//mis rutas
Route::get('cat/{category}/{slug}', 'WebController@page')->where('category', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
Route::get('cat/{slug}', 'WebController@category')->where('slug', '[a-z,0-9-]+');

//Stores y landings
Route::get('{store}/{slug}', 'LandingController@show')->where('store', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
Route::get('{slug}', 'StoreController@show')->where('slug', '[a-z,0-9-]+');
