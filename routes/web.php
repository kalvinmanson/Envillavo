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

//Login
Auth::routes();
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'WebController@index')->name('home');
Route::get('/admin', function() {
	return redirect()->route('admin.pages.index');
});

Route::get('/', 'WebController@index');

//mis rutas
Route::get('cat/{category}/{slug}', 'WebController@page')->where('category', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
Route::get('cat/{slug}', 'WebController@category')->where('slug', '[a-z,0-9-]+');

//chat
Route::get('/chats/{record_id}/{last}', 'ChatController@fetch')->where('record_id', '[0-9]+')->where('last', '[0-9]+');
Route::post('/chats/{record_id}', 'ChatController@send')->where('record_id', '[0-9]+');

//records
Route::post('/record', 'RecordController@store');



//Stores y landings
Route::get('/buscar', 'StoreController@index');
Route::get('/stores/create', 'StoreController@create')->middleware('auth');
Route::post('/stores', 'StoreController@store')->middleware('auth');
Route::get('{slug}/edit', 'StoreController@edit')->where('slug', '[a-z,0-9-]+');
Route::post('{slug}/update', 'StoreController@update')->where('slug', '[a-z,0-9-]+');
Route::get('{store}/{slug}', 'LandingController@show')->where('store', '[a-z,0-9-]+')->where('slug', '[a-z,0-9-]+');
Route::get('{slug}', 'StoreController@show')->where('slug', '[a-z,0-9-]+');
