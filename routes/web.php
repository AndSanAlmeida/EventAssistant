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


// Homepage
Route::get('/', function () {
    return view('public.pages.home');
});

// Auth Routes
Auth::routes();

// Auth Google Account
Route::get('/redirect', 'Auth\LoginController@redirectToProvider')->name('redirectGoogle');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback')->name('callbackGoogle');

// Namespace: Admin
// Prefix: admin
// Middleware: auth e auth.admin
// Name: admin.
Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function()
	{

	// Dashboard
	Route::get('/', 'UserController@dashboard')->name('dashboard');

	// Dashboard - UserController
	Route::resource('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
});

// Namespace: Public
// Prefix: public
// Middleware: auth e auth.public
// Name: public.
Route::namespace('PublicAdmin')->prefix('public')->middleware(['auth', 'auth.public'])->name('public.')->group(function(){
	
	// PublicDashboard
	Route::get('/', 'UserController@dashboard')->name('dashboard');

	// PublicDashboard - UserController
	Route::get('/user/{user}', 'UserController@show')->name('user.show');

	Route::get('/edit/user', 'UserController@edit')->name('user.edit');
	Route::patch('/edit/user', 'UserController@update')->name('user.update');

	Route::get('/edit/password/user', 'UserController@passwordEdit')->name('password.edit');
	Route::post('/edit/password/user', 'UserController@passwordUpdate')->name('password.update');

	// PublicDashboard - EventController

	Route::get('/events/create', 'EventController@create')->name('events.create');
	Route::post('/events', 'EventController@store')->name('events.store');
	
	Route::get('/events/{event}', 'EventController@index')->name('events.index'); 

	Route::get('/events/{event}/edit', 'EventController@edit')->name('events.edit');
	Route::patch('/events/{event}', 'EventController@update')->name('events.update');

	Route::delete('/events/{event}', 'EventController@destroy')->name('events.destroy');

	// PublicDashboard - FileController
	Route::get('/files/createOnEvent/{event}', 'FileController@create')->name('files.create');
	Route::post('/files', 'FileController@store')->name('files.store');

	Route::get('/files/{file}/edit', 'FileController@edit')->name('files.edit');
	Route::patch('/files/{file}', 'FileController@update')->name('files.update');

	Route::delete('/files/{file}', 'FileController@destroy')->name('files.destroy');

	// PublicDashboard - LocalizationController
	Route::get('/localizations/createOnEvent/{event}', 'LocalizationController@create')->name('localizations.create');
	Route::post('/localizations', 'LocalizationController@store')->name('localizations.store');

	Route::get('/localizations/{localization}/edit', 'LocalizationController@edit')->name('localizations.edit');
	Route::patch('/localizations/{localization}', 'LocalizationController@update')->name('localizations.update');

	Route::delete('/localizations/{localization}', 'LocalizationController@destroy')->name('localizations.destroy');

	// PublicDashboard - PaymentsController 
	Route::post('/{user}/checkout', 'TransactionController@checkout')->name('transaction.checkout');
});

// Namespace: Public
// Prefix: public
// Name: public.
Route::namespace('PublicAdmin')->prefix('public')->name('public.')->group(function()
	{

	// Google Calendar 
	Route::get('/events/{id}/{slug}/addToGoogleCalendar', 'GoogleCalendarController@create')->name('googlecalendar.create');
	
	// Show Event to Public
	Route::get('/events/{id}/{slug}', 'EventController@show')->name('events.show');
});