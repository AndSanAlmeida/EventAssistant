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
    return view('public.pages.home');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

// Namespace: Admin
// Prefix: admin
// Middleware: auth e auth.admin
// Name: admin.
Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function() {
	
	// Dashboard
	Route::get('/', 'UserController@dashboard')->name('dashboard');

	// Dashboard - UserController
	Route::resource('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
});

// Namespace: Public
// Prefix: public
// Middleware: auth e auth.public
// Name: public.
Route::namespace('PublicAdmin')->prefix('public')->middleware(['auth', 'auth.public'])->name('public.')->group(function() {
	
	// PublicDashboard
	Route::get('/', 'UsersController@dashboard')->name('dashboard');

	// PublicDashboard - UserController
	Route::get('/user/{user}', 'UsersController@show')->name('user.show');

	Route::get('/edit/user', 'UsersController@edit')->name('user.edit');
	Route::patch('/edit/user', 'UsersController@update')->name('user.update');

	Route::get('/edit/password/user', 'UsersController@passwordEdit')->name('password.edit');
	Route::post('/edit/password/user', 'UsersController@passwordUpdate')->name('password.update');

	// PublicDashboard - EventController
	// Route::get('/event/{event}', 'EventController@show')->name('event.show'); // ESTA A GERAR ERRO NO CREATE EVENT

	Route::get('/event/create', 'EventsController@create')->name('event.create');
	Route::post('/event', 'EventsController@store')->name('event.store');

	Route::get('/edit/event', 'EventsController@edit')->name('event.edit');
	Route::patch('/edit/event', 'EventsController@update')->name('event.update');

	Route::delete('/event/{event}', 'EventsController@destroy')->name('event.destroy');

	// PublicDashboard - FileController
	Route::get('/file/{event}/create', 'FilesController@create')->name('file.create');
	Route::post('/file', 'FilesController@store')->name('file.store');
});