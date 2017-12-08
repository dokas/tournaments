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

// Home
Route::name('home')->get('/', 'Front\IndexController@index');

// Profile
Route::prefix('profile')->namespace('Front')->middleware('player')->group(function() {
    Route::name('profile')->get('/', 'UserController@profile');
    Route::name('profile.settings')->get('/settings', 'UserController@settings');
    Route::name('profile.update')->put('/settings', 'UserController@update');
});

// Authentification
Auth::routes();

/*
 * Backend
 */
Route::prefix('admin')->namespace('Back')->group(function() {
    Route::middleware('author')->group(function() {
        Route::name('admin')->get('/', 'AdminController@index');
        
        // News
        Route::resource('news', 'NewsController');
    });
    
    Route::middleware('admin')->group(function() {
        Route::resource('users', 'UserController', ['only' => [
            'index', 'edit', 'update', 'destroy'
        ]]);
    });
    
});
