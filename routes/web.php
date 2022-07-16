<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(route('home'));
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// group route prefix admin
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    //group profile
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('user');
        Route::get('getdata', 'UserController@view_data')->name('user.getdata');
        Route::get('profile', 'UserController@profile')->name('user.profile');
        Route::post('simpan', 'UserController@simpanData')->name('user.simpan');
        Route::post('update', 'UserController@updateProfile')->name('user.update');
        Route::delete('delete', 'UserController@deleteUser')->name('user.delete');
    });
});
