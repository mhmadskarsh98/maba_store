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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/admin/products', 'ProductController')->middleware(['auth', 'admin']);

// Route::get('/admin/products/delete/{product}', 'ProductController@destroy');
Route::get('/admin/products/delete/{id}', 'ProductController@destroy')->middleware(['auth', 'admin']);

Route::get('product/{id}', 'HomeController@show');

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('about', 'HomeController@about');

Route::resource('admin/users', 'UserController')->middleware(['auth', 'admin']);

Route::resource('/profile', 'ProfileController')->middleware('auth');
Route::resource('/cart', 'CartController')->middleware('auth');

Route::post('search', 'HomeController@search');


Route::get('pdf', 'ProductController@pdf')->middleware(['auth', 'admin']);


Route::get('admin/users/delete/{id}', 'UserController@destroy')->middleware(['auth', 'admin']);
