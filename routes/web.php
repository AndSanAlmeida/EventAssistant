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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Namespace: Admin
// Prefix: admin
// Middleware: auth e auth.admin
// Name: admin.
Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function() {
	
	// Dashboard
	Route::get('/', 'DashboardController@index')->name('dashboard');

	// Dashboard - UserController
	Route::resource('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
});

// Namespace: Public
// Prefix: public
// Middleware: auth e auth.public
// Name: public.
Route::namespace('PublicAdmin')->prefix('publicAdmin')->middleware(['auth', 'auth.public'])->name('publicAdmin.')->group(function() {
	
	// PublicDashboard
	// Route::get('/', 'DashboardController@index');

	// PublicDashboard - UserController
	Route::get('/user/{user}', 'UserController@show')->name('user.show');

	// Route::get('/edit/user', 'UserController@edit')->name('user.edit');
	// Route::patch('/edit/user', 'UserController@update')->name('user.update');
	Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
	Route::patch('/user/{user}', 'UserController@update')->name('user.update');

	Route::get('/edit/password/user', 'UserController@editPassword')->name('user.editPassword');
	Route::get('/edit/password/user', 'UserController@updatePassword')->name('user.updatePassword');
});