<?php

use Illuminate\Support\Facades\Route;
use App\Mail\NewUserWelcomeMail;

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



Auth::routes();

//Follow RESTful Controllers in Laravel Documentation

Route::get('/email', function(){
	return new NewUserWelcomeMail();
});

Route::get('/', 'PostsController@index');

Route::post('/follow/{user}','FollowsController@store');

// IN ROUTES THE ORDER MATTER
// RENDER A VIEW TO CREATE A NEW POST
Route::get('/p/create', 'PostsController@create');

// POST OUR NEW POST
Route::post('/p', 'PostsController@store');

// RENDER A VIEW TO SHOW A SPECIFIC POST
Route::get('/p/{post}', 'PostsController@show');

Route::get('/profiles', 'ProfilesController@index')->name('profile.index');

Route::get('/profile/{user}', 'ProfilesController@show')->name('profile.show');

// EDIT THE PROFILE
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');

// UPDATE PROFILE
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

